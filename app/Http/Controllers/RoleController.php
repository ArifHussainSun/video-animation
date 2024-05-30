<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        // $this->middleware('auth');
        $this->middleware('permission:Role-Create|Role-Edit|Role-View|Role-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Role-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:Role-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Role-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $roles = Role::orderBy('id', 'DESC')->paginate(5);
        if ($request->ajax()) {
            $roles = Role::all();
            return DataTables::of($roles)
                ->addColumn('action', function ($row) {
                    // $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Role-Edit')) {
                        $html = '<a href="#"  class="btn btn-success btn-edit" data-id="'.$row->id.'"><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Role-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="role_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','created_at','status'])->make(true);
        }
        $permission = Permission::get();
        return view('admin.roles.list', compact('permission'));
    }

    public function trashed(Request $request){
        if ($request->ajax()) {
            $roles = Role::onlyTrashed()->get();
            return DataTables::of($roles)
                ->addColumn('action', function ($row) {
                    // $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Role-Edit')) {
                        $html = '<a href="'.route('role.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Role-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="role_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','deleted_at','status'])->make(true);
        }
        $permission = Permission::get();
        return view('admin.roles.trashed', compact('permission'));
    }

    public function form()
    {
        $permission = Permission::get();
        return view('admin.roles.add', compact('permission'));
    }

    public function edit(Request $request)
    {
        $data['role'] = Role::find($request->id);
        $data['permission'] = Permission::all();
        $data['rolePermissions'] = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$request->id)
        ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
        ->all();
        $previous_permission="";
        $module = array();
        $datapush[]= "";
        $getPermissions = array();
        foreach($data['permission'] as $value)
        {
            $permission_name = explode( "-", $value->name);
            $module_name = $permission_name[0];
            if($module_name==$previous_permission){
                $module[$module_name][] = $permission_name[1];
            } else{
                $previous_permission = $permission_name[0];
                $module[$module_name][] = $permission_name[1];
            }
            $getPermissions[] = $value->id;
        }
        $module_wise_permission[] = $module;
        $upt_module =   array_keys($module);
        $i=0;
        $html = '';
        foreach($module as $key=>$mod){
            $html .= '<tr>';
            $html .= '<td>'.$key.'</td>';
            foreach($mod as $per){
                $html .= '<td><input type="checkbox" name="permission[]" value="'.$data['permission'][$i]->name.'" '.(in_array($data['permission'][$i]->id, $data['rolePermissions']) ? 'checked' : '').'/>&nbsp'.$per.'</td>';
                $i++;
            }
            $html .= '</tr>';
        }
        $data['html'] = $html;
        return $data;
    }

    public function view(Request $request)
    {
        $permission = Permission::all();
        $role = Role::find($request->id);
        $role['permission'] = $permission;
        return Response()->json($role);
    }

    public function delete(Request $request)
    {
        $role = Role::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Role Destroy Successfully!"
        );

        if(!$role->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Role!";
        }

        return response()->json($response);
    }

    public function restore(Request $request ,$id)
    {
        $role = Role::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Role Restored Successfully!"
        );

        if(!$role->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Role!";
        }

        return redirect()->route('role.list')->with($response);
    }

    function status(Request $request, $id,$isType=null) {

        $role = Role::find($id);
        $role->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($role->save()) {
            $response["success"] = true;
            $response["message"] = "Role Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Role Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);
        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');
        $data = array(
            "success"=> true,
            "message" => "Role Updated Successfully"
        );
        if($role = Role::create(['name' => $request->input('name')])){

            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Added New Role",
                "desc" => array(
                    "added_title" => $request->name,
                )
            );
            Notification::send($management, new QuickNotify($notify));
            $role->syncPermissions($request->input('permission'));

        }else {
            $data["success"] = false;
            $data["message"] = "Role Not Added Successfully.";

            Session::flash('error', $data["message"]);
        }

        return redirect()->route('role.list')->with($data);


    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);
        $role = Role::find($request->id);
        $role->name = $request->name;
        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');
        $data = array(
            "success"=> true,
            "message" => "Role Updated Successfully"
        );
        if($role->save()){

            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Added New Role",
                "desc" => array(
                    "added_title" => $request->name,
                )
            );
            Notification::send($management, new QuickNotify($notify));
            $role->syncPermissions($request->input('permission'));

        }else {
            $data["success"] = false;
            $data["message"] = "Role Not Updated Successfully.";

            Session::flash('error', $data["message"]);
        }

        return redirect()->route('role.list')->with($data);

    }

    public function destroy(Request $request)
    {
        $Role = Role::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Role Destroy Successfully!"
        );

        if(!$Role->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Role!";
        }

        return response()->json($response);
    }
}
