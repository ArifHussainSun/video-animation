<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="noindex, nofollow">
    <title>Payment Failed | {{ (!empty($data["itemprice"]) ? "Amount: ".$data['currency'].$data["itemprice"] : "") }} {{ (!empty($data["itemname"]) ? ' | Item Name: '.$data["itemname"] : '') }} {{ (!empty($data["message"]) ? "Message: ".$data["message"] : '') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('frontend/payment/css/transaction_success.css') }}">
</head>

<body class="failed-body">
    <section class="thank-section failed-section">
        <div class="container">
            <div class="thankyou-container">
                <div class="thank-tick">
                    <i class="fas fa-times-octagon"></i>
                    <span class="before"></span>
                    <span class="after"></span>
                </div>
                <div class="thank-detail token-exp-detail">
                    <h1>Payment Failed</h1>
                    <h3>{{ (!empty($data["message"]) ? $data["message"] : "" ) }}</h3>

                    <a href="#">Contact Sales</a>
                    <a href="{{ route('home') }}">Visit Website</a>
                </div>
            </div>
        </div>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
</body>

</html>
