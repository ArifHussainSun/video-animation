@extends('admin.layouts.main')
@section('container')
<style>
    #hvt:hover {
        transform: scale(3.5);
    }
</style>

<div class="row">
    @if( Session::has("success") && Session::has("message"))
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
                    <a href="{{ route('banner.add')}}" class="btn btn-xs btn-success float-right add">ADD BANNER</a>
                    <a href="{{ route('banner.list') }}" class="btn btn-xs btn-primary">ALL BANNER</a>
                    <a href="{{ route('banner.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                </h3>
                <hr>
                <table id="banner" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Heading One</th>
                            <th>Heading Two</th>
                            <th>Description</th>
                            <th>Page</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>
                <!-- <div class="modal" id="modal" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form class="form" action="" method="POST" enctype="multipart/form-data">
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
                                        <label for="heading_one">Heading One</label>
                                        <input type="text" name="heading_one" id="heading_one" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="heading_two">Heading Two</label>
                                        <input type="text" name="heading_two" id="heading_two" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <input type="text" name="description" id="description" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_title">Button Title</label>
                                        <input type="text" name="btn_title" id="btn_title" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="btn_link">Button Link</label>
                                        <input type="text" name="btn_link" id="btn_link" class="form-control input-sm">
                                    </div>

                                    <div class="form-group">
                                        <label for="name">Pages</label><br />
                                        <select class="form-control select2" name="page" id="page" style="width:100%">
                                            <option value="">Select Pages</option>

                                            <option value=""> </option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Old Preview Image</label>
                                        <img src='' id="edi_image" class="form-control input-sm" width="180px;" height="120" />
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control input-sm">
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
                <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog"
                        aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width: 700px">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderdetailsModalLabel"> View Banner</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- <p class="mb-2">Product id: <span class="text-primary">#SK2540</span></p> -->
                                    <!-- <p class="mb-4">Billing Name: <span class="text-primary">Neal Matthews</span></p> -->

                                    <div class="table-responsive">
                                        <table class="table align-middle table-nowrap">
                                            <thead>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6>ID :</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="id" class="badge badge-soft-success font-size-14">
                                                        </h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Heading One:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="heading_one" class="m-0 text-right badge badge-soft-success font-size-14"></h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Heading Two:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="heading_two" class="badge badge-soft-success font-size-14">
                                                        </h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Description:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="description"></h6>
                                                    </td>
                                                </tr>


                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">Btn Title:</h5>
                                                        </div>
                                                    </td>
                                                    <th scope="row">
                                                        <div>
                                                            <h6 id="btn_title"></h6>
                                                        </div>
                                                    </th>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Btn Link:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="btn_link"></h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Image:</h6>
                                                    </td>
                                                    <td>
                                                       <img  src='' id="image" class="form-control input-sm" width="180px;" height="120" />
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
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

        var table = $('#banner').DataTable({
            ajax: route('banner.list'),
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
                    data: 'image',
                    name: 'image'
                },
                {
                    data: 'heading_one',
                    name: 'heading_one'
                },
                {
                    data: 'heading_two',
                    name: 'heading_two'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'page',
                    name: 'page'
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
        // update ajax
        $(document).on('click', '.btn-view', function() {
            btnSave.hide();
            btnView.hide();
            btnUpdate.hide();
            $.ajax({
                url: route('banner.detail.view'),
                type: "post",
                data: {
                    id: $(this).data('id')
                },

                success: function(data) {
                    $('#id').html(data.id);
                    $('#heading_one').html(data.heading_one);
                    $('#heading_two').html(data.heading_two);
                    $('#description').html(data.description);
                    $('#btn_title').html(data.btn_title);
                    $('#btn_link').html(data.btn_link);
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
        $(document).on('click', '.btn-edit', function() {
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();


            $.ajax({
                url: route('banner.edit'),
                type: "post",
                data: {
                    id: $(this).data('id')
                },

                success: function(data) {
                    // console.log(data)
                    form.find('select[name="page"]').val(data.page)
                    form.find('input[name="heading_two"]').val(data.heading_two)
                    form.find('input[name="heading_one"]').val(data.heading_one)
                    form.find('input[name="description"]').val(data.description)
                    form.find('input[name="btn_title"]').val(data.btn_title)
                    form.find('input[name="btn_link"]').val(data.btn_link)
                    $("#edi_image").attr('src', data.image);
                    $('select[name="page"]').removeAttr('readonly');
                    $('input[name="heading_two"]').removeAttr('readonly');
                    $('input[name="description"]').removeAttr('readonly');
                    $('input[name="heading_one"]').removeAttr('readonly');
                    $('input[name="btn_title"]').removeAttr('readonly');
                    $('input[name="image"]').removeAttr('readonly');
                    $('input[name="btn_link"]').removeAttr('readonly');



                }

            });

            modal.find('.modal-title').text('Update SubCategories')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData = table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="heading_one"]').val(rowData.heading_one)
            form.find('input[name="heading_two"]').val(rowData.heading_two)
            form.find('input[name="description"]').val(rowData.description)
            form.find('input[name="btn_title"]').val(rowData.btn_title)
            form.find('input[name="btn_link"]').val(rowData.btn_link)
            form.find('select[name="page"]').val(rowData.page)
            modal.modal()

        });

        form.submit(function(event) {
            event.preventDefault();
            if (!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('banner.update'),
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
                    console.log(el);
                    if (!id) return;
                    $.ajax({
                        url: route('banner.remove'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {
                                if($.isEmptyObject(data.error)){
                                  let table = $('#banner').DataTable();
                                  table.row('#' + id).remove().draw(false)
                                  showMsg("success", data.message);
                                }else{
                                    printErrorMsg(data.error);
                                }
                        }
                    });

                } else {

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
                    url: route('banner.status',[id]),
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
