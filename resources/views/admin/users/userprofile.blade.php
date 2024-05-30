@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4"> USERS PROFILE</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                        <p><strong>Opps Something went wrong</strong></p>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        </div>
                    @endif
                    @if(session('error'))
                    <div class="alert alert-danger">{{session('error')}}</div>
                    @endif
                    <form action="{{route('admin-user.profile-update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Roles</label></strong>

                                        <select class="form-control select2" name="roles" id="roles">
                                            <option value="" selected disabled>Select Roles</option>
                                            @if(!empty($user->getRoleNames()))
                                            @foreach($user->getRoleNames() as $role)
                                            <option value="{{$role}}" selected disabled>{{ $role }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-first_name-input" class="col-sm-3 col-form-label">First Name</label></strong>
                                        <div class="col-sm-12">
                                            @if(!empty(auth()->user()->id || auth()->user()->first_name))
                                            <input type="hidden" class="form-control" name="id" value="{{ auth()->user()->id }}">
                                            <input type="text" class="form-control" name="first_name" value="{{ auth()->user()->first_name }}" id="horizontal-first_name-input" placeholder="Enter First Name here">
                                            @if ($errors->has('first_name'))
                                            <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                            @endif
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-last_name-input" class="col-sm-3 col-form-label">Last Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="last_name" value="{{ auth()->user()->last_name }}" id="horizontal-last_name-input" placeholder="Enter Last Name here">
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
                                            <input type="email" class="form-control" placeholder="Enter Email here" value="{{ auth()->user()->email }}" name="email" id="horizontal-email-input">
                                            @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-phone-input" class="col-sm-3 col-form-label">Phone</label></strong>
                                        <div class="col-sm-12">
                                            <input class="form-control phone" name="phone" id="phone" value="{{ auth()->user()->phone }}" placeholder="Enter Phone Number here">
                                            @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-state-input" class="col-sm-5 col-form-label">State</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="state" id="horizontal-state-input" value="{{ auth()->user()->state }}" placeholder="Enter State here">

                                            @if ($errors->has('state'))
                                            <span class="text-danger">{{ $errors->first('state') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-address-input" class="col-sm-5 col-form-label">Address</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="address" id="horizontal-address-input" value="{{ auth()->user()->address }}" placeholder="Enter Address here">

                                            @if ($errors->has('address'))
                                            <span class="text-danger">{{ $errors->first('address') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
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
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4">
                                <label for="image" class="control-label">User Icon image</label>
                                <input type="file" class="form-control" name="image" id="image">
                                <div class="invalid-feedback">
                                    Please upload icon image.
                                </div>

                                <label for="image" class="control-label mt-5">User Icon image</label>
                                <img src="{{ (!empty(auth()->user()->image) ? asset(auth()->user()->image) : asset('backend/assets/images/default/no-image.jpg')) }}" class="form-control input-sm" width="180px;" height="120" />
                            </div>
                        </div><br/><br/>
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
