<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    function __construct()
    {
        $this->galleriesimagepath = 'backend/assets/images/gallery/';
        $this->middleware('permission:Gallery-Create|Gallery-Edit|Gallery-View|Gallery-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Gallery-Create', ['only' => ['form','store']]);
        $this->middleware('permission:Gallery-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Gallery-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $gallery = Gallery::whereNull('deleted_at')->with('createdBy')->get();
            return DataTables::of($gallery)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $html = ' <a href="#" class="btn btn-primary viewModal"  data-bs-toggle="modal" data-bs-target=".galleryDetailsModal" data-id="' . $row->id . '"><i title="View" class="fas fa-eye"></i></a>&nbsp';


                    $html .= '<a href="'.route('gallery.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;

                    if (Auth::user()->can('Gallery-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })
                ->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if($row->image){
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    }else{
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })
                ->addColumn('created_by_name', function ($row) {


                    return $row->createdBy()->first();
                })
                ->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="gallery_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                    return $btn;
                })
                ->rawColumns(['action','image', 'status','created_at','created_by_name'])->make(true);

        }


        return view('admin.gallery.list');
    }
    public function form($id = 0)
    {
       return view('admin.gallery.add');
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',


        ]);
        // dd($valid);
        if ($valid) {
            $gallery = new Gallery();
            $gallery->name = $request->input('name');
            $gallery->desc = strip_tags($request->desc);
            $gallery->created_at = Carbon::now();
            $gallery->created_by = Auth::user()->id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->galleriesimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->galleriesimagepath . $imagename;
                $gallery->image = $imagename;

            }
            $gallery->save();
            Session::flash('success', 'Gallery has been, Added Successfully.');
            return redirect()->route('gallery.list')->with('success', 'Gallery has been, Added Successfully.');
        } else {
            return redirect()->back();
        }
    }
    public function edit(Request $request)
    {

        $where = array('id' => $request->id);
        $gallery  = Gallery::where($where)->first();
        return view('admin.gallery.edit',compact('gallery'));
    }
    public function view(Request $request, $id)
    {
        $gallery = Gallery::find($id);
        if(!$gallery){
            abort(404);
        }

        $data['gallery'] = $gallery;


        $data['gallerynames'] = Gallery::where('id',$gallery->id)->with('createdBy')->first();
        $data['created_by'] = $data['gallery']->createdBy()->first()->first_name;
        $data['created_at']= Carbon::parse($data['gallery']->created_at)->diffForHumans();
        if($data['gallery']->updated_by != NULL){

            $data['updated_by'] = User::where('id',$data['gallery']->updated_by)->first()->first_name;
        }
        else{
            $data['updated_by'] = "";
        }
        $data['updated_at']= Carbon::parse($data['gallery']->updated_at)->diffForHumans();
        return $data;
    }
    public function update(Request $request)
    {

        $valid =  $request->validate([
            'name' => 'required',



        ]);

        if ($valid) {
            $gallery = Gallery::find($request->id);
            $gallery->name = $request->input('name');
            $gallery->desc = strip_tags($request->desc);
            $gallery->updated_at = Carbon::now();
            $gallery->updated_by = Auth::user()->id;
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->galleriesimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->galleriesimagepath . $imagename;
                $gallery->image = $imagename;
            }
            if($gallery->save()){
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Updated Gallery",
                    "desc" => array(
                        "added_title" => $request->name,
                        "added_description" => $request->desc,
                        )
                );
                 Notification::send($management, new QuickNotify($notify));

                Session::flash('success', 'Gallery has been, Updated Successfully.');

            }


            return redirect()->route('gallery.list');

        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $gallery = Gallery::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Gallery Deleted Successfully!"
        );

        if(!$gallery->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Deleted Gallery!";
        }

        return response()->json($response);
    }
    public function destroy(Request $request)
    {

        $gallery = Gallery::withTrashed()->find($request->id);
        // dd($gallery);
        if ($gallery->forceDelete()) {

            $notification['type'] = "success";
            $notification['message'] = "gallery Destroy Successfuly!.";
            $notification['icon'] = 'mdi-check-all';
            echo json_encode($notification);

        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Destroy Gallery";
            $notification['icon'] = 'mdi-block-helper';
            echo json_encode($notification);

        }

    }
    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Gallery::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="restore btn btn-xs  btn-success btn-restore" data-id="' . $row->id . '"><i title="Restore" class="fas fa-trash-restore-alt"></i></a>&nbsp';
                    $btn .= '<a data-id="' . $row->id . '" class="btn btn-xs  btn-danger btn-destroy" ><i title="destroy" class="far fa-trash-alt"></i></a>&nbsp';

                    return $btn;
                }) ->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if($row->image){
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    }else{
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })
                ->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })

                ->rawColumns(['action','image', 'deleted_at'])
                ->make(true);
        }
        return view('admin.gallery.trash');
    }
    public function restore(Request $request)
    {
        $gallery = Gallery::withTrashed()->find($request->id);
        if ($gallery) {
            $gallery->restore();
            $notification['type'] = "success";
            $notification['message'] = "Gallery Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore Gallery.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
    function status(Request $request, $id) {
        $gallery = Gallery::find($id);
        $gallery->active = (($request->active == "true") ? 1 : 0);

        $response = array();

        if($gallery->save()) {
            $response["success"] = true;
            $response["message"] = "Gallery Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update Gallery Status!";
        }

        return response()->json($response);
    }
}
