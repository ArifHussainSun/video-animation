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
                    @can('SubCategories-Create')
                    <a href="{{route('sub-category.add')}}" class="btn btn-xs btn-success float-right add">ADD SUBCATEGORY</a>
                    <a href="{{ route('sub-category.list') }}" class="btn btn-xs btn-primary">ALL SUBCATEGORY</a>
                    <a href="{{ route('sub-category.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                    @endcan
                </h3><hr>
                <table id="subCategory" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Short Description</th>
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
                                    <h5 class="modal-title" id="orderdetailsModalLabel"> View Sub Category</h5>
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
                                                            <h5 class="text-truncate font-size-14">Category</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12"
                                                                id="category"></h5>
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
                                                            <h5 class="text-truncate font-size-14 "
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
                                                            <h5 class="text-truncate font-size-14 ">Image</h5>
                                                        </div>
                                                    </th>
                                                    <td>
                                                        <div>
                                                            <img  src='' id="image" class="form-control input-sm" width="180px;" height="120" />
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

        var table = $('#subCategory').DataTable({
                ajax: route('sub-category.list.trashed'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'image', name: 'image'},
                    {data: 'title', name: 'title'},
                    {data: 'short_description', name: 'short_description'},
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
                url: route('sub-category.detail.view',[1]),
                type: "post",
                data: {
                    id: $(this).data('id')
                },
                success: function(data) {
                    if($.isEmptyObject(data.error)){
                        $('#id').html(data.id);
                        $('#category').html(data.categories.name);
                        $('#name').html(data.name);
                        $('#title').html(data.title);
                        $('#description').html(data.desc);
                        let image;
                        if(data?.image) {
                            image = '{{ URL::asset("/") }}' + data.image;
                        } else {
                            image = '{{ URL::asset("backend/assets/images/default/no-image.jpg") }}';

                        }
                        document.getElementById('image').src = image;
                    } else {
                        alert('data not Exit');
                    }
                }
            });
        });

        $(document).on('click','.btn-edit',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();
            $("#imgdiv").show();

            $.fn.modal.Constructor.prototype.enforceFocus = function() {};

            $.ajax({
                url: route('sub-category.edit'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {
                    var catogories = "";
                    var imageUrl = '{{ URL::asset("/") }}';
                    for(let i = 0; i<data.categories.length; i++ ) {
                            console.log(data.categories[i]);
                        if(data.categories[i].id == data.categories_id) {
                            catogories += '<option value="'+data.categories[i].id+'" selected>'+data.categories[i].name+'</option>';
                        } else {
                            catogories += '<option value="'+data.categories[i].id+'">'+data.categories[i].name+'</option>';
                        }

                    }
                    form.find('select[name="categories_id"]').html(catogories);
                    form.find('input[name="name"]').val(data.name)
                    form.find('input[name="title"]').val(data.title)
                    form.find('input[name="short_description"]').val(data.short_description)
                    form.find('input[name="desc"]').val(data.desc)
                    form.find('input[name="subcategorylink"]').val(data.subcategorylink)
                    form.find('img[id="edi_image"]').attr('src', imageUrl+"/"+data.image);
                    $('input[name="name"]').removeAttr('readonly');
                    $('input[name="title"]').removeAttr('readonly');
                    $('input[name="short_description"]').removeAttr('readonly');
                    $('input[name="desc"]').removeAttr('readonly');
                    $('input[name="subcategorylink"]').removeAttr('readonly');
                    $('input[name="image"]').removeAttr('readonly');
                    $('select[name="categories_id"]').removeAttr('disabled');



                }

            });

            modal.find('.modal-title').text('Update SubCategories')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()



            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            form.find('input[name="title"]').val(rowData.title)
            form.find('input[name="short_description"]').val(rowData.short_description)
            form.find('input[name="desc"]').val(rowData.desc)
            form.find('input[name="subcategorylink"]').val(rowData.subcategorylink)

            modal.modal()

        });

        $(document).on('click','.btn-restore',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();
            $("#imgdiv").show();

            $.fn.modal.Constructor.prototype.enforceFocus = function() {};

            $.ajax({
                url: route('sub-category.edit'),
                type: "get",
                data: {id: $(this).data('id')},

                success: function (data) {
                    var catogories = "";
                    var imageUrl = '{{ URL::asset("/") }}';
                    for(let i = 0; i<data.categories.length; i++ ) {
                            console.log(data.categories[i]);
                        if(data.categories[i].id == data.categories_id) {
                            catogories += '<option value="'+data.categories[i].id+'" selected>'+data.categories[i].name+'</option>';
                        } else {
                            catogories += '<option value="'+data.categories[i].id+'">'+data.categories[i].name+'</option>';
                        }

                    }
                    form.find('select[name="categories_id"]').html(catogories);
                    form.find('input[name="name"]').val(data.name)
                    form.find('input[name="title"]').val(data.title)
                    form.find('input[name="short_description"]').val(data.short_description)
                    form.find('input[name="desc"]').val(data.desc)
                    form.find('input[name="subcategorylink"]').val(data.subcategorylink)
                    form.find('img[id="edi_image"]').attr('src', imageUrl+"/"+data.image);
                    $('input[name="name"]').removeAttr('readonly');
                    $('input[name="title"]').removeAttr('readonly');
                    $('input[name="short_description"]').removeAttr('readonly');
                    $('input[name="desc"]').removeAttr('readonly');
                    $('input[name="subcategorylink"]').removeAttr('readonly');
                    $('input[name="image"]').removeAttr('readonly');
                    $('select[name="categories_id"]').removeAttr('disabled');



                }

            });

            modal.find('.modal-title').text('Update SubCategories')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()



            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            form.find('input[name="title"]').val(rowData.title)
            form.find('input[name="short_description"]').val(rowData.short_description)
            form.find('input[name="desc"]').val(rowData.desc)
            form.find('input[name="subcategorylink"]').val(rowData.subcategorylink)

            modal.modal()

        });

        form.submit(function(event){
            event.preventDefault();
            if(!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('sub-category.update'),
                type: "POST",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
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
                        url: route('sub-category.delete'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#subCategory').DataTable();
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
    $(document).on('change', '.subcategory_status', function(e) {
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
                    url: route('sub-category.status',[id]),
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
    });;

</script>
@endpush
