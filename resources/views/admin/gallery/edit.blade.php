@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD UPDATED GALLERY</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                <form action="{{route('gallery.update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <h3>
                            @can('Gallery-Create')
                            <a href="{{route('gallery.add')}}" class="btn btn-xs btn-success float-right add">Add Gallert</a>
                            @endcan
                            @can('Gallery-View')
                            <a href="{{route('gallery.list')}}" class="btn btn-xs btn-primary float-right add">All Gallery</a>
                            @endcan
                            @can('Gallery-Delete')
                            <a href="{{route('gallery.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                            @endcan
                        </h3>
                        <div class="col-9">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label"> Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ !empty($gallery->id) ? $gallery->id  : '' }}">
                                    <input type="text" class="form-control" name="name" id="horizontal-name-input" value="{{ !empty($gallery->name) ? $gallery->name  : '' }}" placeholder="Enter First Name here">
                                    @if ($errors->has('name'))
                                    <span class="text-danger">{{ $errors->name('name') }}</span>
                                    @endif

                                </div>
                            </div>
                            <br /><br />
                            <div class="col-sm-12">
                                        <div class="mb-3">
                                            <label for="desc" class="form-label">Description</label>
                                            <textarea rows="4" class="form-control" name="desc" id="desc"
                                                placeholder="Description here" value="{{$gallery->desc ?? ''}}"
                                                required>{{$gallery->desc ?? ''}}</textarea>
                                            <div class="invalid-feedback">
                                                Please enter valid Description.
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label for="image" class="form-label">Image</label>
                                                <input type="file" class="form-control" id="image" name="image" />
                                                <div class="invalid-feedback">
                                                    Please upload valid image
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="mb-3">
                                                <label class="form-label">Current Image</label>
                                                <img  src="{{ (!empty($gallery->image) ? asset($gallery->image) : asset('backend/assets/images/default/no-image.jpg')) }}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


            </div><br /><br />
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
</div>

@endsection
@push('customScripts')
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script>
    $(document).ready(function() {
    $('#desc').summernote({
      placeholder: 'Enter Description Here',
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
