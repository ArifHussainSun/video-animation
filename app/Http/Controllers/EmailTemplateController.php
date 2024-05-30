<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmailTemplate;
use App\Models\BrandSettings;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailTemplate;
use App\Jobs\MailTemplateJob;
use Barryvdh\DomPDF\Facade\PDF as PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Blade;
use App\Classes\Billing;
use App\Models\User;
use App\Traits\ApplicationTrait;
use Error;
use Illuminate\Console\Concerns\InteractsWithIO;
use Illuminate\Validation\Rule;
use PhpParser\Node\Expr\Error as ExprError;
use Throwable;

class EmailTemplateController extends Controller
{
    use ApplicationTrait;
    function __construct()
    {

        $this->middleware('permission:EmailTemplate-Create|EmailTemplate-Edit|EmailTemplate-View|EmailTemplate-Delete', ['only' => ['index','store']]);
        $this->middleware('permission:EmailTemplate-Create', ['only' => ['form','store']]);
        $this->middleware('permission:EmailTemplate-Edit', ['only' => ['edit','update']]);
        $this->middleware('permission:EmailTemplate-Delete', ['only' => ['destroy']]);
    }
    public function index(Request $request)
    {


        if ($request->ajax()) {
            $emailtemplate = EmailTemplate::whereNull('deleted_at')->with('createdBy')->get();
            return DataTables::of($emailtemplate)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $html = ' <a href="#" class="btn btn-primary viewModal"  data-bs-toggle="modal" data-bs-target=".emailtemplateDetailsModal" data-id="' . $row->id . '"><i title="View" class="fas fa-eye"></i></a>&nbsp';


                    $html .= '<a href="'.route('emailtemplate.edit',$row->id).'"  class="btn btn-success btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;

                    if (Auth::user()->can('EmailTemplate-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-xs  btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })
                ->addColumn('created_at', function ($row) {
                    return date('d-M-Y', strtotime($row->created_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->created_at)->diffForHumans() . '</label>';
                })
                ->addColumn('created_by_name', function ($row) {


                    return $row->createdBy()->first();
                })
                ->addColumn('status', function ($row) {
                    $btn = '<div class="square-switch"><input type="checkbox" id="switch' . $row->id . '" class="emailtemplate_status" switch="bool" data-id="' . $row->id . '" value="'.($row->status==1 ? "1" : "0").'" '.($row->status==1 ? "checked" : "").'/><label for="switch' . $row->id . '" data-on-label="Yes" data-off-label="No"></label></div>';
                    return $btn;
                })
                ->rawColumns(['action', 'status','created_at','created_by_name'])->make(true);

        }


        return view('admin.emailtemplate.list');
    }
    public function form()
    {
        $mailes = BrandSettings::where('key_name','LIKE',"%mail_setting%")->get();

        return view('admin.emailtemplate.add',compact('mailes'));
    }

    public function store(Request $request)
    {

        $valid =  $request->validate([
            'name' => 'required|unique:email_templates,name',
            'title' => 'required',
            'to' => 'required|email',
            'from' => 'required|email',
            'cc' => 'nullable|email',
            'bcc' => 'nullable|email',
            'subject' => 'required',
            'content' => 'required',
        ]);
        if($valid)
        {

           $brandSettings = $this->get_setting();

           $email_template = new EmailTemplate();
                $email_template->name = $request->name;
                $email_template->title = $request->title;
                $email_template->to = $request->to;
                $email_template->from = $request->from;
                $email_template->cc = $request->cc;
                $email_template->bcc = $request->bcc;
                $email_template->subject = $request->subject;
                $email_template->content = $request->content;
                $management = User::role(['Admin', 'Brand Manager'])->get();
                $management->pluck('id');
                $email_template->created_at = Carbon::now();
                $email_template->created_by = Auth::user()->id;
                $email_template->save();

                $notify = array(
                     "performed_by" => Auth::user()->id,
                     "title" => "Added New Email Template",
                     "desc" => array(
                         "added_title" => $request->input('name'),
                         "added_description" => $request->title,
                       )
                 );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', 'Email Template has been, Added Successfully.');
                return redirect()->route('emailtemplate.list')->with('success', 'Email Template has been, Added Successfully.');


        }
        else {
           return redirect()->back();
        }
    }



    function render($template) {
      $content = EmailTemplate::latest()->first();
    //   $this->invoice = Blade::render(' {!! $content !!} ', $this->brandSetting->toArray());
    //   return Blade::render('admin.emailtemplate.invoice', [ 'data' => $this->invoice ] );

      $this->invoice = Blade::render($content->content, $this->brandSetting->toArray());
      return Blade::render('admin.emailtemplate.invoice', [ 'data' => $this->invoice ] );
    }

    function generate() {
        $content = EmailTemplate::latest()->first();

        // $parseHTML = Blade::render(' {!! $content !!} ' , $this->brandSetting->toArray() );
        // $this->pdf = PDF::loadHtml($parseHTML);

        $parseHTML = Blade::render($content->content  , $this->brandSetting );
        $downloadPdf = $this->pdf = PDF::loadHtml($parseHTML);
        return $downloadPdf->download('invoice.pdf');

    }

    public function edit(Request $request,$id)
    {
        $mailes = BrandSettings::where('key_name','LIKE',"%mail_setting%")->get();
        $emailtemplate = EmailTemplate::where('id',$request->id)->first();

        return view('admin.emailtemplate.edit',compact('emailtemplate','mailes'));
    }

    public function view(Request $request,$id)
    {
        $emailtemplate = EmailTemplate::find($id);
        if(!$emailtemplate){
            abort(404);
        }

        $data['emailtemplate'] = $emailtemplate;

        $data['emailtemplatenames'] = EmailTemplate::where('id',$emailtemplate->id)->with('createdBy')->first();
        $data['created_by'] = $data['emailtemplate']->createdBy()->first()->first_name;
        $data['created_at']= Carbon::parse($data['emailtemplate']->created_at)->diffForHumans();
        if($data['emailtemplate']->updated_by != NULL){

            $data['updated_by'] = User::where('id',$data['emailtemplate']->updated_by)->first()->first_name;
        }
        else{
            $data['updated_by'] = "";
        }
        $data['updated_at']= Carbon::parse($data['emailtemplate']->updated_at)->diffForHumans();
        return $data;
    }
    public function update(Request $request)
    {
        $valid =  $request->validate([
            'name' => [
                        'required',
                        Rule::unique('email_templates')->ignore($request->id)
                    ],
            'title' => 'required',
            'to' => 'required|email',
            'from' => 'required|email',
            'cc' => 'nullable|email',
            'bcc' => 'nullable|email',
            'subject' => 'required',
            'content' => 'required',
        ]);

        if($valid)
        {
          $email_template = EmailTemplate::find($request->id);
          $email_template->name = $request->name;
          $email_template->title = $request->title;
          $email_template->to = $request->to;
          $email_template->from = $request->from;
          $email_template->cc = $request->cc;
          $email_template->bcc = $request->bcc;
          $email_template->subject = $request->subject;
          $email_template->content = $request->content;
          $email_template->updated_at = Carbon::now();
          $email_template->updated_by = Auth::user()->id;
          $management = User::role(['Admin', 'Brand Manager'])->get();
          $management->pluck('id');
          $email_template->save();

          $notify = array(
               "performed_by" => Auth::user()->id,
               "title" => "Updated Email Template",
               "desc" => array(
                   "added_title" => $request->input('name'),
                   "added_description" => $request->title,
                 )
           );
           Notification::send($management, new QuickNotify($notify));

           Session::flash('success', 'Email Template has been, Updated Successfully.');
           return redirect()->route('emailtemplate.list');
        }
        else {
           return redirect()->back();
        }
    }

    public function updateStatus(Request $request)
    {
        $update = EmailTemplate::where('id', $request->id)->update(['status' => $request->status]);

        if ($update) {
            $request->status == 1 ? $alertType = 'success' : $alertType = 'danger';
            $request->status == 1 ? $message = 'Email Template Activated Successfuly!' : $message = 'Email Template Deactivated Successfuly!';

            $notification = array(
                'message' => $message,
                'type' => $alertType,
                'icon' => 'mdi-check-all'
            );
        } else {
            $notification = array(
                'message' => 'Some Error Occured, Try Again!',
                'type' => 'error',
                'icon'  => 'mdi-block-helper'
            );
        }

        echo json_encode($notification);
    }
    public function delete(Request $request)
    {
        $emailtemplate = EmailTemplate::find($request->id);
        $response = array(
            "success" => true,
            "message" => "EmailTemplate Deleted Successfully!"
        );

        if(!$emailtemplate->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Deleted EmailTemplate!";
        }

        return response()->json($response);
    }
    public function destroy(Request $request)
    {

        $emailtemplate = EmailTemplate::withTrashed()->find($request->id);
        // dd($emailtemplate);
        if ($emailtemplate->forceDelete()) {

            $notification['type'] = "success";
            $notification['message'] = "emailtemplate Destroy Successfuly!.";
            $notification['icon'] = 'mdi-check-all';
            echo json_encode($notification);

        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Destroy emailtemplate, please try again.";
            $notification['icon'] = 'mdi-block-helper';
            echo json_encode($notification);

        }

    }
    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $data = EmailTemplate::onlyTrashed()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0);" class="restore btn btn-xs  btn-success btn-restore" data-id="' . $row->id . '"><i title="Restore" class="fas fa-trash-restore-alt "></i></a>&nbsp';
                    $btn .= '<a data-id="' . $row->id . '" class="btn btn-xs  btn-danger btn-destroy" ><i title="destroy" class="far fa-trash-alt "></i></a>&nbsp';

                    return $btn;
                })
                ->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })

                ->rawColumns(['action', 'deleted_at'])
                ->make(true);
        }
        return view('admin.emailtemplate.trash');
    }
    public function restore(Request $request)
    {
        $emailtemplate = EmailTemplate::withTrashed()->find($request->id);
        if ($emailtemplate) {
            $emailtemplate->restore();
            $notification['type'] = "success";
            $notification['message'] = "EmailTemplate Restored Successfuly!.";
            $notification['icon'] = 'mdi-check-all';

            echo json_encode($notification);
        } else {
            $notification['type'] = "danger";
            $notification['message'] = "Failed to Restore EmailTemplate, please try again.";
            $notification['icon'] = 'mdi-block-helper';

            echo json_encode($notification);
        }
    }
    function status(Request $request, $id) {
        $emailtemplate = EmailTemplate::find($id);
        $emailtemplate->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($emailtemplate->save()) {
            $response["success"] = true;
            $response["message"] = "Email Template Status Updated Successfully!";
        } else {
            $response["error"] = false;
            $response["message"] = "Failed to Update Email Template Status!";
        }

        return response()->json($response);
    }
}
