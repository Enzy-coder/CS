<!-- Flash Sale Starts -->
<section class="flashSale__area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ $campaign->title ?? '' }}</h2>
                    <div class="global__countdown">
                        <div class="flashCountdown" data-date="{{ $campaign?->end_date ? $campaign->end_date->format('Y-m-d') ?? '' : '' }}">
                            <div class="global__countdown__item">
                                <span class="counter-days global__countdown__count radius-5"></span>
                                <span class="global__countdown__name">{{ __("D") }}</span>
                            </div>
                            <div class="global__countdown__item">
                                <span class="counter-hours global__countdown__count radius-5"></span>
                                <span class="global__countdown__name">{{ __("H") }}</span>
                            </div>
                            <div class="global__countdown__item">
                                <span class="counter-minutes global__countdown__count radius-5"></span>
                                <span class="global__countdown__name">{{ __("M") }}</span>
                            </div>
                            <div class="global__countdown__item">
                                <span class="counter-seconds global__countdown__count radius-5"></span>
                                <span class="global__countdown__name">{{ __("S") }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row gy-5 mt-1">
            @foreach($campaign->product ?? [] as $product)
                <x-product::frontend.grid-style-05 :$product class="btn__black" />
            @endforeach
        </div>
    </div>
</section>
<!-- Flash Sale end -->