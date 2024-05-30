<?php

namespace App\Http\Controllers;

use App\Models\CountryCurrencies;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserInfo;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Exception;
use Illuminate\Support\Facades\Validator;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Arr;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    function __construct()
    {
        $this->userimagepath = 'backend/assets/images/users/';
        $this->middleware('permission:User-Create|User-Edit|User-View|User-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:User-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:User-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:User-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $user = User::whereHas('roles', function ($query) {
                return $query->where('name','!=', 'Customer');
            })->get();
            return DataTables::of($user)
                ->addColumn('action', function ($row) {

                    $html = ' <a href="#" class="btn btn-primary viewModal"  data-bs-toggle="modal" data-bs-target=".userDetailsModal" data-id="' . $row->id . '"><i title="View" class="fas fa-eye"></i></a>&nbsp';


                    $html .= '<a href="' . route('user.edit', $row->id) . '"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp';

                    if (Auth::user()->can('User-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })
                ->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })
                ->addColumn('roles', function (User $User) {
                    if ($User->Roles->first()) {
                        return '<span class="badge badge-pill badge-soft-success font-size-12 ">'. (!empty($User->Roles->first()->name) ? $User->Roles->first()->name : '-') .'</span>';
                    } else {

                        return '-';
                    }
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('created_by_name', function ($row) {


                    return $row->createdBy()->first();
                })
                ->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="user_status" switch="bool" data-id="' . $row->id . '" value="' . ($row->status == 1 ? "1" : "0") . '" ' . ($row->status == 1 ? "checked" : "") . '/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                    return $btn;
                })->rawColumns(['action', 'roles', 'image', 'created_at', 'status', 'created_by_name'])->make(true);
        }
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.list', compact('roles'));
    }

    public function form(Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();
        $country = CountryCurrencies::all();
        return view('admin.users.add', ['roles' => $roles, 'country' => $country]);
    }

    public function store(Request $request)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'roles' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'address' => 'required',
            'phone_number' => 'required',
            'company_name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
        ],
        [
            'key_name.without_spaces' => 'Whitespace not allowed.'
        ]);

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->company_name = $request->company_name;
        $user->address = $request->address;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->country = $request->country;
        $user->created_at = Carbon::now();
        $user->created_by = Auth::user()->id;
        $user->password = Hash::make($request->password);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->userimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->userimagepath . $imagename;
            $user->image = $imagename;
        }
        $user->user_target = $request->sale_target;


        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');
        if($user->save())
        {
            if (!empty($request->alias_name)) {
                $alias_name = UserInfo::where('user_id' , $request->id)->where("key_name", '=', "alias_name")->with('userInfos')->first();

                if ($alias_name) {
                    $alias_name = UserInfo::find($alias_name->id);
                    $alias_name->key_name = 'alias_name';
                    $alias_name->user_id = $user->id;
                    $alias_name->key_value = $request->alias_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Alias Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $alias_name = new UserInfo();
                    $alias_name->key_name = 'alias_name';
                    $alias_name->user_id = $user->id;
                    $alias_name->key_value = $request->alias_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Alias Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }
            if (!empty($request->alias_email)) {
                $alias_email = UserInfo::where('user_id' , $request->id)->where("key_name", '=', "alias_email")->with('userInfos')->first();

                if ($alias_email) {
                    $alias_email = UserInfo::find($alias_email->id);
                    $alias_email->key_name = 'alias_email';
                    $alias_email->user_id = $user->id;
                    $alias_email->key_value = $request->alias_email;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_email->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Alias Email",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $alias_email = new UserInfo();
                    $alias_email->key_name = 'alias_email';
                    $alias_email->user_id = $user->id;
                    $alias_email->key_value = $request->alias_email;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_email->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Alias Email",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }
            $additional_data = new UserInfo();
            $additional_data->key_name = 'additional_data';
            $detailarray = array_values($request->outergroup);
            $additional_data->key_value = json_encode($detailarray);
            $additional_data->user_id = $user->id;
            $additional_data->save();




        }


        $notify = array(
            "performed_by" => Auth::user()->id,
            "title" => "Added Key Name",
            "desc" => array(
                "added_title" => $request->key_name,
            )
        );
        Notification::send($management, new QuickNotify($notify));

        $user->assignRole($request->roles);
        return redirect()->route('user.list')->with('success', 'User has been, Added Successfully.');
    }

    public function edit(Request $request, $id)
    {
        $countries = CountryCurrencies::all();
        $roles = Role::get();
        // $user_additional_records = UserInfo::where('user_id',$id)->whereIn('key_name', ['alias_name', 'alias_email'])->first();
        $user_additional_records = UserInfo::where('user_id',$id)->where('key_name', 'additional_data')->orderBy('id','desc')->first();
        $alias_name  = UserInfo::where('user_id',$id)->where("key_name", '=', "alias_name")->with('userInfos')->first();
        $alias_email = UserInfo::where('user_id',$id)->where("key_name", '=', "alias_email")->with('userInfos')->first();



        $data['roles'] = '<option selected disabled value="">data</option>';
        $editUser  = User::where("id", $id)->first();
        return view('admin.users.edit', compact('editUser', 'roles','user_additional_records','alias_name','alias_email','countries'));
    }
    public function view(Request $request)
    {
        $rolessel = Role::all();
        $data['roles'] = '<option selected disabled value="">data</option>';
        $role = DB::table('roles')->select('name', 'id')->where('id', $request->id)->get();
        $data['user'] = User::find($request->id);
        $data['roles'] = Role::pluck('name', 'name')->all();
        $data['rolessel'] = $rolessel;

        $data['created_by'] = $data['user']->createdBy()->first()->first_name;
        $data['created_at']= Carbon::parse($data['user']->created_at)->diffForHumans();

        if($data['user']->updated_by != NULL){
            $data['updated_by'] = User::where('id',$data['user']->updated_by)->first()->first_name;
        } else {
            $data['updated_by'] = "";
        }

        $data['updated_at']= Carbon::parse($data['user']->updated_at)->diffForHumans();
        // $data['userRole'] = $data['user']->roles->pluck('name','name')->all();

        return Response()->json($data);
        // return view('user.userform',compact('user','roles','userRole'));
    }
    public function update(Request $request)
    {
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/ ^\S*$/u', $value);
        });

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'roles' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($request->id)
            ],
            'address' => 'required',
            'company_name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'zipcode' => 'required',
            'country' => 'required',
        ],
        [
            'key_name.without_spaces' => 'Whitespace not allowed.'
        ]);

        $user = User::find($request->id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->company_name = $request->company_name;
        $user->address = $request->address;
        $user->city = $request->city;
        $user->zipcode = $request->zipcode;
        $user->country = $request->country;
        $user->state = $request->state;
        $user->updated_at = Carbon::now();

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->userimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->userimagepath . $imagename;
            $user->image = $imagename;
        }
        $user->user_target = $request->sale_target;
        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');

        if($user->save()){

            if ($request->alias_name) {
                $alias_name = UserInfo::where('user_id' , $request->id)->where("key_name", '=', "alias_name")->with('userInfos')->first();

                if ($alias_name) {
                    $alias_name = UserInfo::find($alias_name->id);
                    $alias_name->key_name = 'alias_name';
                    $alias_name->user_id = $user->id;
                    $alias_name->key_value = $request->alias_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Alias Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $alias_name = new UserInfo();
                    $alias_name->key_name = 'alias_name';
                    $alias_name->user_id = $user->id;
                    $alias_name->key_value = $request->alias_name;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_name->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Alias Name",
                        "desc" => array(
                            "added_title" => $request->input('key_value'),
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                }
            }

            if ($request->alias_email) {
                $alias_email = UserInfo::where('user_id' , $request->id)->where("key_name", '=', "alias_email")->with('userInfos')->first();

                if ($alias_email) {
                    Log::info('if alias email performed');
                    $alias_email = UserInfo::find($alias_email->id);
                    $alias_email->key_name = 'alias_email';
                    $alias_email->user_id = $user->id;
                    $alias_email->key_value = $request->alias_email;
                    $management = User::role(['Admin', 'Brand Manager'])->get();
                    $management->pluck('id');
                    $alias_email->save();

                    $notify = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Updated Alias Name",
                        "desc" => array(
                            "added_title" => $request->alias_email,
                        )
                    );
                    Notification::send($management, new QuickNotify($notify));
                } else {
                    $alias_email2 = new UserInfo();
                    $alias_email2->key_name = 'alias_email';
                    $alias_email2->user_id = $user->id;
                    $alias_email2->key_value = $request->alias_email;
                    $management2 = User::role(['Admin', 'Brand Manager'])->get();
                    $management2->pluck('id');
                    try{
                        $t = $alias_email2->save();
                        Log::info($t);
                    }
                    catch(Exception $e){
                        Log::info($e->getMessage());
                        Log::info("Exception");
                    }

                    Log::info($alias_email2);


                    $notify2 = array(
                        "performed_by" => Auth::user()->id,
                        "title" => "Added Alias Name",
                        "desc" => array(
                            "added_title" => $request->alias_email,
                        )
                    );
                    Notification::send($management2, new QuickNotify($notify2));
                }
            }


        }
        $user_additional_data = UserInfo::where('user_id' , $request->id)->where('key_name', 'additional_data')->orderBy('id','desc')->first();
        if($user_additional_data){
            $additional_data = UserInfo::find($user_additional_data->id);
            $additional_data->key_name = 'additional_data';
            $detailarray = array_values($request->outergroup);
            $additional_data->key_value = json_encode($detailarray);
            $additional_data->save();
            $notify = array(
             "performed_by" => Auth::user()->id,
             "title" => "Updated User Info",
             "desc" => array(
                "added_title" => $request->key_name,
             )
            );
        } else{
            $additional_data = new UserInfo();
            $additional_data->key_name = 'additional_data';
            $detailarray = array_values($request->outergroup);
            $additional_data->key_value = json_encode($detailarray);
            $additional_data->user_id = $user->id;
            $additional_data->save();
            $notify = array(
             "performed_by" => Auth::user()->id,
             "title" => "Added User Info",
             "desc" => array(
                "added_title" => $request->key_name,
             )
            );
        }
        Notification::send($management, new QuickNotify($notify));



        Session::flash('success', 'User has been, Updated Successfully.');
        DB::table('model_has_roles')->where('model_id', $request->id)->delete();
        $user->assignRole($request->roles);
        return redirect()->route('user.list');

    }
    public function delete(Request $request)
    {
        $user = User::find($request->id);
        $response = array(
            "success" => true,
            "message" => "User Deleted Successfully!"
        );

        if (!$user->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Deleted User!";
        }

        return response()->json($response);
    }
    public function destroy(Request $request)
    {

        $user = User::withTrashed()->find($request->id);
        // dd($user);
        if ($user->forceDelete()) {

            $notification['type'] = "success";
            $notification['message'] = "User Destroyed Successfuly!.";
            $notification['icon'] = 'mdi-check-all';
            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Delete user, please try again.";
            $notification['icon'] = 'mdi-block-helper';
            echo json_encode($notification);
        }
    }
    public function trashed(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        if ($request->ajax()) {
            $data = User::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="restore btn btn-xs  btn-success btn-restore" data-id="' . $row->id . '"><i title="Restore" class="fas fa-trash-restore-alt"></i></a>&nbsp';
                    $btn .= '<a data-id="' . $row->id . '" class="btn btn-xs  btn-danger btn-destroy" ><i title="destroy" class="far fa-trash-alt"></i></a>&nbsp';

                    return $btn;
                })->editColumn('roles', function (User $User) {
                    if ($User->Roles->first()) {
                        return ($User->Roles->first()) ? $User->Roles->first()->name : '-';
                    } else {
                        return '-';
                    }
                })->addColumn('image', function ($row) {

                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })
                ->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })

                ->rawColumns(['action', 'role', 'image', 'deleted_at'])
                ->make(true);
        }
        $roles = Role::pluck('name', 'name')->all();
        return view('admin.users.trash', compact('roles'));
    }
    public function restore(Request $request)
    {
        $user = User::withTrashed()->find($request->id);
        if ($user) {
            $user->restore();
            $notification['type'] = "success";
            $notification['message'] = "User Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore User, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
    function status(Request $request, $id)
    {
        $user = User::find($id);
        $user->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if ($user->save()) {
            $response["success"] = true;
            $response["message"] = "User Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update User Status!";
        }

        return response()->json($response);
    }


    // OLD CODE

    // public function permission_update(Request $request, $id)
    // {

    //     $this->validate($request, [
    //         // 'first_name' => 'required',
    //     ]);
    //     $user = User::find($request->user_id);
    //     $userPermissions = $user->getDirectPermissions();
    //     $user->first_name = $request->user_name;
    //     $user->revokePermissionTo($userPermissions);
    //     $user->save();
    //     $user->syncPermissions($request->permission);
    //     return redirect()->back()->with('message', 'Permission  has been, Updated Successfully.');
    // }
    public function userProfile_form(Request $request)
    {
        $roles = Role::pluck('name', 'name')->all();
        $user = User::find(auth()->user()->id);
        return view('admin.users.userprofile', ['roles' => $roles]);
    }
    public function userProfile_update(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $request->id,
            'current_password' => ['nullable'],
            'new_password' => ['nullable'],
            'new_confirm_password' => ['same:new_password'],

            // 'roles' => 'required'
        ]);

        $user = User::find($request->id);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->address = $request->address;
        $user->state = $request->state;
        $old_password = $request->current_password;
        if (Hash::check($old_password, $user->password)) {
            $newpassword = $request->new_password;
            $user->update(['password' => Hash::make($newpassword)]);

            $user->save();
            // DB::table('model_has_roles')->where('model_id',$request->id)->delete();
            // $user->assignRole($request->roles);
            return redirect()->back()->with('success', 'User Profile  has been successfully Update.');
        } else {

            session()->flash('error', 'Current password doesnt matched ');
            return redirect()->back();
        }
    }

    // public function updateStatus(Request $request)
    // {
    //     $update = User::where('id', $request->id)->update(['status' => $request->status]);
    //     if ($update) {
    //         $request->status == 1 ? $alertType = 'success' : $alertType = 'danger';
    //         $request->status == 1 ? $message = 'User Activated Successfuly!' : $message = 'User Deactivated Successfuly!';

    //         $notification = array(
    //             'message' => $message,
    //             'type' => $alertType,
    //             'icon' => 'mdi-check-all'
    //         );
    //     } else {
    //         $notification = array(
    //             'message' => 'Some Error Occured, Try Again!',
    //             'type' => 'error',
    //             'icon'  => 'mdi-block-helper'
    //         );
    //     }

    //     echo json_encode($notification);
    // }
    // public function details(Request $request, $id)
    // {
    //     $user = User::find($id);

    //     $permission = Permission::all();
    //     $userRole = DB::table("model_has_roles")->where("model_id", $id)->select('role_id')->first();
    //     $rolePermissions = DB::table("model_has_permissions")->where("model_id", $id)->pluck('permission_id')->toArray();
    //     // $rolePermissions = DB::table("role_has_permissions")->where("role_id",$userRole->role_id)->pluck('permission_id')->toArray();
    //     $role = DB::table("roles")->where("id", $userRole->role_id)->select('name', 'id')->first();
    //     $userPermission = $user->getDirectPermissions();
    //     // dd($userPermission1);
    //     // $userPermission = new Collection($userPermission1);
    //     // $userPermission->contains($userPermission1);
    //     return view('admin.users.additionalpermission', compact('permission', 'rolePermissions', 'role', 'userPermission', 'user'));
}
