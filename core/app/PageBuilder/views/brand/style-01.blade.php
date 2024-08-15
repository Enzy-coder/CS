<!-- Client Logo area Starts -->
<div class="clent-logo-area padding-top-50 padding-bottom-50">
    <div class="section-title text-left section-border-bottom">
        <div class="title-left">
            <h2 class="title"> {{ $section_title }} </h2>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="global-slick-init client-logo-slider nav-style-one nav-color-two slider-inner-margin" data-infinite="true" data-arrows="true"
                 data-dots="false" data-slidesToShow="5" data-swipeToSlide="true"
                 data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                 data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                 data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 4}},{"breakpoint": 1400,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768, "settings": {"slidesToShow": 2} }]'>
                @foreach($brands as $brand)
                    <div class="client-logo-single">
                        <div class="slingle-client">
                            <a href="#1">
                                {!! render_image($brand?->logo) !!}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- Client Logo area end -->