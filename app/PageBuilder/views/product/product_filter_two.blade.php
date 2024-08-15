<!-- Trending Porduct Starts -->
<section class="trendingProduct__area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <h2 class="title">{{ $section_title ?? "" }}</h2>
                    <div class="allProduct__tab">
                        <ul class="tabs">
                            <li data-card-style="2" data-item-limit="12" id="product_filter_featured_products" data-tab="featured_product" class="tabs_list">{{ __("Featured") }}</li>
                            <li data-card-style="2" data-item-limit="12" id="product_filter_top_selling" data-tab="top_selling_product" class="tabs_list">{{ __("Top Selling") }}</li>
                            <li data-card-style="2" data-item-limit="12" id="product_filter_new_products" data-tab="weekly_top_product" class="tabs_list">{{ __("Weekly Top") }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gy-5 mt-1" id="product_filter_section">
            @foreach($products as $product)
                <x-product::frontend.grid-style-05 :product="$product" />
            @endforeach
        </div>
    </div>
</section>
<!-- Trending Porduct end -->