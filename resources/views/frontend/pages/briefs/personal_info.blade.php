@extends('frontend.layouts.brief.master')
@section('container')
@push('customStyles')
<style>
	input[type=number]::-webkit-outer-spin-button,
	input[type=number]::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
		-moz-appearance: textfield;
	}
</style>
@endpush

<form class="step-form" action="{{route('front.slug','brief/thankyou')}}" method="GET">
	<section class="step-container">
		<div class="step-center top-48-desktop">
			<div class="container">
				<div class="step-heading">
					<h1>Fill In Details To Get It Moving</h1>
				</div>
				<div class="step-input-area max-700">
					<div class="row">
						<div class="col-12">
							<input type="text" placeholder="Please Enter Your Name (Required)" name="cus_name" id="cus_name" class="step-input" required>
						</div>
						<div class="col-12">
							<input type="email" placeholder="Please Enter Your Email (Required)" name="cus_email" id="cus_email" class="step-input" required>
						</div>
						<div class="col-12 step-number-hidden" id="step-number-hidden">
							<input type="number" min="0" placeholder="Please Enter Your Number (Optional)" name="cus_phone" id="cus_phone" class="step-input">
						</div>
						<div class="col-12 text-center">
							<div class="click-show-hide">
								Add Your Phone Number (Optional)
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="step-footer">
		<div class="step-footer-loader" data-load-from-per="90" data-load-per="100"></div>
		<div class="container">
			<div class="step-form-submit-area">
				<input type="hidden" id="ip" name="ip" value="" />
				<input type="hidden" id="city" name="city" value="" />
				<input type="hidden" id="region" name="region" value="" />
				<input type="hidden" id="country" name="country" value="" />
				<input type="hidden" id="postal_code" name="postal_code" value="" />
				<input type="hidden" id="timezone" name="timezone" value="" />
				<input type="hidden" name="cname" value="{{ isset($cname) ? $cname : '' }}">
				<input type="hidden" name="sname" value="{{ isset($sname) ? $sname : '' }}">
				@foreach($industry as $ind)
				<input type="hidden" name="industry[]" value="{{$ind}}">
				@endforeach
				@foreach($logo_type as $logotype)
				<input type="hidden" name="logo_type[]" value="{{$logotype}}">
				@endforeach
				@foreach($logocolor as $lc)
				<input type="hidden" name="logocolor[]" value="{{$lc}}">
				@endforeach
				@foreach($logo_style as $ls)
				<input type="hidden" name="logo_style[]" value="{{$ls}}">
				@endforeach
				<input type="submit" value="Skip" class="step-form-submit">
			</div>
		</div>
	</section>
</form>
@endsection