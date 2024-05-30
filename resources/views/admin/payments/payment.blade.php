@extends('admin.layouts.main')
@section('container')
<link href="{{ asset('frontend/assets/css/payment.css') }}" rel="stylesheet">

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    @if( Session::has("success") )
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get("success") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
                    @if( Session::has("error") )
                        <div class="alert alert-danger alert-block" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {{ Session::get("error") }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4 order-md-2 mb-4" id="sidebar">
                            <h4 class="justify-content-between align-items-center mb-3 section-heading"> <span class="badge badge-secondary display-desktop">3</span> <span class="badge badge-secondary display-mobile">1</span> <span>Billing Invoice</span> </h4>
                            <ul class="list-group mb-3">
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h5 class="my-0">Pro Logo</h5>
                                    </div>
                                </li>
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">Item Price</h6>
                                    </div> <span class="text-muted itemprice_coupon" id="itemPrice">USD</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between bg-light" id="discount_div"> </li>
                                <li class="list-group-item d-flex justify-content-between"> <span>Total (USD)</span> <strong id="calculated_total" class="total_amount">USD</strong> </li>
                            </ul>
                            <!-- <div id="coupon-div"> <div class="input-group"> <input type="text" class="form-control coupon-code" placeholder="Promo code"> <div class="input-group-append"> <button type="button" id="" class="btn btn-secondary apply-coupon">Redeem</button> </div> </div> <div class="coupon-response-div"></div> </div> -->
                            <div class="complete"> <a href="javascript:void(0)" target="_blank" class="money-back-img" style="display:table;margin:12px auto;clear:both"> <img src="https://ik.imagekit.io/designmanhattan/assets/images/checkout/moneyback.webp?updatedAt=1633696816335" width="200px" border="0"> </a> </div>
                        </div>
                        <div class="col-md-8 order-md-1" id="main-formarea">
                            @if(session()->has('success'))
                                <div class="alert alert-success">
                                    {{ session()->get('success') }}
                                </div>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <h4 class="justify-content-between align-items-center mb-3 section-heading"> <span class="badge badge-secondary display-desktop">1</span> <span class="badge badge-secondary display-mobile">2</span> <span>Billing Information</span> </h4>
                            <form role="form" class="validation" data-cc-on-file="false" id="payment-form" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="hidden" class="form-control" id="id" name="id" >
                                        <input type="hidden" class="form-control" id="customer_id" name="customer_id" >
                                        <input type="text" class="form-control" id="item_name" name="item_name" placeholder="Item Name" required>
                                    @if ($errors->has('item_name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('item_name') }}</strong>
                                            </span>
                                        @endif
                                        <div class="invalid-feedback"> Valid Item name is required. </div>
                                    </div>
                                    <div class="col-md-6 mb-3"> <input type="text" class="form-control" id="item_price" name="item_price" placeholder="Item Price" required>
                                        @if ($errors->has('item_price'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('item_price') }}</strong>
                                            </span>
                                        @endif
                                        <div class="invalid-feedback"> Valid Item Price is required. </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3"> <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount " required>
                                    @if ($errors->has('discount'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('discount') }}</strong>
                                            </span>
                                        @endif
                                        <div class="invalid-feedback"> Please enter a valid Discount . </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <!-- <label for="phoneNumber">Phone Number</label> <input type="number" minlength="9" min="0" class="form-control" name="phonenum" id="phoneNumber" placeholder="Please Enter Your Number Here" required> <div class="invalid-feedback"> Valid last name is required. </div> -->
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <input type="text" id="original_price" name="original_price" class="form-control" style="width:100%;padding-right: 56px;" placeholder="Original Price"> </div>
                                            <div class="invalid-feedback"> Valid Original Price is required. </div>
                                        </div> <span id="valid-msg" class="hide"></span> <span id="error-msg" class="hide"></span>
                                    </div>
                                </div>
                                <div class="mb-3"> <input type="text" class="form-control" id="item_desc" name="item_desc" placeholder="Enter Item Description" required>
                                @if ($errors->has('item_desc'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('item_desc') }}</strong>
                                            </span>
                                        @endif
                                    <div class="invalid-feedback"> Please enter your item_desc. </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Enter Email" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                        <div class="invalid-feedback"> Please provide a valid email. </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                    <input type="text" class="form-control" name="converted_amount" id="converted_amount" placeholder="Enter Converted Amount(USD)" required>
                                    @if ($errors->has('converted_amount'))
                                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('converted_amount') }}</strong>
                                        </span>
                                    @endif
                                        <div class="invalid-feedback"> Please provide a valid converted_amount. </div>
                                    </div>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="currency" id="currency" placeholder="Enter Currency" required>
                                        @if ($errors->has('currency'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('currency') }}</strong>
                                            </span>
                                        @endif
                                        <div class="invalid-feedback"> Please select a valid currency. </div>
                                    </div>
                                    <div class="col-md-6">
                                    <input type="text" class="form-control" name="Comment" id="Comment" placeholder="Enter Comment" required>
                                        @if ($errors->has('Comment'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('Comment') }}</strong>
                                            </span>
                                        @endif
                                        <div class="invalid-feedback"> Please select a valid Comment. </div>
                                    </div>

                                </div>

                                <h4 class="justify-content-between align-items-center mb-3 mt-3 section-heading"> <span class="badge badge-secondary display-desktop">2</span> <span class="badge badge-secondary display-mobile">3</span> <span>Payment Information</span> </h4>

                                <br/>
                                <div class='row'>
                                    <div class='col-sm-12 card required'>
                                    <div id="card-element">
                                    </div>
                                    <div id="card-errors" role="alert"></div>
                                    </div>
                                <div id="payment-element">
                                </div>
                                <!-- <br/> -->
                                <input type="hidden" id="final_itemprice" name="itemprice" class="itemprice" value="" />
                                <input type="hidden" name="itemname" id="itemname" class="itemname" value="Pro Logo" />
                                <input type="hidden" name="ptoken"  />
                                <input type="hidden" name="category" value="Logo Design" />
                                <input type="hidden" name="discount" id="discount" value="">
                                <input type="hidden" name="original_amount" id="original_amount" value="">
                                <input type="hidden" name="payment_gateway" value="Stripe_lo">
                                <input type="hidden" name="currency" value="USD" />
                                <input type="hidden" name="sale_type" value="Fresh Sales" />
                                <input type="hidden" id="brief_id" name="brief_id" class="brief_id" value="" />
                                <input type="hidden" id="item_desc" name="item_desc" class="item_desc" value="" />
                                <input type="hidden" name="salesman" value="">
                                <input type="hidden" id="coupon_id" name="coupon_id" class="coupon_id" value="" />
                                <input type="hidden" id="nonce" name="payment_method_nonce">
                                <input type="hidden" id="currency_symbol" name="currency_symbol" value="$">
                                <button class="btn btn-primary btn-lg btn-block" id="card-button" data-secret="" type="submit" style="background-color:#f15874;border-block-color: #f15874;">Pay Now</button>
                                <div class="card-errors"></div>
                                <input autocomplete='off' class='form-control amount' name="amount"  value="" placeholder='12' size='10' type='hidden'>
                                </div>
                                <input type="hidden" id="stripeToken" name="stripeToken" value="">
                                </div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
@push('customScripts')
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            var stripe = Stripe('pk_test_51JrmXVGn0jFtCK65AaCY1L1i9ll4rFJrf3Iwm1DitXyvkyJLQRcM4ebQ4riK1rTMW4uWQFKFcl4X4TXaNIsZGHW500vw0fniNO');
            var elements = stripe.elements();
            var confirmdata =  null;
            $('#card-success').text('');
            $('#card-errors').text('');
            var stripe = Stripe('pk_test_51JrmXVGn0jFtCK65AaCY1L1i9ll4rFJrf3Iwm1DitXyvkyJLQRcM4ebQ4riK1rTMW4uWQFKFcl4X4TXaNIsZGHW500vw0fniNO');
            var elements = stripe.elements();
            $('#submit').prop('disabled', true);
            // Set up Stripe.js and Elements to use in checkout form
            var style = {
            base: {
                color: "#32325d",
            }
            };

            var card = elements.create("card", { style: style });
            card.mount("#card-element");
            card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
                $('#submit').prop('disabled', true);
            } else {
                displayError.textContent = '';
                $('#submit').prop('disabled', false);
            }
            });
             // payment 1
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(ev) {
            $('.loading').css('display','block');

            ev.preventDefault();
            //cardnumber,exp-date,cvc
            stripe.createPaymentMethod('card', card, {
                billing_details: {
                name: card.value,


                }
            }).then(function(result) {

                if (result.error) {
                } else {
                    // Send paymentMethod.id to server
                    // console.log('result',result);
                    fetch("{{ route('payments.securePayment') }}", {
                    method: 'POST',

                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: JSON.stringify({
                        payment_method_id: result.paymentMethod.id,
                        item_name:$('#item_name').val(),
                        email:$('#email').val(),
                        item_price:$('#item_price').val(),
                        discount:$('#discount').val(),
                        original_price:$('#original_price').val(),
                        item_desc:$('#item_desc').val(),
                        convert_amount:$('#convert_amount').val(),


                    })
                    }).then(function(result) {
                    result.json().then(function(json) {
                        handleServerResponse(json);
                    })
                    });
                }
            });
            // payment 2
            function handleServerResponse(response) {
                if (response.error) {

                } else if (response.requires_action) {
                    // Use Stripe.js to handle required card action
                    console.log('response11',response);
                    handleAction(response);
                } else {
                   alert('Payment Successfuly Save');
                }
            }
            // payment 3
        function handleAction(response) {

            stripe.handleCardAction(
                response.payment_intent_client_secret
            ).then(function(result) {
                if (result.error) {
                // Show error in payment form
                } else {
                    // console.log(response);
                //    alert('Payment Successfuly Save');
                // The card action has been handled
                // The PaymentIntent can be confirmed again on the server
                fetch(" {{ route('payments.securePayment1') }}", {
                    method: 'POST',
                    headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: JSON.stringify({
                    payment_intent_id: result.paymentIntent.id

                    })

                }).then(function(confirmResult) {
                    console.log('arif sun...',confirmResult);
                    return confirmResult.json();
                }).then(handleServerResponse);
                }
            });
        }
            });
        function printErrorMsg (msg) {
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                $.each( msg, function( key, value ) {
                    $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                });
        }
        </script>
    @endpush
