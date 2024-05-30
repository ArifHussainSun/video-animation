<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\Pages;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class CategoriesController extends Controller
{
    function __construct()
    {
        $this->categoriesimagepath= 'backend/assets/images/categories/';
        $this->middleware('permission:Categories-Create|Categories-Edit|Categories-View|Categories-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Categories-Create', ['only' => ['form','store']]);
        $this->middleware('permission:Categories-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Categories-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $categories = Categories::all();
            return DataTables::of($categories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('categories.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Subscriber-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="banner_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function($row){
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;

                })->rawColumns(['action', 'status','image','created_at'])->make(true);

        }

        return view('admin.categories.list');
    }
    public function form($id = 0)
    {
        $pages = Pages::all();
        return view('admin.categories.form', compact('pages'));

    }

    public function status(Request $request ,$id)
    {
        $category = Categories::find($id);
        $category->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($category->save()) {
            $response["success"] = true;
            $response["message"] = "Category Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Category Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'required',

        ]);
        if($valid)
        {
          $categories = new Categories();
          $categories->name = $request->input('name');
          $categories->title = $request->input('title');
          $categories->description = strip_tags($request->description);
        //   $categories->metatitle = $request->input('metatitle');
        //   $categories->metadesc = $request->input('metadesc');
        //   $categories->metakeyword = $request->input('metakeyword');
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->categoriesimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->categoriesimagepath . $imagename;
            $categories->image = $imagename;
           }
           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $data = array(
            "success"=> true,
            "message" => "Category Added Successfully"
           );

           if ($categories->save()) {
            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Added New category",
                "desc" => array(
                    "added_title" => $request->input('name'),
                    "added_description" => $request->message,
                )
            );
            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);
        } else {
            $data["success"] = false;
            $data["message"] = "Category Not Added Successfully.";
            Session::flash('error', $data["message"]);
        }
        return redirect()->route('categories.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }
    public function edit(Request $request,$id)
    {
        $pages = Pages::all();
        $where = array('id' => $request->id);
        $categories  = Categories::where($where)->first();

        return view('admin.categories.edit',compact('pages','categories'));
    }

    public function view(Request $request, $isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null) {
            $contactqueries = Categories::onlyTrashed()->where($where)->first();
        } else {
            $contactqueries = Categories::where($where)->first();
        }

        return Response::json($contactqueries);
    }

    public function update(Request $request)
    {

        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'nullable',
        ]);

        if($valid)
        {
          $categories = Categories::find($request->id);
          $categories->name = $request->input('name');
          $categories->title = $request->input('title');
          $categories->description = strip_tags($request->description);
        //   $categories->metatitle = $request->input('metatitle');
        //   $categories->metadesc = $request->input('metadesc');
        //   $categories->metakeyword = $request->input('metakeyword');
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->categoriesimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->categoriesimagepath . $imagename;
            $categories->image = $imagename;
           }

           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $data = array(
            "success"=> true,
            "message" => "Category Updated Successfully"
           );

           if($categories->save()) {
            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Category Updated Successfully",
                "desc" => array(
                    "added_title" => $request->input('name'),
                    "added_description" => $request->email,
                )
            );
            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);
        } else {
            $data["success"] = false;
            $data["message"] = "Category Not Updated Successfully.";

            Session::flash('error', $data["message"]);
        }

         return redirect()->route('categories.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }

    public function restore(Request $request ,$id)
    {
        $Contactqueries = Categories::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Category Restored Successfully!"
        );

        if(!$Contactqueries->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Category!";
        }

        return redirect()->route('categories.list')->with($response);
    }

    public function destroy(Request $request)
    {
        $subscriber = Categories::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Category Destroy Successfully!"
        );

        if(!$subscriber->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Category!";
        }

        return response()->json($response);

    }

    public function delete(Request $request)
    {
        $category = Categories::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Category deleted Successfully!"
        );

        if(!$category->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to deleted Category!";
        }

        return response()->json($response);
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $subscriber = Categories::onlyTrashed();
            return DataTables::of($subscriber)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('categories.restore',$row->id).'"  class="btn btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Subscriber-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="subscriber_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function($row){
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;

                })->rawColumns(['action', 'status','deleted_at','image'])->make(true);

        }

        return view('admin.categories.trashed');
    }

    public function CategoryApi()
    {
        $categories = Categories::all();
        return response()->json($categories);
    }
}
