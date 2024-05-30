<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\Service;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Str;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ServiceController extends Controller
{
    function __construct()
    {
        $this->serviceimagepath = 'backend/assets/images/service/img/';
        $this->serviceiconimagepath = 'backend/assets/images/service/icon/';
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $service = Service::all();
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary viewModal" data-bs-toggle="modal" data-bs-target=".servicedetailsModal" data-id="' . $row->id . '"><i class="far fa-eye"></i></a>&nbsp';
                    if (Auth::user()->can('Service-Edit')) {
                        $html .= '<a href="'.route('service.edit',$row->id).'"  class="btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Service-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        $btn0 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="service_status" switch="bool" data-id="' . $row->id . '" value="0"/><label class="switch2" for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn0;
                    } elseif ($row->status == 1) {
                        $btn1 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="service_status" switch="bool" data-id="' . $row->id . '" value="1" checked/><label class="switch2" for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn1;
                    }
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })
                ->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status', 'created_at', 'image'])->make(true);
        }

        return view('admin.service.list');
    }

    public function form()
    {
        return view('admin.service.add');
    }

    public function store(Request $request)
    {

        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'icon' => 'nullable',
            'metatitle' => 'nullable',
            'metadesc' => 'nullable',
            'metakeyword' => 'nullable',
        ]);
        if ($valid) {
            $service = new Service();
            $service->name = $request->name;
            $service->title = $request->title;
            $service->description = strip_tags($request->description);
            $service->metatitle = $request->metatitle;
            $service->metadesc = $request->metadesc;
            $service->metakeyword  = $request->metakeyword;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->serviceimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->serviceimagepath . $imagename;
                $service->image = $imagename;
            }
            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->serviceiconimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->serviceiconimagepath . $imagename;
                $service->icon = $imagename;
            }
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Service Added Successfully"
            );
            if($service->save()){
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Service",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->message,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Failed to add Service";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('service.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {

        $where = array('id' => $request->id);
        $service  = Service::where($where)->first();
        return view('admin.service.edit' , compact('service'));
    }
    public function view(Request $request , $isTrashed=null)
    {


        // $service = Service::find($id);
        // if(!$service){
        //     abort(404);
        // }

        // $data['service'] = $service;

        // $data['servicenames'] = Service::where('id',$service->id)->with('createdBy')->first();
        // // $data['created_by'] = $data['service']->createdBy()->first()->first_name;
        // $data['created_at']= Carbon::parse($data['service']->created_at)->diffForHumans();
        // if($data['service']->updated_by != NULL){

        //     $data['updated_by'] = User::where('id',$data['service']->updated_by)->first()->first_name;
        // }
        // else{
        //     $data['updated_by'] = "";
        // }
        // $data['updated_at']= Carbon::parse($data['service']->updated_at)->diffForHumans();
        // return $data;

        $where = array('id' => $request->id);

        if($isTrashed!=null && $isTrashed == 'yes') {
            $service = Service::onlyTrashed()->where($where)->with('createdBy')->first();
        } else {
            $service = Service::where($where)->with('createdBy')->first();
        }

        return Response::json($service);

    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',
            'image' => 'nullable',
            'icon' => 'nullable',
            'metatitle' => 'nullable',
            'metadesc' => 'nullable',
            'metakeyword' => 'nullable',
        ]);

        if ($valid) {
            $service = Service::find($request->id);
            $service->name = $request->name;
            $service->title = $request->title;
            $service->description = strip_tags($request->description);
            $service->metatitle = $request->metatitle;
            $service->metadesc = $request->metadesc;
            $service->metakeyword  = $request->metakeyword;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->serviceimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->serviceimagepath . $imagename;
                $service->image = $imagename;
            }
            if ($request->hasFile('icon')) {
                $image = $request->file('icon');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->serviceiconimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->serviceiconimagepath . $imagename;
                $service->icon = $imagename;
            }
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Service Updated Successfully"
            );
            if($service->save()){
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Updated New Service",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->message,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Failed to update Service";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('service.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {

        $service = Service::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Service Deleted Successfully!"
        );

        if(!$service->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Service!";
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $service = Service::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Service Destroy Successfully!"
        );

        if(!$service->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Service!";
        }

        return response()->json($response);
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $service = Service::onlyTrashed();
            return DataTables::of($service)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary viewModal" data-bs-toggle="modal" data-bs-target=".servicedetailsModal" data-id="' . $row->id . '"><i class="far fa-eye"></i></a>&nbsp';
                    if (Auth::user()->can('Service-Edit')) {
                        $html .= '<a href="'.route('service.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Service-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="service_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status','image','deleted_at'])->make(true);
        }

        return view('admin.service.trashed');
    }

    public function restore(Request $request ,$id)
    {
        $service = Service::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Service Restored Successfully!"
        );

        if(!$service->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Service!";
        }

        return redirect()->route('service.list')->with($response);
    }


    function status(Request $request, $id)
     {
        $banner = Service::find($id);
        $banner->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($banner->save()) {
            $response["success"] = true;
            $response["message"] = "Service Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update Service Status!";
        }

        return response()->json($response);
    }
}
