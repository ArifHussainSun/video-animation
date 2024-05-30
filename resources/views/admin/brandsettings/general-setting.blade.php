@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"></h4>
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
                    <ul class="nav nav-tabs nav-tabs-custom nav-justified" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#contact" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">CONTACT INFORMATION</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#social" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">SOCIAL LINKS</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#logo" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">LOGO & FAVICON</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#theme" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-envelope"></i></span>
                                <span class="d-none d-sm-block">THEME</span>
                            </a>
                        </li>


                    </ul>
                    <div class="tab-content p-3 text-muted">
                            <div class="tab-pane active" id="contact" role="tabpanel">
                                <div class="col-sm-12">
                                  <form action="{{ route('admin-brand-settings.contact-information-save') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Company Alias</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="company_alias" id="company_alias" value="{{ (!empty($company_alias->key_value) ? $company_alias->key_value : '') }}" placeholder="Enter Company Alias here">
                                                    @if ($errors->has('company_alias'))
                                                        <span class="text-danger">{{ $errors->first('company_alias') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Company Name</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="company_name" id="company_name" value="{{ (!empty($company_name->key_value) ? $company_name->key_value : '') }}" placeholder="Enter Company Name here">
                                                    @if ($errors->has('company_name'))
                                                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Phone</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="company_phone" id="company_phone" value="{{ (!empty($company_phone->key_value) ? $company_phone->key_value : '') }}" placeholder="Enter Company Phone here">
                                                    @if ($errors->has('company_phone'))
                                                        <span class="text-danger">{{ $errors->first('company_phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-heading_two-input" class="col-sm-3 col-form-label">Email</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="email" class="form-control" name="company_email" id="company_email" value="{{ (!empty($company_email->key_value) ? $company_email->key_value : '') }}" placeholder="Enter Email here">
                                                    @if ($errors->has('company_email'))
                                                        <span class="text-danger">{{ $errors->first('company_email') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Address</label></strong>
                                                <div class="col-sm-12">
                                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter address here"  name="company_address" id="horizontal-address-input">{{ (!empty($company_address->key_value) ? $company_address->key_value : '') }}</textarea>
                                                    @if ($errors->has('company_address'))
                                                        <span class="text-danger">{{ $errors->first('company_address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <br/><br/>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <button type="submit" class="btn btn-primary w-md">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                  </div>
                            </div>
                            <div class="tab-pane" id="social" role="tabpanel">
                                <div class="col-sm-12">
                                    <form action="{{ route('admin-brand-settings.social-link-save')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-facebook-input" class="col-sm-3 col-form-label">Facebook</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" value="{{ (!empty($social_facebook->key_value) ? $social_facebook->key_value : '') }}" name="social_facebook" id="horizontal-facebook-input" placeholder="Enter Facebook Link here">
                                                    @if ($errors->has('social_facebook'))
                                                    <span class="text-danger">{{ $errors->first('social_facebook') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-instagram-input" class="col-sm-3 col-form-label">Instagram</label></strong>
                                                <div class="col-sm-12">

                                                    <input type="text" class="form-control" value="{{ (!empty($social_instagram->key_value) ? $social_instagram->key_value : '') }}" name="social_instagram" id="horizontal-instagram-input" placeholder="Enter Instagram Link here">

                                                    @if ($errors->has('social_instagram'))
                                                    <span class="text-danger">{{ $errors->first('social_instagram') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-twitter-input" class="col-sm-3 col-form-label">Twitter</label></strong>
                                                <div class="col-sm-12">

                                                    <input type="text" class="form-control" value="{{ (!empty($social_twitter->key_value) ? $social_twitter->key_value : '') }}" name="social_twitter" id="horizontal-twitter-input" placeholder="Enter Twitter Link here">

                                                    @if ($errors->has('social_twitter'))
                                                    <span class="text-danger">{{ $errors->first('social_twitter') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-youtube-input" class="col-sm-3 col-form-label">Youtube</label></strong>
                                                <div class="col-sm-12">

                                                    <input type="text" class="form-control" value="{{ (!empty($social_youtube->key_value) ? $social_youtube->key_value : '') }}" name="social_youtube" id="horizontal-youtube-input" placeholder="Enter Youtube Link here">

                                                    @if ($errors->has('social_youtube'))
                                                        <span class="text-danger">{{ $errors->first('social_youtube') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-linkedin-input" class="col-sm-3 col-form-label">LinkedIn</label></strong>
                                                <div class="col-sm-12">

                                                    <input type="text" class="form-control" value="{{ (!empty($social_linkedin->key_value) ? $social_linkedin->key_value : '') }}" name="social_linkedin" id="horizontal-linkedin-input" placeholder="Enter LinkedIn Link here">

                                                    @if ($errors->has('social_linkedin'))
                                                        <span class="text-danger">{{ $errors->first('social_linkedin') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <br /><br />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <button type="submit" class="btn btn-primary w-md">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="logo" role="tabpanel">
                                <div class="col-sm-12">
                                    <form action="{{route('admin-brand-settings.logos-save')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong><label for="horizontal-Logo-input" class="col-sm-12 col-form-label">Logo</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" name="logo" id="logo">
                                                    <div class="invalid-feedback">
                                                        Please upload icon image.
                                                    </div>
                                                    @if ($errors->has('logo'))
                                                    <span class="text-danger">{{ $errors->first('logo') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong><label for="horizontal-Logo-input" class="col-sm-12 col-form-label">Logo Preview</label></strong>
                                                <div class="col-sm-10">
                                                    <img id="logos" src="{{ (!empty($logo->key_value) ? asset($logo->key_value) : asset('backend/assets/images/default/no-image.jpg')) }}" class="form-control input-sm" width="180px;" height="120">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong><label for="horizontal-Logo-input" class="col-sm-3 col-form-label">Logo White</label></strong>
                                                <div class="col-sm-12">

                                                    <input type="file" class="form-control" name="logo_white" id="logo_white">

                                                    <div class="invalid-feedback">
                                                        Please upload icon image.
                                                    </div>
                                                    @if ($errors->has('logo'))
                                                    <span class="text-danger">{{ $errors->first('logo_white') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong><label for="horizontal-Logo-input" class="col-sm-12 col-form-label">Logo White Preview</label></strong>
                                                <div class="col-sm-10">
                                                    <img id="logo_white_img" src="{{ (!empty($logo_white->key_value) ? asset($logo_white->key_value) : asset('backend/assets/images/default/no-image.jpg')) }}" class="form-control input-sm" width="180px;" height="120">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-8">
                                                <strong><label for="horizontal-instagram-favicon" class="col-sm-12 col-form-label">Favicon</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="file" class="form-control" name="favicon" id="favicon">
                                                    <div class="invalid-feedback">
                                                        Please upload icon image.
                                                    </div>
                                                    @if ($errors->has('favicon'))
                                                    <span class="text-danger">{{ $errors->first('favicon') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <strong><label for="horizontal-Logo-input" class="col-sm-12 col-form-label">Favicon Preview</label></strong>
                                                <div class="col-sm-10">
                                                    <img id="favicons" src="{{ (!empty($favicon->key_value) ? asset($favicon->key_value) : asset('backend/assets/images/default/no-image.jpg')) }}" class="form-control input-sm" width="180px;" height="120">
                                                </div>
                                            </div>
                                        </div>
                                        <br />
                                        <br />
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <button type="submit" class="btn btn-primary w-md">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane" id="theme" role="tabpanel">
                                <div class="col-sm-6">
                                    <form action="{{route('admin-brand-settings.theme-save')}}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <div class="card">
                                            <div class="card-body">
                                                    <div class="sm-3 custom-color">

                                                    <div class="row">
                                                         <div class="col-md-6">
                                                         <label class="form-label p-color">Primary Color</label>
                                                         <input type="color" class="form-control primary-color" id="colorpicker-default" value="{{ (!empty($primary_color->key_value) ? $primary_color->key_value : '') }}" name="primary_color">
                                                         </div>
                                                         <div class="col-md-6">
                                                         <label class="form-label p-color">Secondary Color</label>
                                                        <input type="color" class="form-control primary-color" id="colorpicker-showalpha" value="{{ (!empty($secondary_color->key_value) ? $secondary_color->key_value : '') }}" name="secondary_color">                                                         </div>
                                                    </div>
                                                    <div class="col-12 mt-4">
                                                        <label class="p-color">Default Customer Password</label>
                                                        <!-- <input type="password" id="password" placeholder="Enter Default Customer Password" class="form-control" value="" name="default_customer_password">
                                                        <input type="checkbox" id="checkbox">Show Password -->
                                                        <div class="input-group auth-pass-inputgroup">
                                                            <input type="password" id="password" class="form-control masked" name="default_customer_password" value="{{ (!empty($default_customer_password->key_value) ? $default_customer_password->key_value : '') }}" placeholder="Enter password" aria-label="Password" aria-describedby="password-addon">
                                                            <button class="btn btn-light " type="button" id="eye"><i class="mdi mdi-eye-outline"></i></button>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                    <!-- <input type="password" placeholder="Password" id="pwd" class="masked" name="password" />
                                                        <button type="button" id="eye">
                                                            <img src="https://cdn0.iconfinder.com/data/icons/feather/96/eye-16.png" alt="eye" />
                                                        </button>
                                                    </div> -->

                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="col-sm-12" style="text-align: center;">
                                                    <button type="submit" class="btn btn-primary w-md">SAVE</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
  <script>
    function show() {
    var p = document.getElementById('password');
    p.setAttribute('type', 'text');
    }

    function hide() {
        var p = document.getElementById('password');
        p.setAttribute('type', 'password');
    }

    var pwShown = 0;

    document.getElementById("eye").addEventListener("click", function () {
        if (pwShown == 0) {
            pwShown = 1;
            show();
        } else {
            pwShown = 0;
            hide();
        }
    }, false);
  </script>

@endpush
