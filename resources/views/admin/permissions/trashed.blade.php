@extends('admin.layouts.main')
@section('container')

    <div class="row">
        @if( Session::has("success") && Session::has("message") )
            <div class="alert alert-{{ (Session::get('success') == 'true' ? 'success' : 'danger') }} alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ Session::get("message") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="col-md-12 message"></div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                <h3>
                    @can('Permission-Create')
                     <a href="{{route('permission.add')}}" class="btn btn-xs btn-success float-right add">ADD PERMISSION</a>
                     <a href="{{ route('permission.list') }}" class="btn btn-xs btn-primary">ALL PERMISSION</a>
                     <a href="{{ route('permission.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                    @endcan
                </h3>
                <hr>
                <table id="permission" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Deleted At</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- <div class="modal" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        {!! Form::open(array('class' => 'form','method'=>'POST')) !!}
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add</h5>
                                    <button type="button" class="close btn btn-dangar" style="font-size:large" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" name="id">

                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
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
                </div> -->

                <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel">  View Permission</h5>
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
    $(document).ready(function() {

        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
            btnView = $('.btn-view');

        var table = $('#permission').DataTable({
                ajax: route('permission.trashed'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'deleted_at', name: 'deleted_at'},
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
                url: route('permission.detail.view' , 'yes'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
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
                url: route('permission.edit'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {

                    form.find('input[name="name"]').val(data.permission.name)
                    // form.find('input[name="sort_no"]').val(data.user.sort_no)
                    // form.find('input[name="password"]').val(data.user.password)
                    // form.find('input[name="confirm-password"]').val(data.user.confirm-password)
                    // form.find('input[name="roles"]').val(data.user.roles)
                    $('input[name="name"]').removeAttr('readonly');
                    // $('input[name="sort_no"]').removeAttr('readonly');
                    // $('input[name="password"]').removeAttr('readonly');
                    // $('input[name="confirm-password"]').removeAttr('readonly');
                    // $('input[name="roles"]').removeAttr('readonly');

                }

            });

            modal.find('.modal-title').text('Update Permissions')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            // form.find('input[name="sort_no"]').val(rowData.sort_no)
            // form.find('input[name="password"]').val(rowData.password)
            // form.find('input[name="confirm-password"]').val(rowData.confirm-password)
            // form.find('input[name="roles"]').val(rowData.roles)
            modal.modal();
            event.preventDefault();

        });

        $(document).on('click','.btn-restore',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();


            $.ajax({
                url: route('permission.restore'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {

                    form.find('input[name="name"]').val(data.permission.name)
                    $('input[name="name"]').removeAttr('readonly');

                }

            });

            modal.find('.modal-title').text('Update Permissions')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            // form.find('input[name="sort_no"]').val(rowData.sort_no)
            // form.find('input[name="password"]').val(rowData.password)
            // form.find('input[name="confirm-password"]').val(rowData.confirm-password)
            // form.find('input[name="roles"]').val(rowData.roles)
            modal.modal();
            event.preventDefault();

        });

        btnUpdate.click(function(){
            if(!confirm("Are you sure?")) return;
            var formData = form.serialize();
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('permission.update'),
                type: "POST",
                data: formData,

                success: function (data) {
                    console.log(data)
            //     var table = $('#permission').DataTable({

            //     serverSide: true,
            //     processing: true,
            //     aaSorting:[[0,"desc"]],
            //     columns: [
            //         {data: 'name', name: 'name'},
            //         {data: 'email', name: 'email'},
            //         {data: 'password', name: 'password'},
            //         {data: 'confirm-password', name: 'confirm-password'},
            //         {data: 'roles', name: 'roles'},
            //         {data: 'action', name: 'action'},
            //     ],
            //     'createdRow': function(row, data) {
            //             $(row).attr('id', data.id)
            //         },
            //         "bDestroy": true,


            // });
                    //$(document).find("#permission").dataTable().fnDestroy()

                    //$(document).find("#permission").dataTable();
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
                        url: route('permission.delete'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#permission').DataTable();
                                table.row('#' + id).remove().draw(false)
                                showMsg("success", data.message);
                            }else{
                                printErrorMsg(data.error);
                            }
                        }
                    });

                }

            })
        })
    })
    $(document).on('change', '.permission_status', function(e) {
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
                    url: route('permission.status',[id]),
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
