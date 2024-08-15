<!-- Deal area starts -->
<section class="deal-area padding-top-50 padding-bottom-50">
    <div class="deal-area-wrapper sidebar-wrapper single-border radius-10">
        <div class="row justify-content-center">
            <div class="col-xxl-12 col-lg-6">
                <div class="deal-wrapper center-text">
                    <h3 class="sidebar-title fw-500 mb-4"> {{ $section_title ?? "Deal of the Week!" }} </h3>
                    <div class="global-slick-init flash-store-sliders nav-style-two nav-color-two dot-style-one dot-color-two" data-infinite="true"
                         data-arrows="true" data-swipeToSlide="true"
                         data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                         data-autoplay="true"
                         data-autoplaySpeed="2500"
                         data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                         data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 992,"settings": {"arrows": false,"dots": true}},{"breakpoint": 768, "settings": { "arrows": false,"dots": true} }]'>
                        @foreach($campaign?->product ?? [] as $product)
                            <x-product::frontend.card-style-01 :product="$product" :campaign="$campaign"/>
                        @endforeach
                    </div>
                    <div class="sidebar-countdown-area single-border-top center-text mt-4 pt-4 flash-countdown justify-content-center">
                        <div class="loopCounter_flash loopCounter_global m-auto" data-date="{{ $campaign?->end_date?->format("Y-m-d h:i:s") }}">
                            <div class="loopCounter_global__item"><span class="counter-days"></span> {{ __("D") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-hours"></span> {{ __("H") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-minutes"></span> {{ __("M") }}</div>
                            <div class="loopCounter_global__item"><span class="counter-seconds"></span> {{ __("S") }}</div>
                        </div>
                        <span class="side-offer color-light d-block mt-2"> {{ __("Remains until end of the offer") }} </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Deal area end -->