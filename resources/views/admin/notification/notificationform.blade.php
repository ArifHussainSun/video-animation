@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW NOTIFICATIONS</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <form action="{{route('admin-notification.save')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Title</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="title" id="horizontal-title-input" placeholder="Enter Title here">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Description</label></strong>
                                <div class="col-sm-12">
                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter Description here" name="description" id="horizontal-description-input"></textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div><br/>
                        </div>
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
          $('.select2').select2();
       });

 </script>

@endpush
