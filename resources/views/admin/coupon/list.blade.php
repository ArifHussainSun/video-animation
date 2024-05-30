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
                        @can('Coupon-Create')
                        <a href="{{route('coupon.add')}}" class="btn btn-xs btn-success float-right add">Add Coupon</a>
                        @endcan
                        @can('Coupon-View')
                            <a href="{{route('coupon.list')}}" class="btn btn-xs btn-primary float-right add">All Coupons</a>
                            @endcan
                            @can('Coupon-Delete')
                            <a href="{{route('coupon.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
                        @endcan

                    </h3>
                    <hr>
                    <table id="coupons" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                        <thead>
                            <tr>
                                <th width="1%">ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th width="15%">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- Modal -->
                    <div class="modal fade couponDetailsModal" tabindex="-1" role="dialog" aria-labelledby="couponDetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="couponDetailsModalLabel">COUPON DETAILS</h5>
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
                                                        <h6 class="m-0 text-right">Name :</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="coupon_name"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Description:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="coupon_description" class="m-0 text-right"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Discount:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="discount"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Discount Type:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="discount_type"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Date To:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="date_to"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">Date From:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="date_from"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">Quantity:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="quantity"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">Utilized:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="utilized"></h6>
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

        var table = $('#coupons').DataTable({
            ajax: route('coupon.list'),
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
                    data: 'coupon_name',
                    name: 'coupon_name'
                },
                {
                    data: 'coupon_description',
                    name: 'coupon_description'
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
                url: route('coupon.detail.view', id),
                type: "GET",
                data: {
                    id: id
                },
                success: function(data) {
                    console.log(data['coupon']);
                    $(document).find('#id').html(data['coupon'].id);
                    $(document).find('#coupon_name').html(data['coupon'].coupon_name);
                    $(document).find('#coupon_description').html(data['coupon'].coupon_description);
                    $(document).find('#discount').html(data['coupon'].discount);
                    $(document).find('#discount_type').html(data['coupon'].discount_type);
                    $(document).find('#date_from').html(data['coupon'].date_from);
                    $(document).find('#date_to').html(data['coupon'].date_to);
                    $(document).find('#quantity').html(data['coupon'].quantity);
                    $(document).find('#utilized').html(data['coupon'].utilized);
                    $(document).find('#created_by').html(data['created_by']);
                    $(document).find('#created_at').html(data['created_at']);
                    $(document).find('#updated_by').html(data['updated_by']);
                    $(document).find('#updated_at').html(data['updated_at']);
                    console.log(innerHTML = data['coupon'].coupon_name);



                }

            })
        });


        $(document).on('click', '.btn-edit', function() {
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();


            $.ajax({
                url: route('admin-brand-settings-coupon.freshdata'),
                type: "post",
                data: {
                    id: $(this).data('id')
                },

                success: function(data) {
                    var discounttype = "";

                    // coupon
                    for (let i = 0; i < data.discounttype.length; i++) {
                        console.log(data.discounttype[i]);
                        if (data.discounttype[i].id == data.discount_type) {
                            discounttype += '<option value="' + data.discounttype[i].id + '" selected>' + data.discounttype[i].discount_type + '</option>';
                        } else {
                            discounttype += '<option value="' + data.discounttype[i].id + '">' + data.discounttype[i].discount_type + '</option>';
                        }
                    }
                    form.find('select[name="discount_type"]').html(discounttype);
                    form.find('input[name="coupon_name"]').val(data.coupon_name)
                    form.find('input[name="coupon_description"]').val(data.coupon_description)
                    form.find('input[name="discount"]').val(data.discount)
                    form.find('input[name="date_from"]').val(data.date_from)
                    form.find('input[name="date_to"]').val(data.date_to)
                    form.find('input[name="quantity"]').val(data.quantity)
                    form.find('input[name="utilized"]').val(data.utilized)
                    $('input[name="coupon_name"]').removeAttr('readonly');
                    $('input[name="coupon_description"]').removeAttr('readonly');
                    $('input[name="discount"]').removeAttr('readonly');
                    $('select[name="discount_type"]').removeAttr('readonly');
                    $('input[name="date_from"]').removeAttr('readonly');
                    $('input[name="date_to"]').removeAttr('readonly');
                    $('input[name="quantity"]').removeAttr('readonly');
                    $('input[name="utilized"]').removeAttr('readonly');
                }

            });

            modal.find('.modal-title').text('Update Coupon')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData = table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="coupon_name"]').val(rowData.coupon_name)
            form.find('input[name="coupon_description"]').val(rowData.coupon_description)
            form.find('input[name="discount"]').val(rowData.discount)
            form.find('select[name="discount_type"]').val(rowData.discount_type)
            form.find('input[name="date_from"]').val(rowData.date_from)
            form.find('input[name="date_to"]').val(rowData.date_to)
            form.find('input[name="quantity"]').val(rowData.quantity)
            form.find('input[name="utilized"]').val(rowData.utilized)
            modal.modal()

        });

        form.submit(function(event) {
            event.preventDefault();
            if (!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('coupon.update'),
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
                text: "You are able to revert this on trash!",
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
                        url: route('coupon.remove'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {

                            if($.isEmptyObject(data.error)){
                                let table = $('#coupons').DataTable();
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



        $(document).on('change', '.coupon_status', function(e) {
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
                        url: route('coupon.status', [id]),
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

    })
</script>
@endpush
