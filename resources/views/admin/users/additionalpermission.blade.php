@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title mb-4">Additional Permissions</h4>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::model($user, ['method' => 'post','route' => ['admin-user.additionalpermission', $user->id]]) !!}
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>User Role:</strong>
                        {!! Form::hidden('user_id', $user->id, array('placeholder' => 'Name','class' => 'form-control'))  !!}
                        {!! Form::hidden('user_name', $user->first_name, array('placeholder' => 'Name','class' => 'form-control'))  !!}
                        {!! Form::hidden('id', $role->id, array('placeholder' => 'Name','class' => 'form-control'))  !!}
                        {!! Form::text('name', $role->name, array('placeholder' => 'Name','class' => 'form-control'))  !!}
                    </div>
                </div>
                <br/>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        <?php
                            $previous_permission="";
                            $module = array();
                            $datapush[]= "";
                        ?>
                        @foreach($permission  as $value)
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
                        @endforeach
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
                            @foreach($module as $key=>$mod)
                                <tr>
                                <td>{{ $key }} </td>
                                @foreach($mod as $per)
                                    <td>
                                    {{ Form::checkbox('permission[]',  $permission[$i]->name, in_array($permission[$i]->id, $rolePermissions ) ? true : false )  }}  {{ $per }}
                                    </td>
                                    <?php $i++; ?>
                                @endforeach
                            @endforeach
                        </table>
                        <br/>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">SAVE</button>
                    <a class="btn btn-primary" href="{{ route('admin-user.main') }}"> Back</a>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
    </div>

@endsection
