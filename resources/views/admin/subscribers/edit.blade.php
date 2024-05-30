@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">UPDATE SUBSCRIBERS</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{ route('subscriber.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="id"  value="{{ !empty($subscriber->id) ? $subscriber->id : ''}}" placeholder="Enter Name here">
                                    <input type="text" class="form-control" name="name" id="horizontal-name-input" value="{{ !empty($subscriber->name) ? $subscriber->name : ''}}" placeholder="Enter Name here">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif

                                </div>
                            </div>

                            <div class="col-sm-12">
                                <strong><label for="horizontal-heading_two-input" class="col-sm-3 col-form-label">Email</label></strong>
                                <div class="col-sm-12">
                                    <input type="email" class="form-control" name="email" id="horizontal-email-input" placeholder="Enter Email here" value="{{ !empty($subscriber->email) ? $subscriber->email : ''}}">
                                    @if ($errors->has('email'))
                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Phone</label></strong>
                                <div class="col-sm-12">
                                    <input type="text"  class="form-control" placeholder="Enter Phone Number here" name="phone" id="horizontal-phone-input" value="{{ !empty($subscriber->phone) ? $subscriber->phone : ''}}">
                                    @if ($errors->has('phone'))
                                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Data</label></strong>
                                <div class="col-sm-12">
                                    <input type="text"  class="form-control" placeholder="Enter Data here" name="data" value="{{ !empty($subscriber->data) ? $subscriber->data : ''}}" id="horizontal-data-input">
                                    @if ($errors->has('data'))
                                        <span class="text-danger">{{ $errors->first('data') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div><br/><br/>
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

@endpush
