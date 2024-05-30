@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW EMAIL TEMPLATE</h4>
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-block" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            {{ Session::get('error') }}
                        </div>
                    @endif
                    <form action="{{ route('mailtemplate.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-sm-12 mb-2">

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="Content"
                                                        class="col-sm-3 col-form-label">Content</label></strong>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" placeholder="Enter Content here" name="content" id="content"></textarea>
                                                    @if ($errors->has('content'))
                                                        <span class="text-danger">{{ $errors->first('content') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div><br />
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

        CKEDITOR.replace('content');


    </script>
@endpush
