<!-- popular dress area start -->
<div class="popular-dress-area-wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="section-title-wrapper style-02-new">
                    <h2 class="main-title">{{ $title }}</h2>
                    <p class="sub-title">{{ $description }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container custom-container-1618 filter-two-main-container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="our-stor-isotop-btn-wrapper">
                    <ul class="our-stor-btn-list">
                        <li data-filter="new-items" class="product_filter_style_two active">New items</li>
                        <li data-filter="top-rated" class="product_filter_style_two">Top Rated</li>
                        <li data-filter="top-selling" class="product_filter_style_two">Top Selling</li>
                        <li data-filter="campaign" class="product_filter_style_two">Campaign</li>
                        <li data-filter="discounted" class="product_filter_style_two">Discounted</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="our-store-item-wrap product-filter-style-two-product-wrapper" data-item-limit="{{ $items }}">
            <div class="filter-style-block-preloader lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="row filter-item-wrap">
                @foreach ($all_products as $item)
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <x-frontend.product.product-card-03 :item="$item" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
<!-- popular dress area end -->
