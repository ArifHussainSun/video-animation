@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Edit Contact Message</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{route('contact-queries.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" name="id" value="{{ !empty($contactqueries->id) ? $contactqueries->id : ''}}">
                                    <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter Name here" value="{{ !empty($contactqueries->name) ? $contactqueries->name : ''}}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="horizontal-heading_two-input" class="col-sm-3 col-form-label">Email</label></strong>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" id="horizontal-email-input" placeholder="Enter Email here" value="{{ !empty($contactqueries->email) ? $contactqueries->email : ''}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="subject" class="col-sm-3 col-form-label">Subject</label></strong>
                                <div class="col-sm-12">
                                    <input type="subject" class="form-control" name="subject" id="subject" placeholder="Enter Subject here" value="{{ !empty($contactqueries->subject) ? $contactqueries->subject : ''}}">
                                    @if ($errors->has('subject'))
                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Pages</label></strong>
                                <select class="form-control select2" name="pages_id" id="pages_id">
                                <option value="" selected disabled>Select Pages</option>
                                @forelse($pages as $page)
                                    <option value="{{ $page->name }}" {{ $contactqueries->pages_id == $page->id ? 'selected' : '' }}>{{ $page->name }}</option>
                                    @empty
                                @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Data</label></strong>
                                <div class="col-sm-12">
                                    <input type="text"  class="form-control" placeholder="Enter Data here" name="data" value="{{ !empty($contactqueries->data) ? $contactqueries->data : ''}}" id="horizontal-data-input">
                                    @if ($errors->has('data'))
                                        <span class="text-danger">{{ $errors->first('data') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Message</label></strong>
                                <div class="col-sm-12">
                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter Message here" name="message" id="summernote">{{ !empty($contactqueries->message) ? $contactqueries->message : ''}}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <br/><br/>
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

       $('#summernote').summernote({
           placeholder: 'Enter Message here',
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

 </script>

@endpush
