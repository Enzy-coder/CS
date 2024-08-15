<div class="deal-fo-the-week-area-wrapper index-02">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{{ $section_title }}</h2>
                    <div class="img-box">
                        {!! render_image_markup_by_attachment_id($title_image, '', 'grid', false) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row deal-of-the-week-slider-inst-index-02">
            @foreach ($all_products as $product)
                <div class="col-lg-12">
                    <x-frontend.product.product-card-03 :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</div>
