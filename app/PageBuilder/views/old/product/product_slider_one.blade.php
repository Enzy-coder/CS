<div class="deal-fo-the-week-area-wrapper index-01">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title-wrapper-02">
                    <h2 class="section-title">{{ $banner_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 extra @if (isset($row_direction) && $row_direction == 'opposite') flex-row-reverse @endif">
            <div class="col-6 col-sm-5 col-md-4 col-lg-3">
                <div class="add-banner-y-style-02">
                    <a href="{{ $image_link }}">
                        {!! render_image_markup_by_attachment_id($banner_image, '', 'grid', true) !!}
                    </a>
                    <div class="content">
                        <h4 class="title">{{ $section_title }}</h4>
                        <div class="flash-countdown-1 flash-countdown-style-2" data-date="{{ $end_date }}">
                            <div class="single-box">
                                <span class="counter-days item time">00</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-hours item time">00</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-minutes item time">00</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-seconds item time">00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-sm-7 col-md-8 col-lg-9">
                <div class="row custom-product-slider-inst">
                    @foreach ($all_products as $product)
                        <div class="col-lg-12">
                            <x-frontend.product.product-card :product="$product" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
