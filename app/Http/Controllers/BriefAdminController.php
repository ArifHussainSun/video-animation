<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Briefs;
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

class BriefAdminController extends Controller
{
    function __construct()
    {

        $this->middleware('permission:Brief-Create|Brief-Edit|Brief-View|Brief-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:Brief-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:Brief-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Brief-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $brief = Briefs::all();
            return DataTables::of($brief)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="' . $row->id . '"><i class="far fa-eye"></i></button>&nbsp';
                    if (Auth::user()->can('Brief-Edit')) {
                        $html .= '<a href="' . route('brief.edit', $row->id) . '"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp';
                    }
                    if (Auth::user()->can('Brief-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="banner_status" switch="bool" data-id="' . $row->id . '" value="' . ($row->active == 1 ? "1" : "0") . '" ' . ($row->active == 1 ? "checked" : "") . '/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action', 'status', 'created_at'])->make(true);
        }

        return view('admin.brief.list');
    }

    public function form($id = 0)
    {
        return view('admin.brief.form');
    }

    public function status(Request $request, $id)
    {
        $brief = Briefs::find($id);
        $brief->active = (($request->active == "true") ? 1 : 0);

        $response = array();

        if ($brief->save()) {
            $response["success"] = true;
            $response["message"] = "Brief Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Brief Status!";
        }

        return response()->json($response);
    }

    public function store(Request $request)
    {
        $valid =  $request->validate([
            'cus_name' => 'required',
            'cus_email' => 'required|email',
            'company_name' => 'nullable',
            'company_slogan' => 'nullable',
            'industry' => 'nullable',
            'logo_color' => 'nullable',
            'logo_style' => 'nullable',
            'logo_type' => 'nullable',
            'data' => 'nullable',
        ]);

        if ($valid) {
            $brief = new Briefs();
            $brief->cus_name = $request->cus_name;
            $brief->cus_email = $request->cus_email;
            $brief->company_name = $request->company_name;
            $brief->company_slogan = $request->company_slogan;
            $brief->industry = $request->industry;
            $brief->logo_color = $request->logo_color;
            $brief->logo_style = $request->logo_style;
            $brief->logo_type = $request->logo_type;
            $brief->data = json_encode($request->data);
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success" => true,
                "message" => "Brief Added Successfully"
            );

            if ($brief->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Brief",
                    "desc" => array(
                        "added_title" => $request->cus_name,
                        "added_description" => $request->data,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Brief Not Added Successfully.";
                Session::flash('error', $data["message"]);
            }
            return redirect()->route('brief.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function edit(Request $request, $id)
    {
        $pages = Pages::all();
        $where = array('id' => $request->id);
        $brief  = Briefs::where($where)->first();
        // $brief["pages"] = $pages;

        return view('admin.brief.edit', compact('pages', 'brief'));
    }

    public function view(Request $request, $isTrashed = null)
    {
        $where = array('id' => $request->id);

        if ($isTrashed != null) {
            $brief = Briefs::onlyTrashed()->where($where)->first();

        } else {
            $brief = Briefs::where($where)->first();
        }

        $arraydata = array(
            "industry" => $brief->industry,
            "logo_color" => $brief->logo_color,
            "logo_style" => $brief->logo_style,
            "logo_type" => $brief->logo_type,
            "data" => $brief->data,
        );


        //return json_decode($arraydata);
        return Response::json($brief);
    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'cus_name' => 'required',
            'cus_email' => 'required|email',
            'company_name' => 'nullable',
            'company_slogan' => 'nullable',
            'industry' => 'nullable',
            'logo_color' => 'nullable',
            'logo_style' => 'nullable',
            'logo_type' => 'nullable',
            'data' => 'nullable',
        ]);

        if ($valid) {
            $brief = Briefs::find($request->id);
            $brief->cus_name = $request->cus_name;
            $brief->cus_email = $request->cus_email;
            $brief->company_name = $request->company_name;
            $brief->company_slogan = $request->company_slogan;
            $brief->industry = $request->industry;
            $brief->logo_color = $request->logo_color;
            $brief->logo_style = $request->logo_style;
            $brief->logo_type = $request->logo_type;
            $brief->data = json_encode($request->data);

            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success" => true,
                "message" => "Brief Updated Successfully"
            );


            if ($brief->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Brief Updated Successfully",
                    "desc" => array(
                        "added_title" => $request->cus_name,
                        "added_description" => $request->data,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);
            } else {
                $data["success"] = false;
                $data["message"] = "Brief Not Updated Successfully.";

                Session::flash('error', $data["message"]);
            }

            return redirect()->route('brief.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function restore(Request $request, $id)
    {
        $Briefs = Briefs::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Brief Restored Successfully!"
        );

        if (!$Briefs->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Brief!";
        }

        return redirect()->route('brief.list')->with($response);
    }

    public function destroy(Request $request)
    {
        $brief = Briefs::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Brief Destroy Successfully!"
        );

        if (!$brief->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Brief!";
        }

        return response()->json($response);
    }

    public function delete(Request $request)
    {
        $brief = Briefs::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Brief deleted Successfully!"
        );

        if (!$brief->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to deleted Brief!";
        }

        return response()->json($response);
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $brief = Briefs::onlyTrashed();
            return DataTables::of($brief)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-view"  data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="' . $row->id . '"><i class="far fa-eye"></i></button>&nbsp';
                    if (Auth::user()->can('Brief-Edit')) {
                        $html .= '<a href="' . route('brief.restore', $row->id) . '"  class="btn btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp';
                    }
                    if (Auth::user()->can('Brief-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="brief_status" switch="bool" data-id="' . $row->id . '" value="' . ($row->active == 1 ? "1" : "0") . '" ' . ($row->active == 1 ? "checked" : "") . '/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';

                    return $btn;
                })->rawColumns(['action', 'status', 'deleted_at'])->make(true);
        }

        return view('admin.brief.trashed');
    }
}
