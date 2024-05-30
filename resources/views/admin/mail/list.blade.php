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
    <div class="col-md-12 message"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>
                    <div class="col-sm-12 mb-2">
                        @can('EmailTemplate-Create')
                        <a href="{{route('mailtemplate.add')}}" class="btn btn-xs btn-success float-right add">Add Email Template</a>
                        @endcan
                        @can('EmailTemplate-View')
                        <a href="{{route('mailtemplate.list')}}" class="btn btn-xs btn-primary float-right add">All Email Template</a>
                        @endcan
                        @can('EmailTemplate-Delete')
                        <a href="{{route('mailtemplate.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                        @endcan
                    </div>
                </h3>
                <hr>
                <table id="emailtemplates" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Title</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
               <!-- Modal -->
               <div class="modal fade emailtemplateDetailsModal" tabindex="-1" role="dialog" aria-labelledby="emailtemplateDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="emailtemplateDetailsModalLabel">emailtemplate DETAILS</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">ID :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="id"></h6>
                                                </td>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">To :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="to"></h6>
                                                </td>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">From :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="from"></h6>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">CC:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="cc"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">BCC :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="bcc"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Title:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="title"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Name :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="name"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Subject:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="subject"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Content:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="content-c"></h6>
                                                </td>
                                            </tr>

                                            <tr>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Created By:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="created_by"></h6>
                                                </td>


                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Created At:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="created_at"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Updated By:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="updated_by"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Updated At:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="updated_at"></h6>
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
                <!-- end modal -->
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
        CKEDITOR.replace('content');
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

        var table = $('#emailtemplates').DataTable({
            ajax: route('emailtemplate.list'),
            serverSide: true,
            processing: true,
            aaSorting: [
                [0, "desc"]
            ],
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'title',
                    name: 'title'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action'
                },
            ],
            'createdRow': function(row, data) {
                $(row).attr('id', data.id)
            },
            "bDestroy": true
        });


        $(document).on('click', '.viewModal', function(event) {
            var id = $(this).data('id');
            console.log(id);

            $.ajax({
                url: route('emailtemplate.detail.view', id),
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data['emailtemplate']);
                    $(document).find('#id').html(data['emailtemplate'].id);
                    $(document).find('#to').html(data['emailtemplate'].to);
                    $(document).find('#form').html(data['emailtemplate'].form);
                    $(document).find('#cc').html(data['emailtemplate'].cc);
                    $(document).find('#bcc').html(data['emailtemplate'].bcc);
                    $(document).find('#title').html(data['emailtemplate'].title);
                    $(document).find('#name').html(data['emailtemplate'].name);
                    $(document).find('#subject').html(data['emailtemplate'].subject);
                    $(document).find('#content-c').html(data['emailtemplate'].content);
                    // form.find('textarea[name="content-c"]').val(data.content)
                    // $('textarea[name="content"]').attr('readonly', 'true');


                    $(document).find('#created_by').html(data['created_by']);
                    $(document).find('#created_at').html(data['created_at']);
                    $(document).find('#updated_by').html(data['updated_by']);
                    $(document).find('#updated_at').html(data['updated_at']);
                    console.log(innerHTML = data['emailtemplate'].emailtemplate_name);



                }

            })
        });


        form.submit(function(event) {
            event.preventDefault();
            if (!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('admin-email-template.update'),
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
                    // console.log(el);
                    if (!id) return;
                    $.ajax({
                        url: route('emailtemplate.remove'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                let table = $('#emailtemplates').DataTable();
                                table.row('#' + id).remove().draw(false)
                                showMsg("success", data.message);
                            } else {
                                printErrorMsg(data.error);
                            }
                        }
                    });

                } else {
                    alert('Cancel');

                }
            })
        })
    })
    $(document).on('change', '.emailtemplate_status', function(e) {
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
                    url: route('emailtemplate.status', [id]),
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
                alert('Cancel');
            }
        })
    });
</script>

@endpush
