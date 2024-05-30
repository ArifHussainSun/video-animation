<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    function __construct()
    {
        $this->bannersimagepath = 'backend/assets/images/banners/';
        // $this->middleware('permission:banner-Create|subcategories-Edit|subcategories-View|subcategories-Delete', ['only' => ['index','store']]);
        // $this->middleware('permission:subcategories-Create', ['only' => ['form','store']]);
        // $this->middleware('permission:subcategories-Edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:subcategories-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $banner = Banner::all();
            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp';
                    $html .= '<a href="'.route('banner.edit',$row->id).'"  class="btn btn-success btn-edit"><i class="fas fa-edit"></i></a>&nbsp';
                    $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="banner_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if($row->image){
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    }else{
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status', 'image','created_at'])->make(true);
        }

        return view('admin.banners.list');
    }

    public function trashed(Request $request){
        if ($request->ajax()) {
            $banner = Banner::onlyTrashed();
            return DataTables::of($banner)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp';
                    $html .= '<a href="'.route('banner.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="banner_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if($row->image){
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    }else{
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status', 'image','deleted_at'])->make(true);
        }

        return view('admin.banners.trashed');
    }

    public function form($id = 0)
    {
        $pages = Pages::all();
        $banner = Banner::all();
        return view('admin.banners.add', compact('banner','pages'));
    }

    function status(Request $request, $id,$isType=null) {

        $banner = Banner::find($id);
        $banner->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($banner->save()) {
            $response["success"] = true;
            $response["message"] = "Banner Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Banner Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'heading_one' => 'required',
            'heading_two' => 'required',
        ]);

        if ($valid) {
            $banner = new Banner();
            $banner->heading_one = $request->input('heading_one');
            $banner->heading_two = $request->input('heading_two');
            $banner->description = $request->input('description');
            $banner->btn_title = $request->input('btn_title');
            $banner->btn_link = $request->input('btn_link');
            $banner->page = $request->input('page');
            $banner->btn_title = $request->input('btn_title');

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->bannersimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->bannersimagepath . $imagename;
                $banner->image = $imagename;
            }
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Banner Added Successfully."
            );

            if ($banner->save()) {

                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Banner New Payment",
                    "desc" => array(
                       "added_title" => $request->input('heading_one'),
                       "added_description" => $request->description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);

            }else {
                $data["success"] = false;
                $data["message"] = "Banner Not Added Successfully.";

                Session::flash('error', $data["message"]);
            }

            return redirect()->route('banner.list')->with($data);
        } else {
            return redirect()->back();
        }
    }


    public function edit(Request $request,$id)
    {
        $pages = Pages::all();
        $where = array('id' => $id);
        $banners  = Banner::where($where)->first();

        return view('admin.banners.edit', compact('banners','pages'));
    }

    public function restore(Request $request ,$id)
    {
        $banner = Banner::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Banner Restored Successfully!"
        );

        if(!$banner->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Banner!";
        }

        return redirect()->route('banner.list')->with($response);
    }

    public function view(Request $request,$isTrashed=null)
    {
        $pages = Pages::all();
        $where = array('id' => $request->id);
        if($isTrashed != null && $isTrashed == 1 ) {
            $banners  = Banner::onlyTrashed()->where($where)->first();
        } else {
            $banners  = Banner::where($where)->first();
        }

        return Response()->json($banners);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'heading_one' => 'required',
            'heading_two' => 'required',
        ]);

        if ($valid) {
            $banner = Banner::find($request->id);
            $banner->heading_one = $request->input('heading_one');
            $banner->heading_two = $request->input('heading_two');
            $banner->description = $request->input('description');
            $banner->btn_title = $request->input('btn_title');
            $banner->btn_link = $request->input('btn_link');
            $banner->page = $request->input('page');
            $banner->btn_title = $request->input('btn_title');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->bannersimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->bannersimagepath . $imagename;
                $banner->image = $imagename;
            }

            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Banner Updated Successfully."
            );

            if ($banner->save()) {

                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Banner Updated Payment",
                    "desc" => array(
                       "added_title" => $request->input('heading_one'),
                       "added_description" => $request->description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);

            }else {
                $data["success"] = false;
                $data["message"] = "Banner Not Updated Successfully.";

                Session::flash('error', $data["message"]);
            }

            return redirect()->route('banner.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $banner = Banner::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Banner Deleted Successfully!"
        );

        if(!$banner->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Banner!";
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $banner = Banner::onlyTrashed()->find($request->id);
        $response = array(
            "success" => true,
            "message" => "Banner Destroy Successfully!"
        );

        if(!$banner->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Banner!";
        }

        return response()->json($response);
    }


}
