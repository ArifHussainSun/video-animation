<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:Subscriber-Create|Subscriber-Edit|Subscriber-View|Subscriber-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:Subscriber-Create', ['only' => ['form','store']]);
        $this->middleware('permission:Subscriber-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:Subscriber-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subscriber = Subscriber::all();
            return DataTables::of($subscriber)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('subscriber.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Subscriber-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="subscriber_status" switch="bool" data-id="' . $row->id . '" value="'.($row->active==1 ? "1" : "0").'" '.($row->active==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action', 'status','created_at'])->make(true);

        }

        return view('admin.subscribers.list');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $subscriber = Subscriber::onlyTrashed();
            return DataTables::of($subscriber)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('subscriber.restore',$row->id).'"  class="btn btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
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
                })->rawColumns(['action', 'status','deleted_at'])->make(true);

        }

        return view('admin.subscribers.trashed');
    }

    public function form($id = 0)
    {
        return view('admin.subscribers.add');
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'data'  => 'nullable',

        ]);
        if($valid)
        {
          $subscriber = new Subscriber();

          $subscriber->name = $request->name;
          $subscriber->email = $request->email;
          $subscriber->phone = $request->phone;
          $subscriber->data = json_encode($request->data);
          $management = User::role(['Admin', 'Brand Manager'])->get();
          $management->pluck('id');
          $data = array(
            "success"=> true,
            "message" => "Subscriber Added Successfully"
           );

            if($subscriber->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Subscriber Updated Successfully",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->email,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Subscriber Not Added Successfully.";

                Session::flash('error', $data["message"]);
            }

             return redirect()->route('subscriber.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }
    public function edit(Request $request,$id)
    {
        $where = array('id' => $id);
        $subscriber  = Subscriber::where($where)->first();

        return view('admin.subscribers.edit',compact('subscriber'));
    }

    public function view(Request $request,$isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null) {
            $subscriber = Subscriber::onlyTrashed()->where($where)->first();
        } else {
            $subscriber = Subscriber::where($where)->first();
        }

        return Response::json($subscriber);
    }

    public function delete(Request $request)
    {
        $subscriber = Subscriber::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Subscriber Deleted Successfully!"
        );

        if(!$subscriber->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Subscriber!";
        }

        return response()->json($response);
    }

    public function restore(Request $request ,$id)
    {
        $subscriber = Subscriber::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Subscriber Restored Successfully!"
        );

        if(!$subscriber->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Subscriber!";
        }

        return redirect()->route('subscriber.list')->with($response);
    }

    public function status(Request $request ,$id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->active = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($subscriber->save()) {
            $response["success"] = true;
            $response["message"] = "Subscriber Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Subscriber Status!";
        }

        return response()->json($response);
    }


    public function update(Request $request)
    {

        $valid =  $request->validate([
            'phone' => 'required',
            'email' => 'required|email',
            'data'  => 'nullable',
        ]);

        if($valid)
        {
          $subscriber = Subscriber::find($request->id);
          $subscriber->name = $request->input('name');
          $subscriber->email = $request->input('email');
          $subscriber->phone = $request->input('phone');
          $subscriber->data = json_encode($request->data);
          $management = User::role(['Admin', 'Brand Manager'])->get();
          $management->pluck('id');
          $data = array(
            "success"=> true,
            "message" => "Subscriber Updated Successfully"
           );

            if($subscriber->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Subscriber Updated Successfully",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->email,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Subscriber Not Updated Successfully.";

                Session::flash('error', $data["message"]);
            }

             return redirect()->route('subscriber.list')->with($data);
        }
        else {
           return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $subscriber = Subscriber::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Subscriber Destroy Successfully!"
        );

        if(!$subscriber->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Subscriber!";
        }

        return response()->json($response);

    }
}
