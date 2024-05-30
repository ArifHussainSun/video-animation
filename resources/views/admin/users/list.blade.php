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
                    @can('User-Create')
                    <a href="{{route('user.add')}}" class="btn btn-xs btn-success float-right add">Add User</a>
                    @endcan
                    @can('User-View')
                    <a href="{{route('user.list')}}" class="btn btn-xs btn-primary float-right add">All Users</a>
                    @endcan
                    @can('User-Delete')
                    <a href="{{route('user.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                    @endcan
                </h3>
                <hr>
                <table id="user" class="table table-busered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>First Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="19%">Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Modal -->
                <div class="modal fade userDetailsModal" tabindex="-1" role="dialog" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="userDetailsModalLabel">USER DETAILS</h5>
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
                                        {{-- <tbody>


                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">First Name</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 " id="first_name"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Last Name</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 " id="last_name"></h5>
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
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="email"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Phone Number</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" id="phone"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">State</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" id="state"></h5>
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
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14">Address</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" id="address"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody> --}}
                                        <tbody>
                                            <tr>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">First Name :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="first_name"></h6>
                                                </td>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Last Name :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="last_name"></h6>
                                                </td>


                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Email:</h6>
                                                </td>
                                                <td>
                                                    <h6 class="badge badge-pill badge-soft-success font-size-14" id="email"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Phone Number:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="phone_number"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Company Name:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="company_name"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Address:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="address"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">City:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="city"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">State:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="state"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Zip Code:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="zipcode"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">Country:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="country"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Image:</h6>
                                                </td>
                                                <td>
                                                    <img src="" class="avatar-md" id="image">
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

    

        var table = $('#user').DataTable({
            ajax: route('user.list'),
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
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'roles',
                    name: 'roles'
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
        $(document).on('click', '.viewModal', function(event) {
            var id = $(this).data('id');

            $.ajax({
                url: route('user.detail.view', id),
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    $(document).find('#id').html(data['user'].id);
                    $(document).find('#first_name').html(data['user'].first_name);
                    $(document).find('#last_name').html(data['user'].last_name);
                    $(document).find('#email').html(data['user'].email);
                    $(document).find('#phone_number').html(data['user'].phone_number);
                    $(document).find('#state').html(data['user'].state);
                    $(document).find('#address').html(data['user'].address);
                    $(document).find('#company_name').html(data['user'].company_name);
                    $(document).find('#city').html(data['user'].city);
                    $(document).find('#zipcode').html(data['user'].zipcode);
                    $(document).find('#country').html(data['user'].country);
                    
                    $(document).find('#created_by').html(data['created_by']);
                    $(document).find('#created_at').html(data['created_at']);
                    $(document).find('#updated_by').html(data['updated_by']);
                    $(document).find('#updated_at').html(data['updated_at']);

                    let image;
                    if(data['user']?.image) {
                        image = '{{ URL::asset("/") }}' + data['user'].image;
                    } else {
                        image = '{{ URL::asset("backend/assets/images/default/no-image.jpg") }}';

                    }

                    document.getElementById('image').src = image;

                    $(document).find('#created_by').html(data['created_by']);
                    $(document).find('#created_at').html(data['created_at']);
                    $(document).find('#updated_by').html(data['updated_by']);
                    $(document).find('#updated_at').html(data['updated_at']);



                }

            })
        });





        form.submit(function(event) {
            event.preventDefault();
            if (!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = $(this).find('input[name="id"]').val();
            $.ajax({
                url: route('admin-user.update'),
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    // console.log(data)

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
                        url: route('user.remove'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                let table = $('#user').DataTable();
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
    $(document).on('change', '.user_status', function(e) {
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
                    url: route('user.status', [id]),
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
