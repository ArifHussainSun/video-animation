@extends('admin.layouts.main')
@section('container')

<div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Brief</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{route('brief.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Customer Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" name="id" value="{{ !empty($brief->id) ? $brief->id : '' }}">
                                    <input type="text" class="form-control" name="cus_name" id="horizontal-name-input" value="{{ !empty($brief->cus_name) ? $brief->cus_name : '' }}" placeholder="Enter Customer Name here">
                                    @if ($errors->has('cus_name'))
                                        <span class="text-danger">{{ $errors->first('cus_name') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Customer Email</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="cus_email" value="{{ !empty($brief->cus_email) ? $brief->cus_email : '' }}" id="horizontal-name-input" placeholder="Enter Customer Email here">
                                    @if ($errors->has('cus_email'))
                                        <span class="text-danger">{{ $errors->first('cus_email') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Company Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" value="{{ !empty($brief->company_name) ? $brief->company_name : '' }}" name="company_name" id="horizontal-name-input" placeholder="Enter Company Name here">
                                    @if ($errors->has('company_name'))
                                        <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Company Slogan</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="company_slogan" value="{{ !empty($brief->company_slogan) ? $brief->company_slogan : '' }}" id="horizontal-name-input" placeholder="Enter Company Slogan here">
                                    @if ($errors->has('company_slogan'))
                                        <span class="text-danger">{{ $errors->first('company_slogan') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Industry</label></strong>
                                <select class="form-control select2" name="industry" id="industry">
                                <option value="" selected disabled>Select Industry</option>
                                    <option value="Agriculture & Outdoor">Agriculture & Outdoor</option>
                                    <option value="Art & Photography">Art & Photography</option>
                                    <option value="Building & Construction">Building & Construction</option>
                                    <option value="Business & Finance">Business & Finance</option>
                                    <option value="Children">Children</option>
                                    <option value="Religious">Religious</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Food & Drinks">Food & Drinks</option>
                                    <option value="Games & Betting">Games & Betting</option>
                                    <option value="Health & Medical">Health & Medical</option>
                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                    <option value="Education">Education</option>
                                    <option value="Pet & Animal">Pet & Animal</option>
                                    <option value="Home Service">Home Service</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Security">Security</option>
                                    <option value="Law">Law</option>
                                    <option value="Beauty & Spa">Beauty & Spa</option>
                                    <option value="Creative">Creative</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Science">Science</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Music">Music</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Logo Style</label></strong>
                                <select class="form-control select2" name="logo_style" id="logo_style">
                                <option value="" selected disabled>Select Logo Style</option>
                                    <option value="Agriculture & Outdoor">Agriculture & Outdoor</option>
                                    <option value="Art & Photography">Art & Photography</option>
                                    <option value="Building & Construction">Building & Construction</option>
                                    <option value="Business & Finance">Business & Finance</option>
                                    <option value="Children">Children</option>
                                    <option value="Religious">Religious</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Food & Drinks">Food & Drinks</option>
                                    <option value="Games & Betting">Games & Betting</option>
                                    <option value="Health & Medical">Health & Medical</option>
                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                    <option value="Education">Education</option>
                                    <option value="Pet & Animal">Pet & Animal</option>
                                    <option value="Home Service">Home Service</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Security">Security</option>
                                    <option value="Law">Law</option>
                                    <option value="Beauty & Spa">Beauty & Spa</option>
                                    <option value="Creative">Creative</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Science">Science</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Music">Music</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Logo Type</label></strong>
                                <select class="form-control select2" name="logo_type" id="logo_type">
                                <option value="" selected disabled>Select Logo Type</option>
                                    <option value="Agriculture & Outdoor">Agriculture & Outdoor</option>
                                    <option value="Art & Photography">Art & Photography</option>
                                    <option value="Building & Construction">Building & Construction</option>
                                    <option value="Business & Finance">Business & Finance</option>
                                    <option value="Children">Children</option>
                                    <option value="Religious">Religious</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Food & Drinks">Food & Drinks</option>
                                    <option value="Games & Betting">Games & Betting</option>
                                    <option value="Health & Medical">Health & Medical</option>
                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                    <option value="Education">Education</option>
                                    <option value="Pet & Animal">Pet & Animal</option>
                                    <option value="Home Service">Home Service</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Security">Security</option>
                                    <option value="Law">Law</option>
                                    <option value="Beauty & Spa">Beauty & Spa</option>
                                    <option value="Creative">Creative</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Science">Science</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Music">Music</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Logo Color</label></strong>
                                <select class="form-control select2" name="logo_color" id="logo_color">
                                <option value="" selected disabled>Select Logo Color</option>
                                    <option value="Agriculture & Outdoor">Agriculture & Outdoor</option>
                                    <option value="Art & Photography">Art & Photography</option>
                                    <option value="Building & Construction">Building & Construction</option>
                                    <option value="Business & Finance">Business & Finance</option>
                                    <option value="Children">Children</option>
                                    <option value="Religious">Religious</option>
                                    <option value="Fashion">Fashion</option>
                                    <option value="Food & Drinks">Food & Drinks</option>
                                    <option value="Games & Betting">Games & Betting</option>
                                    <option value="Health & Medical">Health & Medical</option>
                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                    <option value="Education">Education</option>
                                    <option value="Pet & Animal">Pet & Animal</option>
                                    <option value="Home Service">Home Service</option>
                                    <option value="Real Estate">Real Estate</option>
                                    <option value="Security">Security</option>
                                    <option value="Law">Law</option>
                                    <option value="Beauty & Spa">Beauty & Spa</option>
                                    <option value="Creative">Creative</option>
                                    <option value="Sports">Sports</option>
                                    <option value="Science">Science</option>
                                    <option value="Transportation">Transportation</option>
                                    <option value="Music">Music</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Data</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="data" value="{{ !empty($brief->data) ? $brief->data : '' }}" id="horizontal-name-input" placeholder="Enter Data here">
                                    @if ($errors->has('data'))
                                        <span class="text-danger">{{ $errors->first('data') }}</span>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <br/><br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('customScripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

@endpush
