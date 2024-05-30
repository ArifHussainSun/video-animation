@extends('admin.layouts.main')
@section('container')
    <style>
        #hvt:hover {
            transform: scale(3.5);
        }
    </style>

<div class="row">
    @if (Session::has('success') && Session::has('message'))
        <div class="alert alert-{{ Session::get('success') == 'true' ? 'success' : 'danger' }} alert-dismissible fade show"
            role="alert">
            <i class="mdi mdi-check-all me-2"></i>
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="col-md-12 message"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                @can('Subscriber-Create')
                    <h3>
                        <a href="{{ route('contact-queries.add') }}" class="btn btn-xs btn-success float-right add">Add
                            Contact Message</a>
                        <a href="{{ route('contact-queries.list') }}" class="btn btn-xs btn-primary">All Contact
                            Message</a>
                        <a href="{{ route('contact-queries.list.trashed') }}"class="btn btn-xs btn-danger">Trash Files</a>

                    </h3>
                @endcan
                <hr>
                <table id="contactqueries" class="table table-bordered table-condensed table-striped"
                    style="font-size: small;">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>name</th>
                        <th>Email</th>
                        <th>message</th>
                        <th>Deleted At</th>
                        <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
                <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog"
                    aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel"> View Contact Message</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
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
                                                        <h5 class="text-truncate font-size-14">Name</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12"
                                                            id="name"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Email</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12"
                                                            id="email"></h5>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Message</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" id="message"></h5>
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
            $('.select2').select2();
        });
        $(document).ready(function() {

            var modal = $('.modal')
            var form = $('.form')
            var btnAdd = $('.add'),
                btnSave = $('.btn-save'),
                btnUpdate = $('.btn-update');
            btnView = $('.btn-view');

            var table = $('#contactqueries').DataTable({
                ajax: route('contact-queries.list.trashed'),
                serverSide: true,
                processing: true,
                aaSorting: [
                    [0, "desc"]
                ],
                    columns: [
                     {data: 'id', name: 'id'},
                     {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'message', name: 'message'},
                    {data: 'deleted_at', name: 'deleted_at'},
                    {data: 'action', name: 'action'},
                ],
                'createdRow': function(row, data) {
                    $(row).attr('id', data.id)
                },
                "bDestroy": true
            });
            // update ajax
            $(document).on('click', '.btn-view', function() {
                $.ajax({
                    url: route('contact-queries.detail.view', ["yes"]),
                    type: "post",
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(data) {
                        $('#id').html(data.id);
                        $('#name').html(data.name);
                        $('#email').html(data.email);
                        $('#message').html(data.message);
                    }
                });
            });

            $(document).on('click', '.btn-restore', function() {
                btnSave.hide();
                btnView.hide();
                btnUpdate.show();


                $.ajax({
                    url: route('contact-queries.restore'),
                    type: "post",
                    data: {
                        id: $(this).data('id')
                    },

                    success: function(data) {
                        form.find('input[name="name"]').val(data.name)
                        form.find('input[name="email"]').val(data.email)
                        form.find('input[name="message"]').val(data.message)
                        $('input[name="name"]').removeAttr('readonly');
                        $('input[name="email"]').removeAttr('readonly');
                        $('input[name="message"]').removeAttr('readonly');
                    }

                });

                modal.find('.modal-title').text('Update Subscriber')
                modal.find('.modal-footer button[type="submit"]').text('Update')

                var rowData = table.row($(this).parents('tr')).data()
                form.find('input[name="id"]').val(rowData.id)
                form.find('textarea[name="name"]').val(rowData.name)
                form.find('input[name="email"]').val(rowData.email)
                form.find('input[name="message"]').val(rowData.message)
                modal.modal()

            });

            form.submit(function(event) {
                event.preventDefault();
                if (!confirm("Are you sure?")) return;
                var formData = new FormData(this);
                var updateId = form.find('input[name="id"]').val();
                $.ajax({
                    url: route('contact-queries.update'),
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#modal").modal('hide');
                        table.ajax.reload(null, false);
                    }
                }); //end ajax

            })
            // delete ajax
            $(document).on('click', '.btn-delete', function() {

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
                        if (!id) return;
                        $.ajax({
                            url: route('contact-queries.delete'),
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'JSON',

                            success: function(data) {
                                if ($.isEmptyObject(data.error)) {
                                    let table = $('#contactqueries').DataTable();
                                    table.row('#' + id).remove().draw(false)
                                    showMsg("success", data.message);
                                } else {
                                    printErrorMsg(data.error);
                                }
                            }
                        });

                    }

                })
            })
        })
        $(document).on('change', '.subscriber_status', function(e) {
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
                        url: route('contact-queries.status', [id]),
                        type: "post",
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

                } else {}
            })
        });
    </script>
@endpush
