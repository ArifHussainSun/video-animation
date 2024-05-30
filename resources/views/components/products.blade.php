@if(!empty($products))
@forelse($products as $product)
<div class="col-md-3 mt-5 mt-md-0">
    <div class="card pricing-1">
        <div class="img-div">
            <div class="shadow-img text-center position-relative">
                <h4>60s</h4>
                <img src="https://ik.imagekit.io/VideoAnimation/Assets/pricing.gif" alt="">
            </div>
        </div>
        <div class="card-upper text-center">
            <h5 class="card-title pricing-heading">{{ $product->name }}</h5>
             <small>{{ $product->subcategory->name }}</small>
            <h3 class="card-title pricing-title pricing-title-2"> <span>$</span>{{ $product->price }}</h3>
        </div>
        <div class="card-body pricing-body mt-4">
            {!! $product->description !!}
        </div>
        <div class="btn-div d-flex justify-content-center mt-4 mt-md-4">
            <a href="{{ route('payment.generatelink',$product->id) }}" class="">Buy Now - Click</a>
        </div>
    </div>
</div>
@empty
@endforelse
@endif