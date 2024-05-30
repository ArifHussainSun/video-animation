@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">EDIT TESTIMONIAL</h4>
                @if( Session::has("success") )
                <div class="alert alert-success alert-block" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{ Session::get("success") }}
                </div>
                @endif
                @if( Session::has("error") )
                <div class="alert alert-danger alert-block" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{ Session::get("error") }}
                </div>
                @endif
                <form action="{{route('testimonial.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    @can('Testimonial-Create')
                                    <a href="{{route('testimonial.add')}}" class="btn btn-xs btn-success float-right add">Add Gallery</a>
                                    @endcan
                                    @can('Testimonial-View')
                                    <a href="{{route('testimonial.list')}}" class="btn btn-xs btn-primary float-right add">ALL Gallery</a>
                                    @endcan
                                    @can('Testimonial-Delete')
                                    <a href="{{route('testimonial.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                                    @endcan
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" name="id" value="{{ !empty($testimonial->id) ? $testimonial->id : ''}}">
                                                <input type="text" class="form-control" name="name" id="horizontal-name-input" value="{{ !empty($testimonial->name) ? $testimonial->name : ''}}" placeholder="Enter Name here">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-designation-input" class="col-sm-6 col-form-label">Designation</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="designation" id="horizontal-designation-input" value="{{ !empty($testimonial->designation) ? $testimonial->designation : ''}}" placeholder="Enter designation here">
                                                @if ($errors->has('designation'))
                                                <span class="text-danger">{{ $errors->first('designation') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-company-input" class="col-sm-3 col-form-label">Company</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Enter Company here" name="company" value="{{ !empty($testimonial->company) ? $testimonial->company : ''}}" id="horizontal-company-input">
                                                @if ($errors->has('company'))
                                                <span class="text-danger">{{ $errors->first('company') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-rating-input" class="col-sm-3 col-form-label">Rating</label></strong>
                                            <div class="col-sm-12">
                                                <select name="rating" class="form-control" required>

                                                <option @if($testimonial) {{ 'selected' }} @endif value="{{$testimonial->rating}}">{{$testimonial->rating}}</option>
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
                                            <strong><label for="horizontal-desc-input" class="col-sm-3 col-form-label">Description</label></strong>
                                            <div class="col-sm-12">
                                                <textarea class="form-control desc" name="desc" id="summernote"> {{ !empty($testimonial->desc) ? $testimonial->desc : ''}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="col-sm-4">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body" style="margin-top: 2%">
                                        <label for="image">Old Preview Image</label>
                                        <img src="{{ (!empty($testimonial->image) ? asset($testimonial->image) : asset('backend/assets/images/default/no-image.jpg')) }}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="image" style="">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br />
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
