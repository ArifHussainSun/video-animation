<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
   
    <link rel="shortcut icon" href="{{ (!empty($brand_settings['favicon']->key_value) ? asset($brand_settings['favicon']->key_value) : asset('backend/assets/img/users/no-image.jpg')) }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frontend/assets/fancy-box/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/OwlCarousel/dist/assets/owl.carousel.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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

        @stack('customStyles')
        @routes   

    <style type="text/css">
    .success-box
    {
        display: none;
    }
    .error-box
    {
        display: none;
    }
    .success-box-footer
    {
        display: none;
    }
    .error-box-footer
    {
        display: none;
    }
    .icon-box
    {
        padding: 30px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgb(0 0 0 / 10%);
        margin: 7px 0;
    }
    .icon-l
    {
        margin-bottom: 15px;
    }
    .icon-box i
    {
        font-size:40px;
        color:#fd1d4f;
    }
    .double-section-b
    {
     margin-bottom:5px;   
    }
    .working-process
    {
    background: #eee;
    }
    /*home page contact form*/
   
        .ipn12
        {
            background: #fd1d4e;
            padding: 14px 20px;
            color: #161c2d;
            border-radius: 7px
        }
        .ipn12:focus
        {
            background: #fd1d4e;
        }
        .ipn12::placeholder
        {
            color:#fff;
        }
        .ipn13 
        {
            padding: 17px 0 0 20px;
            background: #fd1d4e;
            border-radius: 7px;
        }
        textarea::placeholder 
        {
            color: #fff !important;
        }
        .ipn13:focus
        {
            background: #fd1d4e;
        }
        .send-message
        {
            width: 202px;
            margin: 10px 0 0 0;
            color: #fff;
            border: 0;
            border-radius: 100px;
            background: #fd1d4e;
            padding: 17px 50px;
        }
        .icon-1 .circle
          {
              background:#fd1d4e;
              width:80px;
              height:80px;
              border-radius:100%;
              font-size:35px;
              text-align:center;
              margin:auto;
              line-height: 75px;
          }
          .icon-1 .circle i
          {
              color:#fff;
          }
          .p-text {
              margin-top: 20px;
          }
          .p-text .heading
          {
              margin-bottom: 13px;
  
          }
        .home-banner .absolute-main-container
       {
        width:100%;
       }
    .videobannerbtn {
        text-align: center;
        font-size: 80px;
        display: inline-block;
        align-items: center;
        justify-content: center;
        position: relative;
        width: 180px;
        height: 180px;
        line-height: 180px;
        background: #fff;
        color: #fd1d4f;
        border: none;
        border-radius: 50%;
        box-shadow: 10px 10px 33px #6d6d6d;
        outline: none;
        cursor: pointer;
    }
    .videobannerbtn:hover
    {
        color: #fd1d4f;
    }
    .videobannerbtn::before, .videobannerbtn:after {
        content: '';
        position: absolute;
        top: 16%;
        left: 16%;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        border: 2px solid #fff;
        /* filter: blur(2px); */
        transform-origin: 50%;
        z-index: -1;
        animation: ripple-1 2s infinite ease-in-out;
        transform: scale(1);
        transition: 1000ms transform ease, 2100ms blur ease, 900ms border-color ease;
    }
    .videobannerbtn::after {
        transition-delay: 100ms;
        animation: ripple-2 2s infinite ease-in-out;
        animation-delay: 0.5s;
    }
        .main-heading h2
        {
        text-align:left;
        font-size:54px;
    }
    .playbtndiv {
        transform: translate(34%, 0%);
    }
    .home-banner .banner-form i
    {
        left:25px;
    }
@keyframes ripple-1 { 0% { transform: scale(1); opacity: 1; } 100% { transform: scale(2.5); opacity: 0; } } 
@keyframes ripple-2 { 0% { transform: scale(1); opacity: 1; } 100% { transform: scale(2.7); opacity: 0; } }

    </style>
{!! (!empty($brand_settings['customheader']) ? $brand_settings['customheader'] : '') !!} 
</head>

<body>

    <div class="mob-menu">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-6">
                    <div class="img-div">
                        <a href="{{ route('front.slug','') }}">
                        <img src="{{ (!empty($brand_settings['logo']->key_value) ? asset($brand_settings['logo']->key_value) : asset('https://ik.imagekit.io/VideoAnimation/Assets/Group_43.png')) }}">
                        </a>
                    </div>
                </div>
                <div class="col-sm-8 col-6 d-flex justify-content-end align-items-center">
                    <button class="menu-btn">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    @include('frontend.layouts.header')

    @yield('container')

    @include('frontend.layouts.footer')

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script> <!--add jquery version for parallax object in banner-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="{{ asset('frontend/assets/OwlCarousel/dist/owl.carousel.js') }}"></script>
    <script src="{{ asset('frontend/assets/fancy-box/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/parallax.js') }}"></script> <!--add for parallax object in banner-->
    <script>
        $('.client-slider').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            autoplay: true,
            autoplayTimeout: 3980,
            autoplaySpeed: 1000,
            autoplayHoverPause: true,
            rtl: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        })
        $('.client-slider2').owlCarousel({
            loop: true,
            margin: 20,
            nav: true,
            autoplay: true,
            autoplayTimeout: 4000,
            autoplaySpeed: 1000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 1
                },
                1000: {
                    items: 2
                }
            }
        })
        $('[data-fancybox="gallery"]').fancybox({
            buttons: [
                'slideShow',
                'share',
                'zoom',
                'fullScreen',
                'thumbs',
                'close'
            ]
        });
        $(window).on("scroll", function() {
            if ($(window).scrollTop() > 250) {
                $(".desktop-menu").addClass("bg-active");
                $(".desktop-menu").addClass("animate__fadeInDown");

                $(".desktop-menu .menu-items li a ").css("color", "#000")
                $(".desktop-menu .menu-items li a.active").css("color", "#fd1d4e")
                $(".desktop-menu .contact-box a").css("color", "#000")

            } else {
                $(".desktop-menu").removeClass("bg-active");
                $(".desktop-menu .menu-items li a ").css("color", "#8b8b8b")
                $(".desktop-menu .menu-items li a.active").css("color", "#fff")
                $(".desktop-menu .contact-box a").css("color", "#fff")
                $(".desktop-menu").removeClass("animate__fadeInDown");
            }
        });


        $(".menu-btn").click(function() {
            $(".menu-mob-items").toggleClass("shown");

        })
        

    </script>
     {!! (!empty($brand_settings['customfooter']) ? $brand_settings['customfooter'] : '') !!}
 @stack('customScripts')
</body>

</html>