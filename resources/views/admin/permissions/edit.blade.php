@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Update Permissions</h4>
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">

                        {{ session('success') }}
                    </div>
                    @elseif(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ session('failed') }}
                    </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('permission.update') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="horizontal-phone-input" class="col-sm-3 col-form-label">Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control"  name="id" id="id" value="{{ !empty($permission->id) ? $permission->id : '' }}">
                                    <input type="text"  class="form-control"  name="name" id="name" value="{{ !empty($permission->name) ? $permission->name : '' }}" placeholder="Enter Name here">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div><br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="col-sm-12" >
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
