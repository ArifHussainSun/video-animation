@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-16">Payment Details</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <!-- <li class="breadcrumb-item"><a href="javascript: void(0);">Invoices</a></li>
                            <li class="breadcrumb-item active">Detail</li> -->
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="invoice-title">
                            <h4 class="float-end font-size-16">Payment ID # {{ request()->segment(2) }}</h4>
                            <div class="mb-4">
                                sleekhive
                                <!-- <img src="assets/images/logo-dark.png" alt="logo" height="20"/> -->
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-6 mt-3">
                                <address>
                                    <strong>Payment Method:</strong><br>
                                    <!-- Visa ending **** 4242 -->
                                    <br>
                                    <!-- jsmith@email.com -->
                                </address>
                            </div>
                            <div class="col-sm-6 mt-3 text-sm-end">
                                <address>
                                    <strong>Payment Date:</strong><br>

                                    {{ $payments->created_at->format('Y-m-d') }}<br><br>

                                </address>
                            </div>
                        </div>
                        <div class="py-2 mt-3">
                            <h3 class="font-size-15 fw-bold">Payment summary</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-nowrap">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">ID</th>
                                        <th>Item Name</th>
                                        <th>Discount</th>
                                        <th>Original Price</th>
                                        <th>Item Descripion</th>
                                        <th>Convert Amount</th>
                                        <th class="text-end">Item Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $payments->id }}</td>
                                        <td>{{ $payments->item_name }}</td>
                                        <td>{{ $payments->discount }}</td>
                                        <td>{{ $payments->original_price }}</td>
                                        <td>{{ $payments->item_desc }}</td>
                                        <td>{{ $payments->convert_amount }}</td>
                                        <td class="text-end">${{ $payments->item_price }}</td>
                                    </tr>

                                        <td colspan="6" class="border-0 text-end">
                                            <strong>Total</strong></td>
                                        <td class="border-0 text-end"><h4 class="m-0">${{ $payments->item_price }}</h4></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="d-print-none">
                            <div class="float-end">
                                <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light me-1"><i class="fa fa-print"></i></a>
                                <!-- <a href="javascript: void(0);" class="btn btn-primary w-md waves-effect waves-light">Send</a> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
