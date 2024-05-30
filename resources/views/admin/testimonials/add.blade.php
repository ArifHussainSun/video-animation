@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW TESTIMONIAL</h4>
                    @if (Session::has('success'))
                        <div class="alert alert-success alert-block" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    @if (Session::has('error'))
                        <div class="alert alert-danger alert-block" role="alert">
                            <button class="close" data-dismiss="alert"></button>
                            {{ Session::get('error') }}
                        </div>
                    @endif

                    <form action="{{ route('testimonial.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input"
                                                class="col-sm-3 col-form-label">Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name"
                                                id="horizontal-name-input" placeholder="Enter Name here">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-designation-input"
                                                class="col-sm-6 col-form-label">Designation</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="designation"
                                                id="horizontal-designation-input" placeholder="Enter designation here">
                                            @if ($errors->has('designation'))
                                                <span class="text-danger">{{ $errors->first('designation') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-company-input"
                                                class="col-sm-3 col-form-label">Company</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" placeholder="Enter Company here"
                                                name="company" id="horizontal-company-input">
                                            @if ($errors->has('company'))
                                                <span class="text-danger">{{ $errors->first('company') }}</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-rating-input"
                                                class="col-sm-3 col-form-label">Rating</label></strong>
                                        <div class="col-sm-12">
                                            <select name="rating" class="form-control" required>
                                                <option selected disabled>Select Rating</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>

                                            @if ($errors->has('rating'))
                                                <span class="text-danger">{{ $errors->first('rating') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-desc-input"
                                                class="col-sm-3 col-form-label">Description</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control desc" name="desc" id="summernote"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="image" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-12">
                                <div class="col-sm-12">
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
    $('#summernote').summernote({
        placeholder: 'Enter Description here',
        tabsize: 2,
        height: 250,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
        ]
    });
</script>

@endpush
