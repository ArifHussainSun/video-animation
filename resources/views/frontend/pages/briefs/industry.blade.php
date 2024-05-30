@extends('frontend.layouts.brief.master')
@section('container')

<form class="step-form" action="{{route('front.slug','brief/logostyle')}}">

    <section class="step-container">
        <div class="step-center top-mob step2">
            <div class="container">
                <div class="step-heading">
                    <h1>What Best Defines Your Business</h1>
                </div>
                <div class="step-input-area max-900">
                    <div class="row">
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Agriculture & Outdoor" id="myCheckbox1">
                            <label class="step-label" for="myCheckbox1">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/1.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Agriculture & Outdoor</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Art & Photography" id="myCheckbox2">
                            <label class="step-label" for="myCheckbox2">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/2.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Art & Photography</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Building & Construction" id="myCheckbox3">
                            <label class="step-label" for="myCheckbox3">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/3.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Building & Construction</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Business & Finance" id="myCheckbox4">
                            <label class="step-label" for="myCheckbox4">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/4.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Business & Finance</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Children" id="myCheckbox5">
                            <label class="step-label" for="myCheckbox5">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/5.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Children</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Religious" id="myCheckbox6">
                            <label class="step-label" for="myCheckbox6">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/6.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Religious</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Fashion" id="myCheckbox7">
                            <label class="step-label" for="myCheckbox7">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/7.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Fashion</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Food & Drinks" id="myCheckbox8">
                            <label class="step-label" for="myCheckbox8">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/8.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Food & Drinks</h3>
                            </label>
                        </div>

                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Games & Betting" id="myCheckbox9">
                            <label class="step-label" for="myCheckbox9">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/9.png')}}" alt="">

                                </div>
                                <h3 class="step-label-heading">Games & Betting</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Health & Medical" id="myCheckbox10">
                            <label class="step-label" for="myCheckbox10">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/10.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Health & Medical</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Travel & Tourism" id="myCheckbox11">
                            <label class="step-label" for="myCheckbox11">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/11.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Travel & Tourism</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Education" id="myCheckbox12">
                            <label class="step-label" for="myCheckbox12">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/12.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Education</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Pet & Animal" id="myCheckbox13">
                            <label class="step-label" for="myCheckbox13">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/13.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Pet & Animal</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Home Service" id="myCheckbox14">
                            <label class="step-label" for="myCheckbox14">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/14.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Home Service</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Real Estate" id="myCheckbox15">
                            <label class="step-label" for="myCheckbox15">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/15.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Real Estate</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Security" id="myCheckbox16">
                            <label class="step-label" for="myCheckbox16">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/16.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Security</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Law" id="myCheckbox17">
                            <label class="step-label" for="myCheckbox17">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/17.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Law</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Beauty & Spa" id="myCheckbox18">
                            <label class="step-label" for="myCheckbox18">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/18.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Beauty & Spa</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Creative" id="myCheckbox19">
                            <label class="step-label" for="myCheckbox19">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/19.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Creative</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Sports" id="myCheckbox20">
                            <label class="step-label" for="myCheckbox20">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/20.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Sports</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Science" id="myCheckbox21">
                            <label class="step-label" for="myCheckbox21">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/21.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Science</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Transportation" id="myCheckbox22">
                            <label class="step-label" for="myCheckbox22">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/22.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Transportation</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective" value="Music" id="myCheckbox23">
                            <label class="step-label" for="myCheckbox23">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/23.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Music</h3>
                            </label>
                        </div>
                        <div class="col-lg-2 col-md-3 col-6">
                            <input type="checkbox" name="industry[]" class="step-selective step-other open-popup-link" value="Other" id="myCheckbox24" data-mfp-src="#other-popup">
                            <label class="step-label" for="myCheckbox24">
                                <div class="step-img-holder">
                                    <img src="{{ asset('frontend/assets/brief/images/steps/step2/24.pn')}}g" alt="">

                                </div>
                                <h3 class="step-label-heading">Other</h3>
                            </label>
                        </div>

                        <div id="other-popup" class="container white-popup mfp-hide">
                            <div class="col-md-12 col-xs-12 pop-set-new">
                                <input class="step-input other_industry" name="other_industry" autofocus type="text" placeholder="Please Enter Your Option">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-footer">
        <div class="step-footer-loader" data-load-from-per="10" data-load-per="30"></div>
        <div class="container">
            <div class="step-form-submit-area">
                <input type="hidden" name="cname" value="{{ isset($_GET['cname']) ? $_GET['cname'] : '' }}">
                <input type="hidden" name="sname" value="{{ isset($_GET['sname']) ? $_GET['sname'] : '' }}">
                <input type="submit" value="Skip" class="step-form-submit">
            </div>
        </div>
    </section>
</form>
@endsection