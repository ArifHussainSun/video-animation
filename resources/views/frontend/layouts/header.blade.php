<header class="desktop-menu animated">
    <div class="container">
        <div class="row">
            <div class="col-md-2 d-flex align-items-center">
                <a href="{{ route('front.slug','') }}">
             <img src="{{ (!empty($brand_settings['logo']->key_value) ? asset($brand_settings['logo']->key_value) : asset('https://ik.imagekit.io/VideoAnimation/Assets/Group_43.png')) }}">
             </a>
            </div>
            <div class="col-md-7">
                <ul class="menu-items d-flex align-items-center justify-content-center">
                    <li><a href="{{ route('front.slug','') }}" class="active">Home</a></li>
                    <li><a href="{{ route('front.slug','about-us') }}">About</a></li>
                    <li><a href="{{ route('front.slug','services') }}">Services</a></li>
                    <li><a href="{{ route('front.slug','portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ route('front.slug','pricing') }}">Pricing</a></li>
                    <li><a href="{{ route('front.slug','contact-us') }}">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3 d-flex align-items-center justify-content-center">
                <i class="fa-solid fa-phone-volume contact-icon"></i>
                <div class="contact-box">
                    <p>Call Any Time</p>
                    <a href="tel:{{ (!empty($brand_settings['company_number']->key_value) ? $brand_settings['company_number']->key_value : '') }}">{{ (!empty($brand_settings['company_number']->key_value) ? $brand_settings['company_number']->key_value : '') }}</a>
                </div>
                <i class="fa-solid fa-magnifying-glass"></i>
            </div>
        </div>
    </div>
</header>
<section class="menu-mob-items">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <ul>
                    <li><a href="{{ route('front.slug','') }}" class="active">Home</a></li>
                    <li><a href="{{ route('front.slug','about-us') }}">About</a></li>
                    <li><a href="{{ route('front.slug','services') }}">Services</a></li>
                    <li><a href="{{ route('front.slug','portfolio') }}">Portfolio</a></li>
                    <li><a href="{{ route('front.slug','pricing') }}">Pricing</a></li>
                    <li><a href="{{ route('front.slug','contact-us') }}">Contact</a></li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 d-flex align-items-center">
                <div class="contact-mob">
                    <i class="fa-solid fa-phone-volume contact-icon"></i>
                    <div class="contact-box">
                        <p>Call Any Time</p>
                        <a href="#">012 345 6789</a>
                    </div>
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
            </div>
        </div>
    </div>

</section>