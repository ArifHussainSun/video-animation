@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Add New Custom Header & Footer</h4>
                    @if( Session::has("success") )
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get("success") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
                    @if( Session::has("error") )
                        <div class="alert alert-danger alert-block" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {{ Session::get("error") }}
                        </div>
                    @endif
                    {{-- <form action="{{route('admin-brand-settings.custom-header-footer-save')}}" method="post" enctype="multipart/form-data"> --}}
                        @csrf
                        <div class="row">
                            <h5> Custom Header</h5>
                            <div class="col-sm-12">
                                    @if(!empty($customheader->key_value))
                                        <textarea class="form-control customheader" name="customheader" id="customheader" placeholder="Enter Custom Header Here">{{$customheader->key_value}}</textarea>
                                    @else
                                        <textarea class="form-control customheader" name="customheader" id="customheader" placeholder="Enter Custom Header Here"></textarea>
                                    @endif
                                    <span class="validation-error text-danger d-none"></span>
                                    @if ($errors->has('customheader'))
                                        <span class="text-danger">{{ $errors->first('customheader') }}</span>
                                    @endif
                            </div>
                        </div>
                        <br />
                        <div class="row">
                            <h5> Custom Footer</h5>
                            <div class="col-sm-12">
                                    @if(!empty($customfooter->key_value))
                                        <textarea class="form-control customfooter" name="customfooter" id="customfooter" placeholder="Enter Custom Header Here">{{$customfooter->key_value}}</textarea>
                                    @else
                                        <textarea class="form-control customfooter" name="customfooter" id="customfooter" placeholder="Enter Custom Header Here"></textarea>
                                    @endif
                                    <span class="validation-error text-danger d-none"></span>
                                    @if ($errors->has('customfooter'))
                                        <span class="text-danger">{{ $errors->first('customfooter') }}</span>
                                    @endif
                            </div>
                        </div>
                            <br /><br />
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
        $('#customheader').on('summernote.init', function() {
            $('#customheader').summernote('codeview.activate');
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
        // $('#customfooter').summernote({
        //   height: 250,
        //   toolbar: [
        //     ['view', ['codeview']]
        //   ]
        // });
        // $('#customfooter').summernote('codeview.toggle');

           $('#customfooter').on('summernote.init', function() {
               $('#customfooter').summernote('codeview.activate');
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
           $('#customheader').summernote('codeview.deactivate');
           $('#customfooter').summernote('codeview.deactivate');
           var customheader = $('#customheader').val().replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/\." /g, "\.\"").replace(/="{{ " /g, '="{{ "').replace(/"="" \}\}"=""/g, '" \}\}"').replace(/-="">/g, '->').replace(/&amp;/g, "&");
           var customfooter = $('#customfooter').val().replace(/&gt;/g, ">").replace(/&lt;/g, "<").replace(/\." /g, "\.\"").replace(/="{{ " /g, '="{{ "').replace(/"="" \}\}"=""/g, '" \}\}"').replace(/-="">/g, '->').replace(/&amp;/g, "&");
           
           $.ajax({
                   url: route('admin-brand-settings.custom-header-footer-save'),
                   type: "post",
                   data: {customheader:customheader, customfooter:customfooter,_token:_token},
                   success: function (data) {
                             window.location.href = data.route;
                   },
                   error: function (err) {
                       $('#customheader').summernote('codeview.activate');
                       $('#customfooter').summernote('codeview.activate');
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
