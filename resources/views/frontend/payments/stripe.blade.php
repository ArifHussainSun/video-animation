<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Checkout {{ (!empty($country_currency) ? "- ".$country_currency->currency_code : "") }} {{ (!empty($item_detail) ? $item_detail->price : "") }} {{ (!empty($company_number) ? "| ".$company_number : "") }}</title>
    
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon') }}">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,400i&amp;display=swap" rel="stylesheet">
    <link href="{{ asset('frontend/payment/css/checkout.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.15/css/intlTelInput.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">

    @stack('custom_style')
    
    @routes
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
                        <a href="{{ route('front.home') }}">
                            <img src="{{ (!empty($brand_settings['logo']) ? asset($brand_settings['logo']) : '') }}" height="30px" alt="Logo" />
                        </a>
                    </div>
                </div>
                @if (!empty($brand_settings['company_number']) && $brand_settings['company_number']!== null)
                    <div class="col-md-9 col-5 d-none d-sm-none d-md-block">
                        <a href="tel:{{ $brand_settings['company_number'] }}" class="company_number"><i class="fa fa-phone"></i> <span>{{ $brand_settings['company_number'] }}</span></a>
                    </div>
                @endif
            </div>
        </div>

    </header>

    <div id="app">
        <stripe-payment></stripe-payment>
    </div>
    
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    
</body>
</html>