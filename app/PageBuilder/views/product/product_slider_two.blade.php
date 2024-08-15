<div class="fruits-area-wrapper index-01">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title-wrapper-02">
                    <h2 class="section-title">{{ $banner_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 extra @if (isset($row_direction) && $row_direction == 'opposite') flex-row-reverse @endif">
            <div class="col-sm-5 col-md-4 col-lg-3">
                <div class="add-banner-y-style-01">
                    <a href="{{ url($button_url) }}">
                        {!! render_image_markup_by_attachment_id($banner_image, '', 'grid', true) !!}
                    </a>
                    <div class="content">
                        <span class="sub-title">{{ $banner_subtitle }}</span>
                        <h4 class="title">{{ $banner_title }}</h4>
                        <div class="btn-wrapper">
                            <a href="{{ url($button_url) }}" class="shop-now-btn-style-01">{{ $button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-md-8 col-lg-9">
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
