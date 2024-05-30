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
                @can('Partner-Create')
                    <a href="{{ route('partner.add')}}" class="btn btn-xs btn-success float-right add">Add Partner</a>
                    <a href="{{ route('partner.list') }}" class="btn btn-xs btn-primary">All Partner</a>
                    <a href="{{ route('partner.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                @endcan
                </h3>
                <hr>
                <table id="partners" class="table table-bordered table-condensed table-striped" style="font-size: small;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Deleted At</th>
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
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="desc">Description</label>
                                        <input type="text" name="desc" id="desc" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Old Preview Image</label>

                                        <img  src='' id="edi_image" class="form-control input-sm" width="180px;" height="120" />
                                    </div>
                                    <div class="form-group" id="imgdiv">
                                        <label for="image">Image</label>
                                        <input type="file" name="image" id="image" class="form-control input-sm" >
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
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="orderdetailsModalLabel">   View Partner</h5>
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
                                                        <h5 class="text-truncate font-size-14" >Name</h5>
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
                                                        <h5 class="text-truncate font-size-14" >Description</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="desc"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" >Image</h5>
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
    $(document).ready(function() {

        var modal = $('.modal')
        var form = $('.form')
        var btnAdd = $('.add'),
            btnSave = $('.btn-save'),
            btnUpdate = $('.btn-update');
            btnView = $('.btn-view');

        var table = $('#partners').DataTable({
                ajax: route('partner.list.trashed'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'image', name: 'image'},
                    {data: 'name', name: 'name'},
                    {data: 'desc', name: 'desc'},
                    {data: 'deleted_at', name: 'deleted_at'},
                    {data: 'action', name: 'action'},
                ],
                'createdRow': function(row, data) {
                        $(row).attr('id', data.id)
                    },
                    "bDestroy": true
            });
        // update ajax

        $(document).on('click','.btn-view',function(){
            var imageUrl = '{{ URL::asset("/") }}';
            $.ajax({
                url: route('partner.detail.view', ["yes"]),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    console.log(data)
                    $('#id').html(data.id);
                    $('#name').html(data.name);
                    $('#desc').html(data.desc);
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
        $(document).on('click','.btn-restore',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();
            $("#imgdiv").show();
            var imageUrl = '{{ URL::asset("/") }}';

            $.ajax({
                url: route('partner.restore'),
                type: "get",
                data: {id: $(this).data('id')},

                success: function (data) {
                    console.log(data)
                    form.find('input[name="name"]').val(data.name)
                    form.find('file[name="image"]').val(data.image)
                    form.find('input[name="desc"]').val(data.desc)
                    form.find('img[id="edi_image"]').attr('src', imageUrl+"/"+data.image);
                    $('input[name="name"]').removeAttr('readonly');
                    $('file[name="image"]').removeAttr('readonly');
                    $('input[name="desc"]').removeAttr('readonly');



                }

            });

            modal.find('.modal-title').text('Update Partners')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('input[name="name"]').val(rowData.name)
            form.find('file[name="image"]').val(rowData.image)
            form.find('input[name="desc"]').val(rowData.desc)
            modal.modal()

        });

        form.submit(function(event){
            event.preventDefault();
            if(!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = form.find('input[name="id"]').val();
            $.ajax({
                url: route('partner.update'),
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
                        url: route('partner.delete'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#partners').DataTable();
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
    $(document).on('change', '.partner_status', function(e) {
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
                    url: route('partner.status',[id]),
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
