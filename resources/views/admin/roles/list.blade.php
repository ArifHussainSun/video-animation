@extends('admin.layouts.main')
@section('container')
    <style>
        .form{
            width: 133%;
            margin: 0px -100px;
        }
    </style>
    <div class="row">
        @if( Session::has("success") && Session::has("message") )
            <div class="alert alert-{{ (Session::get('success') == 'true' ? 'success' : 'danger') }} alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ Session::get("message") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>
                    <a href="{{ route('role.add')}}" class="btn btn-xs btn-success float-right add">ADD ROLE</a>
                    <a href="{{ route('role.list') }}" class="btn btn-xs btn-primary">ALL ROLE</a>
                     <a href="{{ route('role.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                </h3>
                <hr>
                <table id="roles" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
                <div class="modal" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <!-- <form class="form" action="" method="POST"> -->
                        {!! Form::open(array('class' => 'form ','method'=>'POST')) !!}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add</h5>
                                    <button type="button" class="close btn btn-dangar" style="font-size:large" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id">
                                <div class="col-sm-12">
                                <div class="row">
                                    <!-- <div class="col-sm-6"> -->
                                    <div class="form-group">
                                        <label for="name">Permission</label>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
                                        <br/>
                                        <table class="table table-bordered" style="font-size: small;">
                                            <thead>
                                                <tr>
                                                <th>Module</th>
                                                <th>Add</th>
                                                <th>Edit</th>
                                                <th>View</th>
                                                <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody class="pBody">
                                            </tbody>
                                        </table>
                                        <br/>
                                    </div>
                                </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-save">Save</button>
                                    <button type="button" class="btn btn-primary btn-update">Update</button>
                                    <button type="button" disabled class="btn btn-primary  btn-view" data-keyboard="false">View</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            {!! Form::close() !!}
                    </div>
                </div>
                <div class="modal1 fade orderdetailsModal" id="modal1" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel">  View Role</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">ID</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 " id="id"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" >Name</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12" id="name"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')
  <script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {


    $(document).find('.select2').select2({

        dropdownParent: $('#modal')
    });
    });

    $(document).ready(function() {
        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
            btnView = $('.btn-view');
        var table = $('#roles').DataTable({
                ajax: route('role.list'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
                'createdRow': function(row, data) {
                        $(row).attr('id', data.id)
                    },
                    "bDestroy": true
            });

        // update ajax
        $(document).on('click','.btn-view',function(){
            $.ajax({
                url: route('role.detail.view'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    console.log(data);
                    $('#id').html(data.id);
                    $('#name').html(data.name);
                }
            });
        });

        $(document).on('click','.btn-edit',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();
            $.ajax({
                url: route('role.edit'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    // console.log(data)
                    form.find('input[name="id"]').val(data.role.id)
                    form.find('input[name="name"]').val(data.role.name)
                    form.find('input[name="permission[]"]').val(data.permission.permission)
                    $('input[name="name"]').removeAttr('readonly');
                    $('input[name="permission"]').removeAttr('readonly');
                    $('.pBody').html(data.html);
                }
            });
            modal.find('.modal-title').text('Update Roles')
            modal.find('.modal-footer button[type="submit"]').text('Update')
            // var rowData =  table.row($(this).parents('tr')).data()
            // form.find('input[name="id"]').val(rowData.id)
            // form.find('input[name="name"]').val(rowData.name)
            // form.find('input[name="permission"]').val(rowData.permission)
            modal.modal('show')
        });
        btnUpdate.click(function(){
            if(!confirm("Are you sure?")) return;
            var formData = form.serialize();
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('role.update'),
                type: "POST",
                data: formData,
                success: function (data) {
            $("#modal").modal('hide');
            table.ajax.reload( null, false );
                }
            }); //end ajax
        })
        // delete ajax
        $(document).on('click','.btn-delete',function(){
            var formData = form.serialize();
            var updateId = form.find('input[name="id"]').val();
            var id = $(this).data('id')
            var el = $(this)
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    if(!id) return;
                    $.ajax({
                        url: route('role.remove'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#roles').DataTable();
                                table.row('#' + id).remove().draw(false)
                                showMsg("success", data.message);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }
                else{

                }
            })
        })
    })
    $(document).on('change', '.role_status', function(e) {
        let id = $(this).attr("data-id");
        let status = $(this).is(':checked');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Yes, Update it!",
            cancelButtonText: "No, cancel!",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ms-2 mt-2",
            buttonsStyling: !1
        }).then(function(t) {
            if (t.value) {
                if (!id) return;
                $.ajax({
                    url: route('role.status',[id]),
                    type: "POST",
                    data: {
                        id: id,
                        status: status
                    },
                    dataType: 'JSON',
                    success: function(data) {
                        showMsg("success", data.message);
                        table.ajax().reload();
                    }
                });

            } else {
            }
        })
    });
  </script>
@endpush

