@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW PAGE</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    {{-- <form action="{{route('page.store')}}" method="post" enctype="multipart/form-data"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-sm-8">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name here">
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <strong><label for="horizontal-title-input" class="col-sm-3 col-form-label">Title</label></strong>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="title" id="title" placeholder="Enter Title here">
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
                                            <input type="text" class="form-control" placeholder="Enter Slug here" name="url" id="url">
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('url'))
                                            <span class="text-danger">{{ $errors->first('url') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <strong><label for="headerm" class="col-sm-3 col-form-label"> Page Header</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control" placeholder="Enter header here" name="pages_header" id="pages_header"></textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('pages_header'))
                                            <span class="text-danger">{{ $errors->first('pages_header') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <strong><label for="content" class="col-sm-3 col-form-label">Page Content</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control content" name="pages_content" id="pages_content"></textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('pages_content'))
                                            <span class="text-danger">{{ $errors->first('pages_content') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-sm-12">
                                        <strong><label for="footer" class="col-sm-3 col-form-label">Page Footer</label></strong>
                                        <div class="col-sm-12">
                                            <textarea class="form-control footer" name="pages_footer" id="pages_footer"></textarea>
                                            <span class="validation-error text-danger d-none"></span>
                                            @if ($errors->has('pages_footer'))
                                            <span class="text-danger">{{ $errors->first('pages_footer') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4 mt-4">
                                <label for="image" class="control-label">Image</label>
                                <input type="file" class="form-control" name="image" id="image" style="">
                                <span class="validation-error text-danger d-none"></span>
                                <div class="invalid-feedback">
                                    Please upload icon image.
                                </div>

                                <div class="col-sm-12">
                                    <strong><label for="meta_title" class="col-sm-6 col-form-label">Meta Title</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="meta_title" id="meta_title" placeholder="Meta Title"></textarea>
                                        <span class="validation-error text-danger d-none"></span>
                                        @if ($errors->has('meta_title'))
                                        <span class="text-danger">{{ $errors->first('meta_title') }}</span>
                                        @endif
                                    </div>
                                    <br />
                                    <strong><label for="meta_content" class="col-sm-12 col-form-label">Meta Description</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="meta_description" id="meta_description" placeholder="Meta Description"></textarea>
                                        <span class="validation-error text-danger d-none"></span>
                                        @if ($errors->has('meta_description'))
                                        <span class="text-danger">{{ $errors->first('meta_description') }}</span>
                                        @endif
                                    </div>
                                    <br />
                                    <strong><label for="meta_keyword" class="col-sm-6 col-form-label">Meta Keyword</label></strong>
                                    <div class="col-sm-12">
                                        <textarea rows="4" class="form-control" name="meta_keyword" id="meta_keyword" placeholder="Meta Keywords"></textarea>
                                        <span class="validation-error text-danger d-none"></span>
                                        @if ($errors->has('metakeyword'))
                                        <span class="text-danger">{{ $errors->first('metakeyword') }}</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div><br />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary w-md save">SAVE</button>
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
        $(document).ready(function() {
            $('.select2').select2();
        });
    
        // var header = CKEDITOR.replace('header', {
        //     toolbarGroups: [{
        //             "name": "document",
        //             "groups": ["mode"]
        //         }
        //     ],
        //     // Remove the redundant buttons from toolbar groups defined above.
        //     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
        // });
    
        // CKEDITOR.replace('content', {
        //     height: '800px',
        //     toolbarGroups: [{
        //             "name": "basicstyles",
        //             "groups": ["basicstyles"]
        //         },
        //         {
        //             "name": "links",
        //             "groups": ["links"]
        //         },
        //         {
        //             "name": "paragraph",
        //             "groups": ["list", "blocks"]
        //         },
        //         {
        //             "name": "document",
        //             "groups": ["mode"]
        //         },
        //         {
        //             "name": "insert",
        //             "groups": ["insert"]
        //         },
        //         {
        //             "name": "styles",
        //             "groups": ["styles"]
        //         },
        //         {
        //             "name": "about",
        //             "groups": ["about"]
        //         }
        //     ],
        //     // Remove the redundant buttons from toolbar groups defined above.
        //     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
        // });
    
        // CKEDITOR.startupMode = 'source';
    
        // var footer = CKEDITOR.replace('footer', {
        //     toolbarGroups: [{
        //             "name": "document",
        //             "groups": ["mode"]
        //         }
        //     ],
        //     // Remove the redundant buttons from toolbar groups defined above.
        //     removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,PasteFromWord'
        // });
    
        // header.on('instanceReady', function() {
        //     this.setMode('source');
        // });
    
        // footer.on('instanceReady', function() {
        //     this.setMode('source');
        // });
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
   $(document).on('click','.save',function(){
       $('#pages_header').summernote('codeview.deactivate');
       $('#pages_footer').summernote('codeview.deactivate');
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
               url: route('page.store'),
               type: "post",
               data: {name:name,title:title,url:url,pages_header:pages_header, pages_content:pages_content,pages_footer:pages_footer,image:image,meta_title:meta_title,meta_description:meta_description,meta_keyword:meta_keyword,_token:_token},
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