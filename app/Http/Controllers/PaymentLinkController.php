<?php

namespace App\Http\Controllers;

use App\Models\BrandSettings;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\PaymentLink;
use App\Models\CountryCurrencies;
use App\Models\PaymentSaleTypeModel;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\QuickNotify;
use Illuminate\Support\Facades\Response;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Stripe;
use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Support\Str;

use function GuzzleHttp\Promise\all;

class PaymentLinkController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:PaymentLinkGenerator-Create|PaymentLinkGenerator-Edit|PaymentLinkGenerator-View|PaymentLinkGenerator-Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:PaymentLinkGenerator-Create', ['only' => ['form', 'store']]);
        $this->middleware('permission:PaymentLinkGenerator-Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:PaymentLinkGenerator-Delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $paymentlink = PaymentLink::all();

            return DataTables::of($paymentlink)
                ->addColumn('item', function ($row) {
                    return $row->item_name;
                })
                ->addColumn('price', function ($row) {
                    $currency = CountryCurrencies::find($row->currency);
                    return $currency->currency_symbol . " " . $row->price;
                })
                ->addColumn('payment_gateway', function ($row) {
                    $gateway_name = str_replace("payment_gateway_", "", $row->payment_gateway);
                    $gateway_name = str_replace("_", " ", $gateway_name);
                    $gateway_name = Str::upper($gateway_name);
                    return $gateway_name;
                })
                ->addColumn('category', function ($row) {
                    $category_id = Categories::find($row->category_id)->first();

                    return $category_id->name;
                })
                ->addColumn('sale_type', function ($row) {
                    $sale_type = PaymentSaleTypeModel::find($row->sale_type_id)->first();

                    return $sale_type->name;
                })
                /* ->addColumn('valid_till', function ($row) {
                    return Carbon::now()->timestamp($row->valid_till);
                }) */
                ->addColumn('time_left', function ($row) {
                    
                    if ($row->status == 2) {
                        $status = array('text' => 'Paid!', 'badge' => 'success',);
                    } else {
                        $finishTime = Carbon::now()->timestamp($row->valid_till);
                        $currentTime =  Carbon::now();

                        $totalDurationInHours = $currentTime->diffInHours($finishTime, false);
                        $totalDurationInMins = $currentTime->diffInSeconds($finishTime, false);
                        
                        if (($totalDurationInHours >= 1)&&($totalDurationInHours <= 48)) {
                            if($totalDurationInHours == 1) {
                                $time_left = array('text' => $totalDurationInHours . " Hour", 'badge' => 'primary',);
                            } else {
                                $time_left = array('text' => $totalDurationInHours . " Hours", 'badge' => 'primary',);
                            }
                        } else if ($totalDurationInMins > 0) {
                            $time_left = array('text' => (number_format($totalDurationInMins / 60, 0)) . " Mins", 'badge' => 'primary',);
                        } else {
                            $time_left = array('text' => 'Expired', 'badge' => 'danger',);
                        }
                       
                    }

                    if(!empty($time_left)){
                        $html = '<span class="bg-'.$time_left["badge"].' badge me-2">'.$time_left["text"].'</span>';
                    }
                    else{
                        $html = '<span class="bg-primary badge me-2">48 Hours</span>';

                    }
                    return $html;
                })
                ->addColumn('status', function ($row) {

                    $finishTime = Carbon::now()->timestamp($row->valid_till);
                    $currentTime =Carbon::now();

                    $totalDurationInHours = $currentTime->diffInHours($finishTime, false);
                    $totalDurationInMins = $currentTime->diffInSeconds($finishTime, false);

                    if ($row->status == 2) {
                        $status = array('text' => 'Paid', 'badge' => 'success',);
                    }
                    else {
                        if($totalDurationInMins > 0){
                            $status = array('text' => 'Active', 'badge' => 'primary',);
                        }
                        else{
                            $status = array('text' => 'Inactive', 'badge' => 'danger',);
                        }
                            
                    }

                    $html = '<span class="bg-' . $status["badge"] . ' badge me-2">' . $status["text"] . '</span>';
                    return $html;
                })
                
                ->addColumn('action', function ($row) {

                    $gateway_name = explode("_", $row->payment_gateway);
                    $gateway_type = $gateway_name[2];
                    $link = route('payment.'.$gateway_type).'?token='.$row->token;
                    
                    $html = '<input type="hidden" class="form-control" name="link" id="copy_link_'.$row->id.'" value="'.$link.'"><button class="btn btn-primary btn-sm btn-copy" data-id="'.$row->id.'"><i class="far fa-copy"></i></button>&nbsp';

                        $html .= '<button href="#"  class="btn btn-primary btn-sm btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;

                    if (Auth::user()->can('PaymentLinkGenerator-Edit')) {
                        $html .= '<a href="'.route('payment-link-generator.edit',$row->id).'"  class="btn btn-success btn-sm btn-edit" ><i class="fas fa-edit"></i></a>&nbsp' ;
                        // $html .= '<a href="'.route('paymentlink.fetchdata',$row->id).'" style="background-color: #008CBA;color:white"  class="btn btn-default btn-detail"><i class="fas fa-arrow-right"></i></a>&nbsp' ;
                    }

                    if (Auth::user()->can('PaymentLinkGenerator-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-sm btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }

                    if ($row->status == 0) {
                        $html .= '<button class="btn btn-warning btn-sm btn-extend" data-id="'.$row->id.'"><i class="fas fa-arrow-up"></i></button>&nbsp' ;
                    }

                    return $html;
                })
                ->rawColumns(['time_left', 'status', 'action'])
                ->toJson();
        }

        return view('admin.paymentlink.list');
    }

    public function trashed(Request $request)
    {
        if ($request->ajax()) {
            $paymentlink = PaymentLink::onlyTrashed();

            return DataTables::of($paymentlink)
                ->addColumn('item', function ($row) {
                    return $row->item_name;
                })
                ->addColumn('price', function ($row) {
                    $currency = CountryCurrencies::find($row->currency);
                    return $currency->currency_symbol . " " . $row->price;
                })
                ->addColumn('payment_gateway', function ($row) {
                    $gateway_name = str_replace("payment_gateway_", "", $row->payment_gateway);
                    $gateway_name = str_replace("_", " ", $gateway_name);
                    $gateway_name = Str::upper($gateway_name);
                    return $gateway_name;
                })
                ->addColumn('category', function ($row) {
                    $category_id = Categories::find($row->category_id)->first();

                    return $category_id->name;
                })
                ->addColumn('sale_type', function ($row) {
                    $sale_type = PaymentSaleTypeModel::find($row->sale_type_id)->first();

                    return $sale_type->name;
                })
                /* ->addColumn('valid_till', function ($row) {
                    return Carbon::now()->timestamp($row->valid_till);
                }) */
                ->addColumn('time_left', function ($row) {
                    if ($row->status == 2) {
                        $status = array('text' => 'Paid!', 'badge' => 'success',);
                    } else {
                        $finishTime = Carbon::now()->timestamp($row->valid_till);
                        $currentTime =  Carbon::now();

                        $totalDurationInHours = $currentTime->diffInHours($finishTime, false);
                        $totalDurationInMins = $currentTime->diffInSeconds($finishTime, false);
                        
                        if (($totalDurationInHours >= 1)&&($totalDurationInHours <= 48)) {
                            if($totalDurationInHours == 1) {
                                $status = array('text' => $totalDurationInHours . " Hour", 'badge' => 'primary',);
                            } else {
                                $status = array('text' => $totalDurationInHours . " Hours", 'badge' => 'primary',);
                            }
                        } else if ($totalDurationInMins > 0) {
                            $status = array('text' => (number_format($totalDurationInMins / 60, 0)) . " Mins", 'badge' => 'primary',);
                        } else {
                            $status = array('text' => 'Expired', 'badge' => 'danger',);
                        }
                       
                    }

                    $html = '<span class="bg-'.$status["badge"].' badge me-2">'.$status["text"].'</span>';

                    return $html;
                })
                ->addColumn('status', function ($row) {
                    $finishTime = Carbon::now()->timestamp($row->valid_till);
                    $currentTime =Carbon::now();

                    $totalDurationInHours = $currentTime->diffInHours($finishTime, false);
                    $totalDurationInMins = $currentTime->diffInSeconds($finishTime, false);

                    if ($row->status == 2) {
                        $status = array('text' => 'Paid', 'badge' => 'success',);
                    }
                    else {
                        if($totalDurationInMins > 0){
                            $status = array('text' => 'Active', 'badge' => 'primary',);
                        }
                        else{
                            $status = array('text' => 'Inactive', 'badge' => 'danger',);
                        }
                            
                    }

                    $html = '<span class="bg-' . $status["badge"] . ' badge me-2">' . $status["text"] . '</span>';
                    return $html;

                })
                
                ->addColumn('deleted_at', function ($row) {
                    return date('d-M-Y', strtotime($row->deleted_at)) . '<br /> <label class="text-primary">' . Carbon::parse($row->deleted_at)->diffForHumans() . '</label>';
                })
                ->addColumn('action', function ($row) {
                    $html = '<button href="#"  class="btn btn-primary btn-sm btn-view" data-bs-toggle="modal" data-bs-target=".orderdetailsModal" data-id="'.$row->id.'"><i class="far fa-eye"></i></button>&nbsp' ;

                    if (Auth::user()->can('PaymentLinkGenerator-Edit')) {
                        $html .= '<a href="'.route('payment-link-generator.restore',$row->id).'"  class="btn btn-sm btn-success btn-restore" ><i class="mdi mdi-delete-restore"></i></a>&nbsp' ;
                    }

                    if (Auth::user()->can('PaymentLinkGenerator-Delete')) {
                        $html .= '<button data-id="' . $row->id . '" id="sa-params" class="btn btn-sm btn-danger btn-delete" ><i class="far fa-trash-alt"></i></button>&nbsp';
                    }
                    return $html;
                })
                ->rawColumns(['time_left', 'status', 'deleted_at', 'action'])
                ->toJson();
        }

        return view('admin.paymentlink.trashed');
    }

    public function form()
    {
        $customer = User::role('Customer')->get();
        $currency = CountryCurrencies::all();
        $sale_types = PaymentSaleTypeModel::all();
        $categories = Categories::all();
        $paymentGateways = BrandSettings::where('key_name', 'like', '%payment_gateway_%')->get();
        $defaultCurrency = BrandSettings::where('key_name', 'like', '%default_currency%')->first();
        $defaultPaymentGateway = BrandSettings::where('key_name', 'like', '%default_payment_gateway%')->first();

        return view('admin.paymentlink.add', compact('customer','currency', 'sale_types', 'paymentGateways', 'categories', 'defaultCurrency','defaultPaymentGateway'));
    }

    protected function discountAccType($discount_type, $discount, $itemprice)
    {
        $discounted_price = 0;
        $discount = floatval($discount);
        $itemprice = floatval($itemprice);

        if ($discount_type == "flat") {
            $discounted_price = $itemprice - $discount;
        } else if ($discount_type == "percent") {
            $discounted_price = ceil($itemprice - ($itemprice * ($discount / 100)));
        }

        return $discounted_price;
    }

    function status(Request $request, $id,$isType=null) {

        $paymentLinkgenerator = PaymentLink::find($id);
        $paymentLinkgenerator->status = (($request->status == "true") ? 1 : 0);

        $response = array();

        if($paymentLinkgenerator->save()) {
            $response["success"] = true;
            $response["message"] = "Payment Link Generator Status Updated Successfully!";
        } else {
            $response["success"] = false;
            $response["message"] = "Failed to Update Payment Link Generator Status!";
        }

        return response()->json($response);
    }


    public function store(Request $request) {
        $current_date_time = Carbon::now()->toDateTimeString();
        $request["token"] = sha1(uniqid($current_date_time, true));

        $valid =  $request->validate([
            'customer_id' => 'nullable',
            'sale_type' => 'required',
            'token' => 'unique:payment_links,token',
            'item_name' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'discount_type' => 'nullable',
            'item_description' => 'nullable',
            'currency' => 'required',
            'category_id' => 'required',
            'coupon_id' => 'nullable',
            'payment_type' => 'required',
            'payment_gateway' => 'required',
        ]);

        if ($valid) {
            $paymentlink = new PaymentLink();

            if ($request->filled('customer_id')) {
                $paymentlink->customer_id = $request->customer_id;
            }

            if($request->filled('discount')) {
                $discounted_price = $this->discountAccType($request->discount_type, $request->discount, $request->price);
            } else {
                $discounted_price = $this->discountAccType('flat', 0, $request->price);
            }

            $paymentlink->valid_till = Carbon::now()->addHours(48)->timestamp;
            $paymentlink->item_name = $request->item_name;
            $paymentlink->price = $discounted_price;
            $paymentlink->original_price = $request->price;
            $paymentlink->discount = $request->discount;
            $paymentlink->discount_type = $request->discount_type;
            $paymentlink->item_description = $request->item_description;
            $paymentlink->sale_type_id = $request->sale_type;
            $paymentlink->currency = $request->currency;
            $paymentlink->comment = $request->comment;
            $paymentlink->category_id = $request->category_id;
            $paymentlink->payment_type = $request->payment_type;
            $paymentlink->token = $request->token;
            $paymentlink->payment_gateway = $request->payment_gateway;
            $paymentlink->created_by = Auth::user()->id;
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Payment Link Generator Added Successfully."
            );

            if ($paymentlink->save()) {

                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Added New Payment Link Generator",
                    "desc" => array(
                       "added_title" => $request->input('item_name'),
                       "added_description" => $request->item_description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);

            }else {
                $data["success"] = false;
                $data["message"] = "Payment Link Generator Not Added Successfully.";

                Session::flash('error', $data["message"]);
            }

            return redirect()->route('payment-link-generator.list')->with($data);

        } else {
            return redirect()->back();
        }
    }

    public function restore(Request $request ,$id)
    {
        $paymentLink = PaymentLink::withTrashed()->find($id);
        $response = array(
            "success" => true,
            "message" => "Payment Link Generator Restored Successfully!"
        );

        if(!$paymentLink->restore()) {
            $response["success"] = false;
            $response["message"] = "Failed to Restore Payment Link Generator!";
        }

        return redirect()->route('payment-link-generator.list')->with($response);
    }

    public function edit(Request $request ,$id) {
        $saletypes = PaymentSaleTypeModel::all();
        $categories = Categories::all();
        $paymentGateways = BrandSettings::where('key_name', 'like', '%payment_gateway_%')->get();
        $customers = User::role('Customer')->get();
        $currency = CountryCurrencies::all();
        $where = array('id' => $id);
        $paymentlink  = PaymentLink::where($where)->first();
        
        // $paymentlink["saletypes"] = $saletypes;
        // $paymentlink["paymentlik"] = $paymentlik;
        // $paymentlink["customer"] = $customer;
        // $paymentlink["currency"] = $currency;
        // $paymentlink["paymentlinks"] = $paymentlinks;
        // $paymentlink["categories"] = $categories;
        // $paymentlink["paymentGateways"] = $paymentGateways;

        return view('admin.paymentlink.edit',compact('saletypes','customers','currency','paymentlink','categories','paymentGateways'));
    }
    public function view(Request $request,$isTrashed=null) {

        $saletypes = PaymentSaleTypeModel::all();
        $categories = Categories::all();
        $paymentGateways = BrandSettings::all();
        $customers = User::role('Customer')->get();
        $currency = CountryCurrencies::all();
        $where = array('id' => $request->id);
        if($isTrashed != null && $isTrashed == 1 ) {

            $paymentlink  = PaymentLink::onlyTrashed()->where($where)->with('customer','countrycurrencies','categories','PaymentSaleType')->first();
            $paymentlink["saletypes"] = $saletypes;
            $paymentlink["categories"] = $categories;
            $paymentlink["paymentGateways"] = $paymentGateways;
            $paymentlink["customers"] = $customers;
            $paymentlink["currency"] = $currency;

        } else {

            $paymentlink  = PaymentLink::where($where)->with('customer','countrycurrencies','categories','PaymentSaleType')->first();
            $paymentlink["saletypes"] = $saletypes;
            $paymentlink["categories"] = $categories;
            $paymentlink["paymentGateways"] = $paymentGateways;
            $paymentlink["customers"] = $customers;
            $paymentlink["currency"] = $currency;
        }
        return Response()->json($paymentlink);

    }

    public function update(Request $request)
    {
        $valid =  $request->validate([
            'customer_id' => 'nullable',
            'sale_type' => 'required',
            'item_name' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'discount_type' => 'nullable',
            'item_description' => 'nullable',
            'currency' => 'required',
            'category_id' => 'required',
            'coupon_id' => 'nullable',
            'payment_type' => 'required',
            'payment_gateway' => 'required',
        ]);

        if ($valid) {
            $paymentlink = PaymentLink::find($request->id);
            $paymentlink->customer_id = $request->customer_id;

            if(($request->filled('discount')) && ($request->discount!=$paymentlink->discount) || ($request->price!=$paymentlink->price)) {
                $discounted_price = $this->discountAccType($request->discount_type, $request->discount, $request->price);
                
            } else {
                $discounted_price = $this->discountAccType('flat', 0, $request->price);
            }
            
            $paymentlink->item_name = $request->item_name;
            $paymentlink->price = $discounted_price;
            $paymentlink->original_price = $request->price;
            $paymentlink->discount = $request->discount;
            $paymentlink->discount_type = $request->discount_type;
            $paymentlink->item_description = $request->item_description;
            $paymentlink->sale_type_id = $request->sale_type;
            $paymentlink->currency = $request->currency;
            $paymentlink->comment = $request->comment;
            $paymentlink->category_id = $request->category_id;
            $paymentlink->payment_type = $request->payment_type;
            $paymentlink->payment_gateway = $request->payment_gateway;
            $paymentlink->updated_by = Auth::user()->id;
            $management = User::role(['Admin', 'Brand Manager'])->get();
            $management->pluck('id');
            $data = array(
                "success"=> true,
                "message" => "Payment Link Generator Updated Successfully."
            );

            if ($paymentlink->save()) {
                $notify = array(
                    "performed_by" => Auth::user()->id,
                    "title" => "Updated Payment Link Generator",
                    "desc" => array(
                       "updated_title" => $request->input('item_name'),
                       "updated_description" => $request->item_description,
                    )
                );
                Notification::send($management, new QuickNotify($notify));
                Session::flash('success', $data["message"]);

            }else {
                $data["success"] = false;
                $data["message"] = "Payment Link Generator Not Updated Successfully.";

                Session::flash('error', $data["message"]);
            }
            return redirect()->route('payment-link-generator.list')->with($data);
        } else {
            return redirect()->back();
        }
    }

    public function delete(Request $request)
    {
        $paymentlik = PaymentLink::find($request->id);
        $response = array(
            "success" => true,
            "message" => "Payment Link Generator Deleted Successfully!"
        );

        if(!$paymentlik->delete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Delete Payment Link Generator!";
        }

        return response()->json($response);
    }


    public function destroy(Request $request)
    {
        $paymentlink = PaymentLink::onlyTrashed()->find($request->id);

        $response = array(
            "success" => true,
            "message" => "Payment Link Generator Destroy Successfully!"
        );

        if(!$paymentlink->forceDelete()) {
            $response["success"] = false;
            $response["message"] = "Failed to Destroy Payment Link Generator!";
        }

        return response()->json($response);
    }

    // Cron Job To update link status
    public static function checkLinkValidity()
    {
        $paymentlinks = PaymentLink::where('status',1)->get();
        
        foreach ($paymentlinks as $paymentlink) {

            $finishTime = Carbon::now()->timestamp($paymentlink->valid_till);
            $currentTime =Carbon::now();

            $totalDurationInHours = $currentTime->diffInHours($finishTime, false);
            $totalDurationInMins = $currentTime->diffInSeconds($finishTime, false);

        if ($totalDurationInMins <= 0) {

            $linkupdate = PaymentLink::find($paymentlink->id);
            $linkupdate->status = 0;
            $linkupdate->save();
        }
    }                
        
    }

    public function extendValidity(Request $request)
    {
        $paymentlink = PaymentLink::find($request->id);
        $paymentlink->valid_till = Carbon::now()->addHours(48)->timestamp;
        $paymentlink->status = 1;
        $paymentlink->status = 1;
        
        if($paymentlink->save()) {
            $response["success"] = true;
            $response["type"] = "success";
            $response["message"] = "Payment Link Generator Date Extended Successfully!";
        } else {
            $response["success"] = false;
            $response["type"] = "danger";
            $response["message"] = "Failed to Extend Payment Link Generator Date!";
        }
        
        return response()->json($response);

    }
}
