@extends('admin.layouts.main')
@section('container')
    <div class="row">
        @if( Session::has("success") && Session::has("message"))
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
                        @can('Payment-Create')
                            <a href="{{ route('payment.add') }}" class="btn btn-xs btn-success float-right add">ADD PAYMENT</a>
                            <a href="{{ route('payment.list') }}" class="btn btn-xs btn-primary">ALL PAYMENT</a>
                            <a href="{{ route('payment.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                            <a href="{{ route('payment.generate.report') }}"class="btn btn-xs btn-warning">Generate Report</a>
                        @endcan
                    </h3>
                    <hr>
                    <table id="payments" class="table table-bordered table-condensed table-striped"
                        style="font-size: small;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Price</th>
                                <th>Category</th>
                                <th>Payment Gateway</th>
                                <th>Sale Type</th>
                                <th>Deleted At</th>
                                <th>Status</th>
                                <th width="19%">Action</th>
                            </tr>
                        </thead>
                    </table>
                    <!-- <div class="modal" id="modal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <form class="form" action="" method="POST">
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
                                            <label for="customer_id">Customer</label>
                                            <select class="form-control input-sm select2" name="customer_id" id="customer_id" style="width: 100%;">
                                                <option value="" selected disabled>Select Customer</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="item_name">Item Name</label>
                                            <input type="text" name="item_name" id="item_name" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Discount</label>
                                            <input type="text" name="discount" id="discount" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="item_description">Item Descripion</label>
                                            <textarea name="item_description" id="item_description" class="form-control input-sm"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="converted_amount">Converted Amount</label>
                                            <input type="text" name="converted_amount" id="converted_amount" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="currency">Currency</label>
                                            <select class="form-control input-sm select2" name="currency" id="currency" style="width: 100%;">
                                                <option value="" selected disabled>Select Currency</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control input-sm select2" name="category_id" id="category_id" style="width: 100%;">
                                                <option value="" selected disabled>Select Category</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="coupon_id">Coupon</label>
                                            <input type="text" name="coupon_id" id="coupon_id" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="sale_type_id">Sale Type</label>
                                            <select class="form-control input-sm select2" name="sale_type_id" id="sale_type_id" style="width: 100%;">
                                                <option value="" selected disabled>Select Sale Type</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_gateway">Payment Gateway</label>
                                            <input type="text" name="payment_gateway" id="payment_gateway" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="payment_type">Payment Type</label>
                                            <select class="form-control input-sm select2" name="payment_type" id="payment_type" style="width: 100%;">
                                                <option value="" selected disabled>Select Payment Type</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="remaining_amount">Remaining Amount</label>
                                            <input type="text" name="remaining_amount" id="remaining_amount" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="balance">Balance</label>
                                            <input type="text" name="balance" id="balance" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="comment">Comment</label>
                                            <input type="text" name="comment" id="comment" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="message">Message</label>
                                            <input type="text" name="message" id="message" class="form-control input-sm">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary btn-save">Save</button>
                                        <button type="button" class="btn btn-primary btn-update">Update</button>
                                        <button type="button" id="detail" class="btn btn-primary  btn-detail" data-keyboard="false">Detail</button>
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
                                    <h5 class="modal-title" id="orderdetailsModalLabel"> View Payment</h5>
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
                                                        <h6 class="m-0 text-right">Customer Name:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="customer_id"
                                                            class="m-0 text-right badge badge-soft-success font-size-14">
                                                        </h6>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">item name:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="item_name" class="badge badge-soft-success font-size-14">
                                                        </h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">price:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="price"></h6>
                                                    </td>
                                                </tr>


                                            </thead>
                                            <tbody>



                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14">item description:</h5>
                                                        </div>
                                                    </td>
                                                    <th scope="row">
                                                        <div>
                                                            <h6 id="item_description"></h6>
                                                        </div>
                                                    </th>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">converted amount:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="converted_amount"></h6>
                                                    </td>
                                                </tr>



                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">currency:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="currency"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">category id:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="category_id"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">coupon id:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="coupon_id"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">sale type:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="sale_type_id"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">payment gateway:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="payment_gateway"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">payment type:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="payment_type"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">remaining amount:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="remaining_amount"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">balance:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="balance"></h6>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="1">
                                                        <h6 class="m-0 text-right">comment:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="comment"></h6>
                                                    </td>

                                                    <td colspan="1">
                                                        <h6 class="m-0 text-left">message:</h6>
                                                    </td>
                                                    <td>
                                                        <h6 id="message"></h6>
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
    <script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).find('.select2').select2({
            dropdownParent: $('#modal')
        });
    </script>

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
            btnDetail = $('.btn-detail');
            var table = $('#payments').DataTable({
                ajax: route('payment.trashed'),
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
                        data: 'customer_name',
                        name: 'customer_name'
                    },
                    {
                        data: 'customer_email',
                        name: 'customer_email'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'category',
                        name: 'category'
                    },
                    {
                        data: 'payment_gateway',
                        name: 'payment_gateway'
                    },
                    {
                        data: 'sale_type',
                        name: 'sale_type'
                    },
                    {
                        data: 'deleted_at',
                        name: 'deleted_at'
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

            $(document).on('click', '.btn-view', function() {
                $.ajax({
                    url: route('payment.detail.view',[1]),
                    type: "post",
                    data: {
                        id: $(this).data('id')
                    },
                    success: function(data) {
                        $('#id').html(data.id);
                        $('#customer_id ').html(data.customer.first_name + " " + data.customer
                            .last_name);
                        $('#item_name').html(data.item_name);
                        $('#price').html(data.price);
                        $('#discount').html(data.discount);
                        $('#item_description').html(data.item_description);
                        $('#converted_amount').html(data.converted_amount);
                        $('#currency').html(data.currency.currency_name);
                        $('#category_id').html(data.category.name);
                        $('#coupon_id').html(data.coupon_id);
                        $('#sale_type_id').html(data.sale_type.name);
                        $('#payment_gateway').html(data.payment_gateway);
                        $('#payment_type').html(data.payment_type);
                        $('#remaining_amount').html(data.remaining_amount);
                        $('#balance').html(data.balance);
                        $('#comment').html(data.comment);
                        $('#message').html(data.message);
                    }
                });
            });
            $(document).on('click', '.btn-edit', function() {
                btnSave.hide();
                btnView.hide();
                btnDetail.hide();
                btnUpdate.show();


                $.ajax({
                    url: route('payment.edit'),
                    type: "post",
                    data: {
                        id: $(this).data('id')
                    },

                    success: function(data) {
                        var customer = "";
                        var currency = "";
                        var categories = "";
                        var saletypeies = "";
                        var payment_typies = "";

                        for (let i = 0; i < data.customer.length; i++) {
                            console.log(data.customer[i]);
                            if (data.customer[i].id == data.customer_id) {
                                customer += '<option value="' + data.customer[i].id +
                                    '" selected>' + data.customer[i].first_name + '</option>';
                            } else {
                                customer += '<option value="' + data.customer[i].id + '">' +
                                    data.customer[i].first_name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.currency.length; i++) {
                            console.log(data.currency[i]);
                            if (data.currency[i].id == data.currency) {
                                currency += '<option value="' + data.currency[i].id +
                                    '" selected>' + data.currency[i].currency_name +
                                    '</option>';
                            } else {
                                currency += '<option value="' + data.currency[i].id + '">' +
                                    data.currency[i].currency_name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.categories.length; i++) {
                            console.log(data.categories[i]);
                            if (data.categories[i].id == data.category_id) {
                                categories += '<option value="' + data.categories[i].id +
                                    '" selected>' + data.categories[i].name + '</option>';
                            } else {
                                categories += '<option value="' + data.categories[i].id + '">' +
                                    data.categories[i].name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.saletypeies.length; i++) {
                            console.log(data.saletypeies[i]);
                            if (data.saletypeies[i].id == data.sale_type_id) {
                                saletypeies += '<option value="' + data.saletypeies[i].id +
                                    '" selected>' + data.saletypeies[i].name + '</option>';
                            } else {
                                saletypeies += '<option value="' + data.saletypeies[i].id +
                                    '">' + data.saletypeies[i].name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.payment_typies.length; i++) {
                            console.log(data.payment_typies[i]);
                            if (data.payment_typies[i].id == data.payment_type) {
                                payment_typies += '<option value="' + data.payment_typies[i]
                                    .id + '" selected>' + data.payment_typies[i].payment_type +
                                    '</option>';
                            } else {
                                payment_typies += '<option value="' + data.payment_typies[i]
                                    .id + '">' + data.payment_typies[i].payment_type +
                                    '</option>';
                            }

                        }
                        form.find('select[name="customer_id"]').html(customer);
                        form.find('select[name="category_id"]').html(categories);
                        form.find('select[name="sale_type_id"]').html(saletypeies);
                        form.find('select[name="payment_type"]').html(payment_typies);
                        form.find('select[name="currency"]').html(currency);
                        form.find('input[name="item_nmae"]').val(data.item_nmae)
                        form.find('input[name="price"]').val(data.price)
                        form.find('input[name="discount"]').val(data.discount)
                        form.find('input[name="coupon_id"]').val(data.coupon_id)
                        CKEDITOR.instances['item_description'].setData(data.item_description)
                        form.find('input[name="converted_amount"]').val(data.converted_amount)
                        form.find('input[name="item_name"]').val(data.item_name)
                        form.find('input[name="payment_gateway"]').val(data.payment_gateway)
                        form.find('input[name="remaining_amount"]').val(data.remaining_amount)
                        form.find('input[name="balance"]').val(data.balance)
                        form.find('input[name="comment"]').val(data.comment)
                        form.find('input[name="message"]').val(data.message)

                        $('select[name="customer_id"]').removeAttr('readonly');
                        $('select[name="category_id"]').removeAttr('readonly');
                        $('select[name="sale_type_id"]').removeAttr('readonly');
                        $('select[name="payment_type"]').removeAttr('readonly');
                        $('select[name="currency"]').removeAttr('readonly');
                        $('input[name="item_name"]').removeAttr('readonly');
                        $('input[name="price"]').removeAttr('readonly');
                        $('input[name="discount"]').removeAttr('readonly');
                        $('input[name="coupon_id"]').removeAttr('readonly');
                        $('textarea[name="item_description"]').removeAttr('readonly');
                        $('input[name="converted_amount"]').removeAttr('readonly');
                        $('input[name="payment_gateway"]').removeAttr('readonly');
                        $('input[name="remaining_amount"]').removeAttr('readonly');
                        $('input[name="balance"]').removeAttr('readonly');
                        $('input[name="comment"]').removeAttr('readonly');
                        $('input[name="message"]').removeAttr('readonly');


                    }

                });

                modal.find('.modal-title').text('Update Payment')
                modal.find('.modal-footer button[type="submit"]').text('Update')

                var rowData = table.row($(this).parents('tr')).data()
                form.find('input[name="id"]').val(rowData.id)
                form.find('select[name="customer_id"]').val(rowData.customer_id);
                form.find('select[name="category_id"]').val(rowData.category_id);
                form.find('select[name="sale_type_id"]').val(rowData.sale_type_id);
                form.find('select[name="payment_type"]').val(rowData.payment_type);
                form.find('select[name="currency"]').val(rowData.currency);
                form.find('input[name="item_nmae"]').val(rowData.item_nmae)
                form.find('input[name="price"]').val(rowData.price)
                form.find('input[name="discount"]').val(rowData.discount)
                form.find('input[name="coupon_id"]').val(rowData.coupon_id)
                form.find('textarea[name="item_description"]').val(rowData.item_description)
                form.find('input[name="converted_amount"]').val(rowData.converted_amount)
                form.find('input[name="item_name"]').val(rowData.item_name)
                form.find('input[name="payment_gateway"]').val(rowData.payment_gateway)
                form.find('input[name="remaining_amount"]').val(rowData.remaining_amount)
                form.find('input[name="balance"]').val(rowData.balance)
                form.find('input[name="comment"]').val(rowData.comment)
                form.find('input[name="message"]').val(rowData.message)

                modal.modal()

            });

            $(document).on('click', '.btn-restore', function() {
                btnSave.hide();
                btnView.hide();
                btnDetail.hide();
                btnUpdate.show();


                $.ajax({
                    url: route('payment.restore'),
                    type: "post",
                    data: {
                        id: $(this).data('id')
                    },

                    success: function(data) {
                        var customer = "";
                        var currency = "";
                        var categories = "";
                        var saletypeies = "";
                        var payment_typies = "";

                        for (let i = 0; i < data.customer.length; i++) {
                            console.log(data.customer[i]);
                            if (data.customer[i].id == data.customer_id) {
                                customer += '<option value="' + data.customer[i].id +
                                    '" selected>' + data.customer[i].first_name + '</option>';
                            } else {
                                customer += '<option value="' + data.customer[i].id + '">' +
                                    data.customer[i].first_name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.currency.length; i++) {
                            console.log(data.currency[i]);
                            if (data.currency[i].id == data.currency) {
                                currency += '<option value="' + data.currency[i].id +
                                    '" selected>' + data.currency[i].currency_name +
                                    '</option>';
                            } else {
                                currency += '<option value="' + data.currency[i].id + '">' +
                                    data.currency[i].currency_name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.categories.length; i++) {
                            console.log(data.categories[i]);
                            if (data.categories[i].id == data.category_id) {
                                categories += '<option value="' + data.categories[i].id +
                                    '" selected>' + data.categories[i].name + '</option>';
                            } else {
                                categories += '<option value="' + data.categories[i].id + '">' +
                                    data.categories[i].name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.saletypeies.length; i++) {
                            console.log(data.saletypeies[i]);
                            if (data.saletypeies[i].id == data.sale_type_id) {
                                saletypeies += '<option value="' + data.saletypeies[i].id +
                                    '" selected>' + data.saletypeies[i].name + '</option>';
                            } else {
                                saletypeies += '<option value="' + data.saletypeies[i].id +
                                    '">' + data.saletypeies[i].name + '</option>';
                            }

                        }
                        for (let i = 0; i < data.payment_typies.length; i++) {
                            console.log(data.payment_typies[i]);
                            if (data.payment_typies[i].id == data.payment_type) {
                                payment_typies += '<option value="' + data.payment_typies[i]
                                    .id + '" selected>' + data.payment_typies[i].payment_type +
                                    '</option>';
                            } else {
                                payment_typies += '<option value="' + data.payment_typies[i]
                                    .id + '">' + data.payment_typies[i].payment_type +
                                    '</option>';
                            }

                        }
                        form.find('select[name="customer_id"]').html(customer);
                        form.find('select[name="category_id"]').html(categories);
                        form.find('select[name="sale_type_id"]').html(saletypeies);
                        form.find('select[name="payment_type"]').html(payment_typies);
                        form.find('select[name="currency"]').html(currency);
                        form.find('input[name="item_nmae"]').val(data.item_nmae)
                        form.find('input[name="price"]').val(data.price)
                        form.find('input[name="discount"]').val(data.discount)
                        form.find('input[name="coupon_id"]').val(data.coupon_id)
                        CKEDITOR.instances['item_description'].setData(data.item_description)
                        form.find('input[name="converted_amount"]').val(data.converted_amount)
                        form.find('input[name="item_name"]').val(data.item_name)
                        form.find('input[name="payment_gateway"]').val(data.payment_gateway)
                        form.find('input[name="remaining_amount"]').val(data.remaining_amount)
                        form.find('input[name="balance"]').val(data.balance)
                        form.find('input[name="comment"]').val(data.comment)
                        form.find('input[name="message"]').val(data.message)

                        $('select[name="customer_id"]').removeAttr('readonly');
                        $('select[name="category_id"]').removeAttr('readonly');
                        $('select[name="sale_type_id"]').removeAttr('readonly');
                        $('select[name="payment_type"]').removeAttr('readonly');
                        $('select[name="currency"]').removeAttr('readonly');
                        $('input[name="item_name"]').removeAttr('readonly');
                        $('input[name="price"]').removeAttr('readonly');
                        $('input[name="discount"]').removeAttr('readonly');
                        $('input[name="coupon_id"]').removeAttr('readonly');
                        $('textarea[name="item_description"]').removeAttr('readonly');
                        $('input[name="converted_amount"]').removeAttr('readonly');
                        $('input[name="payment_gateway"]').removeAttr('readonly');
                        $('input[name="remaining_amount"]').removeAttr('readonly');
                        $('input[name="balance"]').removeAttr('readonly');
                        $('input[name="comment"]').removeAttr('readonly');
                        $('input[name="message"]').removeAttr('readonly');


                    }

                });

                modal.find('.modal-title').text('Update Payment')
                modal.find('.modal-footer button[type="submit"]').text('Update')

                var rowData = table.row($(this).parents('tr')).data()
                form.find('input[name="id"]').val(rowData.id)
                form.find('select[name="customer_id"]').val(rowData.customer_id);
                form.find('select[name="category_id"]').val(rowData.category_id);
                form.find('select[name="sale_type_id"]').val(rowData.sale_type_id);
                form.find('select[name="payment_type"]').val(rowData.payment_type);
                form.find('select[name="currency"]').val(rowData.currency);
                form.find('input[name="item_nmae"]').val(rowData.item_nmae)
                form.find('input[name="price"]').val(rowData.price)
                form.find('input[name="discount"]').val(rowData.discount)
                form.find('input[name="coupon_id"]').val(rowData.coupon_id)
                form.find('textarea[name="item_description"]').val(rowData.item_description)
                form.find('input[name="converted_amount"]').val(rowData.converted_amount)
                form.find('input[name="item_name"]').val(rowData.item_name)
                form.find('input[name="payment_gateway"]').val(rowData.payment_gateway)
                form.find('input[name="remaining_amount"]').val(rowData.remaining_amount)
                form.find('input[name="balance"]').val(rowData.balance)
                form.find('input[name="comment"]').val(rowData.comment)
                form.find('input[name="message"]').val(rowData.message)

                modal.modal()

            });

            btnUpdate.click(function() {
                if (!confirm("Are you sure?")) return;
                var formData = form.serialize();
                var updateId = form.find('input[name="id"]').val();
                $.ajax({
                    url: route('payment.update'),
                    type: "POST",
                    data: formData,

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
                    confirmButtonText: "Yes, Update it!",
                    cancelButtonText: "No, cancel!",
                    confirmButtonClass: "btn btn-success mt-2",
                    cancelButtonClass: "btn btn-danger ms-2 mt-2",
                    buttonsStyling: !1
                }).then(function(t) {
                    if (t.value) {
                        console.log(el);
                        if (!id) return;
                        $.ajax({
                            url: route('payment.delete'),
                            type: "POST",
                            data: {
                                id: id
                            },
                            dataType: 'JSON',

                            success: function(data) {
                                if($.isEmptyObject(data.error)){
                                let table = $('#payments').DataTable();
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
        $(document).on('click','.payment_status',function(){

            let id = $(this).attr("data-id");
            let status = $(this).is(':checked');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, Updated it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    if(!id) return;
                    $.ajax({
                        url: route('payment.status',[id]),
                        type: "POST",
                        data: {
                            id: id,
                            status: status
                        },
                        dataType: 'JSON',

                        success: function (data) {
                            showMsg("success", data.message);
                            table.ajax().reload();
                        }
                    });

                }

            })
        })
    </script>
@endpush
