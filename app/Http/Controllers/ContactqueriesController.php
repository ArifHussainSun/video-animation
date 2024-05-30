<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contactqueries;
use App\Models\Pages;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ContactqueriesController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:ContactQueries-Create|ContactQueries-Edit|ContactQueries-View|ContactQueries-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:ContactQueries-Create', ['only' => ['form','store']]);
        $this->middleware('permission:ContactQueries-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:ContactQueries-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $subscriber = Contactqueries::all();
            return DataTables::of($subscriber)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('contact-queries.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                    }
                    if (Auth::user()->can('Subscriber-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="banner_status" switch="bool" data-id="' . $row->id . '" value="'.($row->status==1 ? "1" : "0").'" '.($row->status==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action', 'status','created_at'])->make(true);

        }

        return view('admin.contactqueries.list');
    }

    public function form($id = 0)
    {
        $pages = Pages::all();
        return view('admin.contactqueries.form', compact('pages'));
    }

    public function status(Request $request ,$id)
    {
        $subscriber = Contactqueries::find($id);
        $subscriber->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($subscriber->save()) {
            $response["success"] = true;
            $response["message"] = "Contact/Query Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Contact/Query Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'nullable',
            'pages_id' => 'nullable',
            'message' => 'nullable',
            'data' => 'nullable',
        ]);

        if ($valid) {
            $contactqueries = new Contactqueries();
            $contactqueries->name = $request->input('name');
            $contactqueries->email = $request->input('email');
            $contactqueries->message = $request->input('message');
            $contactqueries->subject = $request->input('subject');
            $contactqueries->pages_id = $request->input('pages_id');
            $contactqueries->data = json_encode($request->data);
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Contact/Query Added Successfully"
               );

            if ($contactqueries->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Contact/Queries",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->message,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Contact/Query Not Added Successfully.";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('contact-queries.list')->with($data);

        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request ,$id)
    {
        $pages = Pages::all();
        $where = array('id' => $request->id);
        $contactqueries  = Contactqueries::where($where)->first();
        // $contactqueries["pages"] = $pages;

        return view('admin.contactqueries.edit',compact('pages','contactqueries'));
    }

    public function view(Request $request, $isTrashed=null)
    {
        $where = array('id' => $request->id);

        if($isTrashed!=null) {
            $contactqueries = Contactqueries::onlyTrashed()->where($where)->first();
        } else {
            $contactqueries = Contactqueries::where($where)->first();
        }

        return Response::json($contactqueries);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'nullable',
            'subject' => 'nullable',
            'pages_id' => 'nullable',
            'data' => 'nullable',
        ]);

        if($valid) {
            $contactqueries = Contactqueries::find($request->id);
            $contactqueries->name = $request->input('name');
            $contactqueries->email = $request->input('email');
            $contactqueries->message = $request->input('message');
            $contactqueries->subject = $request->input('subject');
            $contactqueries->pages_id = $request->input('pages_id');
            $contactqueries->data = json_encode($request->data);
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Contact/Query Updated Successfully"
               );


               if($contactqueries->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Contact/Query Updated Successfully",
                    "desc" => array(
                        "added_title" => $request->input('name'),
                        "added_description" => $request->email,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Contact/Query Not Updated Successfully.";

                Session::flash('error', $data["message"]);
            }

             return redirect()->route('contact-queries.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function restore(Request $request ,$id)
    {
        $Contactqueries = Contactqueries::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Contact/Query Restored Successfully!"
        );

        if(!$Contactqueries->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Contact/Query!";
        }

        return redirect()->route('contact-queries.list')->with($response);
    }

    public function destroy(Request $request)
    {
        $subscriber = Contactqueries::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Contact/Query Destroy Successfully!"
        );

        if(!$subscriber->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Contact/Query!";
        }

        return response()->json($response);

    }

    public function delete(Request $request)
    {
        $subscriber = Contactqueries::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Contact/Query deleted Successfully!"
        );

        if(!$subscriber->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to deleted Contact/Query!";
        }

        return response()->json($response);
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $subscriber = Contactqueries::onlyTrashed();
            return DataTables::of($subscriber)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;
                    if (Auth::user()->can('Subscriber-Edit')) {
                        $html .= '<a href="'.route('contact-queries.restore',$row->id).'"  class="btn btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
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

        return view('admin.contactqueries.trashed');
    }




}
