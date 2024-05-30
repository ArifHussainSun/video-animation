<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    function __construct()
    {
        $this->testimonialimagepath= 'backend/assets/images/testimonial/';
        $this->middleware('permission:Testimonial-Create|Testimonial-Edit|Testimonial-View|Testimonial-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Testimonial-Create', ['only' => ['form','store']]);
        $this->middleware('permission:Testimonial-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Testimonial-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {


        if ($request->ajax()) {
            $testimonial = Testimonial::whereNull('deleted_at')->with('createdBy')->get();
            return DataTables::of($testimonial)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $html = ' <a href="#" class="btn btn-primary viewModal"  data-bs-toggle="modal" data-bs-target=".testimonialDetailsModal" data-id="' . $row->id . '"><i title="View" class="fas fa-eye"></i></a>&nbsp';


                    $html .= '<a href="'.route('testimonial.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;

                    if (Auth::user()->can('Testimonial-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })
                ->addColumn('created_at', function ($row) {
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
                })

                ->addColumn('created_by_name', function ($row) {


                    return $row->createdBy()->first();
                })
                ->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="testimonial_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                    return $btn;
                })
                ->rawColumns(['action','image', 'status','created_at','created_by_name'])->make(true);

        }

        return view('admin.testimonials.list');
    }

    public function form()
    {

        return view('admin.testimonials.add');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $valid =  $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'rating' => 'required',

        ]);
        if($valid)
        {
          $testimonial = new Testimonial();
          $testimonial->name = $request->name;
          $testimonial->designation = $request->designation;
          $testimonial->company = $request->company;
          $testimonial->rating = $request->rating;
          $testimonial->desc = $request->desc;
          $testimonial->created_at = Carbon::now();
          $testimonial->created_by = Auth::user()->id;

          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->testimonialimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->testimonialimagepath . $imagename;
            $testimonial->image = $imagename;
           }

           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $testimonial->save();

           $notify = array(
              "performed_by" => Auth::user()->id,
              "title" => "Added New Testimonial",
              "desc" => array(
                  "added_title" => $request->name,
                  "added_description" => $request->desc,
                  )
           );
           Notification::send($management, new QuickNotify($notify));
          Session::flash('success', 'Testimonial has been, Added Successfully.');
          return redirect()->route('testimonial.list')->with('success', 'Testimonial has been, Added Successfully.');
        }
        else {
           return redirect()->back();
        }
    }

    public function edit(Request $request,$id)
    {
        $where = array('id' => $id);
        $testimonial  = Testimonial::where($where)->first();

        return view('admin.testimonials.edit',compact('testimonial'));
    }


    public function view(Request $request,$id)
    {
        $testimonial = Testimonial::find($id);
        if(!$testimonial){
            abort(404);
        }

        $data['testimonial'] = $testimonial;


        $data['testimonialnames'] = Testimonial::where('id',$testimonial->id)->with('createdBy')->first();
        $data['created_by'] = $data['testimonial']->createdBy()->first()->first_name;
        $data['created_at']= Carbon::parse($data['testimonial']->created_at)->diffForHumans();
        if($data['testimonial']->updated_by != NULL){

            $data['updated_by'] = User::where('id',$data['testimonial']->updated_by)->first()->first_name;
        }
        else{
            $data['updated_by'] = "";
        }
        $data['updated_at']= Carbon::parse($data['testimonial']->updated_at)->diffForHumans();
        return $data;
    }
    public function update(Request $request)
    {
        $valid = $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'company' => 'required',
            'rating' => 'required',
        ]);

        if($valid)
        {
          $testimonial = Testimonial::find($request->id);
          $testimonial->name = $request->name;
          $testimonial->designation = $request->designation;
          $testimonial->company = $request->company;
          $testimonial->rating = $request->rating;
          $testimonial->desc = $request->desc;
          $testimonial->updated_at = Carbon::now();
          $testimonial->updated_by = Auth::user()->id;

          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->testimonialimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->testimonialimagepath . $imagename;
            $testimonial->image = $imagename;
           }

           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $testimonial->save();

           $notify = array(
              "performed_by" => Auth::user()->id,
              "title" => "Updated Testimonial",
              "desc" => array(
                  "added_title" => $request->name,
                  "added_description" => $request->desc,
                  )
           );
           Notification::send($management, new QuickNotify($notify));
        //   $data['url'] = route('admin-testimonials.main');
        //   $data['save'] = $testimonial;
          Session::flash('success', 'Testimonial has been, Updated Successfully.');
          return redirect()->route('testimonial.list');
        }
        else {
           return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $testimonial = Testimonial::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Testimonial Deleted Successfully!"
        );

        if(!$testimonial->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Deleted Testimonial!";
        }

        return response()->json($response);
    }
    public function destroy(Request $request)
    {

        $testimonial = Testimonial::withTrashed()->find($request->id);
        // dd($testimonial);
        if ($testimonial->forceDelete()) {

            $notification['type'] = "success";
            $notification['message'] = "testimonial Destroy Successfuly!.";
            $notification['icon'] = 'mdi-check-all';
            echo json_encode($notification);

        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Destroy testimonial, please try again.";
            $notification['icon'] = 'mdi-block-helper';
            echo json_encode($notification);

        }

    }
    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $data = Testimonial::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="restore btn btn-xs  btn-success btn-restore" data-id="' . $row->id . '"><i title="Restore" class="fas fa-trash-restore-alt"></i></a>&nbsp';
                    $btn .= '<a data-id="' . $row->id . '" class="btn btn-xs  btn-danger btn-destroy" ><i title="destroy" class="far fa-trash-alt"></i></a>&nbsp';

                    return $btn;
                }) ->addColumn('image', function ($row) {
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

                ->rawColumns(['action','image', 'deleted_at'])
                ->make(true);
        }
        return view('admin.testimonials.trash');
    }
    public function restore(Request $request)
    {
        $testimonial = Testimonial::withTrashed()->find($request->id);
        if ($testimonial) {
            $testimonial->restore();
            $notification['type'] = "success";
            $notification['message'] = "Testimonial Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore Testimonial, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
    function status(Request $request, $id) {
        $testimonial = Testimonial::find($id);
        $testimonial->active = (($request->active == "true") ? 1 : 0);

        $response = array();

        if($testimonial->save()) {
            $response["success"] = true;
            $response["message"] = "Testimonial Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update Testimonial Status!";
        }

        return response()->json($response);
    }
}
