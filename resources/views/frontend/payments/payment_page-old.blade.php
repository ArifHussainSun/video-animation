<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout {{ (!empty($country_currency) ? "- ".$country_currency->currency_code : "") }} {{ (!empty($item_detail) ? $item_detail->price : "") }} {{ (!empty($company_number) ? "| ".$company_number->key_value : "") }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon') }}">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('frontend/payment/css/checkout.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/css/intlTelInput.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

</head>

<body class="bg-light generalClass">
    <div class="loader-bg">
        <i class="fa fa-spinner fa-spin loader-spin" aria-hidden="true"></i>
    </div>

    <header class="header">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-12">
                    <div class="logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset($logo->key_value) }}" height="30px" alt="Logo" />
                        </a>
                    </div>
                </div>
                @if (!empty($company_number) && $company_number->key_value != false)
                    <div class="col-md-9 col-5 d-none d-sm-none d-md-block">
                        <a href="tel:{{ $company_number->key_value }}" class="company_number"><i class="fa fa-phone"></i> <span>{{ $company_number->key_value }}</span></a>
                    </div>
                @endif
            </div>
        </div>

    </header>

    <div class="container padd-30-on-mob">
        <div class="row">
            <div class="col-md-4 order-md-2 mb-4" id="sidebar">
                <h4 class="justify-content-between align-items-center mb-3 section-heading">
                    <span class="badge badge-secondary display-desktop">3</span>
                    <span class="badge badge-secondary display-mobile">1</span>
                    <span>Billing Invoice</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h5 class="my-0">{{ (!empty($item_detail) ? $item_detail->item_name : "") }}</h5>
                        </div>

                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Item Price</h6>
                        </div>
                        <span class="text-muted itemprice_coupon" id="itemPrice">{{ (!empty($country_currency) ? $country_currency->currency_code : "") }} {{ (!empty($item_detail) ? $item_detail->original_amount : "") }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between bg-light" id="discount_div">
                        <?php if (!empty($discount) && !empty($discounted_amount)) { ?>
                            <div class="text-success">
                                <h6 class="my-0">Discount</h6>
                                <small><?php //echo (strstr("%", $discount) ? "(" . $discount . ")" : ""); ?></small>
                            </div>
                            <span class="text-success" id="itemDiscount"><?php //echo "-" . $country_info["currency_code"] . $discounted_amount; ?></span>
                        <?php } ?>
                    </li>

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total ({{ (!empty($country_currency) ? $country_currency->currency_code : "") }})</span>
                        <strong id="calculated_total" class="total_amount">{{ (!empty($country_currency) ? $country_currency->currency_code : "") }} {{ (!empty($item_detail) ? $item_detail->price : "") }}</strong>
                    </li>
                </ul>

                <div id="coupon-div">
                    <div class="input-group">
                    <input type="text" class="form-control coupon-code" placeholder="Promo code">
                    <div class="input-group-append">
                        <button type="button" id="" class="btn btn-secondary apply-coupon">Redeem</button>
                    </div>
                    </div>
                    
                    <div class="coupon-response-div"></div>
                    
                </div>

                <div class="complete">
                    <a href="javascript::void(0)" target="_blank" class="money-back-img" style="display:table;margin:12px auto;clear:both">
                        <img src="{{ asset('frontend/payment/images/moneyback.png') }}" width="200px" border="0">
                    </a>
                </div>
            </div>
            <div class="col-md-8 order-md-1" id="main-formarea">
                <h4 class="justify-content-between align-items-center mb-3 section-heading">
                    <span class="badge badge-secondary display-desktop">1</span>
                    <span class="badge badge-secondary display-mobile">2</span>
                    <span>Billing Information</span>
                </h4>

                <form id="payment-form" class="needs-validation" action="{{ route('payment.stripe.success') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="firstName" name="firstname" placeholder="First Name" data-parsley-required="true" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <input type="text" class="form-control" id="lastName" name="lastname" placeholder=" Last Name " data-parsley-required="true" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <input type="email" class="form-control" id="email" name="clientemail" placeholder="Email Address" data-parsley-type="email" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <input type="tel" id="phone" name="phonenum" class="form-control" data-parsley-type="digits" style="width:100%;padding-right: 56px;">
                                </div>
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>
                            <span id="valid-msg" class="hide"></span>
                            <span id="error-msg" class="hide"></span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                        <div class="invalid-feedback">
                            Please enter your address.
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <input type="text" class="form-control" id="companyName" name="companyname" placeholder="Company Name" required>
                            <div class="invalid-feedback">
                                Please enter a valid email address.
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">


                            <select class="custom-select d-block w-100" name="country" id="country" required>
                                <option selected disabled>Select Country</option>
                                @if(!empty($countries))
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}" data-countryCode="{{ $country->alpha_code2 }}">{{ $country->country_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-md-6 mb-3">
                            <input type="text" class="form-control" name="statename" minlength="4" id="statename" placeholder="State" required>

                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-3">


                            <input type="text" class="form-control" id="city" name="city" placeholder="City" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3">

                            <input type="number" class="form-control" name="zipcode" minlength="4" min="0" id="zip" placeholder="Zip Code" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>

                    <h4 class="justify-content-between align-items-center mb-3 mt-3 section-heading">
                        <span class="badge badge-secondary display-desktop">2</span>
                        <span class="badge badge-secondary display-mobile">3</span>
                        <span>Payment Information</span>
                    </h4>

                    <div class="row">
                        <div class="col-md-12" id="bt-dropin">
                            <div class="form-row">
                                <label for="card-element">

                                </label>
                                <div id="card-element">
                                    <!-- A Stripe Element will be inserted here. -->
                                </div>

                                <!-- Used to display form errors. -->
                                <div id="card-errors" role="alert"></div>
                            </div>
                        </div>
                    </div>
                    
                    <hr class="mb-4">
                    <input type="hidden" id="final_itemprice" name="itemprice" class="itemprice" value="{{ (!empty($item_detail) ? $item_detail->price : '') }}" />
                    <input type="hidden" name="itemname" id="itemname" class="itemname" value="{{ (!empty($item_detail) ? $item_detail->item_name : '') }}" />
                    <input type="hidden" name="ptoken" value="{{ (!empty($item_detail) ? $item_detail->token : '') }}" />
                    <input type="hidden" name="discount" id="discount" value="<?php //echo (isset($discount) ? $discount : ''); ?>">
                    <input type="hidden" name="original_amount" id="original_amount" value="{{ (!empty($item_detail) ? $item_detail->price : '') }}">
                    <input type="hidden" name="payment_gateway" value="<?php //echo (isset($payment_gateway) ? $payment_gateway : ''); ?>">
                    <input type="hidden" name="currency" value="<?php //echo (isset($country_currency) ? $currency : 'USD'); ?>" />
                    <input type="hidden" id="item_desc" name="item_desc" class="item_desc" value="<?php //echo (isset($item_desc) ? $item_desc : ''); ?>" />
                    <input type="hidden" id="coupon_id" name="coupon_id" class="coupon_id" value="" />
                    <input type="hidden" id="currency_symbol" name="currency_symbol" value="<?php //echo $country_info["currency_symbol"]; ?>">

                    <button class="btn btn-primary btn-lg btn-block" id="card-button" data-secret="<?php //echo $intent->client_secret; ?>" type="submit">Pay Now</button>
                    <div class="card-errors"></div>
                </form>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="threeDSecure-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"  data-backdrop="static" data-keyboard="false" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="threeDIframe_Body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/intlTelInput.min.js"></script>
    <script src="{{ asset('frontend/assets/libs/parsleyjs/parsley.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/assets/js/pages/form-validation.init.js') }}"></script>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script>
        var input = document.querySelector("#phone");
        window.intlTelInput(input);

        var input = document.querySelector("#phone");
        window.intlTelInput(input, {
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "";
                    callback(countryCode);
                });
            },
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/js/utils.js" // just for formatting/placeholders etc
        });

        //Coupon Ajax function
        $('.apply-coupon').on("click", function(e) {
            let coupon = $(this).closest("#coupon-div").find(".coupon-code").val();
            let request_url = "<?php //echo base_url('payment/ptoken/redeem_coupon/'); ?>" + coupon;
            //let device = $(this).closest("#coupon-div").attr("id");

            if (coupon != '') {
                $.ajax({
                    url: request_url,
                    type: 'POST',
                    data: {
                        "token": "<?php //echo $_GET['token']; ?>"
                    },
                    success: function(data) {
                        let json_data = JSON.parse(data);
                        let obj = json_data.data;

                        if (obj[0].message_type == "success") {
                            let discount = obj[0].discount;
                            let item_price = $("#final_itemprice").val();
                            let calculate = 0;
                            let discount_in = 0;

                            $("#coupon-div").find(".coupon-response-div").attr('style', 'display: block !important');
                            $("#coupon-div").find(".coupon-response-div").html('<div class="alert alert-success coupon-response" role="alert">' + obj[0].message + '</div>');
                            $("#coupon-div").find(".coupon-code").attr("disabled", "disabled");
                            $("#coupon-div").find(".apply-coupon").css("background", "#8c8c8c");
                            $("#coupon-div").find(".apply-coupon").attr("disabled", "disabled");
                            $("#coupon-div").find(".apply-coupon").remove();

                            $("#coupon_id").val(obj[0].coupon_id);

                            console.log(discount);

                            //if(discount.toString().indexOf("%")>-1) {
                            //calculate = calculate_discount(item_price, discount,"percent");
                            discount_in = discount + "%";
                            /*} else {
                                //calculate = calculate_discount(item_price, discount,"value");
                                discount_in="<?php //echo $country_info["currency_code"]; ?>"+discount;
                            }*/

                            $(".total_amount").html("<?php //echo $country_info["currency_code"]; ?>" + obj[0].item_amount);
                            $("#final_itemprice").val(obj[0].item_amount);
                            $("#discount").val(obj[0].discount_amount);
                            $(".calculated_amount").html("<?php //echo $country_info["currency_code"]; ?>" + obj[0].item_amount);

                            $("#discount_div").attr('style', 'display: flex !important');
                            $("#discount_div").html('<div class="text-success"><h6 class="my-0">Discount</h6><small>' + coupon + '(' + discount_in + ')</small></div><span class="text-success" id="itemDiscount">-<?php //echo $country_info["currency_code"]; ?>' + obj[0].discounted_amount + '</span>');
                            //$("#discount_div").html('<span class="item_detail">Discount:</span><span id="itemDiscount">$'+calculate.discount+'</span><br>');

                        } else if (obj[0].message_type == "error") {
                            $('.apply-coupon').closest("#coupon-div").find(".coupon-response-div").html('<div class="alert alert-danger coupon-response" role="alert">' + obj[0].message + '</div>');
                        } else {
                            $('.apply-coupon').closest("#coupon-div").find(".coupon-response-div").html('<div class="alert alert-danger coupon-response" role="alert">' + obj[0].message + '</div>');
                        }
                    }
                });

            } else {
                $(this).closest("#coupon-div").find(".coupon-response-div").html('<div class="alert alert-danger coupon-response" role="alert">Enter a coupon to redeem.</div>');
            }
        });

        function calculate_discount(amount, discount, type) {
            var data = new Object();

            if (type == 'percent') {
                data['discount'] = Math.ceil(amount * (discount / 100));
                data['amount'] = Number(amount) - Number(data['discount']);

            } else if (type == 'value') {

                data['discount'] = discount;
                data['amount'] = Number(amount) - Number(data['discount']);
            }

            return data;
        }


        $(document).ready(function() {
            var len = $("#discount_div").text().length;

            if (len > 8) {
                $("#discount_div").attr('style', 'display: flex !important');
            }
        });
    </script>

    <script>
        var stripe = Stripe('{{ $payment_gateway->public_key }}');
        var iframeModal = document.getElementById('threeDSecure-Modal');
        var iframeContainer = document.getElementById('threeDIframe_Body');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');
        var paymentData = new Array;
        var paymentMessages = new Array;
        var cardButton = document.getElementById('card-button');
        
        $(document).on("submit", "#payment-form", function(e) {
            e.preventDefault();
            $('.loader-bg').addClass('show-bg');

            var paymentData = $(this).serializeArray();
            let firstName, lastName, postal_code;
            
            for (i=0; i<paymentData.length; i += 1) {
                if (paymentData[i].name === "firstname") {
                    firstName = paymentData[i].value; 
                }

                if (paymentData[i].name === "lastname") {
                    lastName = paymentData[i].value; 
                }

                if (paymentData[i].name === "zipcode") {
                    postal_code = paymentData[i].value; 
                }
            }

            var cardholderName = firstName + " " + lastName;
            
            const options = {
                url: '{{ route("payment.stripe.paymentIntent") }}',
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json;charset=UTF-8',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: paymentData
            };
            
            //FormAttr.push({name: "Name_Of_Attribute", value:"Value_Of_Attributes"});

            console.log(JSON.stringify(cardElement));

            stripe.createPaymentMethod('card', cardElement, {
                billing_details: {
                    name: cardholderName.value,
                }
            }).then(function(result) {
                if (result.error) {
                    console.log('error1');
                    console.log(result.error.code);
                    document.title = document.title + " Error: "+result.error.code;

                    paymentMessages.push({name: "error_code", value: result.error.code});
                    paymentMessages.push({name: "error_message", value: result.error.message});
                    console.log(JSON.stringify(paymentMessages));
                } else {
                    // Otherwise send paymentMethod.id to your server (see Step 2)
                    paymentData.push({name: "payment_method_id", value: result.paymentMethod.id});
                    axios({
                        url: '{{ route("payment.stripe.paymentIntent") }}',
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json;charset=UTF-8',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: paymentData
                    }).then(function (response) {
                        handleServerResponse(response.data);
                    }).then(function(res){
                        console.log(JSON.stringify(res));
                    });
                }
            });
            
            function handleServerResponse(response) {
                console.log("handleServerResponse: "+response);

                if (response.error) {
                    console.log('error2');
                    paymentMessages.push({name: "error_code", value: response.code});
                    paymentMessages.push({name: "error_message", value: response.error});

                    console.log(JSON.stringify(paymentMessages));
                    // Show error from server on payment form
                } else if (response.requires_action) {
                    // Use Stripe.js to handle required card action
                    var action = response.next_action;
                    if (action && action.type === 'redirect_to_url') {
                        window.location = action.redirect_to_url.url;
                    }

                    stripe.handleCardAction(
                        response.payment_intent_client_secret
                    ).then(function(result) {
                        if (result.error) {
                            console.log('error3');
                            //var form_values = getFormData('#payment-form');
                            paymentMessages.push({name: "error_code", value: response.code});
                            paymentMessages.push({name: "error_message", value: response.error});
                            
                            console.log(JSON.stringify(paymentMessages));
                        } else {
                            //var form_data = $("#payment-form").serialize();
                            paymentData.push({name: "payment_intent_id", value: result.paymentIntent.id});

                            // The card action has been handled
                            // The PaymentIntent can be confirmed again on the server
                            axios({
                                url: '{{ route("payment.stripe.paymentIntent_3d") }}',
                                method: 'POST',
                                headers: {
                                    'Accept': 'application/json',
                                    'Content-Type': 'application/json;charset=UTF-8',
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: paymentData
                            }).then(handleServerResponse);
                        }
                    }); 
                } else {
                    // Show success message
                    console.log("SUCCESS");
                    console.log(response);
                    e.currentTarget.submit();
                    /* var form_values = getFormData('#payment-form');
                    send_values(form_values); */    
                }
            }
        });

        
      
    </script>

</body>

</html>