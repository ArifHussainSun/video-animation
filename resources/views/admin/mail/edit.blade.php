@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">UPDATE EMAIL TEMPLATE</h4>
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                            @php
                                Session::forget('success');
                            @endphp
                        </div>
                    @endif
                    <form action="{{ route('mailtemplate.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-sm-12 mb-2">
                                            @can('EmailTemplate-Create')
                                                <a href="{{ route('emailtemplate.add') }}"
                                                    class="btn btn-xs btn-success float-right add">Add Email Template</a>
                                            @endcan
                                            @can('EmailTemplate-View')
                                                <a href="{{ route('emailtemplate.list') }}"
                                                    class="btn btn-xs btn-primary float-right add">All Email Template</a>
                                            @endcan
                                            @can('EmailTemplate-Delete')
                                                <a href="{{ route('emailtemplate.list.trashed') }}"
                                                    class="btn btn-xs btn-danger float-right add">Trash</a>
                                            @endcan
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <strong><label for="horizontal-name-input"
                                                        class="col-sm-3 col-form-label">Name</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="hidden" class="form-control" name="id" id="id"
                                                        placeholder="Enter Name here"
                                                        value="{{ !empty($emailtemplate->id) ? $emailtemplate->id : '' }}">
                                                    <input type="text" class="form-control" name="name"
                                                        id="horizontal-name-input" placeholder="Enter Name here"
                                                        value="{{ !empty($emailtemplate->name) ? $emailtemplate->name : '' }}">
                                                    @if ($errors->has('name'))
                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong><label for="title"
                                                        class="col-sm-3 col-form-label">Title</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Title here" name="title" id="title"
                                                        value="{{ !empty($emailtemplate->title) ? $emailtemplate->title : '' }}">
                                                    @if ($errors->has('title'))
                                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong><label for="to"
                                                        class="col-sm-3 col-form-label">To</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="to" class="form-control" name="to" id="to"
                                                        placeholder="Enter To here"
                                                        value="{{ !empty($emailtemplate->to) ? $emailtemplate->to : '' }}">
                                                    @if ($errors->has('to'))
                                                        <span class="text-danger">{{ $errors->first('to') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong><label for="from"
                                                        class="col-sm-3 col-form-label">From</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="from" class="form-control" placeholder="Enter Form here"
                                                        name="from" id="From"
                                                        value="{{ !empty($emailtemplate->from) ? $emailtemplate->from : '' }}">
                                                    @if ($errors->has('from'))
                                                        <span class="text-danger">{{ $errors->first('from') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong><label for="cc"
                                                        class="col-sm-3 col-form-label">CC</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="cc" class="form-control" placeholder="Enter CC here"
                                                        name="cc" id="cc"
                                                        value="{{ !empty($emailtemplate->cc) ? $emailtemplate->cc : '' }}">
                                                    @if ($errors->has('cc'))
                                                        <span class="text-danger">{{ $errors->first('cc') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <strong><label for="subject"
                                                        class="col-sm-3 col-form-label">BCC</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="bcc" class="form-control" placeholder="Enter BCC here"
                                                        name="bcc" id="bcc"
                                                        value="{{ !empty($emailtemplate->bcc) ? $emailtemplate->bcc : '' }}">
                                                    @if ($errors->has('bcc'))
                                                        <span class="text-danger">{{ $errors->first('bcc') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <strong><label for="subject"
                                                        class="col-sm-3 col-form-label">Subject</label></strong>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter Subject here" name="subject" id="subject"
                                                        value="{{ !empty($emailtemplate->subject) ? $emailtemplate->subject : '' }}">
                                                    @if ($errors->has('subject'))
                                                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <strong><label for="Content"
                                                        class="col-sm-3 col-form-label">Content</label></strong>
                                                <div class="col-sm-12">
                                                    <textarea class="form-control" placeholder="Enter Content here" name="content" id="content">{{ !empty($emailtemplate->content) ? $emailtemplate->content : '' }}</textarea>
                                                    @if ($errors->has('content'))
                                                        <span class="text-danger">{{ $errors->first('content') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div><br />
                        </div>
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
        $(document).ready(function() {
            $('.select2').select2();
        });
        CKEDITOR.replace('content');
    </script>
@endpush
