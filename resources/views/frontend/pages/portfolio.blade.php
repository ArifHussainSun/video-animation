@extends('frontend.layouts.master')
@section('container')
@push('customStyles')
<style type="text/css">
    
    .portfolio .img-div .portfolio-overlay-img
    {
        top:50%;
        z-index:999;
    }
 
</style>   
@endpush

<section class="home-banner inner-page position-relative">

    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_1_-_Tetra0000.png" class="img2" alt="Not Found">
    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_3_-_Octa0000.png" class="img3" alt="Not Found">
    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Sphere0000.png" class="img5" alt="Not Found">
    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Sphere-1.png" class="img6" alt="Not Found">
    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Tube_Short_Y2_-_Thin0000.png" class="img7" alt="Not Found">
    <img src="https://ik.imagekit.io/VideoAnimation/Assets/Torus_Y3_-_Thick0000.png" class="img10" alt="Not Found">
    </div>

    <div class="container absolute-main-container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="main-heading text-center">
                    <h2>Portfolio</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="portfolio portfolio-page text-md-center mt-5 mt-md-0 position-relative">

    <div class="container-objects">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Torus_Y3_-_Thick0000.png" class="img1" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Cube_Super_Rounded0000.png" class="img4" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_3_-_Octa0000.png" class="img2" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Sphere0000.png" class="img5" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_1_-_Tetra0000.png" class="img3" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Tube_Short_Y2_-_Thin0000.png" class="img8" alt="Not Found">
    </div>
    <div class="container container-width">
        <div class="row">
            <div class="col-md-12 px-0">
                <div class="portfolio-tabs mt-4">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="logodesign-tab" data-bs-toggle="tab" data-bs-target="#logodesign" type="button" role="tab" aria-controls="logodesign" aria-selected="false">3D Animation</button>
                        </li>
                
                         <li class="nav-item" role="presentation">
                            <button class="nav-link" id="logo-animation-tab" data-bs-toggle="tab" data-bs-target="#logo-animation" type="button" role="tab" aria-controls="logo-animation" aria-selected="false">Logo Animation</button>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-5" id="myTabContent">
                    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

                         <div class="row justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-8659.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-8659.png') }}" alt="">


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-9815.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-9815.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-760.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/all/video-capture-760.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-md-4 justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-761.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/all/video-capture-761.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-1084.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-1084.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-1109.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-1109.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-md-4 justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-1177.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/all/video-capture-1177.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-1258.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-1258.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-1872.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-1872.png') }}" alt="">
                                </div>
                            </div>

                        </div>


                    </div>

                    <div class="tab-pane fade" id="logodesign" role="tabpanel" aria-labelledby="logodesign-tab">

                        <div class="row justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-4162.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-4162.png') }}" alt="">


                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-4317.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-4317.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-4433.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-4433.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-md-4 justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-4764.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-4764.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-4958.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/all/video-capture-4958.png') }}" alt="">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-5185.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/all/video-capture-5185.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-5277.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/all/video-capture-5277.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-6160.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-6160.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-6461.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-6461.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="car-wrap" role="tabpanel" aria-labelledby="car-wrap-tab">
                        <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-6707.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-6707.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7003.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7003.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7009.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7009.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7274.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7274.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7277.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                        <img src="{{ asset('assets/images/portfolio/all/video-capture-7277.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7352.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7352.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7402.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7402.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7405.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7405.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-8115.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-8115.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="business-card" role="tabpanel" aria-labelledby="business-card-tab">
                       <div class="row justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-6707.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-6707.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7003.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7003.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7009.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7009.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7274.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7274.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7277.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                        <img src="{{ asset('assets/images/portfolio/all/video-capture-7277.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7352.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7352.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7402.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7402.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-7405.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-7405.png') }}" alt="">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/all/video-capture-8115.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/all/video-capture-8115.png') }}" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="logo-animation" role="tabpanel" aria-labelledby="logo-animation-tab">
                        <div class="row justify-content-between">

                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-8937.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-8937.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-9055.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-9055.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-9184.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-9184.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-9452.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-9452.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-9615.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-9615.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-39.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-39.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-65.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-65.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-103.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-103.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-566.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-566.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-726.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-726.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-765.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                  <img src="{{ asset('assets/images/portfolio/video-capture-765.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-789.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                      <img src="{{ asset('assets/images/portfolio/video-capture-789.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                         <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-1652.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                  <img src="{{ asset('assets/images/portfolio/video-capture-1652.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-1824.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-1824.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-1868.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                      <img src="{{ asset('assets/images/portfolio/video-capture-1868.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-1884.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                      <img src="{{ asset('assets/images/portfolio/video-capture-1884.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-2530.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-2530.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-2999.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-2999.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                         <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-3634.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/video-capture-3634.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-3781.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-3781.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-4053.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-4053.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-4342.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/video-capture-4342.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-4395.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-4395.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-4953.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-4953.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-5965.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                      <img src="{{ asset('assets/images/portfolio/video-capture-5965.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-6312.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-6312.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-6786.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                   <img src="{{ asset('assets/images/portfolio/video-capture-6786.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-6997.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                      <img src="{{ asset('assets/images/portfolio/video-capture-6997.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-7070.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/video-capture-7070.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-7089.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                    <img src="{{ asset('assets/images/portfolio/video-capture-7089.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-7830.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/video-capture-7830.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-7863.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                     <img src="{{ asset('assets/images/portfolio/video-capture-7863.png') }}" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-7889.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                  <img src="{{ asset('assets/images/portfolio/video-capture-7889.png') }}" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row mt-md-4 justify-content-between">
                            <div class="col-md-4">
                                <div class="img-div">
                                    <div class="portfolio-overlay-img">
                                        <a href="{{ asset('assets/images/portfolio/video-capture-8426.png') }}" data-fancybox="gallery">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </a>
                                    </div>
                                       <img src="{{ asset('assets/images/portfolio/video-capture-8426.png') }}" class="img-fluid">
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
              
            </div>

        </div>
    </div>
</section>

@endsection