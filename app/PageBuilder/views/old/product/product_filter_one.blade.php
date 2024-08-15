<div class="top-product-wrapper">
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
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-list-wrapper">
                    <ul class="btn-list btn-wrapper product_filter_style_one_btn_list">
                        <li id="product_filter_featured_products" class="active">{{ __('Featured') }}</li>
                        <li id="product_filter_top_selling" class="">{{ __('New Arrival') }}</li>
                        <li id="product_filter_new_products" class="">{{ __('New') }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid-wrapper" id="product_filter_section">
            @foreach ($all_products as $product)
                <div class="single-grid">
                    <x-frontend.product.product-card-03 :product="$product" />
                </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-60">
                    <a href="{{ url('shop-page')() }}" class="btn-default rounded-btn semi-bold">{{ __('see all') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
