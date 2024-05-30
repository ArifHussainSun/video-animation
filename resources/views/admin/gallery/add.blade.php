@extends('admin.layouts.main')
@section('container')

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD NEW GALLERY</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                <form action="{{ route('gallery.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    @can('Gallery-Create')
                                    <a href="{{route('gallery.add')}}" class="btn btn-xs btn-success float-right add">Add Gallery</a>
                                    @endcan
                                    @can('Gallery-View')
                                    <a href="{{route('gallery.list')}}" class="btn btn-xs btn-primary float-right add">All Gallery</a>
                                    @endcan
                                    @can('Gallery-Delete')
                                    <a href="{{route('gallery.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                                    @endcan
                                    <div class="row">

                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-desc-input" class="col-sm-3 col-form-label">Description</label></strong>
                                            <div class="col-sm-12">
                                                <textarea class="form-control desc" name="desc" id="desc"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div><br />
                        <div class="col-sm-4">
                            <div class="card">
                                <div class="card-body" style="margin-top: 2%">
                                    <label for="image" class="control-label">Icon image</label>
                                    <input type="file" class="form-control" name="image" id="image">
                                    <div class="invalid-feedback">
                                        Please upload icon image.
                                    </div>
                                </div>
                            </div>

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
