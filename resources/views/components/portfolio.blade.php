<div class="portfolio-tabs mt-4">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" role="tab" aria-controls="all" aria-selected="true">All</button>
        </li>
        @if(!empty($services))
      @forelse($services as $service)

        <li class="nav-item" role="presentation">
            <button class="nav-link" id="{{ $service->name."-tab" }}" data-bs-toggle="tab" data-bs-target="{{ "#tabs-".$service->id }}" type="button" role="tab" aria-controls="{{ $service->name }}" aria-selected="false">{{ $service->title }}</button>
        </li>
        @empty
      @endforelse
      @endif

    </ul>
</div>

<div class="tab-content mt-5" id="myTabContent">
    <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">

         <div class="row">

            @forelse($all_portfolios as $portfolio)
            <div class="col-md-4 mt-md-4">
                <div class="img-div">
                    <div class="portfolio-overlay-img">
                        <a href="{{ asset($portfolio->popup) }}" data-fancybox="gallery">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                    <img src="{{ asset($portfolio->image) }}" alt="">


                </div>
            </div>
            @empty
        @endforelse
           

        </div>


    </div>

    @if(!empty($services))
      @forelse($services as $service)
   

    <div class="tab-pane fade" id="{{ "tabs-".$service->id }}" role="tabpanel" aria-labelledby="{{ $service->name."-tab" }}">

        <div class="row">
            
        @forelse($service->portfolios as $portfolio)
            <div class="col-md-4 mt-md-4">
                <div class="img-div">
                    <div class="portfolio-overlay-img">
                        <a href="{{ asset($portfolio->popup) }}" data-fancybox="gallery">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                    <img src="{{ asset($portfolio->image) }}" alt="">


                </div>
            </div>
            @empty
        @endforelse
        </div>
    </div>
      

    @empty
   @endforelse
 @endif
</div>