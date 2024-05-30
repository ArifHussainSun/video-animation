<footer class="position-relative">
    <video src="https://ik.imagekit.io/VideoAnimation/Assets/animation3.mp4" class="img1-0" autoplay loop muted></video>
    <!-- <img src="https://ik.imagekit.io/VideoAnimation/Assets/animation3.gif" class="img1-0" alt=""> -->
    <div class="container-objects">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Tube_Short_Y2_-_Thin0000.png" data-parallax='{"y": 500, "x": -300, "scale": 1, "rotateZ": 290}' class="img1" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Sphere-1.png" data-parallax='{"y": -300, "x": 600, "scale": 0.5, "rotateZ": -70}' class="img2" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Atom_2_-_Hexa0000.png" data-parallax='{"y": -300, "x": -500, "scale": 0.5, "rotateZ": -190}' class="img3" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Sphere0000.png" data-parallax='{"y": 400, "x": 100, "scale": 1.5, "rotateZ": 120}' class="img4" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Cube_Super_Rounded0000.png" data-parallax='{"y": 200, "x": -300, "scale": 0, "rotateZ": 60}' class="img5" alt="Not Found">
        <img src="https://ik.imagekit.io/VideoAnimation/Assets/Torus_Y3_-_Thick0000.png" data-parallax='{"y": -500, "x": -300, "scale": 0.5, "rotateZ": 90}' class="img6" alt="Not Found">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <a href="{{ route('front.slug','') }}">
                <img src="https://ik.imagekit.io/VideoAnimation/Assets/Group_43.png" alt="">
                 </a>
                <p class="text-white mt-3 smp">Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur, quia.</p>
                <div class="contact-info">
                    <a href="#" class="mt-3"> <i class="fa-solid fa-location-dot"></i> {{ (!empty($brand_settings['company_address']->key_value) ? $brand_settings['company_address']->key_value : '') }}</a>
                    <a href="#" class="mt-3"><i class="fa-solid fa-envelope"></i>{{ (!empty($brand_settings['company_email']->key_value) ? $brand_settings['company_email']->key_value : '') }}</a>
                    <a href="#" class="mt-3"><i class="fa-solid fa-phone-volume"></i>{{ (!empty($brand_settings['company_number']->key_value) ? $brand_settings['company_number']->key_value : '') }}</a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-md-0 mt-5">
                <h4>Links</h4>
                <div class="links mt-3 d-flex">
                    <ul>
                        <li class="mt-3"><a href="{{ route('front.slug','services') }}">Our Services</a></li>
                        <li class="mt-3"><a href="#">Team</a></li>
                        <li class="mt-3"><a href="{{ route('front.slug','portfolio') }}">Portfolio</a></li>
                        <li class="mt-3"><a href="{{ route('front.slug','contact-us') }}">Contact</a></li>
                        <li class="mt-3"><a href="#">News</a></li>
                    </ul>
                    <ul>
                        <li class="mt-3"><a href="#">FAQ's</a></li>
                        <li class="mt-3"><a href="#">Terms & Conditions</a></li>
                        <li class="mt-3"><a href="#">Privacy Policy</a></li>
                        <li class="mt-3"><a href="#">Help</a></li>
                        <li class="mt-3"><a href="#">Case Studies</a></li>
                    </ul>

                </div>
            </div>
            <div class="col-lg-5 col-md-8 mt-md-0 mt-3">
                <h4>Let's Create Something Animated </h4>
                <div class="footer-message"></div>
                <div class="success-box-footer">
                          <div class="alert alert-success">Congratulations. Your message has been sent successfully.</div>
                  </div>
                <div class="error-box-footer">
                     <div class="alert alert-warning">Error, please retry. Your message has not been sent.</div>
                 </div>
                <form id="contact-footer-form" role="form" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inpts">
                        <div class="first-inp">
                            <input type="text" class="" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                            <span class="error text-danger d-none"></span>
                            <input type="number" class="" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}">
                            <span class="error text-danger d-none"></span>
                        </div>
                        <input type="email" class="mt-2" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        <span class="error text-danger d-none"></span>
                        <textarea rows="4" class="mt-2" id="message" name="message" placeholder="Message">{{ old('message') }}</textarea>
                        <span class="error text-danger d-none"></span>
                    </div>
                    <a href="javascript:{}" class="mt-3 footer-btn" id="submit-footer-form" type="submit">Submit <i class="fa-solid fa-arrow-right"></i></a>
                </form>
            </div>
        </div>
    </div>

</footer>
<section class="footer-btm">
    <div class="container footer-btm">
        <div class="row">
            <div class="col-md-7 d-flex align-items-center">
                <p>© Copyrights 2022 - <span>Video Animation </span>- All Rights Reserved.</p>
            </div>
            <div class="col-md-5 mt-md-0 mt-4 d-flex justify-content-center justify-content-md-end">
                <a href="#">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </div>
</section>