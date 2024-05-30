@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD NEW SERVICE</h4>
                @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                @endif
                <form action="{{ route('service.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Service</label></strong>
                                            <div class="col-sm-12">

                                                <input type="hidden" class="form-control" name="id" value="{{ !empty($service->id) ? $service->id : ''}}">

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="name" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="name" id="name" value="{{$service->name}}" placeholder="Enter Name here">
                                                @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" name="title" id="horizontal-title-input" value="{{$service->title}}" placeholder="Enter Title here">
                                                @if ($errors->has('title'))
                                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="description" class="col-sm-3 col-form-label">Description</label></strong>
                                            <div class="col-sm-12">
                                                <textarea class="form-control desc" name="description" id="desc">{{$service->description}}</textarea>
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
                                        <label for="image" class="control-label">Image</label>
                                        <img src="{{asset(!empty($service->image) ? $service->image : asset('backend/assets/images/default/no-image.jpg') )}}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">Image</label>
                                        <input type="file" class="form-control" name="image" id="image">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <strong><label for="horizontal-metatitle-input" class="col-sm-6 col-form-label">Meta Title</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="metatitle" id="horizontal-metatitle-input">{{$service->metatitle}}</textarea>

                                        </div>
                                        <br />
                                        <strong><label for="horizontal-metadesc-input" class="col-sm-6 col-form-label">Meta Description</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="metadesc" id="horizontal-metadesc-input" placeholder="Meta Description">{{$service->metadesc}}</textarea>
                                            @if ($errors->has('metadesc'))
                                            <span class="text-danger">{{ $errors->first('metadesc') }}</span>
                                            @endif
                                        </div>
                                        <br />
                                        <strong><label for="horizontal-metakeyword-input" class="col-sm-6 col-form-label">Meta Keywords</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="metakeyword" id="horizontal-metakeyword-input" placeholder="Meta Keywords">{{$service->metakeyword}}</textarea>
                                            @if ($errors->has('metakeyword'))
                                            <span class="text-danger">{{ $errors->first('metakeyword') }}</span>
                                            @endif
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
                                <button type="submit" class="btn btn-primary w-md">SAVE</button>
                            </div>
                        </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection
@push('customScripts')
<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
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
