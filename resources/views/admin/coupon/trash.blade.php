@extends('admin.layouts.main')
@section('container')
<style>
    #hvt:hover {
        transform: scale(3.5);
    }
</style>



<div class="row">
    @if (Session::has('message'))
    <div class="col-sm-12">
        <div class="alert alert-{{ Session::get('type') }} alert-dismissible fade show" role="alert">
            @if (Session::get('type') == 'danger') <i class="mdi mdi-block-helper me-2"></i> @else <i class="mdi mdi-check-all me-2"></i> @endif
            {{ __(Session::get('message')) }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif
    <div class="col-sm-12 message"></div>
    <div class="card-body">
        @can('Coupon-Create')
        <a href="{{route('coupon.add')}}" class="btn btn-xs btn-success float-right add">Add COUPON</a>
        @endcan
        @can('Coupon-View')
        <a href="{{route('coupon.list')}}" class="btn btn-xs btn-primary float-right add">ALL COUPON</a>
        @endcan
        @can('Coupon-Delete')
        <a href="{{route('coupon.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
        @endcan
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="coupons" class="table table-bordered data-table wrap">
                    <thead>
                        <tr>
                            <th width="10%">Id</th>
                            <th width="30%">Name</th>
                            <th width="35%">Description</th>
                            <th width="10%">Deleted At</th>
                            <th width="15%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

@endsection

@push('customScripts')
<script type="text/javascript">
    var form = $(".form");

    $(function() {
        var trashTable = $('#coupons').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('coupon.list.trashed')}}",
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
                    data: 'deleted_at',
                    name: 'deleted_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ],
            responsive: true,
            'createdRow': function(row, data, dataIndex) {
                $(row).attr('id', data.id);
            },
            "order": [
                [0, "desc"]
            ],
            "bDestroy": true,
        });

        // destroy ajax
        // $(document).on('click', '.btn-destroy', function() {

        //     var formData = form.serialize();

        //     var updateId = form.find('input[name="id"]').val();
        //     var id = $(this).data('id')
        //     var el = $(this)
        //     Swal.fire({
        //         title: "Are you sure?",
        //         text: "You won't be able to revert this!",
        //         icon: "warning",
        //         showCancelButton: !0,
        //         confirmButtonText: "Yes, destroy it!",
        //         cancelButtonText: "No, cancel!",
        //         confirmButtonClass: "btn btn-success mt-2",
        //         cancelButtonClass: "btn btn-danger ms-2 mt-2",
        //         buttonsStyling: !1
        //     }).then(function(t) {
        //         if (t.value) {
        //             console.log(el);
        //             if (!id) return;
        //             $.ajax({
        //                 url: route('coupon.destroy'),
        //                 type: "POST",
        //                 data: {
        //                     id: id
        //                 },
        //                 dataType: 'JSON',
        //                 success: function(data) {
        //                     if ($.isEmptyObject(data.error)) {
        //                         showMsg("success", data.message);
        //                         trashTable.ajax().reload();
        //                     } else {
        //                         printErrorMsg(data.error);
        //                     }
        //                 }
        //             });
        //         }
        //     })
        // });
    });
    // delete ajax
    $(document).on('click', '.btn-destroy', function() {

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
                    url: route('coupon.destroy'),
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: 'JSON',

                    success: function(data) {

                        if ($.isEmptyObject(data.error)) {
                            let table = $('#coupons').DataTable();
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

    $(document).on("click", ".restore", function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('coupon.restore')}}",
            type: 'POST',
            data: {
                id: id
            },
            success: function(data) {
                let result = JSON.parse(data);
                $('.message').html('<div class="alert alert-' + result.type +
                    ' alert-dismissible fade show" role="alert"><i class="mdi ' + result.icon +
                    ' me-2"></i>' + result.message +
                    '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> </div>'
                );

                let table = $('.data-table').DataTable();
                table.row('#' + id).remove().draw(false);
            },
            error: function(data) {
                console.log(data);
            }
        });
    });
    $(document).ready(function() {



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
                        url: route('coupon.delete'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',

                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                let table = $('#coupons').DataTable();
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
</script>

@endpush
