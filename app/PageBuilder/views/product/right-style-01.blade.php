<!-- Featured area Starts -->
<section class="featured-area padding-top-50 padding-bottom-50">
    <div class="section-title text-left section-border-bottom">
        <div class="title-left">
            <h2 class="title"> {{ $section_title }} </h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="global-slick-init deal-slider nav-style-one nav-color-two slider-inner-margin"
                 data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4"
                 data-swipeToSlide="true"
                 data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                 data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                 data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1} }]'>
                @foreach($products as $product)
                    <x-product::frontend.grid-style-01 :$product :$loop />
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Featured area end -->