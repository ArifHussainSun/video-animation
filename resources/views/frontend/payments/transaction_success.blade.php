<!DOCTYPE html>
<html lang='en' ng-app="myApp">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Payment Successful | {{ (!empty($data['itemprice']) ? "Amount: ".$data['currency'].$data['itemprice'] : "") }} {{ (!empty($data['itemname']) ? ' | Item Name: ' . $data['itemname'] : '') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/payment/css/transaction_success.css') }}">

    <!-- <script>
    dataLayer.push({
      'event': 'gtm4wp.orderCompletedEEC',
      'ecommerce': {
        'purchase': {
          'actionField': {
            'id': '<?php //echo(!empty($data['invoice_id']) ? $data['invoice_id'] : ""); ?>', // Transaction ID. Required           
            'revenue': '<?php //echo (!empty($data['itemprice']) ? $data['itemprice'] : ""); ?>', // Total transaction value (incl. tax and shipping)
          },
          'products': [{ // List of productFieldObjects.
            'name': '<?php //echo (!empty($data['itemname']) ? $data['itemname'] : 'Item'); ?>', // Name or ID is required.
            'id': '<?php //echo (!empty($data['invoice_id']) ? $data['invoice_id'] : ""); ?>',
            'price': '<?php //echo (!empty($data['itemprice']) ? $data['itemprice'] : ""); ?>',
          }] //expand this array if more product exists
        }
      }
    });
  </script> -->

    {{-- @stacks('paymentScripts') --}}
</head>

<body>

    <section class="thank-section">
        <div class="container">
            <div class="thankyou-container">
                <div class="thank-tick">
                    <i class="fa fa-check"></i>
                    <span class="before"></span>
                    <span class="after"></span>
                </div>
                <div class="thank-detail">
                    <h1>Transaction Successful</h1>
                    <h3>Thanks for shopping with us. Your payment has been successfully charged and a confirmation email has been sent to your email Address. We welcome you on board, Our team will start working on your project soon. Stay connected!</h3>

                    <div class="order-detail">
                        <h2>Order Summary</h2>

                        <table class="table success-table">
                            <tbody>
                                <tr>
                                    <th scope="row" style="border-top: none;">Item</th>
                                    <td style="border-top: none;">{{ $data['itemname'] }}</td>
                                </tr>
                                
                                <tr>
                                    <th scope="row">Item Price</th>
                                    <td>{{ $data['currency'] }} {{ (!empty($data['coupon_id'])) ? $data['original_price'] : $data['itemprice'] }}</td>
                                </tr>

                                @if (!empty($data['coupon_id']))
                                    <tr>
                                        <th scope="row">Discount</th>
                                        <td>{{ "-" . $data['discount'] }}</td>
                                    </tr>
                                @endif

                                <tr>
                                    <th scope="row">Total</th>
                                    <td>{{ $data['currency'] }} {{ $data['itemprice'] }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

</body>

</html>