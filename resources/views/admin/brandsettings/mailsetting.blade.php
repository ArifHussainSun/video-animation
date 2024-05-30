@extends('admin.layouts.main')
@section('container')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    @if( Session::has("success") )
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="mdi mdi-check-all me-2"></i>
                            {{ Session::get("success") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>

                    @endif
                    @if( Session::has("error") )
                        <div class="alert alert-danger alert-block" role="alert">
                        <button class="close" data-dismiss="alert"></button>
                        {{ Session::get("error") }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">ADD NEW EMAIL SETTING</h4>
                                    <form action="{{ route('admin-brand-settings.mailsetting-save') }}" method="post">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="col-sm-10">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <strong><label for="name" class="col-sm-12 col-form-label">Name</label></strong>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" name="name" id="name" value="" placeholder="Enter Mail name here" required>
                                                            @if ($errors->has('name'))
                                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <strong><label for="email" class="col-sm-12 col-form-label">Email</label></strong>
                                                        <div class="col-sm-12">
                                                            <input type="email" class="form-control" name="email" id="email" value="" placeholder="Enter Email here" required>
                                                            @if ($errors->has('email'))
                                                                <span class="text-danger">{{ $errors->first('email') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <strong><label for="horizontal-name-input" class="col-sm-12 col-form-label"></label></strong>
                                                <div class="col-sm-12">
                                                    <button type="submit" onclick="goDoSomething($('#payment_gateway_type').val(),$('#name').val())" id="btn" class="btn btn-success w-md" style="margin-top: 8%;">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="accordion" id="accordionExample">
                                                @if(!empty($mailSettings))
                                                @php
                                                    $totalMailSettings = count($mailSettings);
                                                @endphp

                                                @foreach($mailSettings as $setting)
                                                <form name="updateGatwaySettings" action="{{ route('admin-brand-settings.mailsetting-update') }}" method="POST">
                                                    @csrf

                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="headingOne">
                                                            <button class="accordion-button fw-medium" name="" type="button" id="" data-bs-toggle="collapse" data-bs-target="#{{$setting->key_name}}" aria-expanded="{{ ($totalMailSettings==1 ? 'true' : 'false') }}" aria-controls="{{$setting->key_name}}">
                                                                {{$setting->key_name}}
                                                            </button>
                                                            <input type="hidden" class="horizontal-name-input" value="" name="paymentgateway" id="paymentgatewayset">
                                                            @if ($errors->has('paymentgateway'))
                                                            <span class="text-danger">{{ $errors->first('paymentgateway') }}</span>
                                                            @endif
                                                        </h2>
                                                        <div id="{{$setting->key_name}}" class="accordion-collapse {{ ($totalMailSettings==1 ? 'collapse show' : 'collapse') }}" aria-labelledby="{{$setting->key_name}}" data-bs-parent="#accordionExample">

                                                            @php
                                                                $gateway_detail = json_decode($setting->key_value);
                                                            @endphp
                                                            <div class="accordion-body">
                                                                <div class="text-muted">
                                                                    <div class="row mb-3">
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="mail_protocol" class="col-sm-12 col-form-label">Protocol</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control select2" name="mail_protocol" id="mail_protocol" required>
                                                                                <option selected disabled>Select Protocol</option>
                                                                                <option value="protocol mail" {{ (!empty($gateway_detail->mail_protocol == 'protocol mail') ? 'selected' : '') }}>protocol mail</option>
                                                                                <option value="sendmail" {{ (!empty($gateway_detail->mail_protocol == 'sendmail') ? 'selected' : '') }}>sendmail</option>
                                                                                <option value="smtp" {{ (!empty($gateway_detail->mail_protocol == 'smtp') ? 'selected' : '') }}>smtp</option>
                                                                            </select>
                                                                            @if ($errors->has('mail_protocol'))
                                                                                <span class="text-danger">{{ $errors->first('mail_protocol') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="mail_mailtype" class="col-sm-12 col-form-label">Mail Type</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control select2" name="mail_mailtype" id="mail_mailtype" required>
                                                                                <option selected disabled>Select Mailtype</option>
                                                                                <option value="text" {{ (!empty($gateway_detail->mail_mailtype == 'text') ? 'selected' : '') }}>text</option>
                                                                                <option value="html" {{ (!empty($gateway_detail->mail_mailtype == 'html') ? 'selected' : '') }}>html</option>
                                                                            </select>
                                                                            @if ($errors->has('mail_mailtype'))
                                                                                <span class="text-danger">{{ $errors->first('mail_mailtype') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="mail_charset" class="col-sm-12 col-form-label">Charset</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <select class="form-control select2" name="mail_charset" id="mail_charset" required>
                                                                                <option selected disabled>Select Charset</option>
                                                                                <option value="utf-8" {{ (!empty($gateway_detail->mail_charset == 'utf-8') ? 'selected' : '') }}>utf-8</option>
                                                                                <option value="iso-8859-1" {{ (!empty($gateway_detail->mail_charset == 'iso-8859-1') ? 'selected' : '') }}> iso-8859-1</option>
                                                                            </select>
                                                                            @if ($errors->has('mail_charset'))
                                                                                <span class="text-danger">{{ $errors->first('mail_charset') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="mail_wordwrap" class="col-sm-12 col-form-label"> Wordwrap</label></strong>
                                                                        <div class="col-sm-12">
                                                                        <select class="form-control select2" name="mail_wordwrap" id="mail_wordwrap" required>
                                                                                <option selected disabled>Select Wordwrap</option>
                                                                                <option value="true" {{ (!empty($gateway_detail->mail_wordwrap == 'true') ? 'selected' : '') }}>True</option>
                                                                                <option value="false" {{ (!empty($gateway_detail->mail_wordwrap == 'false') ? 'selected' : '') }}>False</option>
                                                                            </select>

                                                                            @if ($errors->has('mail_wordwrap'))
                                                                                <span class="text-danger">{{ $errors->first('mail_wordwrap') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <strong><label for="horizontal-mail_smtp_host-input" class="col-sm-12 col-form-label"> SMTP Host</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <input type="text" class="form-control" value="{{ !empty($gateway_detail->mail_smtp_host) ? $gateway_detail->mail_smtp_host : '' }}" name="mail_smtp_host" id="horizontal-mail_smtp_host-input" placeholder="Enter Mail SMTP Host here">

                                                                            @if ($errors->has('mail_smtp_host'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtp_host') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="horizontal-mail_smtp_port-input" class="col-sm-12 col-form-label">SMTP Port</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <input type="text"  class="form-control" value="{{ !empty($gateway_detail->mail_smtp_port) ? $gateway_detail->mail_smtp_port : '' }}"  name="mail_smtp_port" id="mail_smtp_port" placeholder="Enter Mail SMTP Port here">

                                                                            @if ($errors->has('mail_smtp_port'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtp_port') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-3">
                                                                        <strong><label for="mail_wordwrap" class="col-sm-12 col-form-label"> SMTP Crypto</label></strong>
                                                                        <div class="col-sm-12">
                                                                        <select class="form-control select2" name="mail_smtpcrypto" id="mail_smtpcrypto" required>
                                                                                <option selected disabled>Select SMTP Crypto</option>
                                                                                <option value="tls" {{ (!empty($gateway_detail->mail_smtpcrypto) && ($gateway_detail->mail_smtpcrypto == 'tls') ? 'selected' : '') }}>tls </option>
                                                                                <option value="ssl" {{ (!empty($gateway_detail->mail_smtpcrypto) && ($gateway_detail->mail_smtpcrypto == 'ssl') ? 'selected' : '') }}>ssl</option>
                                                                            </select>
                                                                            @if ($errors->has('mail_smtpcrypto'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtpcrypto') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <strong><label for="horizontal-mail_smtp_user-input" class="col-sm-12 col-form-label"> SMTP Username</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <input type="text"  class="form-control" value="{{ !empty($gateway_detail->mail_smtp_user) ? $gateway_detail->mail_smtp_user : '' }}"  name="mail_smtp_user" id="mail_smtp_user" placeholder="Enter Your SMTP Username here">

                                                                            @if ($errors->has('mail_smtp_user'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtp_user') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <strong><label for="horizontal-mail_smtp_email-input" class="col-sm-12 col-form-label"> SMTP Email</label></strong>
                                                                        <div class="col-sm-12">
                                                                            <input type="text"  class="form-control" value="{{ !empty($gateway_detail->mail_smtp_email) ? $gateway_detail->mail_smtp_email : '' }}"  name="mail_smtp_email" id="mail_smtp_email" placeholder="Enter Your SMTP Email here">

                                                                            @if ($errors->has('mail_smtp_email'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtp_email') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <strong><label for="horizontal-mail_smtp_pass-input" class="col-sm-12 col-form-label"> SMTP Pass</label></strong>
                                                                        <div class="col-sm-12">
                                                                                <input type="password"  class="form-control" value="{{ !empty($gateway_detail->mail_smtp_pass) ? $gateway_detail->mail_smtp_pass : '' }}"  name="mail_smtp_pass" id="mail_smtp_pass" placeholder="Enter Mail SMTP Pass here">

                                                                            @if ($errors->has('mail_smtp_pass'))
                                                                                <span class="text-danger">{{ $errors->first('mail_smtp_pass') }}</span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="col-sm-12" style="text-align: center;">
                                                                            <input name="mail_setting_key" type="hidden" value="{{ $setting->key_name }}">
                                                                            <button type="submit" class="btn btn-primary w-md">SAVE</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    @php
                                                    $totalMailSettings--;
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
                    <br/><br/>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('customScripts')
   <script>
        $(document).ready(function () {
          $('.select2').select2();
        });

        function goDoSomething(data_id, data_option) {
            $("#paymentgatewayset").val('payment_gateway_' + data_id + '_' + data_option);
        }
 </script>
@endpush
