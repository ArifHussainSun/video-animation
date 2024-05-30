@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">EDIT USER</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                @if(Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session::get('error') }}
                    @php
                    Session::forget('error');
                    @endphp
                </div>
                @endif
                <form action="{{route('user.update')}}" class="repeater" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Roles</label></strong>
                                            <input type="hidden" class="form-control" name="id" value="{{ !empty($editUser->id) ? $editUser->id : ''}}">
                                            <select class="form-control select2" name="roles" id="roles">
                                                <option value="" selected disabled>Select Roles</option>
                                                @if(!empty($roles))
                                                    @forelse($roles as $role)
                                                         <option value="{{ $role->id }}" {{ ( in_array($role->name, $editUser->getRoleNames()->toArray()) ? "selected" : "" ) }}>{{ $role->name }}</option>
                                                        @empty
                                                    @endforelse
                                                @endif
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
                                                <input type="text" class="form-control" name="first_name" id="horizontal-first_name-input" value="{{ !empty($editUser->first_name) ? $editUser->first_name : ''}}" placeholder="Enter First Name here">
                                                @if ($errors->has('first_name'))
                                                <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-last_name-input" class="col-sm-3 col-form-label">Last Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="last_name" value="{{ !empty($editUser->last_name) ? $editUser->last_name : ''}}" id="horizontal-last_name-input" placeholder="Enter Last Name here">
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
                                                <input type="email" class="form-control" placeholder="Enter Email here" name="email" value="{{ !empty($editUser->email) ? $editUser->email : ''}}" id="horizontal-email-input">
                                                @if ($errors->has('email'))
                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-phone-input" class="col-sm-5 col-form-label">Phone Number</label></strong>
                                            <div class="col-sm-12">
                                                <input class="form-control phone" name="phone_number" id="phone_number" value="{{ !empty($editUser->phone_number) ? $editUser->phone_number : ''}}" placeholder="Enter Phone Number here">
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
                                                <input type="text" class="form-control" name="company_name" id="horizontal-company-input" value="{{ !empty($editUser->company_name) ? $editUser->company_name : ''}}" placeholder="Enter Company Name here">

                                                @if ($errors->has('company_name'))
                                                <span class="text-danger">{{ $errors->first('company_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-address-input" class="col-sm-5 col-form-label">Address</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="address" id="horizontal-address-input" value="{{ !empty($editUser->address) ? $editUser->address : ''}}" placeholder="Enter Address here">

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
                                                <input type="text" class="form-control" name="city" id="horizontal-city-input" value="{{ !empty($editUser->city) ? $editUser->city : ''}}" placeholder="Enter City here">

                                                @if ($errors->has('city'))
                                                <span class="text-danger">{{ $errors->first('city') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-state-input" class="col-sm-5 col-form-label">State</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="state" id="horizontal-state-input" value="{{ !empty($editUser->state) ? $editUser->state : ''}}" placeholder="Enter State here">

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
                                                <input type="text" class="form-control" name="zipcode" id="horizontal-zipcode-input" value="{{ !empty($editUser->zipcode) ? $editUser->zipcode : ''}}" placeholder="Enter Zip Code here">

                                                @if ($errors->has('zipcode'))
                                                <span class="text-danger">{{ $errors->first('zipcode') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-country-input" class="col-sm-5 col-form-label">Country</label></strong>
                                            <div class="col-sm-12">
                                                <select class="form-control select2" name="country" id="country">
                                                    <option value="" Selected disabled>Select Country</option>
                                                    @forelse($countries as $contry)
                                                    <option value="{{ $contry->id }}" {{ $editUser->country  == $contry->id ? 'selected' : ''}}>{{ $contry->country_name }}</option>
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
                                        {{-- <div class="col-sm-12">
                                            <strong><label for="horizontal-password-input" class="col-sm-5 col-form-label">Current Password</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="current_password" value="" id="current_password" placeholder="Enter Current  Password here">

                                                @if ($errors->has('current_password'))
                                                <span class="text-danger">{{ $errors->first('current_password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-5 col-form-label">New Password</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="new_password" value="" id="new_password" placeholder="Enter New Password here">

                                                @if ($errors->has('new_password'))
                                                <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-12 col-form-label">New Confirm Password</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="new_confirm_password" value="" id="new_confirm_password" placeholder="Enter New Confirm Password here">

                                                @if ($errors->has('new_confirm_password'))
                                                <span class="text-danger">{{ $errors->first('new_confirm_password') }}</span>
                                                @endif
                                            </div>
                                        </div> --}}
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-12 col-form-label">Enter Alias Name </label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="alias_name" value="{{ (!empty($alias_name->key_value) ? $alias_name->key_value : '') }}" id="alias_name" placeholder="Enter Alias Name  here">

                                                @if ($errors->has('alias_name'))
                                                <span class="text-danger">{{ $errors->first('alias_name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-confirm-password-input" class="col-sm-12 col-form-label">Enter Alias Email</label></strong>
                                            <div class="col-sm-12">
                                                <input type="email" class="form-control" name="alias_email" value="{{ (!empty($alias_email->key_value) ? $alias_email->key_value : '') }}" id="alias_email" placeholder="Enter Alias Email here">

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
                                                         @if(!empty($user_additional_records->key_value))
                                                           <input data-repeater-create type="button" class="btn btn-success inner" value="Add" />
                                                         @endif
                                                        </div>
                                                    </div><br />
                                                    <div class="row">
                                                        <div data-repeater-list="outergroup" class="outer">
                                                            <div  class="outer">
                                                                <div class="inner-repeater mb-4">
                                                                    <div data-repeater-list="inner-group" class="inner form-group mb-0 row">
                                                                    @if(!empty($user_additional_records->key_value))
                                                                        @php
                                                                         $user_additional = json_decode($user_additional_records->key_value);
                                                                        @endphp
                                                                        @if(!empty($user_additional))
                                                                          @forelse($user_additional as $user_add)
                                                                            <div  class="inner col-lg-12 ms-md-auto">
                                                                                <div data-repeater-item  class="mb-3 row align-items-center">
                                                                                    <div class="col-md-5">
                                                                                        <label for="name"    class="form-label">Enter Key Name <span>(optional)</span></label>
                                                                                        <input type="text" class="drop-down inner form-control" value="{{ !empty($user_add->name) ? $user_add->name : ''}}" name="name" placeholder="Enter Name (Optional)..." />
                                                                                    </div>
                                                                                    <div class="col-md-5">
                                                                                        <label for="value" class="form-label">Enter Key Value <span>(optional)</span></label>
                                                                                        <input type="text" class="inner form-control" name="value" value="{{ !empty($user_add->value) ? $user_add->value : ''}}" placeholder="Enter Value (Optional)..." />
                                                                                    </div>

                                                                                    <div class="col-md-2">
                                                                                        <div class="mt-2 mt-md-0 d-grid">
                                                                                            <label for="delete_row" class="form-label">Delete Row</label>
                                                                                            <input data-repeater-delete type="button" class="btn btn-primary inner" value="Delete" />
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @empty
                                                                          @endforelse
                                                                         @else
                                                                         <div class="col-sm-12">
                                                                            <div class="row">
                                                                                <div data-repeater-list="outergroup" class="outer">
                                                                                    <div data-repeater-item class="outer">
                                                                                        <div class="inner-repeater mb-4">
                                                                                            <div data-repeater-list="inner-group" class="inner form-group mb-0 row">
                                                                                                <!-- <label class="col-form-label col-lg-2">Add Team Member</label> -->
                                                                                                <div data-repeater-item class="inner col-lg-12 ms-md-auto">
                                                                                                    <div class="mb-3 row align-items-center">

                                                                                                        <div class="col-md-5">
                                                                                                            <label for="name" class="form-label">Enter Key Name <span>(optional)</span></label>
                                                                                                            <input type="text" class="drop-down inner form-control" name="name" placeholder="Enter Name (Optional)..." />
                                                                                                        </div>
                                                                                                        <div class="col-md-5">
                                                                                                            <label for="value" class="form-label">Enter Key Value <span>(optional)</span></label>
                                                                                                            <input type="text" class="inner form-control" name="value" placeholder="Enter Value (Optional)..." />
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
                                                                        @endif
                                                                        @endif
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
                                            <label for="image" class="control-label">Old Preview Icon image</label>
                                            <img src="{{ (!empty($editUser->image) ? asset($editUser->image) : asset('backend/assets/images/default/no-image.jpg')) }}"  class="form-control input-sm" width="180px;" height="120" />

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
                                    <div class="col-sm-12">
                                        <div class="card-body" style="margin-top: 2%">
                                            <strong><label for="sale_target" class="col-sm-12 col-form-label">Sale Target</label></strong>
                                            <input type="number" min="0" class="form-control" value="{{ (!empty($editUser->user_target) ? $editUser->user_target : '') }}" name="sale_target" id="sale_target" placeholder="Enter Sale Target here">
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
    $(document).ready(function() {
        console.log("here");
        $(".repeater").repeater({
            show: function() {
                $(this).slideDown();
            },
            hide: function(e) {
                confirm("Are you sure you want to delete?") && $(this).slideUp(e);
            },
            ready: function(e) {},
        });
    });
</script>

@endpush
