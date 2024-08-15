<!-- Flash Sale area Starts -->
<section class="flashSale_area padding-top-100 padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                    <div class="flashSale_countdown">
                        <span class="flashSale_countdown__para">{{ __("On Ending in") }}</span>
                        <div class="loopCounter_flash loopCounter_global" data-date="{{ $campaign?->end_date?->format("Y-m-d h:i:s") }}">
                            <div class="loopCounter_global__item"><span class="counter-days"></span> {{ __("D") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-hours"></span> {{ __("H") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-minutes"></span> {{ __("M") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-seconds"></span> {{ __("S") }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 row-cols-xl-6 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-vxxs-2 row-cols-1 mt-4">
            @foreach($campaign->product ?? [] as $product)
                <x-product::frontend.campaign-grid-style-02 :$product :$loop />
            @endforeach
        </div>

        <div class="row">
            <div class="col">
                <div class="btn-wrapper center-text mt-4 mt-lg-5">
                    <a href="{{ route("frontend.products.campaign", $campaign->slug ?? "") }}" class="cmn-btn btn-outline-5 btn-small color-five radius-0">{{ __("Explore More") }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Flash Sale area end -->