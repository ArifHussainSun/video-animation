<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategories;
use App\Models\Categories;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SubCategoriesController extends Controller
{
    function __construct()
    {
        $this->subcategoriesimagepath= 'backend/assets/images/subcategories/';
        $this->middleware('permission:SubCategories-Create|SubCategories-Edit|SubCategories-View|SubCategories-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:SubCategories-Create', ['only' => ['form','store']]);
        $this->middleware('permission:SubCategories-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:SubCategories-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subcategories = SubCategories::all();
            return DataTables::of($subcategories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></a>&nbsp' ;
                    if (Auth::user()->can('SubCategories-Edit')) {
                        $html .= '<a href="'.route('sub-category.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('SubCategories-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="subcategory_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/images/default/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status','image','created_at'])->make(true);
        }

        return view('admin.subcategories.list');
    }

    public function trashed(Request $request){
        if ($request->ajax()) {
            $subcategories = SubCategories::onlyTrashed();
            return DataTables::of($subcategories)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#" class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></a>&nbsp' ;
                    if (Auth::user()->can('SubCategories-Edit')) {
                        $html .= '<a href="'.route('sub-category.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('SubCategories-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {

                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="subcategory_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

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

        return view('admin.subcategories.trashed');
    }

    public function form($id = 0)
    {
        $data = [];
        $categories = Categories::all();
        return view('admin.subcategories.add', ['categories' => $categories]);
    }

    function status(Request $request, $id,$isType=null) {

        $subcategories = SubCategories::find($id);
        $subcategories->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($subcategories->save()) {
            $response["success"] = true;
            $response["message"] = "Sub Category Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Sub Category Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'categories_id' => 'required',
            'name' => 'required',
            'title' => 'required',
            'desc' => 'required',
        ]);
        if($valid)
        {
          $subcategories = new SubCategories();
          $subcategories->categories_id = $request->input('categories_id');
          $subcategories->name = $request->input('name');
          $subcategories->title = $request->input('title');
          $subcategories->short_description = $request->input('short_description');
          $subcategories->desc = strip_tags($request->desc);
          $subcategories->subcategorylink = $request->input('subcategorylink');
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->subcategoriesimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->subcategoriesimagepath . $imagename;
            $subcategories->image = $imagename;
           }
           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $data = array(
            "success"=> true,
            "message" => "Sub Category Added Successfully."
           );

           if($subcategories->save()) {
              $notify = array(
                  "performed_by" => Auth::user()->id,
                  "title" => "Added New Sub category",
                  "desc" => array(
                      "added_title" => $request->input('name'),
                      "added_description" => strip_tags($request->short_description),
                    )
              );
              Notification::send($management, new QuickNotify($notify));
              Session::flash('success', $data["message"]);
              return redirect()->route('sub-category.list')->with($data);
           } else {
            $data["success"] = false;
            $data["message"] = "Sub category Not Added Successfully.";

            Session::flash('error', $data["message"]);
           }
           return redirect()->route('sub-category.list')->with($data);

        }
        else {
           return redirect()->back();
        }
    }

    public function restore(Request $request ,$id)
    {
        $subcategories = SubCategories::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Sub Category Restored Successfully!"
        );

        if(!$subcategories->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Sub Category!";
        }

        return redirect()->route('sub-category.list')->with($response);
    }

    public function edit(Request $request,$id)
    {
        $categories = Categories::all();
        $where = array('id' => $id);
        $subcategories  = SubCategories::where($where)->first();

        return view('admin.subcategories.edit',compact('subcategories','categories'));
    }

    public function view(Request $request, $isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null && $isTrashed == 1) {
            $subcategories = SubCategories::onlyTrashed()->where($where)->with('categories')->first();
        } else {
            $subcategories = SubCategories::where($where)->with('categories')->first();
        }

        return Response::json($subcategories);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'desc' => 'required',
        ]);

        if($valid)
        {
          $subcategories = SubCategories::find($request->id);
          $subcategories->categories_id = $request->input('categories_id');
          $subcategories->name = $request->input('name');
          $subcategories->title = $request->input('title');
          $subcategories->desc = strip_tags($request->desc);
          if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image_destinationPath = public_path($this->subcategoriesimagepath);
            $image->move($image_destinationPath, $imagename);
            $imagename = $this->subcategoriesimagepath . $imagename;
            $subcategories->image = $imagename;
           }
           $management = User::role(['Admin', 'Brand Manager'])->get();
           $management->pluck('id');
           $data = array(
            "success"=> true,
            "message" => "Sub Category Added Successfully."
           );

           if($subcategories->save()) {
              $notify = array(
                  "performed_by" => Auth::user()->id,
                  "title" => "Added New Sub category",
                  "desc" => array(
                      "added_title" => $request->input('name'),
                      "added_description" => strip_tags($request->short_description),
                    )
              );
              Notification::send($management, new QuickNotify($notify));
              Session::flash('success', $data["message"]);
              return redirect()->route('sub-category.list')->with('success', 'subcategory has been, Added Successfully.');
           } else {
            $data["success"] = false;
            $data["message"] = "Sub category Not Added Successfully.";

            Session::flash('error', $data["message"]);
           }
           return redirect()->route('sub-category.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $subcategories = SubCategories::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Sub Category Deleted Successfully!"
        );

        if(!$subcategories->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Sub Category!";
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $subcategories = SubCategories::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Sub Category Destroy Successfully!"
        );

        if(!$subcategories->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Sub Category!";
        }

        return response()->json($response);

    }

    public function SubCategoryApi($id=null, $subcategories_id=null)
    {
        $sub_categories_id = SubCategories::where('id', $id)->with('categories')->first();
        if ($sub_categories_id) {
            $sub_categories = SubCategories::where('id', $id)->with('categories')->get();
            return response()->json([
                "status" => true,
                "data" => $sub_categories
            ]);

        }else{

            return response()->json(array(
                "status" => false,
                "message" => 'Sub Categories Id Does Not Exit',
            ), 400);
        }

    }

}
