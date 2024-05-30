@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">EDIT PAGE</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    {{-- <form action="{{route('page.update')}}" method="post" enctype="multipart/form-data"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="card">
                                    <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                            <div class="col-sm-12">
                                                <input type="hidden" class="form-control" name="id" id="id" value="{{ !empty($pages->id) ? $pages->id : ''}}">
                                                <input type="text" class="form-control name" name="name" id="name" placeholder="Enter Name here" value="{{ !empty($pages->name) ? $pages->name : ''}}">
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control title" name="title" id="title" placeholder="Enter Title here" value="{{ !empty($pages->title) ? $pages->title : ''}}">
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('title'))
                                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <strong><label for="url" class="col-sm-3 col-form-label">Url</label></strong>
                                            <div class="col-sm-12">
                                                <input type="text" class="form-control" placeholder="Enter Url here" name="url" id="url" value="{{ !empty($pages->url) ? $pages->url : ''}}">
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('url'))
                                                    <span class="text-danger">{{ $errors->first('url') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                        <strong><label for="headerm" class="col-sm-3 col-form-label"> Page Header</label></strong>
                                            <div class="col-sm-12">
                                                <textarea  class="form-control" placeholder="Enter header here" name="pages_header" id="pages_header">{{ !empty($pages->pages_header) ? $pages->pages_header : ''}}</textarea>
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('pages_header'))
                                                    <span class="text-danger">{{ $errors->first('pages_header') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="content" class="col-sm-3 col-form-label">Page Content</label></strong>
                                            <div class="col-sm-12">
                                                <textarea  class="form-control content"  name="pages_content" id="pages_content">{{ !empty($pages->pages_content) ? $pages->pages_content : ''}}</textarea>
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('pages_content'))
                                                    <span class="text-danger">{{ $errors->first('pages_content') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <strong><label for="footer" class="col-sm-3 col-form-label">Page Footer</label></strong>
                                            <div class="col-sm-12">
                                                <textarea  class="form-control footer"  name="pages_footer" id="pages_footer">{{ !empty($pages->pages_footer) ? $pages->pages_footer : ''}}</textarea>
                                                <span class="validation-error text-danger d-none"></span>
                                                @if ($errors->has('pages_footer'))
                                                    <span class="text-danger">{{ $errors->first('pages_footer') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </div>
                        </div><br/>
                        <div class="col-sm-4">
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body" style="margin-top: 2%">
                                    <label for="image">Old Preview Image</label>
                                    <img  src="{{ (!empty($pages->image) ? asset($pages->image) : asset('backend/assets/img/users/no-image.jpg')) }}" id="edi_image" class="form-control input-sm" width="180px;" height="120" />

                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                <div class="card-body" style="margin-top: 2%">
                                        <label for="image" class="control-label">Image</label>
                                        <input type="file" class="form-control" id="image" name="image" id="image" style="">
                                        <span class="validation-error text-danger d-none"></span>
                                        <div class="invalid-feedback">
                                            Please upload icon image.
                                        </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <strong><label for="meta_title" class="col-sm-6 col-form-label">Meta Title</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="meta_title" id="meta_title"  placeholder="Meta Title"> {{ !empty($pages->meta_title) ? $pages->meta_title : ''}}</textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('meta_title'))
                                                <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                            @endif
                                        </div>
                                        <br/>
                                        <strong><label for="meta_content" class="col-sm-12 col-form-label">Meta Description</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description">{{ !empty($pages->meta_description) ? $pages->meta_description : ''}}</textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('meta_description'))
                                                <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                            @endif
                                        </div>
                                        <br/>
                                        <strong><label for="meta_keyword" class="col-sm-6 col-form-label">Meta Keyword</label></strong>
                                        <div class="col-sm-12">
                                            <textarea rows="4" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Keywords">{{ !empty($pages->meta_keyword) ? $pages->meta_keyword : ''}}</textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('metakeyword'))
                                                <span class="text-danger">{{ $errors->first('metakeyword') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary w-md update">Update</button>
                                </div>
                            </div>
                        </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
    </div>

@endsection
@push('customScripts')

   <script>
        $(document).ready(function () {
          $('.select2').select2();
       });

    //    CKEDITOR.replace('pages_header');
    //    CKEDITOR.replace('content',
    //    {
    //     height: '800px',
    //    } );
    //    CKEDITOR.replace('footer');
 </script>

<script>

        $('#pages_header').on('summernote.init', function() {
            $('#pages_header').summernote('codeview.activate');
        }).summernote({
            height: 300,
            placeholder: 'Enter code here...',
            tabsize: 2,
            codemirror: {
                theme: 'monokai'
            },
            toolbar: [
                ['view', ['codeview']]
            ]
        });
   
</script>

<script>
        $('#pages_content').summernote({
           placeholder: 'Enter Content here',
           tabsize: 2,
           height: 550,
           toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['height', ['height']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['codeview', 'undo', 'redo', 'help']]
           ]
         });
</script>
<script>
   
        $('#pages_footer').on('summernote.init', function() {
            $('#pages_footer').summernote('codeview.activate');
        }).summernote({
            height: 300,
            placeholder: 'Enter code here...',
            tabsize: 2,
            codemirror: {
                theme: 'monokai'
            },
            toolbar: [
                ['view', ['codeview']]
            ]
        });
   
</script>
<script>
     var _token = $('input[name="_token"]').val();
    $(document).on('click','.update',function(){
        $('#pages_header').summernote('codeview.deactivate');
        $('#pages_footer').summernote('codeview.deactivate');
        var id = $('#id').val();
        var pages_header = $('#pages_header').val().replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/\." /g, "\.\"").replace(/="{{ " /g, '="{{ "').replace(/"="" \}\}"=""/g, '" \}\}"').replace(/-="">/g, '->').replace(/&amp;/g, "&");
        var pages_content = $('#pages_content').val().replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/\." /g, "\.\"").replace(/="{{ " /g, '="{{ "').replace(/"="" \}\}"=""/g, '" \}\}"').replace(/-="">/g, '->').replace(/&amp;/g, "&");
        var pages_footer = $('#pages_footer').val().replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/\." /g, "\.\"").replace(/="{{ " /g, '="{{ "').replace(/"="" \}\}"=""/g, '" \}\}"').replace(/-="">/g, '->').replace(/&amp;/g, "&");
        var image = $('#image').val();
        var meta_title = $('#meta_title').val();
        var meta_description = $('#meta_description').val();
        var meta_keyword = $('#meta_keyword').val();
        var name = $('#name').val();
        var title = $('#title').val();
        var url = $('#url').val();
        
        $.ajax({
                url: route('page.update'),
                type: "post",
                data: {id:id, name:name,title:title,url:url,pages_header:pages_header, pages_content:pages_content,pages_footer:pages_footer,image:image,meta_title:meta_title,meta_description:meta_description,meta_keyword:meta_keyword,_token:_token},
                success: function (data) {
                          window.location.href = data.route;
                },
                error: function (err) {
                    $('#pages_header').summernote('codeview.activate');
                    $('#pages_footer').summernote('codeview.activate');
	                $('.validation-error').html('');
                    $.each(err.responseJSON.errors, function (key, value) {
                     $("#" + key).next().html(value[0]);
                     $("#" + key).next().removeClass('d-none');
                   
                  });
                },
                
            });

    });

</script>


@endpush
