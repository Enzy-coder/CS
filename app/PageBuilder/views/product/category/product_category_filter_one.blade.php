<div class="shop-wrapper category_filter_section" data-items="{{ $items }}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-wrapper">
                    <h2 class="section-title">{{ $section_title }}</h2>
                    <div class="img-box">
                        {!! render_image_markup_by_attachment_id($title_image) !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="btn-list-wrapper">
                    <ul class="btn-list btn-wrapper">
                        @foreach ($categories as $category)
                            <li class="category_item" data-catid="{{ $category->id }}">{{ $category->title }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="grid-wrapper category_filter_section_product_container">
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