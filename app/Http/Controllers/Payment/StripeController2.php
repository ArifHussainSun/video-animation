<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\BrandSettings;
use App\Models\CountryCurrencies;
use App\Models\Customer;
use App\Models\PaymentLink;
use App\Models\Payments;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

use Exception, Session, Stripe;


class StripeController2 extends Controller
{
    public $public_key;
    public $secret_key;
    public $statement_descriptor;
    public $environment;
    
    public function index(Request $request) {
        if($request->has('token')) {
            $item_detail = PaymentLink::where("token", "=", $request->token);
            
            if($item_detail->exists()){
                $item_detail = $item_detail->first();

                if($item_detail->valid_till < Carbon::now()->toDateTimeString()) {
                    $gateway_setting = BrandSettings::where("key_name", "=", $item_detail->payment_gateway)->first();
                    $payment_gateway = json_decode($gateway_setting->key_value);
                    
                    $this->public_key = $payment_gateway->public_key;
                    $this->secret_key = $payment_gateway->secret_key;
                    $this->statement_descriptor = $payment_gateway->statement_descriptor;
                    $this->environment = $payment_gateway->environment;
    
                    Session()->put('payment_gateway', $payment_gateway);
        
                    $countries = CountryCurrencies::orderBy('country_name', 'ASC')->get();
    
                    return view('frontend.payments.payment_page', compact('item_detail', 'countries', 'payment_gateway'));
                } else {
                    return response()->json(["message"=>"Token is exired."]);
                }
            } else {
                return response()->json(["message"=>"Token is not valid."]);
            }        
        } else {
            echo 'no token exists';
        }
    }

    public function createPaymentMethod(Request $request) {
        $formData = Arr::pluck($request->all(), 'value', 'name');
        
        $this->paymentSetting();

        $stripe = Stripe\Stripe::setApiKey($this->secret_key);

        //$customer = $this->createCustomer($formData);

        $payment_method = \Stripe\PaymentMethod::create([
            "billing_details" => [
                "email" => null,
                "name"=> null,
            ],
            'type' => 'card',
            'card' => [
              'number' => '4000002500003155',
              'exp_month' => 2,
              'exp_year' => 2023,
              'cvc' => '314',
            ],
        ]);

        $payment_method->attach([
            ['customer' => 'cus_L9RsZeuylQ7kEj']
        ]);

        return response()->json($payment_method);

    }

    public function createCustomer($customerData) {
        if (isset($customerData['item_desc'])) {
            unset($customerData['item_desc']);
        }

        if (isset($customerData['payment_gateway'])) {
            unset($customerData['payment_gateway']);
        }

        $this->paymentSetting();

        Stripe\Stripe::setApiKey($this->secret_key);

        $customer = Stripe\Customer::create([
            'description' => $customerData["clientemail"],
            'email' => $customerData["clientemail"],
            'phone' => $customerData["phonenum"],
            'address' => [
                        "line1" => $customerData["address"],
                        "city" => $customerData["city"],
                        "country" => $customerData["country"],
                        "state" => $customerData["statename"],
                    ],
            'metadata' => $customerData
            ]);

        return $customer;
    }

    public function paymentIntent(Request $request) {
        $this->paymentSetting();
        $customerData = Arr::pluck($request->all(), 'value', 'name');
        
        $intent = null;
        
        try {
            if (isset($customerData['payment_method_id'])) {
                $original_price = $customerData['itemprice'];
                $currency = (!empty($customerData['currency']) ? $customerData['currency'] : "USD");
                $converted_amount = $original_price;
                $converted_amount = (!empty($converted_amount) ? $converted_amount : $original_price);
                $customerData["brand_descriptor"] = $this->statement_descriptor;

                // Create a Customer:
                $customer = $this->createCustomer($customerData);
                
                \Stripe\Stripe::setApiKey($this->secret_key);

                # Create the PaymentIntent
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $customerData['payment_method_id'],
                    'amount' => $converted_amount * 100,
                    'currency' => $currency,
                    'confirmation_method' => 'manual',
                    "customer" => $customer->id,
                    'confirm' => true,
                    'statement_descriptor' => $this->statement_descriptor,
                    'description' => $customerData['itemname'],
                    'metadata' => $customerData,
                ]);
            }
            
            if (isset($customerData['payment_intent_id'])) {
                $intent = \Stripe\PaymentIntent::retrieve(
                    $customerData['payment_intent_id']
                );

                $intent->confirm();
            }

            return $this->generatePaymentResponse($intent);
            
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (Exception $e) {
            return response()->json([ 'error' => $e->getMessage()]);
        }
    }

    function paymentIntent_3d(Request $request) {
        $this->paymentSetting();
        $customerData = Arr::pluck($request->all(), 'value', 'name');
        $intent = null;

        \Stripe\Stripe::setApiKey($this->secret_key);

        try {
            if (isset($customerData['payment_method_id'])) {
                if (isset($customerData['item_desc'])) {
                    unset($customerData['item_desc']);
                }

                if (isset($customerData['payment_gateway'])) {
                    unset($customerData['payment_gateway']);
                }
                $original_price = $customerData['itemprice'];
                $currency = (!empty($customerData['currency']) ? $customerData['currency'] : "USD");
                $converted_amount = $original_price;
                $converted_amount = (!empty($converted_amount) ? $converted_amount : $original_price);
                $cus_data["brand_descriptor"] = "LOGOWEB SERVICES LO12 - DMN";

                # Create the PaymentIntent
                $intent = \Stripe\PaymentIntent::create([
                    'payment_method' => $customerData['payment_method_id'],
                    'amount' => $converted_amount * 100,
                    'currency' => $currency,
                    'confirmation_method' => 'manual',
                    'confirm' => true,
                    'statement_descriptor' => $this->statement_descriptor,
                    'metadata' => $customerData,
                ]);
            }

            if (isset($customerData['payment_intent_id'])) {
                $intent = \Stripe\PaymentIntent::retrieve(
                    $customerData['payment_intent_id']
                );
                $intent->confirm();
            }
            return $this->generatePaymentResponse($intent);
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function three_step(Request $request) {
        $this->paymentSetting();
        $customerData = Arr::pluck($request->all(), 'value', 'name');
        
        $intent = null;

        try {
            if (isset($customerData['payment_method_id'])) {
                if (isset($customerData['item_desc'])) {
                    unset($customerData['item_desc']);
                }

                if (isset($customerData['payment_gateway'])) {
                    unset($customerData['payment_gateway']);
                }

                $original_price = $customerData['itemprice'];
                $currency = (!empty($customerData['currency']) ? $customerData['currency'] : "USD");
                $converted_amount = $original_price;
                $converted_amount = (!empty($converted_amount) ? $converted_amount : $original_price);

                // 1st transaction
                $amount = $converted_amount - 1;
                // 2nd transaction
                //$rand = floatVal('0.' . rand(60, 90));
                $rand = 0.5;
                // 3rd transaction
                //$rand2 = $converted_amount - ($amount + $rand);
                $rand2 = 0.5;

                $stripe = new \Stripe\StripeClient(
                    $this->secret_key
                );

                \Stripe\PaymentMethod::all([
                    'customer' => $customerData['customer_id'],
                    'type' => 'card',
                ]);

                $cus_data["brand_descriptor"] = $this->statement_descriptor." LO12 - DMN";

                $customer = $stripe->customers->update(
                    $customerData['customer_id'], [
                        'description' => $customerData['clientemail'],
                        'email' => $customerData['clientemail'],
                        'phone' => $customerData['phonenum'],
                        'address' => [
                            "line1" => $customerData['address'],
                            "city" => $customerData['city'],
                            "country" => $customerData['country'],
                            "state" => $customerData['statename'],
                        ],
                        'metadata' => $cus_data
                    ]
                );

                $stripe->paymentIntents->update(
                    $customerData['payment_intent_id'], [
                        "customer" => $customerData['customer_id'],
                        'description' => $cus_data['itemname'],
                        'metadata' => $cus_data,
                    ]
                );

                if (isset($customerData['remainingPay']) && $customerData['remainingPay'] == 'yes') {
                    $charge1 = $this->stripe_charge_paymentIntent($customerData['customer_id'], $customerData['itemname'], number_format($rand, 2), "USD");
                    $charge1 = json_decode($charge1);
                    $charge2 = $this->stripe_charge_paymentIntent($customerData['customer_id'], $customerData['itemname'], number_format($rand2, 2), "USD");
                    $charge2 = json_decode($charge2);

                    return response()->json($charge1);

                    /*$transaction1_amount = $charge1->amount_received / 100;
                    $transaction2_amount = $charge2->amount_received / 100;

                    $cust = array();
                    parse_str($json_obj->customer_detail, $cust);

                    $transaction_receipt['currency'] = $currency;
                    $transaction_receipt['itemprice'] = $cus_data['itemprice'];
                    $transaction_receipt['message'] = 'ID : ' . $json_obj->customer_id . ' <br>
                                    First Name : ' . $cust["firstname"] . ' <br>
                                    Last Name : ' . $cus_data['lastname'] . ' <br>
                                    Company : ' . $cus_data['companyname'] . ' <br>
                                    Email : ' . $cus_data['clientemail'] . ' <br>
                                    Phone : ' . $cus_data['phonenum'] . ' <br> <br>
                                    ========== TRANSACTION # 1 ========== <br>
                                    Status : ' . $charge1->status . ' <br>
                                    Amount : ' . $currency . ' ' . $amount . ' <br>
                                    ========== TRANSACTION # 2 ========== <br>
                                    ID : ' . $charge1->id . ' <br>
                                    Status : ' . $charge1->status . ' <br>
                                    Amount : ' . $charge1->currency . ' ' . floatval($transaction1_amount) . ' <br>
                                    ========== TRANSACTION # 3 ========== <br>
                                    ID : ' . $charge2->id . ' <br>
                                    Status : ' . $charge2->status . ' <br>
                                    Amount : ' . $charge2->currency . ' ' . floatval($transaction2_amount) . ' <br>
                                    ========== TOTAL AMOUNT ========== <br>
                                    Transaction # 1 : ' . $currency . ' ' . $amount . ' <br>
                                    Transaction # 2 : ' . $charge1->currency . ' ' . floatval($transaction1_amount) . ' <br>
                                    Transaction # 3 : ' . $charge2->currency . ' ' . floatval($transaction2_amount) . ' <br>
                                    Total Amount : ' . $cus_data['itemprice'] . ' <br>';

                    $this->send_transaction_history($transaction_receipt); */
                }
            }
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function confirm3DSecure() {
        //return view();
    }

    function generatePaymentResponse($intent) {
        # Note that if your API version is before 2019-02-11, 'requires_action'
        # appears as 'requires_source_action'.
        if ($intent->status == 'requires_action' && $intent->next_action->type == 'use_stripe_sdk') {
            # Tell the client to handle the action
            return response()->json([
                'requires_action' => true,
                'payment_intent_client_secret' => $intent->client_secret
            ]);
        } else if ($intent->status == 'succeeded') {
            # The payment didn’t need any additional actions and completed!
            # Handle post-payment fulfillment
            return response()->json([
                "success" => true
            ]);
        } else {
            # Invalid status
            http_response_code(500);
            return response()->json(['error' => 'Invalid PaymentIntent status']);
        }
    }

    public function success(Request $request) {
        //$formData = Arr::pluck($request->all(), 'value', 'name');
        $formData = $request->all();
        
        $customer = User::where("email", "=", $formData["clientemail"]);
        $paymentLink = PaymentLink::where("token", "=", $formData["ptoken"])->first();
        $paymentLink = $paymentLink->toArray();

        //dd($paymentLink);

        $payment = new Payments();

        if($customer->exists()) {
            $customerData = $customer->first();
            $customer_id = $customerData->id;
            
        } else {
            $customer = new Customer();
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
            $customer->created_by = $paymentLink->created_by;
            $customer->save();
            $customer_id = $customer->id;
        }
            
        $payment->customer_id = $customer_id;
        $payment->Item_name = $formData['itemname'];
        $payment->price = $formData['itemprice'];
        $payment->discount = $paymentLink['discount'];
        //$payment->original_price = $paymentLink['original_amount'];
        //$payment->item_description = $paymentLink['item_description'];
        //$payment->converted_amount = $paymentLink['converted_amount'];
        $payment->currency = $paymentLink['currency'];
        $payment->category_id = $paymentLink['category_id'];
        $payment->sale_type = $paymentLink['sale_type_id'];
        $payment->payment_gateway = $paymentLink['payment_gateway'];
        $payment->payment_type = $paymentLink['payment_type'];
        $payment->token = $formData['ptoken'];
        $payment->comment = "";
        $payment->message = "";
        $payment->status = 1;
        $payment->payment_on = Carbon::now();
        $payment->created_by = (!empty($paymentLink->created_by) ? $paymentLink->created_by : NULL);
        $payment->save();
    }

    public function failed(Request $request) {
        $customerData = Arr::pluck($request->all(), 'value', 'name');
    }

    public function paymentSetting() {
        $payment_gateway = Session()->get('payment_gateway');

        $this->public_key = $payment_gateway->public_key;
        $this->secret_key = $payment_gateway->secret_key;
        $this->statement_descriptor = $payment_gateway->statement_descriptor;
        $this->environment = $payment_gateway->environment;
    }

    function stripe_charge_paymentIntent($customer_id, $item_name, $amount, $currency) {
        $this->paymentSetting();
        $intent = null;

        \Stripe\Stripe::setApiKey($this->secret_key);

        $intent = null;
        try {
            $payment_method = \Stripe\PaymentMethod::all([
                'customer' => $customer_id,
                'type' => 'card',
            ]);

            $payment_method_id = $payment_method["data"][0]->id;
            $data = array("pm_id" => $payment_method_id, "customer_id" => $customer_id, $payment_method);
            
            # Create the PaymentIntent
            $intent = \Stripe\PaymentIntent::create([
                'payment_method' => $payment_method_id,
                'amount' => $amount * 100,
                'currency' => $currency,
                "customer" => $customer_id,
                'off_session' => true,
                'confirm' => true,
                'statement_descriptor' => $this->statement_descriptor,
                'description' => $item_name,
            ]);

            return response()->json($intent);
            
        } catch (\Stripe\Exception\AuthenticationException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\CardException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\RateLimitException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'code' => $e->getError()->code,
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
