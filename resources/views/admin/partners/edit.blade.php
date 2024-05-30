@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">EDIT PARTNER</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <form action="{{route('partner.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" name="id"  value="{{ !empty($partners->id) ? $partners->id : '' }}">
                                                <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here" value="{{ !empty($partners->name) ? $partners->name : '' }}">
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
                                                <textarea  class="form-control desc"  name="desc" id="desc">{{ !empty($partners->desc) ? $partners->desc : '' }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="col-sm-4">
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body" style="margin-top: 2%">
                                    <label for="image">Old Preview Image</label>
                                    <img  src="{{ (!empty($partners->image) ? asset($partners->image) : asset('backend/assets/images/default/no-image.jpg')) }}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />

                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">Icon image</label>
                                        <input type="file" class="form-control" name="image" id="image" style="">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
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
          $('#select2').select2();
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
