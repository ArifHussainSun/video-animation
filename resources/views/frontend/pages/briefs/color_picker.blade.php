@extends('frontend.layouts.brief.master')
@section('container')
@push('customStyles')

@endpush
<form class="step-form" action="{{route('front.slug','brief/logotype')}}">

	<section class="step-container">
		<div class="step-area">
			<div class="container">
				<div class="step-heading">
					<h1>Every Design Needs Some Colors</h1>
				</div>
				<div class="step-input-area max-900 small-tick-area">
					<div class="row justify-content-center">
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Red" id="myCheckbox1">
							<label class="step-label" for="myCheckbox1">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/1.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236462135" alt="">
								</div>
								<h3 class="step-label-heading">Red</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Pink" id="myCheckbox2">
							<label class="step-label" for="myCheckbox2">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/2.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236462154" alt="">
								</div>
								<h3 class="step-label-heading">Pink</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Purple" id="myCheckbox3">
							<label class="step-label" for="myCheckbox3">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/3.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236463440" alt="">
								</div>
								<h3 class="step-label-heading">Purple</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Blue" id="myCheckbox4">
							<label class="step-label" for="myCheckbox4">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/4.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236462999" alt="">
								</div>
								<h3 class="step-label-heading">Blue</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Aqua" id="myCheckbox5">
							<label class="step-label" for="myCheckbox5">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/5.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236463058" alt="">
								</div>
								<h3 class="step-label-heading">Aqua</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Green" id="myCheckbox6">
							<label class="step-label" for="myCheckbox6">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/6.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236463740" alt="">
								</div>
								<h3 class="step-label-heading">Green</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Orange" id="myCheckbox7">
							<label class="step-label" for="myCheckbox7">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/7.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236464022" alt="">
								</div>
								<h3 class="step-label-heading">Orange</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Grey" id="myCheckbox8">
							<label class="step-label" for="myCheckbox8">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/8.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236464328" alt="">
								</div>
								<h3 class="step-label-heading">Grey</h3>
							</label>
						</div>

						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Brown" id="myCheckbox9">
							<label class="step-label" for="myCheckbox9">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/9.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236465252" alt="">
								</div>
								<h3 class="step-label-heading">Brown</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Yellow" id="myCheckbox10">
							<label class="step-label" for="myCheckbox10">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/10.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236465967" alt="">
								</div>
								<h3 class="step-label-heading">Yellow</h3>
							</label>
						</div>
						<div class="col-lg-3 col-md-4 col-6">
							<input type="checkbox" name="logocolor[]" class="step-selective" value="Designers Choice" id="myCheckbox11">
							<label class="step-label" for="myCheckbox11">
								<div class="step-img-holder">
									<img src="https://ik.imagekit.io/ffhhlkumnsf/logofie/assets/images/steps/step3/11.jpg?ik-sdk-version=javascript-1.4.3&updatedAt=1643236466514" alt="">
								</div>
								<h3 class="step-label-heading">Designer's Choice</h3>
							</label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="step-footer">
		<div class="step-footer-loader" data-load-from-per="50" data-load-per="70"></div>
		<div class="container">
			<div class="step-form-submit-area">

				<input type="hidden" name="cname" value="{{ isset($cname) ? $cname : '' }}">
				<input type="hidden" name="sname" value="{{ isset($sname) ? $sname : '' }}">
				@foreach($industry as $ind)
				<input type="hidden" name="industry[]" value="{{$ind}}">
				@endforeach
				@foreach($logostyle as $ls)
				<input type="hidden" name="logo_style[]" value="{{$ls}}">
				@endforeach
				<input type="submit" value="Skip" class="step-form-submit">
			</div>
		</div>
	</section>
</form>

@endsection