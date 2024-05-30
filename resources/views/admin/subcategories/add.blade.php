@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW SUB CATEGORY</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{route('sub-category.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Categories</label></strong>
                                        <select class="form-control select2" name="categories_id" id="categories">
                                            <option value="" selected disabled>Select Categories</option>
                                            @forelse($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here">
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title" id="horizontal-title-input" placeholder="Enter Title here">
                                            @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-desc-input" class="col-sm-3 col-form-label">Description</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control desc" name="desc" id="summernote"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 mt-2">
                                <label for="image" class="control-label">Icon image</label>
                                <input type="file" class="form-control" name="image" id="image" style="">
                                <div class="invalid-feedback">
                                    Please upload icon image.
                                </div>
                            </div>
                        </div>
                        <br/>
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
<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();

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
    });

</script>
@endpush
