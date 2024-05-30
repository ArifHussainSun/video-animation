@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">UPDATE SUB CATEGORIES</h4>
                    @if( Session::has("success") && Session::has("message"))
                        <div class="alert alert-{{ (Session::get('success') == 'true' ? 'success' : 'danger') }} alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get("message") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                                <form action="{{route('sub-category.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                    <div class="col-sm-12">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Categories</label></strong>
                                        <input type="hidden" class="form-control" name="id" value="{{ !empty($subcategories->id ) ? $subcategories->id : '' }}" >
                                        <select class="form-control select2" name="categories_id" id="categories">
                                            <option value="" selected disabled>Select Categories</option>
                                            @forelse($categories as $category)
                                            <option value="{{ $category->id }}" {{ $subcategories->categories_id == $category->id ? "selected" : '' }}>{{ $category->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here" value="{{ !empty($subcategories->name ) ? $subcategories->name : '' }}">
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                        <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="title" id="horizontal-title-input" placeholder="Enter Title here" value="{{ !empty($subcategories->title ) ? $subcategories->title : '' }}">
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
                                                <textarea  class="form-control desc"  name="desc" id="summernote">{{ !empty($subcategories->desc ) ? $subcategories->desc : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div><br/>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body" style="margin-top: 2%">
                                        <div class="row">
                                        <div class="col-sm-12">
                                        <div class="col-sm-">
                                            <div class="card">
                                            <div class="card-body" style="margin-top: 2%">
                                                <label for="image">Old Preview Image</label>
                                                <img  src="{{ (!empty($subcategories->image) ? asset($subcategories->image) : asset('backend/assets/images/default/no-image.jpg')) }}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />
                                            </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <label for="image" class="control-label">Icon image</label>
                                            <input type="file" class="form-control" name="image" id="image" style="">
                                            <div class="invalid-feedback">
                                                Please upload icon image.
                                            </div>
                                        </div>
                                        </div>
                                </div>
                                </div>
                            </div>
                        </div><br/>
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
        $(document).ready(function () {
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
