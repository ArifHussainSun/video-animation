<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    function __construct()
    {

        // $this->middleware('permission:banner-Create|subcategories-Edit|subcategories-View|subcategories-Delete', ['only' => ['index','store']]);
        // $this->middleware('permission:subcategories-Create', ['only' => ['form','store']]);
        // $this->middleware('permission:subcategories-Edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:subcategories-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $notification = Notification::all();

            return DataTables::of($notification)
                ->addIndexColumn()
                ->addColumn('title', function($row) {
                    $data = $row->data;

                    return $data["data"]["title"];
                })
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="' . $row->id  . '"><i class="far fa-eye"></i></button>&nbsp';
                    // if (Auth::user()->can('notification-Create')) {
                    // $html .= '<a href="#"  class="btn btn-success btn-edit" data-id="' . $row->id . '"><i class="fas fa-edit"></i></a>&nbsp';
                    // }
                    // if (Auth::user()->can('notification-Delete')) {
                    // $html .= '<button data-rowid="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    // }
                    return $html;
                })->addColumn('status', function ($row) {
                    if ($row->active == 0) {
                        $btn0 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="user_status" switch="bool" data-id="' . $row->id . '" value="0"/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn0;
                    } elseif ($row->active == 1) {
                        $btn1 = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="user_status" switch="bool" data-id="' . $row->id . '" value="1" checked/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                        return $btn1;
                    }
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->rawColumns(['action', 'status', 'created_at'])->make(true);
        }

        return view('admin.notification.notificationlist');
    }
    public function form($id = 0)
    {
        return view('admin.notification.notificationform');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $valid =  $request->validate([
            'title' => 'required',
        ]);
        // dd($valid);
        if ($valid) {
            $notification = new Notification();

            $notification->title = $request->input('title');
            $notification->description = $request->input('description');

            $notification->save();
            Session::flash('success', 'Notification has been, Added Successfully.');
            return redirect()->route('admin-notification.main')->with('success', 'Notification has been, Added Successfully.');
        } else {
            return redirect()->back();
        }
    }

    public function markAllRead()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->route('admin-notification.main');
    }

    public function view(Request $request)
    {
        $where = array('id' => $request->id);
        $notification = Notification::where($where)->with('user')->first();
        // $data = json_decode($notification->data);
        // $notify = $notification->data;
        // $notify["data"]["title"];
        // $notify['name'] = $data->data->performed_by;
        return Response()->json($notification);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $notification  = Notification::where($where)->first();

        return Response::json($notification);
    }
    public function update(Request $request)
    {

        $valid =  $request->validate([
            'title' => 'required',



        ]);

        if ($valid) {
            $notification = Notification::find($request->id);
            $notification->title = $request->input('title');
            $notification->description = $request->input('description');
            $notification->save();
            $data['success'] = "Notification has been, Updated Successfully.";
            $data['url'] = route('admin-notification.main');
            $data['save'] = $notification;
            Session::flash('success', 'Notification has been, Updated Successfully.');
            return Response()->json($data);
        } else {
            return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $notification = Notification::find($request->id);
        $notification->delete();

        return response()->json([
            'success' => 'Notification deleted successfully!'
        ]);
    }
}
