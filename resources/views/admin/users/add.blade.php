@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD NEW USERS</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                <form class="repeater" action="{{route('user.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Roles</label></strong>
                                            <select class="form-control select2" name="roles" id="roles">
                                                <option value="" selected disabled>Select Roles</option>
                                                @forelse($roles as $role)
                                                <option value="{{ $role }}">{{ $role }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                            @if ($errors->has('roles'))
                                            <span class="text-danger">{{ $errors->first('roles') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-first_name-input" class="col-sm-3 col-form-label">First Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="first_name" id="horizontal-first_name-input" placeholder="Enter First Name here">
                                                @if ($errors->has('first_name'))
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-last_name-input" class="col-sm-3 col-form-label">Last Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="last_name" id="horizontal-last_name-input" placeholder="Enter Last Name here">
                                                @if ($errors->has('last_name'))
                                                <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-email-input" class="col-sm-3 col-form-label">Email</label></strong>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" placeholder="Enter Email here" name="email" id="horizontal-email-input">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-phone_number-input" class="col-sm-5 col-form-label">Phone Number</label></strong>
                                            <div class="col-sm-12">
                                                <input class="form-control phone_number" name="phone_number" id="phone_number" placeholder="Enter  Number here">
                                                @if ($errors->has('phone_number'))
                                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-company-input" class="col-sm-5 col-form-label">Company Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="company_name" id="horizontal-company-input" placeholder="Enter Company Name here">

                                                @if ($errors->has('company_name'))
                                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-address-input" class="col-sm-5 col-form-label">Address</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="address" id="horizontal-address-input" placeholder="Enter Address here">

                                                @if ($errors->has('address'))
                                                <span class="text-danger">{{ $errors->first('address') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-city-input" class="col-sm-5 col-form-label">City</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="city" id="horizontal-city-input" placeholder="Enter City here">

                                                @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-state-input" class="col-sm-5 col-form-label">State</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="state" id="horizontal-state-input" placeholder="Enter State here">

                                                @if ($errors->has('state'))
                                                <span class="text-danger">{{ $errors->first('state') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-zipcode-input" class="col-sm-5 col-form-label">Zip Code</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="zipcode" id="horizontal-zipcode-input" placeholder="Enter State here">

                                                @if ($errors->has('zipcode'))
                                                <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-city-input" class="col-sm-5 col-form-label">Country</label></strong>
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
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-password-input" class="col-sm-5 col-form-label">Password</label></strong>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" name="password" id="horizontal-password-input" placeholder="Enter password here">

                                                @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-5 col-form-label">Confirm Password</label></strong>
                                            <div class="col-sm-12">
                                                <input type="password" class="form-control" name="confirm-password" id="horizontal-confirm-password-input" placeholder="Enter Confirm Password here">

                                                @if ($errors->has('confirm-password'))
                                                <span class="text-danger">{{ $errors->first('confirm-password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-12 col-form-label">Enter Alias Name </label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="alias_name" value="" id="alias_name" placeholder="Enter Alias Name  here">

                                                @if ($errors->has('alias_name'))
                                                <span class="text-danger">{{ $errors->first('alias_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-12 col-form-label">Enter Alias Email</label></strong>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="alias_email" value="" id="alias_email" placeholder="Enter Alias Email here">

                                                @if ($errors->has('alias_email'))
                                                <span class="text-danger">{{ $errors->first('alias_email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="row justify-content-end">
                                                        <div class="col-lg-12">
                                                            <input data-repeater-create type="button" class="btn btn-success inner" value="Add" />
                                                        </div>
                                                    </div><br />
                                                    <div class="row">
                                                        <div data-repeater-list="outergroup" class="outer">
                                                            <div class="outer">
                                                                <div class="inner-repeater mb-4">
                                                                    <div data-repeater-list="inner-group" class="inner form-group mb-0 row">
                                                                        <div data-repeater-item class="inner col-lg-12 ms-md-auto">
                                                                            <div  data-repeater-item  class="mb-3 row align-items-center">

                                                                                <div class="col-md-5">
                                                                                    <label for="name" class="form-label">Enter Key Name <span>(optional)</span></label>
                                                                                    <input type="text" class="drop-down inner form-control" name="name[]" placeholder="Enter Name (Optional)..." />
                                                                                </div>
                                                                                <div class="col-md-5">
                                                                                    <label for="value" class="form-label">Enter Key Value <span>(optional)</span></label>
                                                                                    <input type="text" class="inner form-control" name="value[]" placeholder="Enter Value (Optional)..." />
                                                                                </div>

                                                                                <div class="col-md-2">
                                                                                    <div class="mt-2 mt-md-0 d-grid">
                                                                                        <label for="delete_row" class="form-label">Delete Row</label>
                                                                                        <input data-repeater-delete type="button" class="btn btn-primary inner" value="Delete" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br />
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
                                    <div class="col-sm-12">
                                        <div class="card-body" style="margin-top: 2%">
                                            <strong><label for="sale_target" class="col-sm-12 col-form-label">Sale Target</label></strong>
                                            <input type="number" min="0" class="form-control" name="sale_target" id="sale_target" placeholder="Enter Sale Target here">
                                            @if ($errors->has('sale_target'))
                                            <span class="text-danger">{{ $errors->key('sale_target') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br />
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
@endsection
@push('customScripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });

    $(document).ready(function() {
        $(".repeater").repeater({
            show: function() {
                $(this).slideDown();
            },
            hide: function(e) {
                $(this).slideUp(e);
            },
            ready: function(e) {},
        });
    });
</script>

@endpush
