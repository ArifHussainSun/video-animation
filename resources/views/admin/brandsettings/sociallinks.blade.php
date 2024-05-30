@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW SOCIAL LINKS</h4>
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
