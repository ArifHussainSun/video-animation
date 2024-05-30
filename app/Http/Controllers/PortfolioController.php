<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Faq;
use App\Models\Pages;
use App\Models\User;
use App\Models\Portfolio;
use App\Models\Service;
use App\Models\Categories;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PortfolioController extends Controller
{
    function __construct()
    {
        $this->portfolioimagepath = 'backend/assets/images/portfolio/';
        $this->portfoliopopupimagepath = 'backend/assets/images/portfolio/popup/';
        
        $this->middleware('permission:Portfolio-Create|Portfolio-Edit|Portfolio-View|Portfolio-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Portfolio-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:Portfolio-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Portfolio-Delete', ['only' => ['destroy']]);
    }


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $portfolio = Portfolio::all();
            return DataTables::of($portfolio)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary viewModal" data-bs-toggle="modal" data-bs-target=".portfoliodetailsModal" data-id="' . $row->id . '"><i class="far fa-eye"></i></a>&nbsp';
                    if (Auth::user()->can('Portfolio-Edit')) {
                        $html .= '<a href="'.route('portfolio.edit',$row->id).'"  class="btn btn-success" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Portfolio-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('status', function ($row) {
                    if ($row->status == 0) {
                        $btn0 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="portfolio_status" switch="bool" data-id="' . $row->id . '" value="0"/><label class="switch2" for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn0;
                    } elseif ($row->status == 1) {
                        $btn1 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="portfolio_status" switch="bool" data-id="' . $row->id . '" value="1" checked/><label class="switch2" for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
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
                        $image = '<img src=' . asset('backend/assets/img/users/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status', 'created_at', 'image'])->make(true);
        }

        return view('admin.portfolio.list');
    }

    public function form()
    {
        $services = Service::all();
        return view('admin.portfolio.add',compact('services'));
    }

    public function store(Request $request)
    {

        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'service_id  ' => 'nullable',
            'image' => 'nullable',
            'metatitle' => 'nullable',
            'metadesc' => 'nullable',
            'metakeyword' => 'nullable',
            'popup' => 'nullable',
            
        ]);
        if ($valid) {
            $portfolio = new Portfolio();
            $portfolio->name = $request->name;
            $portfolio->title = $request->title;
            $portfolio->description = strip_tags($request->description);
            $portfolio->metatitle = $request->metatitle;
            $portfolio->metadesc = $request->metadesc;
            $portfolio->metakeyword  = $request->metakeyword;
            $portfolio->service_id  = $request->service_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->portfolioimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->portfolioimagepath . $imagename;
                $portfolio->image = $imagename;
            }
            if ($request->hasFile('popup')) {
                $popimage = $request->file('popup');
                $popimagename = time() . '.' . $popimage->getClientOriginalExtension();
                $popimage_destinationPath = public_path($this->portfoliopopupimagepath);
                $popimage->move($popimage_destinationPath, $popimagename);
                $popimagename = $this->portfoliopopupimagepath . $popimagename;
                $portfolio->popup = $popimagename;
            }
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Portfolio Added Successfully"
            );
            if($portfolio->save()){
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Portfolio",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Portfolio Not Added Successfully.";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('portfolio.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request)
    {
        $portfolio  = Portfolio::where('id',$request->id)->with('service')->first();
        $service = Service::whereNull('deleted_at')->get();
        return view('admin.portfolio.edit' , compact('portfolio','service'));
    }

    public function view(Request $request , $id)
    {


        // $portfolio = Portfolio::find($id);
        // if(!$portfolio){
        //     abort(404);
        // }

        // $data['portfolio'] = $portfolio;

        // $data['portfolionames'] = Portfolio::where('id',$portfolio->id)->with('createdBy')->first();
        // // $data['created_by'] = $data['portfolio']->createdBy()->first()->first_name;
        // $data['created_at']= Carbon::parse($data['portfolio']->created_at)->diffForHumans();
        // if($data['portfolio']->updated_by != NULL){

        //     $data['updated_by'] = User::where('id',$data['portfolio']->updated_by)->first()->first_name;
        // }
        // else{
        //     $data['updated_by'] = "";
        // }
        // $data['updated_at']= Carbon::parse($data['portfolio']->updated_at)->diffForHumans();
        // return $data;
        $where = array('id' => $request->id);

        if($id!=null && $id == 'yes') {
            $portfolio = Portfolio::onlyTrashed()->where($where)->with('createdBy')->first();
        } else {
            $portfolio = Portfolio::where($where)->with('createdBy')->first();
        }

        return Response::json($portfolio);
    }

    public function update(Request $request)
    {
    
        $valid =  $request->validate([
            'name' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'service_id  ' => 'nullable',
            'image' => 'nullable',
            'metatitle' => 'nullable',
            'metadesc' => 'nullable',
            'metakeyword' => 'nullable',
            'popup' => 'nullable',
        ]);

        if ($valid) {
            $portfolio = Portfolio::find($request->id);
            // dd($portfolio);
            $portfolio->name = $request->name;
            $portfolio->title = $request->title;
            $portfolio->description = strip_tags($request->description);
            $portfolio->metatitle = $request->metatitle;
            $portfolio->metadesc = $request->metadesc;
            $portfolio->metakeyword  = $request->metakeyword;
            $portfolio->service_id  = $request->service_id;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imagename = time() . '.' . $image->getClientOriginalExtension();
                $image_destinationPath = public_path($this->portfolioimagepath);
                $image->move($image_destinationPath, $imagename);
                $imagename = $this->portfolioimagepath . $imagename;
                $portfolio->image = $imagename;
            }
            
            if ($request->hasFile('popup')) {
                $popimage = $request->file('popup');
                $popimagename = time() . '.' . $popimage->getClientOriginalExtension();
                $popimage_destinationPath = public_path($this->portfoliopopupimagepath);
                $popimage->move($popimage_destinationPath, $popimagename);
                $popimagename = $this->portfoliopopupimagepath . $popimagename;
                $portfolio->popup = $popimagename;
            }
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Portfolio Updated Successfully"
            );
            if($portfolio->save()){
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Updated New Portfolio",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Portfolio Not Updated Successfully.";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('portfolio.list')->with($data);
        } else {
            return redirect()->back();
        }
    }
    public function delete(Request $request)
    {
        $portfolio = Portfolio::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Portfolio Destroy Successfully!"
        );

        if(!$portfolio->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Portfolio!";
        }

        return response()->json($response);
    }
    public function destroy(Request $request)
    {
        $portfolio = Portfolio::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Portfolio Destroy Successfully!"
        );

        if(!$portfolio->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Portfolio!";
        }

        return response()->json($response);
    }


    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $portfolio = Portfolio::onlyTrashed();
            return DataTables::of($portfolio)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<a href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></a>&nbsp' ;
                    if (Auth::user()->can('Portfolio-Edit')) {
                        $html .= '<a href="'.route('portfolio.restore',$row->id).'"  class="btn btn-xs btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Portfolio-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="portfolio_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->addColumn('image', function ($row) {
                    $imageName = Str::of($row->image)->replace(' ', '%10');
                    if ($row->image) {
                        $image = '<img src=' . asset('/' . $imageName) . ' class="avatar-sm" />';
                    } else {
                        $image = '<img src=' . asset('backend/assets/img/users/no-image.jpg') . ' class="avatar-sm" />';
                    }
                    return $image;
                })->rawColumns(['action', 'status','image','deleted_at'])->make(true);
        }

        return view('admin.portfolio.trashed');
    }

    public function restore(Request $request)
    {
        $portfolio = Portfolio::withTrashed()->find($request->id);
        if ($portfolio) {
            $portfolio->restore();
            $notification['type'] = "success";
            $notification['message'] = "Portfolio Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            return view('admin.portfolio.trashed')->with($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore Portfolio, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
    function status(Request $request, $id) {
        $banner = Portfolio::find($id);
        $banner->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($banner->save()) {
            $response["success"] = true;
            $response["message"] = "Portfolio Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update Portfolio Status!";
        }

        return response()->json($response);
    }


}
