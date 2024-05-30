<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="nofollow, noindex" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset($brand_settings['favicon']) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/fancy-box/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/OwlCarousel/dist/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <title>@if(!empty($page->title)) {!! $page->title !!} @else Home @endif</title>

    @if(!empty($page->meta_title))
    <meta name="title" content="{{$page->meta_title}}">
    @endif

    @if(!empty($page->meta_keyword))
    <meta name="keywords" content="{{$page->meta_keyword}}">
    @endif

    @if(!empty($page->meta_description))
    <meta name="description" content="{{$page->meta_description}}">
    @endif

    @routes
    <style>
        .requestaquotebtn {
            color: #fff !important;
        }

        .requestaquotebtn::before,
        .requestaquotebtn::after {
            display: none;
        }

        .step-header {
            border-bottom: 1px solid #ddd;
        }

        .step-form {
            width: 100%;
            height: 100vh;
            position: relative;
        }

        .step-container {
            width: 100%;
            position: relative;
            top: 75px;
            height: calc(100% - 159px);
            overflow: auto;
            padding: 0;
        }

        .step-area {
            padding-top: 60px;
        }

        .step-center {
            position: absolute;
            top: 50%;
            width: 100%;
            transform: translateY(-50%);
        }

        .step-center.top-48-desktop {
            top: 48%;
        }

        .step-heading {
            text-align: center;
            width: 100%;
            padding-bottom: 30px;
        }

        .step-heading h1 {
            font-weight: 700;
            font-size: 30px;
            color: #000;
            margin: 0;

            text-transform: capitalize;
        }

        .step-input {
            width: 100%;
            padding: 14px 15px 14px 15px;
            font-weight: 400;
            outline: 0;
            border: 2px solid #d7d7d7;
            color: #4b4b4b;
            margin-bottom: 14px;
            border-radius: 1000px;
            height: auto;
        }

        .step-input:focus {
            border-color: #5e42d3;
        }

        .step-footer {
            width: 100%;
            background: #fff;
            border-top: 1px solid #ddd;
            padding: 20px 0;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .step-form-submit-area {
            display: inline-block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
        }

        input.step-form-submit,
        button.step-form-submit {
            color: #fff;
            position: relative;
            background: #5e42d3;
            border: 0;
            outline: 0;
            padding: 10px 30px;
            z-index: 2;
            font-weight: 700;
            text-transform: uppercase;
            border-radius: 1000px;
        }

        .step-footer-loader {
            display: none;
            height: 3px;
            position: absolute;
            top: 0;
            left: 0;
            transform: translateY(-50%);
            background: #5e42d3;
            transition: all .5s;
        }

        .step-footer-loader:after {
            content: '';
            position: absolute;
            right: 0;
            top: 49%;
            background: #5e42d3;
            box-shadow: 0 0 10px 2px rgba(0, 0, 0, .2);
            width: 10px;
            height: 10px;
            transform: translate(50%, -50%);
        }

        .step-selective {
            width: 100%;
            display: none;
        }

        .step-label {
            width: calc(100% + 10px);
            height: calc(100% - 20px);
            background: #fff;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, .4);
            position: relative;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            margin: 0 -5px;
            margin-bottom: 20px;
            transition: all .3s;
            border-radius: 6px;
        }

        .step-label {
            width: calc(100% + 10px);
            height: calc(100% - 20px);
            background: #fff;
            box-shadow: 1px 1px 5px rgba(0, 0, 0, .4);
            position: relative;
            cursor: pointer;
            font-size: 14px;
            text-align: center;
            margin: 0 -5px;
            margin-bottom: 20px;
            transition: all .3s;
        }

        .step-img-holder {
            position: relative;
        }

        .step2 .step-img-holder {
            padding-top: 10px;
        }

        .step-label img {
            width: 100%;
            text-align: center;
        }

        .step2 .step-label img {
            max-height: 55px;
            width: auto;
        }

        .step-label-heading {
            margin: 0;
            font-weight: 600;
            text-align: center;
            font-size: 13px;
            padding: 10px 10px;
            color: #010101;
            background: #fff;
            position: relative;
        }

        .step-label:before {
            content: "\f00c";
            font-family: 'Font Awesome 5 Free';
            background-color: #5e42d3;
            top: 10px;
            left: auto;
            right: 10px;
            transform: scale(0);
            color: white;
            display: block;
            border-radius: 50%;
            position: absolute;
            width: 26px;
            height: 26px;
            text-align: center;
            line-height: 28px;
            transition-duration: 0.1s;
            font-weight: 900;
            font-size: 14px;
            transition: all .4;
            z-index: 1;
        }

        :checked+label:before {
            transform: scale(1);
        }

        .small-tick-area .step-label-heading {
            margin-top: -34px;
        }

        .step-footer-loader>span {
            position: absolute;
            top: 0;
            right: -5px;
            transform: translateY(-150%);
            color: #5e42d3;
            font-weight: 400;
            font-size: 18px;
            z-index: 30;

        }

        .step-footer-loader>span>span {
            opacity: .7;
            font-size: 12px;
        }

        .step-pt-20 .step-img-holder {
            padding-top: 20px;
        }

        .step-footer-z-index {
            z-index: 2000;
            background: transparent;
            border: none;
        }

        .step-slider,
        input.step-slider:focus {
            -webkit-appearance: none;
            width: 100%;
            height: 15px;
            border-radius: 1000px;
            background: #d3d3d3;
            outline: none;
            opacity: 0.9;
            -webkit-transition: .2s;
            transition: opacity .2s;
            padding: 0;
            margin-bottom: 15px;
        }

        .step-slider:hover,
        input.step-slider:focus {
            opacity: 1;
        }

        .step-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #5e42d3;
            cursor: pointer;
        }

        .step-slider::-moz-range-thumb {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            background: #5e42d3;
            cursor: pointer;
        }

        .p-left-bar {
            float: left;
            margin: 0;
        }

        .p-right-bar {
            float: right;
            margin: 0;
        }

        .step-number-hidden {
            display: none;
        }

        .step-number-hidden.show-this {
            display: block;
        }

        .click-show-hide {
            cursor: pointer;
            transition: all .3;
        }

        .click-show-hide:hover {
            color: #5e42d3;
        }

        .max-700 {
            width: 100%;
            max-width: 700px;
            margin: 0 auto;
        }

        .max-900 {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
        }

        @media (min-width: 1800px) {
            .step-container {
                top: 93px;
                height: calc(100% - 193px);
            }

            .max-700 {
                max-width: 900px;
            }

            .max-900 {
                max-width: 1100px;
            }

            .step-heading {
                padding-bottom: 40px;
            }

            .step-heading h1 {
                font-size: 40px;
            }

            .step-input {
                padding: 19px 20px 19px 20px;
                font-size: 23px;
            }

            input.step-form-submit,
            button.step-form-submit {
                font-size: 20px;
                height: 55px;
            }

            .step-footer {
                padding: 22px 0;
            }

            .step2 .step-img-holder {
                padding-top: 15px;
            }

            .step2 .step-label img {
                max-height: 65px;
            }

            .step-label-heading {
                font-size: 16px;
            }

            .click-show-hide {
                font-size: 18px;
            }
        }


        @media (max-width: 768px) {
            .step-container {
                top: 63px;
                height: calc(100% - 147px);
            }

            .step-center.top-mob {
                position: relative;
                top: 0;
                transform: none;
                padding-top: 40px;
            }

            .step-heading h1 {
                font-size: 25px;
            }

            .step-input {
                font-size: 14px;
            }

            .mt-mob-7 {
                margin-top: 7px !important;
            }

            .topnav a {
                text-align: center;
            }
        }
    </style>
    @stack('customStyles')
</head>

<body>
    @include('frontend.layouts.brief.header')

    @yield('container')



    <a id="back-to-top" href="javascript:void(0)" class="btn btn-lg back-to-top" role="button"><i class="fas fa-chevron-up"></i></a>

    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/assets/OwlCarousel/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/assets/fancy-box/jquery.fancybox.min.js') }}"></script>

<script src="{{ asset('frontend/assets/brief/js/jquery-magnific-popup.js') }}"></script> 
    {{-- <script src="{{ asset('frontend/assets/js/jquery-3.4.1.min.js') }}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> -->
    <script src="{{ asset('frontend/assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.sticky-kit.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/fixed-section.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/element-mouse-mover.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/scrollable-tabs.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/brief/js/jquery-magnific-popup.js') }}"></script> --}}




    <script>
        $(document).ready(function() {
            var header = $('.header');
            setHeader();
            $(window).on('resize', function() {
                setHeader();
            });

            $(document).on('scroll', function() {
                setHeader();
            });

            function setHeader() {
                if ($(window).scrollTop() > 5) {
                    header.addClass('scrolled');
                } else {
                    header.removeClass('scrolled');
                }
            }
        });
    </script>

    <script>
        $(document).ready(function() {

            $('[data-fancybox="images"]').fancybox({
                buttons: [
                    'slideShow',
                    'share',
                    'zoom',
                    'fullScreen',
                    'thumbs',
                    'close'
                ]
            })
        });
    </script>


    <script>
        function myFunction() {
            var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
        }
    </script>



    <script>
        $(".click-show-hide").click(function() {

            if ($('.step-number-hidden').css('display') == 'none') {
                $("#step-number-hidden").css("display", "block");
                $(".click-show-hide").html("Remove Your Phone Number");
            } else {
                $("#step-number-hidden").css("display", "none");
                $(".click-show-hide").html("Add Your Phone Number (Optional)");
                document.getElementById("cus_phone").value = '';
            }
        });
    </script>

  


    @stack('customScripts')
</body>

</html>