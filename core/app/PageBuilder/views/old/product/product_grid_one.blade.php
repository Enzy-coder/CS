<div class="featured-product-area-wrapper index-01">
    <div class="container">
        <div class="row extra">
            <div class="col-8 col-sm-6 col-md-6 col-lg-6">
                <div class="section-title-wrapper-02">
                    <h2 class="section-title">{{ $section_title }}</h2>
                </div>
            </div>
            <div class="col-4 col-sm-6 col-md-6 col-lg-6">
                <div class="btn-wrapper text-right">
                    <a href="{{ $button_url }}" class="btn-default transparent-btn-2">{{ $button_text }}
                        <i class="las la-arrow-right icon"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row extra">
            @foreach ($all_products as $product)
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                    <x-frontend.product.product-card-02 :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
</div>
