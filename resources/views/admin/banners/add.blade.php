@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW BANNER</h4>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    <form action="{{ route('banner.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong><label for="horizontal-name-input"
                                                        class="col-sm-12 col-form-label">Heading One</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="heading_one"
                                                        id="horizontal-heading_one-input"
                                                        placeholder="Enter Heading One here">
                                                    @if ($errors->has('heading_one'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('heading_one') }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <strong><label for="horizontal-heading_two-input"
                                                        class="col-sm-12 col-form-label">Heading Two</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="heading_two"
                                                        id="horizontal-heading_two-input"
                                                        placeholder="Enter Heading Two here">
                                                    @if ($errors->has('heading_two'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('heading_two') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-short_description-input"
                                                        class="col-sm-3 col-form-label">Description</label></strong>
                                                <div class="col-sm-12">
                                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter Description here" name="description"
                                                        id="desc"></textarea>
                                                    @if ($errors->has('description'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('description') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong><label for="horizontal-name-input"
                                                        class="col-sm-3 col-form-label">Button Title</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="btn_title"
                                                        id="horizontal-btn_title-input"
                                                        placeholder="Enter Button Title here">
                                                    @if ($errors->has('btn_title'))
                                                        <span class="text-danger">{{ $errors->first('btn_title') }}</span>
                                                    @endif

                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <strong><label for="horizontal-heading_two-input"
                                                        class="col-sm-3 col-form-label">Button Link</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" name="btn_link"
                                                        id="horizontal-btn_link-input" placeholder="Enter Button Link here">
                                                    @if ($errors->has('btn_link'))
                                                        <span class="text-danger">{{ $errors->first('btn_link') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="horizontal-name-input"
                                                        class="col-sm-3 col-form-label">Pages</label></strong>
                                                <select class="form-control select2" name="page" id="page">
                                                    <option value="" selected disabled>Select Page </option>
                                                    @foreach ($pages as $page)
                                                        <option value="{{ $page->name }}">{{ $page->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="card">
                                    <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">Icon image</label>
                                        <input type="file" class="form-control" name="image" id="image"
                                            style="">
                                        <div class="invalid-feedback">
                                            Please upload icon image.
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
