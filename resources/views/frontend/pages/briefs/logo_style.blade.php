@extends('frontend.layouts.brief.master')
@section('container')
@push('customStyles')

@endpush

    <form class="step-form" action="{{route('front.slug','brief/colorpicker')}}">
		
		<section class="step-container">
			<div class="step-center top-mob">
				<div class="container">
					<div class="step-heading">
						<h1>Please Choose Your Logo Design Style & Preference</h1>
					</div>
					<div class="step-input-area max-900">
						<div class="row">
							<div class="col-12">
							    <p class="p-left-bar">Vintage</p>
							    <p class="p-right-bar">Modern</p>
								<input type="range" min="-100" max="100" value="0" name="vin_modern" class="step-slider">
							</div>
							<div class="col-12">
							    <p class="p-left-bar">Sophisticated</p>
							    <p class="p-right-bar">Fancy</p>
								<input type="range" min="-100" max="100" value="0" name="sophi_fancy" class="step-slider">
							</div>
							<div class="col-12">
							    <p class="p-left-bar">Delicate</p>
							    <p class="p-right-bar">Strong</p>
								<input type="range" min="-100" max="100" value="0" name="deli_strong" class="step-slider">
							</div>
							<div class="col-12">
							    <p class="p-left-bar">Economical</p>
							    <p class="p-right-bar">Expensive</p>
								<input type="range" min="-100" max="100" value="0" name="eco_expensive" class="step-slider">
							</div>
							<div class="col-12">
							    <p class="p-left-bar">Geometric</p>
							    <p class="p-right-bar">Organic</p>
								<input type="range" min="-100" max="100" value="0" name="geo_organic" class="step-slider">
							</div>
							<div class="col-12">
							    <p class="p-left-bar">Conceptual</p>
							    <p class="p-right-bar">Exact</p>
								<input type="range" min="-100" max="100" value="0" name="con_exact" class="step-slider">
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<section class="step-footer">
		    <div class="step-footer-loader" data-load-from-per="30" data-load-per="50"></div>
		    <div class="container">
		        <div class="step-form-submit-area">
                <input type="hidden" name="cname" value="{{ isset($_GET['cname']) ? $_GET['cname'] : '' }}">
                <input type="hidden" name="sname" value="{{ isset($_GET['sname']) ? $_GET['sname'] : '' }}">
				@foreach($_GET['industry'] as $ind)
				<input type="hidden" name="industry[]" value="{{$ind}}">
					@endforeach
		            <input type="submit" value="Skip" class="step-form-submit">
		        </div>
		    </div>
		</section>
	</form>

@endsection