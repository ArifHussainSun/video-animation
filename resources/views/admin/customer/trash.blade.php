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
    <div class="col-sm-12 mb-2">
        @can('Customer-Create')
        <a href="{{route('customer.add')}}" class="btn btn-xs btn-success float-right add">Add Customer</a>
        @endcan
        @can('Customer-View')
        <a href="{{route('customer.list')}}" class="btn btn-xs btn-primary float-right add">All Customers</a>
        @endcan
        @can('Customer-Delete')
        <a href="{{route('customer.list.trashed')}}" class="btn btn-xs btn-danger float-right add">Trash</a>
        @endcan
    </div>
</div>
<!-- end row -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="customers" class="table table-bordered data-table wrap">
                    <thead>
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">First Name</th>
                            <th width="20%">Last Name</th>
                            <th>Email</th>
                            <th width="30%">Address</th>
                            <th width="10%">Deleted At</th>
                            <th width="10%">Action</th>
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
        var trashTable = $('#customers').DataTable({
            scrollX: true,
            processing: true,
            serverSide: true,
            ajax: "{{route('customer.list.trashed')}}",
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
        $(document).on('click', '.btn-destroy', function() {

            var formData = form.serialize();

            var updateId = form.find('input[name="id"]').val();
            var id = $(this).data('id')
            var el = $(this)
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: !0,
                confirmButtonText: "Yes, destroy it!",
                cancelButtonText: "No, cancel!",
                confirmButtonClass: "btn btn-success mt-2",
                cancelButtonClass: "btn btn-danger ms-2 mt-2",
                buttonsStyling: !1
            }).then(function(t) {
                if (t.value) {
                    console.log(el);
                    if (!id) return;
                    $.ajax({
                        url: route('customer.destroy'),
                        type: "POST",
                        data: {
                            id: id
                        },
                        dataType: 'JSON',
                        success: function(data) {
                            if ($.isEmptyObject(data.error)) {
                                showMsg("success", data.message);
                                trashTable.ajax().reload();
                            } else {
                                printErrorMsg(data.error);
                            }
                        }
                    });
                }
            })
        });
    });
    // delete ajax

    $(document).on("click", ".restore", function(event) {
        var id = $(this).data('id');
        $.ajax({
            url: "{{route('customer.restore')}}",
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
</script>

@endpush
