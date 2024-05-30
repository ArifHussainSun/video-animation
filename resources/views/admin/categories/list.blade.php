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
                    <h3>
                        @can('Subscriber-Create')
                            <h3>
                                <a href="{{ route('categories.add') }}" class="btn btn-xs btn-success float-right add">Add
                                Category</a>
                                <a href="{{ route('categories.list') }}" class="btn btn-xs btn-primary">All Category</a>
                                <a href="{{ route('categories.list.trashed') }}"class="btn btn-xs btn-danger">Trash</a>

                            </h3>
                        @endcan
                    </h3>
                    <hr>
                    <table id="category" class="table table-bordered table-condensed table-striped"
                        style="font-size: small;">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Title</th>
                                <th>Short Description</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog"
                        aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderdetailsModalLabel"> View Category</h5>
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
                                                            <h5 class="text-truncate font-size-14">Title</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12"
                                                                id="title"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Description</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" id="description"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Image</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <img src="" class="text-truncate font-size-11" id="image"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <!-- <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 ">Meta title</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12"
                                                                id="metatitle"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Meta description</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" id="metadesc"></h5>
                                                        </div>
                                                    </td>
                                                </tr> -->
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
            // $.noConflict();

            var modal = $('.modal')
            var form = $('.form')
            var btnAdd = $('.add'),
                btnSave = $('.btn-save'),
                btnUpdate = $('.btn-update');
                btnView = $('.btn-view');

            var table = $('#category').DataTable({
                ajax: route('categories.list'),
                serverSide: true,
                processing: true,
                aaSorting: [
                    [0, "desc"]
                ],
                columns: [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'title',
                        name: 'title'
                    },
                    {
                        data: 'description',
                        name: 'description'
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
            // update ajax
            $(document).on('click', '.btn-view', function() {
                $.ajax({
                    url: route('categories.view'),
                    type: "get",
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(data) {
                        $('#id').html(data.id);
                        $('#name').html(data.name);
                        $('#title').html(data.title);
                        $('#description').html(data.description);
                        // $('#metatitle').html(data.metatitle);
                        // $('#metadesc').html(data.metadesc);
                        let image;
                        if(data?.image) {
                            image = '{{ URL::asset("/") }}' + data.image;
                        } else {
                            image = '{{ URL::asset("backend/assets/images/default/no-image.jpg") }}';

                        }
                        document.getElementById('image').src = image;
                    }
                });
            });

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
                            url: route('categories.remove'),
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'JSON',

                            success: function(data) {
                                console.log(data);
                                if ($.isEmptyObject(data.error)) {
                                    let table = $('#category').DataTable();
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
        $(document).on('change', '.banner_status', function(e) {
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
                    url: route('categories.status',[id]),
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
