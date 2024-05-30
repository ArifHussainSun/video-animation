@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW Brand Settings LOGOS</h4>
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
                            </div> {{dd(asset($logo->key_value))}}
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
        </div>
    </div>
@endsection

@push('customScripts')
 <script>
    $(document).ready(function(e) {


        $(document).on("change", '#logo', function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#logos').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on("change", '#favicon', function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#favicons').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

        $(document).on("change", '#logo_white', function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#logo_white_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

    });
 </script>

@endpush
