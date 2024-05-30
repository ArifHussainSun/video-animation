@extends('frontend.layouts.brief.master')
@section('container')
@push('customStyles')

@endpush
<form class="step-form" action="{{route('front.slug','brief/industry')}}">
    <section class="step-container">
        <div class="step-center top-48-desktop">
            <div class="container">
                <div class="step-heading">
                    <h1>Fill Out Your Details</h1>
                </div>
                <div class="step-input-area max-700">
                    <div class="row">
                        <div class="col-12">
                            <input type="text" placeholder="Company Name" name="cname" id="cname" class="step-input" value="{{ isset($_GET['cname']) ? $_GET['cname'] : '' }}" required>
                        </div>
                        <div class="col-12">
                            <input type="text" placeholder="Company Slogan (Optional)" name="sname" id="sname" class="step-input">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="step-footer">
        <div class="step-footer-loader" data-load-from-per="0" data-load-per="10"></div>
        <div class="container">
            <div class="step-form-submit-area">
                <input type="hidden" name="cname" value="{{ isset($_GET['cname']) ? $_GET['cname'] : '' }}">
                <input type="submit" value="Skip" class="step-form-submit">
            </div>
        </div>
    </section>
</form>
@endsection

@push('customScripts')
<script>
    $(document).ready(function() {
    $('.step-input').keypress(function(){
        
        var otherFormText = $(this).val();
        if(otherFormText!='') {
            $(".step-form-submit").val("Continue");
        } 
        else {
            $(".step-form-submit").val("Skip");
        }
    });  
});
</script>
@endpush
