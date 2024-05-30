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
        <div class="col-md-12">
            <div class="card">
            <div class="card-body">
                <h3>
                    @can('PaymentLinkGenerator-Create')
                      <a href="{{ route('payment-link-generator.add')}}" class="btn btn-xs btn-success float-right add">CREATE LINK</a>
                      <a href="{{ route('payment-link-generator.list') }}" class="btn btn-xs btn-primary">ALL LINKS</a>
                      <a href="{{ route('payment-link-generator.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                    @endcan
                </h3>
                <hr>
                <table id="paymentlink" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th width="1%">Token</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Payment Gateway</th>
                            <th>Sale Type</th>
                            <th>Deletd At</th>
                            <th>Time Left</th>
                            <th>Status</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                </table>
                <div class="modal fade orderdetailsModal" id="modal" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content" style="width: 700px">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel">  View Payment Link Generator</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive">
                                    <table class="table align-middle table-nowrap">
                                        <thead>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 >ID :</h6>
                                                </td>
                                                <td>
                                                    <h6 id="id" class="badge badge-soft-success font-size-14"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">Customer Name:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="customer_id" class="m-0 text-right badge badge-soft-success font-size-14"></h6>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">item name:</h6>
                                                </td>
                                                <td>
                                                    <h6 id="item_name" class="badge badge-soft-success font-size-14"></h6>
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
                                                        <h5 class="text-truncate font-size-14">discount type:</h5>
                                                    </div>
                                                </td>
                                                <th scope="row">
                                                    <div>
                                                    <h6 id="discount_type"></h6>
                                                    </div>
                                                </th>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">discount:</h6>
                                                </td>
                                                <td>
                                                <h6 id="discount"></h6>
                                                </td>
                                            </tr>



                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">original price:</h6>
                                                </td>
                                                <td>
                                                <h6 id="original_price"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">item description:</h6>
                                                </td>
                                                <td>
                                                <h6 id="item_description"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">converted amount:</h6>
                                                </td>
                                                <td>
                                                <h6 id="converted_amount"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">currency:</h6>
                                                </td>
                                                <td>
                                                <h6 id="currency"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">category id:</h6>
                                                </td>
                                                <td>
                                                <h6 id="category_id"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">coupon id:</h6>
                                                </td>
                                                <td>
                                                <h6 id="coupon_id"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">sale type id:</h6>
                                                </td>
                                                <td>
                                                <h6 id="sale_type_id"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">payment gateway:</h6>
                                                </td>
                                                <td>
                                                <h6 id="payment_gateway"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">payment type:</h6>
                                                </td>
                                                <td>
                                                <h6 id="payment_type"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">remaining amount:</h6>
                                                </td>
                                                <td>
                                                <h6 id="remaining_amount"></h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">
                                                    <h6 class="m-0 text-right">balance:</h6>
                                                </td>
                                                <td>
                                                <h6 id="balance"></h6>
                                                </td>

                                                <td colspan="1">
                                                    <h6 class="m-0 text-left">comment:</h6>
                                                </td>
                                                <td>
                                                <h6 id="comment"></h6>
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
            btnDetail= $('.btn-detail');
        var table = $('#paymentlink').DataTable({
                ajax: route('payment-link-generator.list.trashed'),
                serverSide: true,
                processing: true,
                scrollX: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'token', name: 'token'},
                    {data: 'item', name: 'item'},
                    {data: 'price', name: 'price'},
                    {data: 'category', name: 'category'},
                    {data: 'payment_gateway', name: 'payment_gateway'},
                    {data: 'sale_type', name: 'sale_type'},
                    {data: 'deleted_at', name: 'deleted_at'},
                    /* {data: 'valid_till', name: 'valid_till'}, */
                    {data: 'time_left', name: 'time_left'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action'},
                ],
                'createdRow': function(row, data) {
                    $(row).attr('id', data.id)
                },
                "bDestroy": true
            });

        $(document).on('click','.btn-view',function(){
            $.ajax({
                url: route('payment-link-generator.detail.view',[1]),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    console.log(data);
                    $('#id').html(data.id);
                    $('#customer_id').html(data.customer.first_name +" "+ data.customer.last_name );
                    $('#item_name').html(data.item_name);
                    $('#price').html(data.price);
                    $('#discount_type').html(data.discount_type);
                    $('#discount').html(data.discount);
                    $('#original_price').html(data.original_price);
                    $('#item_description').html(data.item_description);
                    $('#converted_amount').html(data.converted_amount);
                    $('#currency').html(data.countrycurrencies.currency_name);
                    $('#category_id').html(data.categories.name);
                    $('#coupon_id').html(data.coupon_id);
                    $('#sale_type_id').html(data.sale_type_id);
                    $('#payment_gateway').html(data.payment_gateway);
                    $('#payment_type').html(data.payment_type);
                    $('#remaining_amount').html(data.remaining_amount);
                    $('#balance').html(data.balance);
                    $('#comment').html(data.comment);
                }
            });
        });
        $(document).on('click','.btn-edit',function(){
            btnSave.hide();
            btnView.hide();
            btnDetail.hide();
            btnUpdate.show();


            $.ajax({
                url: route('payment-link-generator.edit'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {
                    var customer = "";
                    var currency = "";
                    var saletypes = "";
                    var categories = "";
                    var paymentGateways = "";
                    var paymentlik = "";
                    var paymentlinks = "";

                    for(let i = 0; i<data.paymentlik.length; i++ ) {
                            console.log(data.paymentlik[i]);
                        if(data.paymentlik[i].id == data.sale_type_id ) {
                            paymentlik += '<option value="'+data.paymentlik[i].id+'" selected>'+data.paymentlik[i].discount_type+'</option>';
                        } else {
                            paymentlik += '<option value="'+data.paymentlik[i].id+'">'+data.paymentlik[i].discount_type+'</option>';
                        }

                    }

                    for(let i = 0; i<data.categories.length; i++ ) {
                        if(data.categories[i].id == data.category_id) {
                            categories += '<option value="'+data.categories[i].id+'" selected>'+data.categories[i].name+'</option>';
                        } else {
                            categories += '<option value="'+data.categories[i].id+'">'+data.categories[i].name+'</option>';
                        }

                    }
                    for(let i = 0; i<data.paymentGateways.length; i++ ) {
                        if(data.paymentGateways[i].id == data.payment_gateway) {
                            paymentGateways += '<option value="'+data.paymentGateways[i].id+'" selected>'+data.paymentGateways[i].payment_gateway+'</option>';
                        } else {
                            paymentGateways += '<option value="'+data.paymentGateways[i].id+'">'+data.paymentGateways[i].payment_gateway+'</option>';
                        }

                    }
                    for(let i = 0; i<data.paymentlinks.length; i++ ) {
                        if(data.paymentlinks[i].id == data.payment_type) {
                            paymentlinks += '<option value="'+data.paymentlinks[i].id+'" selected>'+data.paymentlinks[i].payment_type+'</option>';
                        } else {
                            paymentlinks += '<option value="'+data.paymentlinks[i].id+'">'+data.paymentlinks[i].payment_type+'</option>';
                        }

                    }
                    for(let i = 0; i<data.customer.length; i++ ) {
                        if(data.customer[i].id == data.customer_id) {
                            customer += '<option value="'+data.customer[i].id+'" selected>'+data.customer[i].first_name+'</option>';
                        } else {
                            customer += '<option value="'+data.customer[i].id+'">'+data.customer[i].first_name+'</option>';
                        }

                    }

                    for(let i = 0; i<data.currency.length; i++ ) {
                        if(data.currency[i].id == data.currency_name) {
                            currency += '<option value="'+data.currency[i].id+'" selected>'+data.currency[i].currency_name+'</option>';
                        } else {
                            currency += '<option value="'+data.currency[i].id+'">'+data.currency[i].currency_name+'</option>';
                        }

                    }
                    for(let i = 0; i<data.saletypes.length; i++ ) {
                        if(data.saletypes[i].id == data.sale_type_id ) {
                            saletypes += '<input value="'+data.saletypes[i].id+'" checked>'+data.saletypes[i].name;
                        } else {
                            saletypes += '<input value="'+data.saletypes[i].id+'">'+data.saletypes[i].name;
                        }

                    }


                    form.find('select[name="customer_id"]').html(customer);
                    form.find('select[name="currency"]').html(currency);
                    form.find('select[name="category_id"]').html(categories);
                    form.find('select[name="payment_gateway"]').html(paymentGateways);
                    form.find('select[name="payment_type"]').html(paymentlinks);
                    form.find('select[name="discount_type"]').html(paymentlik);
                    form.find('select[name="sale_type"]').val(saletypes)
                    form.find('input[name="item_name"]').val(data.item_name)
                    form.find('input[name="price"]').val(data.price)
                    form.find('input[name="discount"]').val(data.discount)
                    form.find('input[name="item_description"]').val(data.item_description)
                    form.find('input[name="comment"]').val(data.comment)

                    $('select[name="customer_id"]').removeAttr('readonly');
                    $('input[name="price"]').removeAttr('readonly');
                    $('input[name="item_name"]').removeAttr('readonly');
                    $('input[name="discount"]').removeAttr('readonly');
                    $('input[name="item_description"]').removeAttr('readonly');
                    $('select[name="currency"]').removeAttr('readonly');
                    $('select[name="category_id"]').removeAttr('readonly');
                    $('select[name="discount_type"]').removeAttr('readonly');
                    $('select[name="sale_type"]').removeAttr('readonly');
                    $('select[name="payment_type"]').removeAttr('readonly');
                    $('select[name="payment_gateway"]').removeAttr('readonly');
                    $('input[name="comment"]').removeAttr('readonly');


                }

            });

            modal.find('.modal-title').text('Update Payment')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('select[name="customer_id"]').val(rowData.customer_id)
            form.find('input[name="item_name"]').val(rowData.item_name)
            form.find('input[name="price"]').val(rowData.price)
            form.find('input[name="discount"]').val(rowData.discount)
            form.find('input[name="item_description"]').val(rowData.item_description)
            form.find('select[name="currency"]').val(rowData.currency)
            form.find('select[name="category_id"]').val(rowData.category_id)
            form.find('select[name="discount_type"]').val(rowData.discount_type)
            form.find('select[name="sale_type"]').val(rowData.sale_type)
            form.find('select[name="payment_type"]').val(rowData.payment_type)
            form.find('select[name="payment_gateway"]').val(rowData.payment_gateway)
            form.find('input[name="comment"]').val(rowData.comment)

            modal.modal()

        });
        $(document).on('click','.btn-restore',function(){
            btnSave.hide();
            btnView.hide();
            btnDetail.hide();
            btnUpdate.show();


            $.ajax({
                url: route('payment-link-generator.restore'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {
                    var customer = "";
                    var currency = "";
                    var saletypes = "";
                    var categories = "";
                    var paymentGateways = "";
                    var paymentlik = "";
                    var paymentlinks = "";

                    for(let i = 0; i<data.paymentlik.length; i++ ) {
                            console.log(data.paymentlik[i]);
                        if(data.paymentlik[i].id == data.sale_type_id ) {
                            paymentlik += '<option value="'+data.paymentlik[i].id+'" selected>'+data.paymentlik[i].discount_type+'</option>';
                        } else {
                            paymentlik += '<option value="'+data.paymentlik[i].id+'">'+data.paymentlik[i].discount_type+'</option>';
                        }

                    }

                    for(let i = 0; i<data.categories.length; i++ ) {
                        if(data.categories[i].id == data.category_id) {
                            categories += '<option value="'+data.categories[i].id+'" selected>'+data.categories[i].name+'</option>';
                        } else {
                            categories += '<option value="'+data.categories[i].id+'">'+data.categories[i].name+'</option>';
                        }

                    }
                    for(let i = 0; i<data.paymentGateways.length; i++ ) {
                        if(data.paymentGateways[i].id == data.payment_gateway) {
                            paymentGateways += '<option value="'+data.paymentGateways[i].id+'" selected>'+data.paymentGateways[i].payment_gateway+'</option>';
                        } else {
                            paymentGateways += '<option value="'+data.paymentGateways[i].id+'">'+data.paymentGateways[i].payment_gateway+'</option>';
                        }

                    }
                    for(let i = 0; i<data.paymentlinks.length; i++ ) {
                        if(data.paymentlinks[i].id == data.payment_type) {
                            paymentlinks += '<option value="'+data.paymentlinks[i].id+'" selected>'+data.paymentlinks[i].payment_type+'</option>';
                        } else {
                            paymentlinks += '<option value="'+data.paymentlinks[i].id+'">'+data.paymentlinks[i].payment_type+'</option>';
                        }

                    }
                    for(let i = 0; i<data.customer.length; i++ ) {
                        if(data.customer[i].id == data.customer_id) {
                            customer += '<option value="'+data.customer[i].id+'" selected>'+data.customer[i].first_name+'</option>';
                        } else {
                            customer += '<option value="'+data.customer[i].id+'">'+data.customer[i].first_name+'</option>';
                        }

                    }

                    for(let i = 0; i<data.currency.length; i++ ) {
                        if(data.currency[i].id == data.currency_name) {
                            currency += '<option value="'+data.currency[i].id+'" selected>'+data.currency[i].currency_name+'</option>';
                        } else {
                            currency += '<option value="'+data.currency[i].id+'">'+data.currency[i].currency_name+'</option>';
                        }

                    }
                    for(let i = 0; i<data.saletypes.length; i++ ) {
                        if(data.saletypes[i].id == data.sale_type_id ) {
                            saletypes += '<input value="'+data.saletypes[i].id+'" checked>'+data.saletypes[i].name;
                        } else {
                            saletypes += '<input value="'+data.saletypes[i].id+'">'+data.saletypes[i].name;
                        }

                    }


                    form.find('select[name="customer_id"]').html(customer);
                    form.find('select[name="currency"]').html(currency);
                    form.find('select[name="category_id"]').html(categories);
                    form.find('select[name="payment_gateway"]').html(paymentGateways);
                    form.find('select[name="payment_type"]').html(paymentlinks);
                    form.find('select[name="discount_type"]').html(paymentlik);
                    form.find('select[name="sale_type"]').val(saletypes)
                    form.find('input[name="item_name"]').val(data.item_name)
                    form.find('input[name="price"]').val(data.price)
                    form.find('input[name="discount"]').val(data.discount)
                    form.find('input[name="item_description"]').val(data.item_description)
                    form.find('input[name="comment"]').val(data.comment)

                    $('select[name="customer_id"]').removeAttr('readonly');
                    $('input[name="price"]').removeAttr('readonly');
                    $('input[name="item_name"]').removeAttr('readonly');
                    $('input[name="discount"]').removeAttr('readonly');
                    $('input[name="item_description"]').removeAttr('readonly');
                    $('select[name="currency"]').removeAttr('readonly');
                    $('select[name="category_id"]').removeAttr('readonly');
                    $('select[name="discount_type"]').removeAttr('readonly');
                    $('select[name="sale_type"]').removeAttr('readonly');
                    $('select[name="payment_type"]').removeAttr('readonly');
                    $('select[name="payment_gateway"]').removeAttr('readonly');
                    $('input[name="comment"]').removeAttr('readonly');


                }

            });

            modal.find('.modal-title').text('Update Payment')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('select[name="customer_id"]').val(rowData.customer_id)
            form.find('input[name="item_name"]').val(rowData.item_name)
            form.find('input[name="price"]').val(rowData.price)
            form.find('input[name="discount"]').val(rowData.discount)
            form.find('input[name="item_description"]').val(rowData.item_description)
            form.find('select[name="currency"]').val(rowData.currency)
            form.find('select[name="category_id"]').val(rowData.category_id)
            form.find('select[name="discount_type"]').val(rowData.discount_type)
            form.find('select[name="sale_type"]').val(rowData.sale_type)
            form.find('select[name="payment_type"]').val(rowData.payment_type)
            form.find('select[name="payment_gateway"]').val(rowData.payment_gateway)
            form.find('input[name="comment"]').val(rowData.comment)

            modal.modal()

        });

        btnUpdate.click(function(){
            if(!confirm("Are you sure?")) return;
            var formData = form.serialize();
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('payment-link-generator.update'),
                type: "POST",
                data: formData,

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
                    if(!id) return;
                    $.ajax({
                        url: route('payment-link-generator.delete'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#paymentlink').DataTable();
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


 </script>
@endpush
