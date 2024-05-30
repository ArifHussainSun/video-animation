@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD NEW CUSTOMERS</h4>
                @if(Session::has('success'))
                div class="alert alert-success alert-block" id="abc" role="alert">
                <button class="close" data-dismiss="alert"></button>
                {{ Session::get('success') }}
                @php
                Session::forget('success');



                @endphp
            </div>
            @endif
            <form action="{{route('customer.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-name-input" class="col-sm-4 col-form-label">First Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="first_name" id="horizontal-first_name-input" placeholder="Enter First Name here">
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-heading_two-input" class="col-sm-4 col-form-label">Last Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="last_name" id="horizontal-last_name-input" placeholder="Enter Last Name here">
                                            @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Email</label></strong>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" placeholder="Enter Email here" name="email" id="horizontal-email-input">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Phone Number</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Phone Number here" name="phone_number" id="horizontal-phone_number-input">
                                            @if ($errors->has('phone_number'))
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Company Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Company Name here" name="company_name" id="horizontal-company_name-input">
                                            @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Address</label></strong>
                                        <div class="col-sm-12">
                                            <textarea type="text" rows="4" class="form-control" placeholder="Enter Address here" name="address" id="horizontal-address-input"></textarea>
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">City</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter City here" name="city" id="horizontal-city-input">
                                            @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">State</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter State here" name="state" id="horizontal-state-input">
                                            @if ($errors->has('state'))
                                            <span class="text-danger">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Zip Code</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Zip Code here" name="zipcode" id="horizontal-zipcode-input">
                                            @if ($errors->has('zipcode'))
                                            <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Country</label></strong>
                                        <div class="col-sm-12">
                                            <select class="form-control select2" name="country" id="country">
                                                <option value="" Selected disabled>Select Country</option>
                                                @forelse($country as $contry)
                                                <option value="{{ $contry->id }}">{{ $contry->country_name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('country'))
                                            <span class="text-danger">{{ $errors->first('country') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">User Icon image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <br /><br />
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-12" style="text-align: center;">
                            <input type="hidden" name="roles" value="Customer">
                            <button type="submit" class="btn btn-primary w-md">SAVE</button>
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
        setTimeout(function() {
            $("#abc").remove();
        }, 2000);

        $('.select2').select2();
    });
</script>

@endpush
