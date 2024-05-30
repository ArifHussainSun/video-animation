@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">

                    @if (Session::has('success') && Session::has('message'))
                        <div class="alert alert-{{ Session::get('success') == 'true' ? 'success' : 'danger' }} alert-dismissible fade show"
                            role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get('message') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <h5>Add New Category:</h5>
                    <form action="{{route('categories.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
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
                                                <textarea  class="form-control description"  name="description" id="summernote"></textarea>
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
                                        <label for="image" class="control-label">Icon image</label>
                                        <input type="file" class="form-control" name="image" id="image" style="">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                        <div class="col-sm-12">
                                            <strong><label for="horizontal-metatitle-input" class="col-sm-6 col-form-label">Meta Title</label></strong>
                                            <div class="col-sm-12">
                                                <textarea rows="4" class="form-control" name="metatitle" id="horizontal-metatitle-input" placeholder="Meta Title"></textarea>
                                                @if ($errors->has('metatitle'))
                                                <span class="text-danger">{{ $errors->first('metatitle') }}</span>
                                                @endif
                                            </div>
                                            <br />
                                            <strong><label for="horizontal-metadesc-input" class="col-sm-6 col-form-label">Meta Description</label></strong>
                                            <div class="col-sm-12">
                                                <textarea rows="4" class="form-control" name="desc" id="desc" placeholder="Meta Description"></textarea>
                                                @if ($errors->has('desc'))
                                                <span class="text-danger">{{ $errors->first('desc') }}</span>
                                                @endif
                                            </div>
                                            <br />
                                            <strong><label for="horizontal-metakeyword-input" class="col-sm-6 col-form-label">Meta Keywords</label></strong>
                                            <div class="col-sm-12">
                                                <textarea rows="4" class="form-control" name="metakeyword" id="horizontal-metakeyword-input" placeholder="Meta Keywords"></textarea>
                                                @if ($errors->has('metakeyword'))
                                                <span class="text-danger">{{ $errors->first('metakeyword') }}</span>
                                                @endif
                                            </div>
                                        </div>

                                        </div>

                                    </div>

                                </div> -->
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
   <script>
       $(document).ready(function () {
          $('#select2').select2();

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
