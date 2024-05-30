<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pages;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class PagesController extends Controller
{
    function __construct()
    {
        $this->pagesimagepath = 'backend/assets/images/pages/';
        $this->middleware('permission:Page-Create|Page-Edit|Page-View|Page-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Page-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:Page-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Page-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $pages = Pages::all();
            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></a>&nbsp' ;
                    if (Auth::user()->can('Page-Edit')) {
                        $html .= '<a href="'.route('page.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Page-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="page_status" switch="bool" data-id="' . $row->id . '" value="'.($row->status==1 ? "1" : "0").'" '.($row->status==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

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

        return view('admin.pages.list');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $pages = Pages::onlyTrashed();
            return DataTables::of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></a>&nbsp' ;
                    if (Auth::user()->can('Page-Edit')) {
                        $html .= '<a href="'.route('page.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Page-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="page_status" switch="bool" data-id="' . $row->id . '" value="'.($row->status==1 ? "1" : "0").'" '.($row->status==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

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

        return view('admin.pages.trashed');
    }

    public function form($id = 0)
    {
        return view('admin.pages.add');
    }

    public function status(Request $request ,$id)
    {
        $page = Pages::find($id);
        $page->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($page->save()) {
            $response["success"] = true;
            $response["message"] = "Page Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Updated Page Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'pages_header' => 'nullable',
            'pages_content' => 'nullable',
            'pages_footer' => 'nullable',
            'url' => 'nullable',
            'image' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
        ]);
        
            $pages = new Pages();
            $pages->name = $request->name;
            $pages->title = $request->title;
            $pages->url = $request->url;
            $pages->pages_header = ($request->pages_header == "<p><br></p>") ? "" : $request->pages_header;
            $pages->pages_content = ($request->pages_content == "<p><br></p>") ? "" : $request->pages_content;
            $pages->pages_footer = ($request->pages_footer == "<p><br></p>") ? "" : $request->pages_footer;

            // if ($request->hasFile('image')) {
            //     $image = $request->file('image');
            //     $imagename = time() . '.' . $image->getClientOriginalExtension();
            //     $image_destinationPath = public_path($this->pagesimagepath);
            //     $image->move($image_destinationPath, $imagename);
            //     $imagename = $this->pagesimagepath . $imagename;
            //     $pages->image = $imagename;
            // }

            $pages->meta_title = $request->meta_title;
            $pages->meta_description  = $request->meta_description;
            $pages->meta_keyword = $request->meta_keyword;
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');

            if($pages->save()) {

                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Page",
                    "desc" => array(
                        "added_title" => $request->name,
                        "added_description" => $request->title,
                    )
                );

                $data = array(
                    "success"=> true,
                    "message" => "Page Added Successfully"
                   );

                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Page Not Added Successfully.";

                Session::flash('error', $data["message"]);
                return response()->json(['success' => false, 'route' => route('page.alert.message')]);
            }
            return response()->json(['success' => true, 'route' => route('page.alert.message')], 200);
            //  return redirect()->route('page.list')->with($data);

    }

    public function edit(Request $request , $id)
    {
        $where = array('id' => $id);
        $pages  = Pages::where($where)->first();
        return view('admin.pages.edit',compact('pages'));
    }

    public function view(Request $request,$isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null && $isTrashed == 1) {
            $pages = Pages::onlyTrashed()->where($where)->first();
        } else {
            $pages = Pages::where($where)->first();
        }

        return Response::json($pages);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'pages_header' => 'nullable',
            'pages_content' => 'nullable',
            'pages_footer' => 'nullable',
            'url' => 'nullable',
            'image' => 'nullable',
            'meta_title' => 'nullable',
            'meta_description' => 'nullable',
            'meta_keyword' => 'nullable',
        ]);
       
          $pages = Pages::find($request->id);
          $pages->name = $request->name;
          $pages->title = $request->title;
          $pages->url = $request->url;
          $pages->pages_header = ($request->pages_header == "<p><br></p>") ? "" : $request->pages_header;
          $pages->pages_content = ($request->pages_content == "<p><br></p>") ? "" : $request->pages_content;
          $pages->pages_footer = ($request->pages_footer == "<p><br></p>") ? "" : $request->pages_footer;
        //   if ($request->image) {
        //     $image = $request->image;
        //     $infoPath = pathinfo($request->image);
        //     $imagename = time() . '.' . $infoPath['extension'];
        //     $image_destinationPath = public_path($this->pagesimagepath);
        //     $image->move($image_destinationPath, $imagename);
        //     $imagename = $this->pagesimagepath . $imagename;
        //     $pages->image = $imagename;
        //    }
         $pages->meta_title = $request->meta_title;
         $pages->meta_description  = $request->meta_description;
         $pages->meta_keyword = $request->meta_keyword;
         $management = User::role(['Admin', 'Brand Manager'])->get();
         $management->pluck('id');

         if($pages->save()) {

            $notify = array(
                "performed_by" => Auth::user()->id,
                "title" => "Updated Page",
                "desc" => array(
                    "added_title" => $request->name,
                    "added_description" => $request->title,
                )
            );

            $data = array(
                "success"=> true,
                "message" => "Page Updated Successfully"
               );

            Notification::send($management, new QuickNotify($notify));
            Session::flash('success', $data["message"]);
         } else {
            $data["success"] = false;
            $data["message"] = "Page Not Updated Successfully.";

            Session::flash('error', $data["message"]);
            return response()->json(['success' => false, 'route' => route('page.alert.message')]);
         }
         return response()->json(['success' => true, 'route' => route('page.alert.message')], 200);
        //  return redirect()->route('page.list')->with($data);
        
    }

    public function alertMessage() {
        if(Session()->get('success')) {
            return redirect()->route('page.list')->with(['success' => true, 'message' => Session()->get('success')]);     
        } else {
            return redirect()->route('page.list')->with(['success' => false, 'message' => Session()->get('error')]);     
        }
    }

    public function restore(Request $request ,$id)
    {
        $page = Pages::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Page Restored Successfully!"
        );

        if(!$page->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Page!";
        }

        return redirect()->route('page.list')->with($response);
    }

    public function slug($pages = null)
    {
        $data['pages'] = Pages::where('url', $pages)->first();
        if(!$data['pages']) {
            abort(404);
        }

        return view('admin.pages.admin-slug', $data);
    }

    public function delete(Request $request)
    {
        $Page = Pages::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Page Deleted Successfully!"
        );

        if(!$Page->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Page!";
        }

        return response()->json($response);
    }

    public function destroy(Request $request)
    {
        $Page = Pages::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Page Destroy Successfully!"
        );

        if(!$Page->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Page!";
        }

        return response()->json($response);

    }
}
