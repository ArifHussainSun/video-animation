<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    /**
     * create a new instance of the class
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('permission:Permission-Create|Permission-Edit|Permission-View|Permission-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Permission-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:Permission-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Permission-Delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $permission = Permission::orderBy('id','DESC')->get();

            return DataTables::of($permission)
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Permission-Edit')) {
                        $html .= '<a href="'.route('permission.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Permission-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="permission_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','created_at','status'])->make(true);

        }

        return view('admin.permissions.list');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $permission = Permission::onlyTrashed();

            return DataTables::of($permission)
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Permission-Edit')) {
                        $html .= '<a href="'.route('permission.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Permission-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="permission_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action','deleted_at','status'])->make(true);

        }

        return view('admin.permissions.trashed');
    }


    public function form()
    {
        return view('admin.permissions.add');
    }

    public function edit(Request $request,$id)
    {
        $permission = Permission::find($id);

        return view('admin.permissions.edit',compact('permission'));
    }

    public function view(Request $request, $isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null) {
            $permissions = Permission::onlyTrashed()->where($where)->first();
        } else {
            $permissions = Permission::where($where)->first();
        }

        return Response::json($permissions);
    }

    public function delete(Request $request)
    {
        $permission = Permission::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Permission Destroy Successfully!"
        );

        if(!$permission->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Permission!";
        }

        return response()->json($response);
    }

    public function restore(Request $request ,$id)
    {
        $permission = Permission::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Permission Restored Successfully!"
        );

        if(!$permission->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Permission!";
        }

        return redirect()->route('permission.list')->with($response);
    }

    function status(Request $request, $id,$isType=null) {

        $permission = Permission::find($id);
        $permission->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($permission->save()) {
            $response["success"] = true;
            $response["message"] = "Permission Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Permission Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:permissions,name',
        ]);

        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');
        $data = array(
            "success"=> true,
            "message" => "Permissions Updated Successfully"
        );
        if(Permission::create(['name' => $request->input('name')])) {
            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Permissions Updated Successfully",
                "desc" => array(
                    "added_title" => $request->input('name')
                )
            );
            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);
        } else {
            $data["success"] = false;
            $data["message"] = "Permissions Not Added Successfully.";

            Session::flash('error', $data["message"]);
        }

        return redirect()->route('permission.list')->with($data);
    }


    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $permission = Permission::find($request->id);
        $permission->name = $request->input('name');
        $management = User::role(['Admin', 'Brand Manager'])->get();
        $management->pluck('id');
        $permission->save();
        $data = array(
            "success"=> true,
            "message" => "Updated Updated Successfully"
        );
        if($permission->save()) {
            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Permissions Updated Successfully",
                "desc" => array(
                    "added_title" => $request->input('name')
                )
            );
            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);
        } else {
            $data["success"] = false;
            $data["message"] = "Permissions Not Updated Successfully.";

            Session::flash('error', $data["message"]);
        }

        return redirect()->route('permission.list')->with($data);
    }

    public function destroy(Request $request)
    {
        $permission = Permission::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Permission Destroy Successfully!"
        );

        if(!$permission->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Permission!";
        }

        return response()->json($response);
    }
}
