 <!-- Offer area starts -->
<section class="offer-area padding-top-50 padding-bottom-50">
    <div class="row">
        <div class="col-lg-12">
            <div class="global-slick-init offer-slider dot-style-one dot-style-two dot-color-two slider-inner-margin"
                 data-infinite="true"
                 data-swipeToSlide="true"
                 data-arrows="false" data-dots="true"
                 data-slidesToShow="3"
                 data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                 data-autoplay="true" data-autoplaySpeed="2000"
                 data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 3}},{"breakpoint": 1400,"settings": {"slidesToShow": 2}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                @foreach($banner_style_for["image_"] as $id)
                    @php
                        $image = $images->where("id", $id)->first();
                    @endphp
                    <div class="slick-slider-item">
                        <div class="offer-thumb-slider radius-10">
                            <a href="{{ $banner_style_for["url_"][$loop->index] }}">
                                {!! render_image($image) !!}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Offer area end -->