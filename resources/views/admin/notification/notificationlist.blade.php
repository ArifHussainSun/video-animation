@extends('admin.layouts.main')
@section('container')
    <style>
        #hvt:hover {
        transform: scale(3.5);
        }

    </style>

    <div class="row">
        @if( Session::has("success") )
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="mdi mdi-check-all me-2"></i>
                {{ Session::get("success") }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

        @endif
        @if( Session::has("error") )
            <div class="alert alert-danger alert-block" role="alert">
            <button class="close" data-dismiss="alert"></button>
            {{ Session::get("error") }}
            </div>
        @endif
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">
                <h3>
                    <!-- <a href="{{route('admin-notification.add')}}" class="btn btn-xs btn-primary float-right add">Add Notifications</a> -->
                </h3>
                <hr>
                <table id="customers" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>

                            <th>ID</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th width="1%">Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- <div class="modal" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form class="form" action="" method="POST" enctype="multipart/form-data" >
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
                                        <label for="name">Title</label>
                                        <input type="text" name="title" id="title" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea type="text" name="description" id="description" class="form-control input-sm"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn-save">Save</button>
                                    <button type="submit" class="btn btn-primary btn-update">Update</button>
                                    <button type="button" disabled class="btn btn-primary  btn-view" data-keyboard="false">View</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> -->
                <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel">  View Notification</h5>
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
                                                    <h5 class="text-truncate font-size-14" >Name</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14  badge badge-pill badge-soft-success font-size-12" id="name"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                    <h5 class="text-truncate font-size-14" >Title</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14  badge badge-pill badge-soft-primary font-size-12" id="title"></h5>
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
        $('.select2').select2();
    });
    $(document).ready(function() {

        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
            btnView = $('.btn-view');

        var table = $('#customers').DataTable({
                ajax: route('admin-notification.main'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
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
                url: route('admin-notification.view'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                   console.log(data);
                   console.log(data.data.data.title);
                   $('#name').html(data.user.first_name +"  "+ data.user.last_name);
                   $('#title').html(data.data.data.title);

                }
            });

        });
        $(document).on('click','.btn-edit',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();


            $.ajax({
                url: route('admin-notification.freshdata'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {
                    form.find('input[name="title"]').val(data.title)
                    form.find('textarea[name="description"]').val(data.description)
                    $('input[name="title"]').removeAttr('readonly');
                    $('textarea[name="description"]').removeAttr('readonly');
                }

            });

            modal.find('.modal-title').text('Update Notification')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="title"]').val(rowData.title)
            form.find('textarea[name="description"]').val(rowData.description)
            modal.modal()

        });

        form.submit(function(event){
            event.preventDefault();
            if(!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('admin-notification.update'),
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
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
            var rowid = $(this).data('rowid')
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
                    console.log(el);
                    if(!rowid) return;
                    $.ajax({
                        url: route('admin-notification.delete'),
                        type: "POST",
                        data:{id:rowid},
                        dataType: 'JSON',

                        success: function () {
                            let table = $('#customers').DataTable();
                            table.row('#' + rowid).remove().draw(false)
                        }
                    });

                }
               
            })
        })
    })

</script>
@endpush
