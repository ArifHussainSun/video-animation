@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD UPDATED CUSTOMERS</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                <form action="{{route('customer.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-sm-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-name-input" class="col-sm-4 col-form-label">First Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="hidden" class="form-control" name="id" id="id" value="{{ !empty($customers->id) ? $customers->id  : '' }}">
                                            <input type="text" class="form-control" name="first_name" id="horizontal-first_name-input" value="{{ !empty($customers->first_name) ? $customers->first_name  : '' }}" placeholder="Enter First Name here">
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
            
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-heading_two-input" class="col-sm-4 col-form-label">Last Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="last_name" value="{{ !empty($customers->last_name) ? $customers->last_name  : '' }}" id="horizontal-last_name-input" placeholder="Enter Last Name here">
                                            @if ($errors->has('last_name'))
                                            <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Email</label></strong>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" placeholder="Enter Email here" value="{{ !empty($customers->email) ? $customers->email  : '' }}" name="email" id="horizontal-email-input">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Phone Number</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Phone Number here" value="{{ !empty($customers->phone_number) ? $customers->phone_number  : '' }}" name="phone_number" id="horizontal-phone_number-input">
                                            @if ($errors->has('phone_number'))
                                            <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Company Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Company Name here" value="{{ !empty($customers->company_name) ? $customers->company_name  : '' }}" name="company_name" id="horizontal-company_name-input">
                                            @if ($errors->has('company_name'))
                                            <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Address</label></strong>
                                        <div class="col-sm-12">
                                            <textarea type="text" rows="4" class="form-control" placeholder="Enter Address here"  name="address" id="horizontal-address-input">{{ !empty($customers->address) ? $customers->address  : '' }}</textarea>
                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">City</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter City here" value="{{ !empty($customers->city) ? $customers->city  : '' }}" name="city" id="horizontal-city-input">
                                            @if ($errors->has('city'))
                                            <span class="text-danger">{{ $errors->first('city') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">State</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter State here" value="{{ !empty($customers->state) ? $customers->state  : '' }}" name="state" id="horizontal-state-input">
                                            @if ($errors->has('state'))
                                            <span class="text-danger">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-short_address-input" class="col-sm-4 col-form-label">Zip Code</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Zip Code here" value="{{ !empty($customers->zipcode) ? $customers->zipcode  : '' }}" name="zipcode" id="horizontal-zipcode-input">
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
                                                @forelse($countries as $contry)
                                                <option value="{{ $contry->id }}" {{ $customers->country  == $contry->id ? 'selected' : ''}}>{{ $contry->country_name }}</option>
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
                                        <label for="image" class="control-label">Old Preview Icon image</label>
                                        <img src="{{ (!empty($customers->image) ? asset($customers->image) : asset('backend/assets/images/default/no-image.jpg')) }}"  class="form-control input-sm" width="180px;" height="120" />

                                    </div>
                                </div>
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
                                <button type="submit" class="btn btn-primary w-md">Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
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
