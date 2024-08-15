<!-- Brand Logo start -->
<div class="brand_area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="brand__slider">
                    <div class="global-slick-init slider-inner-margin" data-infinite="true" data-arrows="false"
                         data-dots="false" data-slidesToShow="6" data-swipeToSlide="true"
                         data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                         data-autoplay="false"
                         data-autoplaySpeed="2500"
                         data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                         data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>'
                         data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 5}},{"breakpoint": 1400,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 576,"settings": {"slidesToShow": 2}},{"breakpoint": 425, "settings": {"slidesToShow": 2} }]'>
                        @foreach($brands as $brand)
                            <div class="brand__slider__item">
                                <div class="brand__item text-center">
                                    <div class="brand__item__thumb">
                                        {!! render_image($brand->logo) !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Brand Logo end -->