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
            <div class="col-md-12 message"></div>
            <div class="col-md-12">
                <div class="card">
                <div class="card-body">
                    <h3>
                        <a href="{{route('product-bundle.add')}}" class="btn btn-xs btn-success float-right add">ADD PRODUCT BUNDLE</a>
                        <a href="{{ route('product-bundle.list') }}" class="btn btn-xs btn-primary">ALL PRODUCT BUNDLE</a>
                        <a href="{{ route('product-bundle.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                    </h3>
                    <hr>
                    <table id="productBundle" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bundle Name</th>
                                <th>Title</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th width="22%">Action</th>
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
                                            <label for="bundles_name">Bundles Name</label>
                                            <input type="text" name="bundles_name" id="bundles_name" placeholder="Enter Bundles Name Here" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" name="title" placeholder="Enter Title Here" id="title" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="products">Products</label><br/>
                                            <select class="form-control input-sm select2 bundleProduct" name="products[]" id="products" multiple style="width:100%">
                                            <option value="" selected disabled>Select Products</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="category_id">Categories</label><br/>
                                            <select class="form-control input-sm select2" name="category_id" id="category_id" style="width:100%">
                                            <option value="" selected disabled>Select Categories</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="discount">Discount</label>
                                            <input type="text" name="discount" id="discount" placeholder="Enter Discount Here" class="form-control input-sm">
                                        </div>
                                        <div class="form-group">
                                            <label for="discount_type">Discount Type</label>
                                            <select class="form-control input-sm select2 discount_type" name="discount_type" id="select2" style="width: 100%;">
                                            <option value="" selected disabled>Select Discount Type</option>
                                            </select>
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
                            <div class="modal-content" >
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderdetailsModalLabel">  View Product Bundle</h5>
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
                                                            <h5 class="text-truncate font-size-14" > Name</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="name"></h5>
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
                                                            <h5 class="text-truncate font-size-14 " id="title"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Discount</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="discount"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Discount Type</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" id="discount_type"></h5>
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
                    <div class="modal fade orderdetails" id="product-lists" tabindex="-1" role="dialog" aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content" style="width: 108%">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="orderdetailsModalLabel">  View Product</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="datatable align-middle table-nowrap" id="datatable">
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
                                                            <h5 class="text-truncate font-size-14 " id="proid"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" > Name</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="product_name"></h5>
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
                                                            <h5 class="text-truncate font-size-14 " id="product_title"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Price</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12" id="product_price"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Description</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" id="product_description"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Currency</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" id="product_currency"></h5>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">
                                                        <div>
                                                            <h5 class="text-truncate font-size-14" >Category</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12" id="product_category"></h5>
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
@push("customScripts")
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

        var table = $('#productBundle').DataTable({
                ajax: route('product-bundle.list'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'title', name: 'title'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'status', name: 'status'},
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
                url: route('product-bundle.detail.view'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    $('#id').html(data.product_bundle.id);
                    $('#name').html(data.product_bundle.name);
                    $('#title').html(data.product_bundle.title);
                    $('#discount').html(data.product_bundle.discount);
                    $('#discount_type').html(data.product_bundle.discount_type)
                }
            });
        });
        $(document).on('click','.btn-product' , function(){

            function createTable(headers, data, heading) {
                let creatingTable;
                let table = "<table class='tbl-product-lists table align-middle table-nowrap'>";
                let theads = "<thead>";
                let tbody = "<tbody>";
                let tRow = "<tr>";

                creatingTable = table;
                creatingTable += tRow;

                // creatingTable += "<tr><th colspan='"+headers.length+"'>"+heading+"</th></tr>";

                for(let i=0; i < headers.length; i++) {
                    creatingTable += "<td><b>" + headers[i] + "</b></td>";
                }

                creatingTable += "</tr>";

                creatingTable += tbody;
                for(let j=0; j<data.length; j++) {
                    creatingTable += tRow;
                        let arrkeys = Object.keys(data[j]);

                        for(let key of arrkeys) {
                            if(key=='name' || key=='price') {
                                creatingTable += "<td><h5 class='text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12'>" + data[j][key] + "</h5></td>";
                            } else {
                                creatingTable += "<td>" + data[j][key] + "</td>";
                            }
                        }
                    creatingTable += "</tr>";
                }

                creatingTable += "</tbody>";
                creatingTable += "</table>";

                return creatingTable;
            }

            $.ajax({
                url: route('product-display.view','yes'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    let products = createTable(["ID", "Name", "Title","Price","Description"],data.products);
                    $("#product-lists").find(".modal-body").html(products);

                    $("table.tbl-product-lists").each(function() {
                        var $this = $(this);
                        var newrows = [];
                        $this.find("tr").each(function(){
                            var i = 0;
                            $(this).find("td").each(function(){
                                i++;
                                if(newrows[i] === undefined) { newrows[i] = $("<tr></tr>"); }
                                newrows[i].append($(this));
                            });
                        });
                        $this.find("tr").remove();
                        $.each(newrows, function(){
                            $this.append(this);
                        });
                    });
                }
            });
        });

        // $(document).on('click','.btn-edit',function() {
        //     btnSave.hide();
        //     btnView.hide();
        //     btnUpdate.show();
        //     $("#imgdiv").show();

        //     $.fn.modal.Constructor.prototype.enforceFocus = function() {};

        //     $.ajax({
        //         url: route('product-bundle.freshdata'),
        //         type: "post",
        //         data: {id: $(this).data('id')},

        //         success: function (data) {
        //             var bundles_discount_type ='';
        //             var catogories = "";
        //             for(let i = 0; i<data.categories.length; i++ ) {
        //                 if(data.categories[i].id == data.category_id) {
        //                     catogories += '<option value="'+data.categories[i].id+'" selected>'+data.categories[i].name+'</option>';
        //                 } else {
        //                     catogories += '<option value="'+data.categories[i].id+'">'+data.categories[i].name+'</option>';
        //                 }
        //             }
        //             bundles_discount_type += '<option value="flat" '+ ( data.discount_type=='flat'  ? 'selected' : ' ') +'>Flat</option>';
        //             bundles_discount_type += '<option value="percent" '+ ( data.discount_type=='percent'  ? 'selected' : ' ') +'>Percent (%)</option>';

        //             $('.bundleProduct').html(data.html);
        //             form.find('select[name="discount_type"]').html(bundles_discount_type)
        //             form.find('input[name="bundles_name"]').val(data.bundles_name)
        //             form.find('select[name="category_id"]').html(catogories)
        //             form.find('input[name="title"]').val(data.title)
        //             form.find('input[name="discount"]').val(data.discount)
        //             $('select[name="products"]').removeAttr('disabled');
        //             $('select[name="category_id"]').removeAttr('disabled');
        //             $('input[name="bundles_name"]').removeAttr('readonly');
        //             $('input[name="title"]').removeAttr('readonly');
        //             $('input[name="discount"]').removeAttr('readonly');
        //             $('select[name="discount_type"]').removeAttr('readonly');
        //         }

        //     });

        //     modal.find('.modal-title').text('Update Product Bundles')
        //     modal.find('.modal-footer button[type="submit"]').text('Update')

        //     var rowData =  table.row($(this).parents('tr')).data()



        //     form.find('input[name="id"]').val(rowData.id)
        //     form.find('select[name="products"]').val(rowData.products)
        //     form.find('select[name="category_id"]').val(rowData.category_id)
        //     form.find('input[name="bundles_name"]').val(rowData.bundles_name)
        //     form.find('input[name="title"]').val(rowData.title)
        //     form.find('input[name="discount"]').val(rowData.discount)
        //     form.find('select[name="discount_type"]').val(rowData.discount_type)

        //     modal.modal()

        // });

        // form.submit(function(event){
        //     event.preventDefault();
        //     if(!confirm("Are you sure?")) return;
        //     var formData = new FormData(this);
        //     var updateId = form.find('input[name="id"]').val();
        //     $.ajax({
        //         url: route('product-bundle.update'),
        //         type: "POST",
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: function (data) {
        //             $("#modal").modal('hide');
        //             table.ajax.reload( null, false );
        //         }
        //     }); //end ajax

        // })
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
                confirmButtonText: "Yes, Updated it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    console.log(el);
                    if(!id) return;
                    $.ajax({
                        url: route('product-bundle.remove'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#productBundle').DataTable();
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
    $(document).on('click','.productBundle_status',function(){

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
                    url: route('product-bundle.status',[id]),
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
