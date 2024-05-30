@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW CONTACT INFORMATION</h4>
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

        </div>

    </div>

@endsection

@push('customScripts')
   <script>
        $(document).ready(function () {
          $('.select2').select2();
       });

 </script>

@endpush
