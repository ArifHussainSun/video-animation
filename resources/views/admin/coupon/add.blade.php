@extends('admin.layouts.main')
@section('container')
<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-4">ADD NEW COUPON</h4>
                @if (Session::has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="mdi mdi-check-all me-2"></i>
                    {{ Session::get('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger alert-block" role="alert">
                    <button class="close" data-dismiss="alert"></button>
                    {{ Session::get('error') }}
                </div>
                @endif
                <form action="{{ route('coupon.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">Coupon
                                    Name</label></strong>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="coupon_name" id="horizontal-coupon_name-input" placeholder="Enter Coupon Name here">
                                @if ($errors->has('coupon_name'))
                                <span class="text-danger">{{ $errors->first('coupon_name') }}</span>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-heading_two-input" class="col-sm-6 col-form-label">Coupon
                                    Description</label></strong>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="coupon_description" id="horizontal-coupon_description-input" placeholder="Enter Coupon Description here">
                                @if ($errors->has('coupon_description'))
                                <span class="text-danger">{{ $errors->first('coupon_description') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Discount</label></strong>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" placeholder="Enter Discount here" name="discount" id="discount">
                                @if ($errors->has('discount'))
                                <span class="text-danger">{{ $errors->first('discount') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Discount
                                    Type</label></strong>
                            <div class="col-sm-12">
                                <select class="form-control select2" name="discount_type" id="discount_type">
                                    <option value="" selected disabled>Select Discount Type</option>
                                    <option value="Percentage">Percentage</option>
                                    <option value="Flat">Flat</option>
                                </select>
                                @if ($errors->has('discount_type'))
                                <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Date
                                    From</label></strong>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" name="date_from" id="date_from">
                                @if ($errors->has('date_from'))
                                <span class="text-danger">{{ $errors->first('date_from') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Date
                                    To</label></strong>
                            <div class="col-sm-12">
                                <input type="date" class="form-control" name="date_to" id="date_to">
                                @if ($errors->has('date_to'))
                                <span class="text-danger">{{ $errors->first('date_to') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Quantity</label></strong>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" placeholder="Enter Quantity here" name="quantity" id="quantity">
                                @if ($errors->has('quantity'))
                                <span class="text-danger">{{ $errors->first('quantity') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <strong><label for="horizontal-short_address-input" class="col-sm-3 col-form-label">Utilize</label></strong>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" placeholder="Enter Utility here" name="utilized" id="utilized">
                                @if ($errors->has('utilized'))
                                <span class="text-danger">{{ $errors->first('utilized') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br /><br />
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="col-sm-12" style="text-align: center;">
                                <button type="submit" class="btn btn-primary w-md">SAVE</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('customScripts')

<script>
    $(document).ready(function() {
        setTimeout(function() {
            $("#abc").remove();
        }, 2000);

        $('.select2').select2();
    });
</script>

@endpush
