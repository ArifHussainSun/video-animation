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
                    @can('Faq-Create')
                     <a href="{{route('faq.add')}}" class="btn btn-xs btn-success float-right add">ADD FAQS</a>
                     <a href="{{ route('faq.list') }}" class="btn btn-xs btn-primary">ALL FAQS</a>
                     <a href="{{ route('faq.list.trashed') }}"class="btn btn-xs btn-danger">TRASH</a>
                    @endcan
                </h3>
                <hr>
                <table id="faqs" class="table table-bordered table-condensed table-striped" style="font-size: small;">

                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Page</th>
                        <th>Question</th>
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
                                        <label for="name">Page</label>
                                        <select class="form-control select2" name="page" id="page" style="width: 100%;">
                                            <option value="" selected disabled>Select Page</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <input type="text" name="question" id="question" class="form-control input-sm">
                                    </div>
                                    <div class="form-group">
                                        <label for="answer">Answer</label>
                                        <input type="text" name="answer" id="answer" class="form-control input-sm">
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
                                <h5 class="modal-title" id="orderdetailsModalLabel">    View Faq</h5>
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
                                                        <h5 class="text-truncate font-size-14" >Page</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" id="page"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" >Qustion</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                        <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-success font-size-12" id="question"></h5>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row">
                                                    <div>
                                                        <h5 class="text-truncate font-size-14" >Answer</h5>
                                                    </div>
                                                </th>
                                                <td>
                                                    <div>
                                                    <h5 class="text-truncate font-size-14 badge badge-pill badge-soft-warning font-size-12" id="answer"></h5>
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

        var table = $('#faqs').DataTable({
                ajax: route('faq.list'),
                serverSide: true,
                processing: true,
                aaSorting:[[0,"desc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'page', name: 'page'},
                    {data: 'question', name: 'question'},
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
                url: route('faq.detail.view'),
                type: "post",
                data: {id: $(this).data('id')},
                success: function (data) {
                    $('#id').html(data.id);
                    $('#page').html(data.page);
                    $('#question').html(data.question);
                    $('#answer').html(data.answer);
                }
            });

        });
        $(document).on('click','.btn-edit',function(){
            btnSave.hide();
            btnView.hide();
            btnUpdate.show();

            $.ajax({
                url: route('faq.edit'),
                type: "post",
                data: {id: $(this).data('id')},

                success: function (data) {
                    var pages = "";
                    // pages
                    for(let i = 0; i<data.pages.length; i++ ) {
                        if(data.pages[i].id == data.page) {
                            pages += '<option value="'+data.pages[i].id+'" selected>'+data.pages[i].name+'</option>';
                        } else {
                            pages += '<option value="'+data.pages[i].id+'">'+data.pages[i].name+'</option>';
                        }
                    }
                    form.find('select[name="page"]').html(pages)
                    form.find('input[name="question"]').val(data.question)
                    form.find('input[name="answer"]').val(data.answer)
                    $('select[name="page"]').removeAttr('disabled');
                    $('input[name="question"]').removeAttr('readonly');
                    $('input[name="answer"]').removeAttr('readonly');
                }

            });

            modal.find('.modal-title').text('Update Faqs')
            modal.find('.modal-footer button[type="submit"]').text('Update')

            var rowData =  table.row($(this).parents('tr')).data()
            form.find('input[name="id"]').val(rowData.id)
            form.find('select[name="page"]').val(rowData.page)
            form.find('input[name="question"]').val(rowData.question)
            form.find('input[name="answer"]').val(rowData.answer)


            modal.modal()

        });

        form.submit(function(event){
            event.preventDefault();
            if(!confirm("Are you sure?")) return;
            var formData = new FormData(this);
            var updateId = $(this).find('input[name="id"]').val();
            $.ajax({
                url: route('faq.update'),
                type: "POST",

                data: formData,
                cache: false,
                contentType: false,
                    processData: false,
                success: function (data) {
                    console.log(data);
            $("#modal").modal('hide');
            $('div.flash-message').html(data);
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
                    // console.log(el);
                    if(!id) return;
                    $.ajax({
                        url: route('faq.remove'),
                        type: "POST",
                        data:{id:id},
                        dataType: 'JSON',

                        success: function (data) {
                            if($.isEmptyObject(data.error)){
                                let table = $('#faqs').DataTable();
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
    $(document).on('change', '.faq_status', function(e) {
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
                    url: route('faq.status',[id]),
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
