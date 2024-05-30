<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceController;
use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use App\Models\Coupon;
use App\Models\Invoice;
use App\Models\PaymentLink;
use App\Models\Payments;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;

class PaymentController extends Controller
{


    public function index(Request $request) {
        if($request->has('token')) {
            $item_detail = PaymentLink::where("token", "=", $request->token);
            
            if($item_detail->exists()) {
                $item_detail = $item_detail->first();

                if($item_detail->valid_till < Carbon::now()->toDateTimeString()) {
                    //$gateway_setting = BrandSettings::where("key_name", "=", $item_detail->payment_gateway)->first();
                    
                    $gateway_name = str_replace("payment_gateway_", "", $item_detail->payment_gateway);
                    $gateway_name = explode("_", $gateway_name);

                    if($gateway_name[0] == "stripe") {
                        return redirect()->route('payment.stripe', ["token" => $request->token]);
                    } else if($gateway_name[0] == "braintree") {

                    }
                } else {
                    $data = array(
                        "heading" => "Sorry! Token is Expired.",
                        "message" => "Kindly chat with our sales team in this regard.",
                        "title" => "Sorry! Token is Expired",
                    );

                    $this->failed($data);

                    //return response()->json(["message"=>"Token is exired."]);
                }
            } else {
                $data = array(
                    "heading" => "Sorry! Token isn't Valid.",
                    "message" => "Kindly chat with our sales team.",
                    "title" => "Sorry! Token isn't Valid",
                );
                $this->failed($data);
                
                return response()->json(["message"=>"Token is not valid."]);
            }        
        } else {
            $data = array(
                "heading" => "Sorry! Token Not Exist.",
                "message" => "Kindly chat with our sales team.",
                "title" => "Sorry! Token Not Exist.",
            );
            $this->failed($data);
        }
    }

    public function success(Request $request) {
        if(Session()->get('success_data')) {
            //return response()->json(Session()->get('failed_data'));
            return view('frontend.payments.transaction_success', ["data"=> Session()->get('success_data')]);
        } else {
            return redirect()->route('payment.expired');
        }
    }

    public function failed(Request $request, $data="") {
        if(Session()->get('failed_data')) {
            return view('frontend.payments.transaction-failed', ["data"=> Session()->get('failed_data')]);
        } else {
            return redirect()->route('payment.expired');
        }
    }

    public function expired(Request $request) {
        return view('frontend.payments.token-expired', [
            'current_time' => Carbon::now()->timestamp,
            'data'=> Session()->get('failed_data')
        ]);
    }

    public function tokenData(Request $request) {
        $token = $request->token;
        $item_detail = PaymentLink::select('id','token','item_name','price','discount_type','discount','original_price','item_description','currency','payment_gateway','category_id', 'sale_type_id')
                        ->where("token", "=", $token)
                        ->with(
                            [
                                'countrycurrencies' => function ($query) {
                                    $query->select('id', 'currency_code', 'currency_name', 'currency_symbol');
                                },'categories' => function ($query) {
                                    $query->select('id', 'name');
                                },'PaymentSaleType' => function ($query) {
                                    $query->select('id', 'name');
                                }
                            ],
                        );
        $item_detail = $item_detail->first();
        $gateway_setting = BrandSettings::where("key_name", "=", $item_detail->payment_gateway)->first();
        $payment_gateway = json_decode($gateway_setting->key_value);
        
        $public_key = $payment_gateway->public_key;
        
        Session()->put('payment_gateway', $payment_gateway);

        return response()->json([
            "status" => true,
            "data" => array(
                "stripe" => array("public_key"=> $public_key),
                "service" => $item_detail,
            )
        ]);

    }

    public function storePaymentApi(Request $request)
    {
        $formData = Arr::pluck($request->all(), 'value', 'name');

        if (!empty($formData)) {

            $customer = User::where("email", "=", $formData["clientemail"]);
            $paymentLink = PaymentLink::where("token", "=", $formData["ptoken"])->first();
            $paymentLink = $paymentLink->toArray();

            if($customer->exists()) {
                $customerData = $customer->first();
                $customer_id = $customerData->id;
                
            } else {
                $customer = new User();
                $customer->first_name = $formData["firstname"];
                $customer->last_name = $formData["lastname"];
                $customer->email = $formData["clientemail"];
                $customer->phone_number = $formData["phonenum"];
                $customer->company_name = $formData["companyname"];
                $customer->address = $formData["address"];
                $customer->city = $formData["city"];
                $customer->state = $formData["statename"];
                $customer->zipcode = $formData["zipcode"];
                $customer->country = $formData["country"];
                $customer->created_by = $paymentLink["created_by"];
                $customer->created_at = Carbon::now();
                $default_customer_password = BrandSettings::where('key_name', 'like', '%default_customer_password%')->first();
                $password = (!empty($default_customer_password->key_value)) ? $default_customer_password->key_value : "12345678";
                $customer->password = Hash::make($password);
                $customer->save();
                $customer_id = $customer->id;
                $roles = "Customer";
                $customer->assignRole($roles);
            }

            $payments = new Payments();
            $payments->customer_id = $customer_id;
            
            $payments->Item_name = $formData['itemname'];
            $payments->price = $formData['itemprice'];
            $payments->discount = $formData['discount'];
            $payments->original_price = $paymentLink['original_price'];
            $payments->currency = $paymentLink['currency'];
            $payments->category_id = $paymentLink['category_id'];
            $payments->sale_type_id = $paymentLink['sale_type_id'];
            $payments->payment_gateway = $paymentLink['payment_gateway'];
            $payments->payment_type = $paymentLink['payment_type'];
            $payments->token = $formData['ptoken'];
                
            if(!empty($formData["payment_error"]) || !empty($formData["payment_message"])) {
                $error_message = array(
                    "error" => $formData["payment_error"],
                    "message" => $formData["payment_message"],
                );
                $payments->comment = $formData["payment_message"];
                $payments->message = json_encode($error_message);
                $payments->status = 2;
            } else {
                $payments->comment = "";
                $payments->message = "";
                $payments->status = 1;
            }
        
            $payments->payment_on = Carbon::now()->format('Y-m-d');
            $payments->created_by = (!empty($paymentLink['created_by']) ? $paymentLink['created_by'] : NULL);
            $payments->save();
            
            if(!empty($formData["payment_error"]) || !empty($formData["payment_message"])) { 
                $sessional_time = Carbon::now()->addMinutes(10)->timestamp;
                
                $failed_data = array(
                    'current_time' => Carbon::now()->timestamp,
                    'session' => $sessional_time,
                    'currency' => $formData['currency'],
                    'itemprice' => $formData['itemname'],
                    'title' => 'Payment Failed | '.$formData['currency'].$formData['itemname'].' | Message:'.$formData["payment_message"],
                    'heading' => 'Payment Failed' ,
                    'message' => $formData["payment_message"]
                );

                Session::flash("failed_data",$failed_data);
                return response()->json(['failed' => true, 'route' => route('payment.failed')], 200);

            } else {
                $payment_id = $payments->id;

                InvoiceController::create($payment_id,1);
                $invoice_data = Invoice::where('payment_id',$payment_id)->first();
                
                if(!empty($formData['coupon_id'])){
                    $coupon = Coupon::find($formData['coupon_id']);
                    $coupon->quantity = $coupon->quantity - 1;
                    $coupon->utilized = $coupon->utilized + 1;
                    $coupon->save();
                }
 
                if($this->paymentLinkStatus($paymentLink['id'], 2 )) {
                    $success_data = array(
                        "original_price" => $paymentLink['original_price'],
                        "itemname" => $formData['itemname'],
                        "itemprice" => $formData['itemprice'],
                        "currency" => $formData['currency'],
                        "invoice_id" => $invoice_data->invoice_no,
                        "discount" => $formData['discount'],
                        "coupon_id" => $formData['coupon_id'],

                    );
                
                // InvoiceController::email_sent($customer_id);
                
                Session::flash("success_data",$success_data);
                return response()->json(['success' => true, 'route' => route('payment.success')], 200);
                }
        }

            } else {
         return redirect()->back();
        }
    }

    public function generatelink($productId)
    {
        $product = Product::find($productId);
        $current_date_time = Carbon::now()->toDateTimeString();
        $token = sha1(uniqid($current_date_time, true));
        $default_payment_gateway = BrandSettings::where("key_name", '=', "default_payment_gateway")->first();
        $default_currency = BrandSettings::where("key_name", '=', "default_currency")->first();
        $currency = CountryCurrencies::where('aplha_code2',$default_currency->key_value)->first();
        $user = User::role('Developer')->latest('id')->first();


        $paymentlink = new PaymentLink();
        $paymentlink->valid_till = Carbon::now()->addHours(48)->timestamp;
        $paymentlink->item_name = $product->name;
        $paymentlink->price = $product->price;
        $paymentlink->original_price = $product->original_price;
        $paymentlink->item_description = $product->description;
        $paymentlink->sale_type_id = 1;
        $paymentlink->currency = $currency->id;
        $paymentlink->category_id = $product->categories_id;
        $paymentlink->payment_type = "straight";
        $paymentlink->token = $token;
        $paymentlink->payment_gateway = $default_payment_gateway->key_value;
        $paymentlink->created_by = $user->id;
        $paymentlink->save();
        $gateway_name = explode("_", $default_payment_gateway->key_value);
        $gateway_type = $gateway_name[2];
        $link = route('payment.'.$gateway_type).'?token='.$token;
        return redirect($link);
    }

    protected function paymentLinkStatus($paymentLink_id, $status) {
        $paymentLink = PaymentLink::find($paymentLink_id);
        $paymentLink->status = $status;

        if($paymentLink->save()) {
            return true;
        } else {
            return false;
        }
    }

    protected function redeemCoupon(Request $request)
    {
        $data = array();
		$json = array();
			
        if(!empty($request->coupon)) {
            $retrieve = Coupon::where('coupon_name',$request->coupon)->first();
            if(!empty($retrieve) && $retrieve!=NULL) {
                date_default_timezone_set('America/New_York');
                $now = date('Y-m-d');
                
                if(($retrieve->date_from < $now) && ($retrieve->date_to > $now)) {
                    if($retrieve->quantity > 0) {
                        $json[] = array("coupon_id"=> $retrieve->id, "coupon"=> $retrieve->coupon_name, "discount"=> $retrieve->discount, "discount_type"=> $retrieve->discount_type, "message"=>"Coupon Applied Successfully.", "message_type"=>"success");
                        $data['data'] = $json;
                    } else {
                        $json[] = array("coupon_id"=> $retrieve->id, "coupon"=> $retrieve->coupon_name, "discount"=> $retrieve->discount, "discount_type"=> $retrieve->discount_type, "message"=>"Expired coupon", "message_type"=>"error");
                        $data['data'] = $json;
                    }
                } else {
                    $json[] = array("message" => "Coupon expired.", "message_type" => "error");
                    $data['data'] = $json;
                }
                
                echo json_encode($data);        
            } else {
                $json[] = array("message"=>"Enter a valid coupon.", "message_type"=>"error");
                $data['data'] = $json;
                echo json_encode($data);
            }
        } else {
            $json[] = array("message"=>"Enter a valid coupon.", "message_type"=>"error");
            $data['data'] = $json;
            echo json_encode($data);
        }
    }
}
