@extends('frontend.layouts.master')
@section('container')

<section class="home-banner pricing-page inner-page position-relative">

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
                    <h2>Resolve your questions with animation gurus </h2>
                    <p style="color:#fff;">Turn your imagination into reality by ACT ON VIDEO</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container">
        <div class="row justify-content-center text-center">
                    <div class="col-md-4">
                           <div class="icon-1">
                                <div class="circle">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                                <div class="p-text">
                                    <p class="heading"><b>Our Location</b></p>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                           </div>
                    </div>
                     <div class="col-md-4">
                        <div class="icon-1">
                            <div class="circle">
                                <i class="fa-solid fa-envelope-open-text"></i>
                            </div>
                            <div class="p-text">
                                <p class="heading"><b>Email Address</b></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-4">
                        <div class="icon-1">
                            <div class="circle">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="p-text">
                                <p class="heading"><b>Urgent Call</b></p>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
</section>
<section class="contact contact-page mt-5 mt-md-0 position-relative pt-0">

    <div class="container-objects">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Torus_Y3_-_Thick0000.png" class="img1" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Cube_Super_Rounded0000.png" class="img4" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_3_-_Octa0000.png" class="img2" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_1_-_Tetra0000.png" class="img3" alt="Not Found">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Let's discuss your animated projects</h1>
            </div>
        </div>
       <div class="row">
        <div class="contact-message"></div>
            <form id="contact-form" role="form" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="name-error" name="name" placeholder="Full Name">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="email-error" name="email" placeholder="Email Address">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                </div>
                 <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="phone-error" name="phone" placeholder="Phone Number">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="website-error" name="website" placeholder="Website">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                </div>
                 <div class="row mt-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="style-error" name="style" placeholder="What Style of video are You Looking For?">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control ipn12" id="organization-error" name="organization" placeholder="Organization">
                            <span class="error text-danger d-none"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mt-2">
                    <textarea type="text" rows="5" cols="3" class="form-control ipn13" id="message-error" name="message" placeholder="Tell Us About Your Project"></textarea>
                    <span class="error text-danger d-none"></span>
                </div>
                </div>
                <div class="row justify-content-center">
                    <button type="button" class="send-message" id="contact-form-submit">Send Message</button>
                </div>
            </form>
        </div>
    </div>

</section>

<section class="above-footer">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="heading-div text-center text-md-start">
                    <h2>Pocket-Friendly Design. Just A Click Away!</h2>
                </div>
            </div>
            <div class="col-md-3 mt-4 mt-md-0 d-flex align-items-md-center justify-content-md-end justify-content-center">
                <button>
                    <a href="{{ route('front.slug','portfolio') }}">View Pocket Plans</a>
                </button>
            </div>
        </div>
    </div>
</section>

@endsection