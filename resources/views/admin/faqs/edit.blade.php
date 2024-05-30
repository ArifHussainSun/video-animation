@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">EDIT FAQS</h4>
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
                    <form action="{{ route('faq.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-4">
                                <strong><label for="horizontal-page-input" class="col-sm-3 col-form-label">Page</label></strong>
                                <input type="hidden" class="form-control" name="id" value="{{!empty($faq->id) ? $faq->id : '' }}">
                                <select class="form-control select2" name="page" id="page">
                                    <option value="" selected disabled>Select Page</option>
                                    @forelse($pages as $page)
                                        <option value="{{ $page->name }}" {{ $faq->page == $page->name ? 'selected' : ''}} >{{ $page->name }}</option>
                                        @empty
                                    @endforelse
                                </select>
                                @if ($errors->has('page'))
                                    <span class="text-danger">{{ $errors->first('page') }}</span>
                                @endif
                            </div>
                            <div class="col-sm-8">
                                <strong><label for="horizontal-question-input" class="col-sm-3 col-form-label">Question</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="question" id="horizontal-question-input" placeholder="Enter Question here" value="{{!empty($faq->question) ? $faq->question : '' }}">
                                    @if ($errors->has('question'))
                                        <span class="text-danger">{{ $errors->first('question') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-answer-input" class="col-sm-3 col-form-label">Answer</label></strong>
                                <div class="col-sm-12">
                                    <textarea  class="form-control answer"  name="answer" id="answer">{{!empty($faq->answer) ? $faq->answer : '' }}</textarea>
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
          $('.select2').select2();
        });
 </script>
  <script>
    $(document).ready(function() {
    $('#answer').summernote({
      placeholder: 'Enter Answer Here',
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
