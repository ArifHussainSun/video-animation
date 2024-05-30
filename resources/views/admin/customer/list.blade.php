@extends('admin.layouts.main')
@section('container')
<style>
    #hvt:hover {
        transform: scale(3.5);
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
    <div class="col-md-12 message"></div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h3>
                    @can('Customer-Create')
                    <a href="{{route('customer.add')}}" class="btn btn-xs btn-success float-right add">Add Customer</a>
                    @endcan
                    @can('Customer-View')
                    <a href="{{route('customer.list')}}" class="btn btn-xs btn-primary float-right add">All Customers</a>
                    @endcan
                    @can('Customer-Delete')
                    <a href="{{route('customer.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                    @endcan
                </h3>
                <hr>
                <table id="customers" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Created At</th>
                            <th>Status</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                </table>

                <!-- Modal -->
                <div class="modal fade customerDetailsModal" tabindex="-1" role="dialog" aria-labelledby="customerDetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="customerDetailsModalLabel">CUSTOMER DETAILS</h5>
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
                                                    <h6 class="m-0 text-right">Phone Number :</h6>
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
                                                    <h6 class="m-0 text-left">Address :</h6>
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

        var modal = $('.modal');
        var form = $('.form');
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
        btnView = $('.btn-view');

        var table = $('#customers').DataTable({
            ajax: route('customer.list'),
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
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'address',
                    name: 'address'
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
            console.log(id);

            $.ajax({
                url: route('customer.detail.view', id),
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data['customer']);
                    $(document).find('#id').html(data['customer'].id);
                    $(document).find('#first_name').html(data['customer'].first_name);
                    $(document).find('#last_name').html(data['customer'].last_name);
                    $(document).find('#email').html(data['customer'].email);
                    $(document).find('#phone_number').html(data['customer'].phone_number);
                    $(document).find('#company_name').html(data['customer'].company_name);
                    $(document).find('#address').html(data['customer'].address);
                    $(document).find('#city').html(data['customer'].city);
                    $(document).find('#state').html(data['customer'].state);
                    $(document).find('#zipcode').html(data['customer'].zipcode);
                    $(document).find('#country').html(data['customer'].country);

                    let image;
                    if(data['customer']?.image) {
                        image = '{{ URL::asset("/") }}' + data['customer'].image;
                    } else {
                        image = '{{ URL::asset("backend/assets/images/default/no-image.jpg") }}';

                    }

                    document.getElementById('image').src = image;

                    $(document).find('#created_by').html(data['created_by']);
                    $(document).find('#created_at').html(data['created_at']);
                    $(document).find('#updated_by').html(data['updated_by']);
                    $(document).find('#updated_at').html(data['updated_at']);


                    console.log(innerHTML = data['customer'].customer_name);



                }

            })
        });

        // update ajax
        $(document).on('click', '.btn-view', function() {
            $.ajax({
                url: route('admin-customer.view'),
                type: "post",
                data: {
                    id: $(this).data('id')
                },
                success: function(data) {
                    $('#id').html(data.id);
                    $('#first_name').html(data.first_name);
                    $('#last_name').html(data.last_name);
                    $('#email').html(data.email);
                    $('#phone_number').html(data.phone_number);
                    $('#company_name').html(data.company_name);
                    $('#address').html(data.address);
                    $('#city').html(data.city);
                    $('#state').html(data.state);
                    $('#zipcode').html(data.zipcode);
                    $('#country').html(data.country.country_name);
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
                    console.log(el);
                    if (!id) return;
                    $.ajax({
                        url: route('customer.remove'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                let table = $('#customers').DataTable();
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

    });

    $(document).on('change', '.customer_status', function(e) {
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
                    url: route('customer.status', [id]),
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
