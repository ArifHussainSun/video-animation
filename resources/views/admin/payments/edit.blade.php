@extends('admin.layouts.main')
@section('container')

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">EDIT PAYMENT</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        @php
                            Session::forget('success');
                        @endphp
                        </div>
                    @endif
                    <form action="{{route('payment.update')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="name" class="col-sm-3 col-form-label">Customer</label></strong>
                                <div class="col-sm-12">
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ !empty($payments->id) ? $payments->id : '' }}">
                                    <select class="form-control select2" name="customer_id" id="customer_id">
                                        <option value="0"selected disabled>Select Customer</option>
                                        @foreach($customer as $customers)
                                            <option value="{{ $customers->id }}" {{ $payments->customer_id == $customers->id ? 'selected' : ''  }}>{{ $customers->first_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="heading_two" class="col-sm-3 col-form-label">Item Name</label></strong>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" name="item_name" id="item_name" value="{{ !empty($payments->item_name) ? $payments->item_name : '' }}" placeholder="Enter Item Name here">
                                    @if ($errors->has('item_name'))
                                        <span class="text-danger">{{ $errors->first('item_name') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Price</label></strong>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" placeholder="Enter Price here" value="{{ !empty($payments->price) ? $payments->price : '' }}" name="price" id="price">
                                    @if ($errors->has('price'))
                                        <span class="text-danger">{{ $errors->first('price') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Discount</label></strong>
                                <div class="col-sm-12">
                                    <input type="number"  class="form-control" placeholder="Enter Discount here" name="discount" id="discount" value="{{ !empty($payments->discount) ? $payments->discount : '' }}">
                                    @if ($errors->has('discount'))
                                        <span class="text-danger">{{ $errors->first('discount') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Discount Type</label></strong>
                                <div class="col-sm-12">
                                    <select name="discount_type" class="form-control select2">
                                        <option value="percent" {{ !empty($payments->discount_type) && ($payments->discount_type == "percent") ? "selected" : "" }}>Percentage (%)</option>
                                        <option value="flat" {{ !empty($payments->discount_type) && ($payments->discount_type == "flat") ? "selected" : ""  }}>Flat (direct)</option>
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
                                    <textarea  class="form-control" row="4" placeholder="Enter Item Description here" name="item_description" id="summernote">{{ !empty($payments->item_description) ? $payments->item_description : '' }}</textarea>
                                    @if ($errors->has('item_description'))
                                        <span class="text-danger">{{ $errors->first('item_description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="converted_amount" class="col-sm-5 col-form-label">Converted Amount</label></strong>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" placeholder="Enter Converted Amount here" name="converted_amount" value="{{ !empty($payments->converted_amount) ? $payments->converted_amount : '' }}" id="converted_amount">
                                    @if ($errors->has('converted_amount'))
                                        <span class="text-danger">{{ $errors->first('converted_amount') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Currency</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="currency" id="currency">
                                        <option value="" selectrd disabled>Select Currency</option>
                                        @foreach($currency as $currencies)
                                            <option value="{{ $currencies->id }}" {{ $payments->currency   == $currencies->id ? 'selected' : ''}}>{{ $currencies->currency_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('currency'))
                                        <span class="text-danger">{{ $errors->first('currency') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Category</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="category_id" id="category_id">
                                        <option value="" selectrd disabled>Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ $payments->category_id == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                        <span class="text-danger">{{ $errors->first('category_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Coupon</label></strong>
                                <div class="col-sm-12">
                                    <input type="text"  class="form-control" placeholder="Enter Coupon here" name="coupon_id" id="coupon_id" value="{{ !empty($payments->coupon_id) ? $payments->coupon_id : '' }}">
                                    @if ($errors->has('coupon_id'))
                                        <span class="text-danger">{{ $errors->first('coupon_id') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Sale Type</label></strong>
                                <div class="col-sm-12">
                                    <select class="form-control select2" name="sale_type_id" id="sale_type_id">
                                        <option value="" selectrd disabled>Select Sale Type</option>
                                        @foreach($saletypes as $saletype)
                                            <option value="{{ $saletype->id }}" {{$payments->sale_type_id == $saletype->id }}>{{ $saletype->name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('sale_type'))
                                        <span class="text-danger">{{ $errors->first('sale_type') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                                                <option value="{{$gateway->key_name}}" {{$payments->payment_gateway == $gateway->key_name ? "selected" : ""}}>{{ $gateway_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if ($errors->has('payment_gateway'))
                                        <span class="text-danger">{{ $errors->first('payment_gateway') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
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
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-6 col-form-label">Remaining Amount</label></strong>
                                <div class="col-sm-12">
                                    <input type="number"  class="form-control" placeholder="Enter Remaining Amount here" name="remaining_amount" id="remaining_amount" value="{{ !empty($payments->remaining_amount) ? $payments->remaining_amount : '' }}">
                                    @if ($errors->has('remaining_amount'))
                                        <span class="text-danger">{{ $errors->first('remaining_amount') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Balance</label></strong>
                                <div class="col-sm-12">
                                    <input type="number"  class="form-control" placeholder="Enter Balance here" name="balance" id="balance" value="{{ !empty($payments->balance) ? $payments->balance : '' }}">
                                    @if ($errors->has('balance'))
                                        <span class="text-danger">{{ $errors->first('balance') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Comment</label></strong>
                                <div class="col-sm-12">
                                    <input type="text"   class="form-control" placeholder="Enter Comment here" name="comment" id="comment" value="{{ !empty($payments->comment) ? $payments->comment : '' }}">
                                    @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <strong><label for="short_address" class="col-sm-3 col-form-label">Message</label></strong>
                                <div class="col-sm-12">
                                    <textarea type="text" row="4" class="form-control" placeholder="Enter Message here" name="message" id="message">{{ !empty($payments->message) ? $payments->message : '' }}</textarea>
                                    @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($emailtemplate->content))
                            <div class="col-sm-12">
                                <div class="col-form-label">
                                    <div class="form-check">
                                        <input class="form-check-input" name="email_sent" type="checkbox" id="formCheck2" {{ !empty($invoice_details->email_sent) ? "checked" : '' }} value="{{ !empty($invoice_details->email_sent) ? $invoice_details->email_sent : '' }}" disabled>
                                        <label class="form-check-label" for="formCheck2">
                                            Send Email
                                        </label>
                                    </div>
                                    @if ($errors->has('message'))
                                        <span class="text-danger">{{ $errors->first('message') }}</span>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div><br/><br/>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="hidden"  class="form-control" name="token" id="token">
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
<script src="{{ asset('ckeditor/ckeditor.js')}}"></script>
   <script>
        $(document).ready(function () {
          $('.select2').select2();
       });
       $('#summernote').summernote({
           placeholder: 'Enter Item Description here',
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

 </script>

@endpush
