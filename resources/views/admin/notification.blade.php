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
                    <form action="{{ url('notification/save/all') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Title</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" id="horizontal-name-input" placeholder="Enter name here">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif

                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Description</label></strong>
                                <div class="col-sm-12">
                                    <textarea type="text" rows="4" class="form-control" placeholder="Enter Description here" name="desc" id="horizontal-desc-input"></textarea>
                                    @if ($errors->has('desc'))
                                        <span class="text-danger">{{ $errors->first('desc') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div><br/><br/>
                        <div class="row">
                            <div class="col-sm-12">

                                <div class="col-sm-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary w-md">Submit</button>
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
