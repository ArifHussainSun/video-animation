@extends('admin.layouts.main')
@section('container')

<div class="row">
<div class="col-xl-12">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4">PAYMENT GATEWAY SETTING</h4>
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
<form action="{{ route('admin-brand-settings.payment-setting-default-save') }}" method="post">
@csrf
<div class="row">
<div class="col-sm-6">
<strong><label for="horizontal-name-input" class="col-sm-6 col-form-label">Default Payment
        Gateway</label></strong>
<div class="col-sm-12">
    <select class="form-control select2" name="default_payment_gateway"
        id="default_payment_gateway">
        <option selected disabled>Select Default Payment Gateway</option>
        @if (!empty($paymentGateways))
            @foreach ($paymentGateways as $gateway)
                @php
                    $gateway_name = str_replace('payment_gateway_', '', $gateway->key_name);
                    $gateway_name = str_replace('_', ' ', $gateway_name);
                    $gateway_name = Str::upper($gateway_name);
                @endphp
                <option value="{{ $gateway->key_name }}"
                    {{ !empty($default_payment_gateway->key_value) && $default_payment_gateway->key_value == $gateway->key_name ? 'selected' : '' }}>
                    {{ $gateway_name }}</option>
            @endforeach
        @endif
    </select>
    @if ($errors->has('default_payment_gateway'))
        <span class="text-danger">{{ $errors->first('default_payment_gateway') }}</span>
    @endif
</div>
</div>
<div class="col-sm-6">
<strong><label for="horizontal-name-input" class="col-sm-6 col-form-label">Default
        Currency</label></strong>
<div class="col-sm-12">
    <select class="form-control select2" name="default_currency" id="default_currency">
        <option selected disabled>Select Default Currency</option>
        @forelse($currency as $curr)
            <option value="{{ $curr->aplha_code2 }}"
                {{ !empty($default_currency->key_value) && $default_currency->key_value == $curr->aplha_code2 ? 'selected' : '' }}>
                {{ $curr->currency_name }}</option>
        @empty
        @endforelse
    </select>
    @if ($errors->has('default_currency'))
        <span class="text-danger">{{ $errors->first('default_currency') }}</span>
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
<div class="col-lg-12">
<div class="card">
<div class="card-body">
<h4 class="card-title mb-4">ADD NEW PAYMENT GATEWAY</h4>
<form action="{{ route('admin-brand-settings.payment-setting-save') }}" method="post">
@csrf

<div class="row mb-3">
<div class="col-sm-10">
<div class="row">
    <div class="col-sm-6">
        <strong><label for="horizontal-name-input" class="col-sm-12 col-form-label">Select
                Payment Gateway</label></strong>
        <div class="col-sm-12">
            <select class="form-control select2" name="payment_gateway_type"
                id="payment_gateway_type" required>
                <option selected disabled>Select Payment Gateway Type</option>
                <option value="braintree">Braintree</option>
                <option value="stripe">Stripe</option>
            </select>
            @if ($errors->has('payment_gateway_type'))
                <span
                    class="text-danger">{{ $errors->first('payment_gateway_type') }}</span>
            @endif
        </div>
    </div>
    <div class="col-sm-6">
        <strong><label for="horizontal-name-input" class="col-sm-12 col-form-label">Select
                Payment Name</label></strong>
        <div class="col-sm-12">

            <input type="text" class="form-control" name="name" id="name"
                value="" placeholder="Enter Payment Name here" required>
            @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
            @endif
        </div>
    </div>

</div>
</div>
<div class="col-sm-2">
<strong><label for="horizontal-name-input" class="col-sm-6 col-form-label"></label></strong>
<div class="col-sm-12">
    <button type="submit"
        onclick="goDoSomething($('#payment_gateway_type').val(),$('#name').val())"
        id="btn" class="btn btn-success w-md">Add</button>
</div>
</div>
</div>
</form>

<div class="row">
<div class="col-sm-12">
<div class="accordion" id="accordionExample">
@if (!empty($paymentGateways))
    @php
        $totalGateways = count($paymentGateways);
    @endphp

    @foreach ($paymentGateways as $gateway)
        <form name="updateGatwaySettings"
            action="{{ route('admin-brand-settings.payment-gateway-setting') }}"
            method="POST">
            @csrf

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button fw-medium" name="" type="button"
                        id="" data-bs-toggle="collapse"
                        data-bs-target="#{{ $gateway->key_name }}"
                        aria-expanded="{{ $totalGateways == 1 ? 'true' : 'false' }}"
                        aria-controls="{{ $gateway->key_name }}">
                        {{ $gateway->key_name }}
                    </button>
                    <input type="hidden" class="horizontal-name-input" value=""
                        name="paymentgateway" id="paymentgatewayset">
                    @if ($errors->has('paymentgateway'))
                        <span
                            class="text-danger">{{ $errors->first('paymentgateway') }}</span>
                    @endif
                </h2>
                <div id="{{ $gateway->key_name }}"
                    class="accordion-collapse {{ $totalGateways == 1 ? 'collapse show' : 'collapse' }}"
                    aria-labelledby="{{ $gateway->key_name }}"
                    data-bs-parent="#accordionExample">

                    @php
                        $gateway_detail = json_decode($gateway->key_value);
                    @endphp

                    <div class="accordion-body">
                        <div class="text-muted">
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <strong><label for="horizontal-name-input"
                                            class="col-sm-12 col-form-label"> Merchant
                                            ID</label></strong>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            name="merchant_id" id="merchant_id"
                                            value="{{ !empty($gateway_detail->merchant_id) ? $gateway_detail->merchant_id : '' }}"
                                            placeholder="Enter Merchant Name here">
                                        @if ($errors->has('merchant_id'))
                                            <span
                                                class="text-danger">{{ $errors->first('merchant_id') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <strong><label for="horizontal-name-input"
                                            class="col-sm-12 col-form-label">Public
                                            Key</label></strong>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            name="public_key" id="public_key"
                                            value="{{ !empty($gateway_detail->public_key) ? $gateway_detail->public_key : '' }}"
                                            placeholder="Enter Public Key here">
                                        @if ($errors->has('public_key'))
                                            <span
                                                class="text-danger">{{ $errors->first('public_key') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <strong><label for="horizontal-name-input"
                                            class="col-sm-12 col-form-label">Secret
                                            Key</label></strong>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control"
                                            name="secret_key" id="secret_key"
                                            value="{{ !empty($gateway_detail->secret_key) ? $gateway_detail->secret_key : '' }}"
                                            placeholder="Enter Secret Key here">
                                        @if ($errors->has('secret_key'))
                                            <span
                                                class="text-danger">{{ $errors->first('secret_key') }}</span>
                                        @endif
                                    </div>
                                </div>

                                                                <div class="col-sm-6">
                                                                    <strong><label for="horizontal-name-input"
                                                                            class="col-sm-12 col-form-label">Statement
                                                                            Descriptor</label></strong>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" class="form-control"
                                                                            name="statement_descriptor"
                                                                            id="statement_descriptor"
                                                                            value="{{ !empty($gateway_detail->statement_descriptor) ? $gateway_detail->statement_descriptor : '' }}"
                                                                            placeholder="Enter Statement Description here">

                                                                        @if ($errors->has('statement_descriptor'))
                                                                            <span
                                                                                class="text-danger">{{ $errors->first('statement_descriptor') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-6">
                                                                    <strong><label for="horizontal-name-input"
                                                                            class="col-sm-12 col-form-label">Environment</label></strong>
                                                                    <div class="col-sm-12">
                                                                        <select name="environment" class="form-control"
                                                                            required>
                                                                            <option selected disabled>Select Environment
                                                                            </option>
                                                                            <option value="testing"
                                                                                {{ !empty($gateway_detail->environment) && $gateway_detail->environment == 'testing' ? 'selected' : '' }}>
                                                                                Testing</option>
                                                                            <option value="production"
                                                                                {{ !empty($gateway_detail->environment) && $gateway_detail->environment == 'production' ? 'selected' : '' }}>
                                                                                Production</option>
                                                                        </select>

                                                                        @if ($errors->has('environment'))
                                                                            <span
                                                                                class="text-danger">{{ $errors->first('environment') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="col-sm-12" style="text-align: center;">
                                                                        <input name="gateway_key" type="hidden"
                                                                            value="{{ $gateway->key_name }}">
                                                                        <button type="submit"
                                                                            class="btn btn-primary w-md">SAVE</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            @php
                                                $totalGateways--;
                                            @endphp
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <!-- end accordian -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>

@endsection
@push('customScripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });

        function goDoSomething(data_id, data_option) {
            $("#paymentgatewayset").val('payment_gateway_' + data_id + '_' + data_option);
        }
    </script>
@endpush
