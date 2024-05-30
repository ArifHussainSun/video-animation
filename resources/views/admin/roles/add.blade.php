@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Roles</h4>
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
                    {!! Form::open(array('route' => 'role.store','method'=>'POST')) !!}
                        @csrf
                        <div class="col-sm-12">
                            <div class="mb-3">
                            <strong><label for="horizontal-key-input" class="col-sm-3 col-form-label">Name</label></strong>
                                <div class="col-sm-12">
                                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
                                </div>
                            </div>
                        <div class="col-sm-12">
                            <div class="mb-3">
                            <strong><label for="horizontal-value-input" class="col-sm-3 col-form-label">Permission</label></strong>
                                <div class="col-sm-12">
                                <br/>
                                <?php
                                    $previous_permission="";
                                    $module = array();
                                    $datapush[]= "";
                                ?>
                            @forelse($permission as $value)
                                <?php
                                        $permission_name = explode( "-", $value->name);
                                        $module_name = $permission_name[0];

                                        if($module_name==$previous_permission){
                                            $module[$module_name][] = $permission_name[1];
                                        } else{
                                            $previous_permission = $permission_name[0];
                                            $module[$module_name][] = $permission_name[1];
                                        }
                                    ?>
                                @empty
                                @endforelse
                            <?php
                                $module_wise_permission[] = $module;
                                $upt_module =   array_keys($module);
                                $i=0;
                            ?>
                            <table class="table table-bordered" style="font-size: small;">
                                <tr>
                                    <th>Module</th>
                                    <th>Add</th>
                                    <th>Edit</th>
                                    <th>View</th>
                                    <th>Delete</th>
                                </tr>
                                @forelse($module as $key=>$mod)
                                <tr>
                                <td>{{ $key }}</td>

                                    @forelse($mod as $per)
                                        <td>
                                            {{ Form::checkbox('permission[]', $permission[$i]->id, false, array('class' => 'name'))  }} {{ $per }}
                                        </td>
                                        <?php $i++; ?>
                                        @empty
                                    @endforelse
                                    @empty
                                @endforelse
                            </table>
                            <br/>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary w-md">SAVE</button>
                                <div>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
