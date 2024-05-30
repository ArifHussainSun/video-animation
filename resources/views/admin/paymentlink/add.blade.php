@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">ADD NEW PAYMENT LINK GENERATOR</h4>
                    @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                    </div>
                    @endif
                    <form action="{{ route('payment-link-generator.store')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="name" class="col-sm-3 col-form-label">Customer (IF EXISTING)</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="customer_id" id="customer_id">
                                        <option selected disabled value="0">Select Customer</option>
                                        @foreach($customer as $cus)
                                        <option value="{{ $cus->id }}">{{ $cus->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="heading_two" class="col-sm-3 col-form-label">Item Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="item_name" id="item_name" placeholder="Enter Item Name here">
                                    @if ($errors->has('item_name'))
                                    <span class="text-danger">{{ $errors->first('item_name') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Price</label></strong>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" placeholder="Enter Price here" name="price" id="price">
                                    @if ($errors->has('price'))
                                    <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Discount</label></strong>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" placeholder="Enter Discount here" name="discount" id="discount">
                                    @if ($errors->has('discount'))
                                    <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Discount Type</label></strong>
                                <div class="col-sm-12">
                                    <select name="discount_type" class="form-control select2">
                                        <option value="percent">Percentage (%)</option>
                                        <option value="flat" selected>Flat (direct)</option>
                                    </select>

                                    @if ($errors->has('discount_type'))
                                    <span class="text-danger">{{ $errors->first('discount_type') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="item_description" class="col-sm-3 col-form-label">Item Description</label></strong>
                                <div class="col-sm-12">
                                    <textarea  class="form-control" row="4" placeholder="Enter Item Description here" name="item_description" id="item_description"></textarea>

                                    @if ($errors->has('item_description'))
                                        <span class="text-danger">{{ $errors->first('item_description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Currency</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="currency" id="currency">
                                        <option disabled>Select Currency</option>
                                        @foreach($currency as $curr)
                                        <option value="{{ $curr->id }}" {{ !empty($defaultCurrency->key_value) && $defaultCurrency->key_value == $curr->aplha_code2 ? 'selected' : '' }}>{{ $curr->currency_name }} ({{ $curr->currency_symbol }})</option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('currency'))
                                        <span class="text-danger">{{ $errors->first('currency') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Category</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="category_id">
                                        <option selected disabled>Select Category</option>
                                        @if(!empty($categories))
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-12 col-form-label">Payment Gateway</label></strong>
                                <div class="col-sm-12">
                                    <select name="payment_gateway" class="form-control select2">
                                        <option selected disabled>Select Payment Gateway</option>
                                        @if(!empty($paymentGateways))
                                            @foreach($paymentGateways as $gateway)
                                                @php
                                                    $gateway_name = str_replace("payment_gateway_", "", $gateway->key_name);
                                                    $gateway_name = str_replace("_", " ", $gateway_name);
                                                    $gateway_name = Str::upper($gateway_name);
                                                @endphp
                                                <option value="{{$gateway->key_name}}" {{ $gateway->key_name == $defaultPaymentGateway->key_value ? "selected" : "" }}>{{ $gateway_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('payment_gateway'))
                                        <span class="text-danger">{{ $errors->first('payment_gateway') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-12 col-form-label">Payment Type</label></strong>
                                <div class="col-sm-12">
                                    <select name="payment_type" class="form-control select2">
                                        <option selected disabled>Select Payment Type</option>
                                        <option value="straight" selected>Straight</option>
                                    </select>

                                    @if ($errors->has('payment_type'))
                                        <span class="text-danger">{{ $errors->first('payment_type') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-12 col-form-label">Sale Type</label></strong>
                                <div class="col-sm-12 d-flex">
                                    @if(!empty($sale_types))
                                        @foreach($sale_types as $sale_type)
                                            <div class="col-sm-4">
                                                <label>
                                                    <input type="radio" class="form-check-input" name="sale_type" value="{{ $sale_type->id }}" {{ (!empty($sale_type->name) && $sale_type->name == "Fresh Sales" ? "checked" : "" ) }}> {{ $sale_type->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if ($errors->has('sale_type'))
                                        <span class="text-danger">{{ $errors->first('sale_type') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Comment</label></strong>
                                <div class="col-sm-12">
                                    <textarea type="text" row="4" class="form-control" placeholder="Enter Comment here" name="comment" id="comment"></textarea>
                                    @if ($errors->has('comment'))
                                    <span class="text-danger">{{ $errors->first('comment') }}</span>
                                    @endif
                                </div>
                            </div>

                        </div><br /><br />
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden" class="form-control" name="token" id="token">
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
        $('.select2').select2();
    });
  </script>
  <script>
    $(document).ready(function() {
    $('#item_description').summernote({
      placeholder: 'Enter Content here',
      tabsize: 2,
      height: 250,
      toolbar: [
       ['style', ['style']],
       ['font', ['bold', 'italic', 'underline', 'clear', 'strikethrough', 'superscript', 'subscript']],
       ['fontsize', ['fontsize']],
       ['color', ['color']],
       ['para', ['ul', 'ol', 'paragraph']],
       ['table', ['table']],
       ['height', ['height']],
       ['insert', ['link', 'picture', 'video']],
       ['view', ['fullscreen', 'codeview', 'undo', 'redo', 'help']]
      ]
    });
});
</script>

@endpush
