@php
    $productPageSlug = \App\Page::select("slug")->where("id", get_static_option("product_page"))->first();
@endphp

<!-- Popular Porduct area Starts -->
<section class="popularProduct_area padding-bottom-50 padding-top-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                    <a href="{{ route("frontend.dynamic.page", $productPageSlug->slug) }}" class="browseAl">{{ __("Browse All") }}</a>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            @foreach($products as $product)
                @php
                    $campaign_product = $product->campaign_product ?? null;
                    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';
                    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                    $campaignSoldCount = $product?->campaign_sold_product;
                    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
                    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
                    $rating_width = round(($product->ratings_avg_rating ?? 0) * 20);
                    $campaign_percentage = round($campaign_percentage, 0);
                    $attributes = $product?->inventory_detail_count ?? null;
                @endphp

                <div class="col-xl-4 col-md-6">
                    <div class="popularProduct">
                        <div class="popularProduct__flex">
                            <div class="popularProduct__thumb">
                                <a href="{{ route("frontend.products.single", $product->slug) }}">
                                    {!! render_image($product->image) !!}
                                </a>
                                <ul class="popularProduct__thumb__icons hover-color-five">
                                    <x-product::frontend.common.link-option :$product />
                                </ul>
                            </div>
                            <div class="popularProduct__contents">
                                <h5 class="popularProduct__title">
                                    <a href="{{ route("frontend.products.single", $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h5>
                                <h4 class="popularProduct__price mt-2">{{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }}
                                    <s>{{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}</s>
                                </h4>

                                <div class="rating-wrap mt-2">
                                    <div class="rating-wrap">
                                        <x-product::frontend.common.rating-markup :rating-count="$product->ratings_count" :avg-rattings="$product->ratings_avg_rating ?? 0" />
                                    </div>
                                </div>

                                <div class="btn-wrapper mt-3">
                                    @if(isset($attributes) && $attributes > 0)
                                        <a data-type="text" data-old-text="{{ __('View Details') }}" class="product-quick-view-ajax cmn-btn btn-outline-5 btn-small color-five radius-0" href="#1"
                                           data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}">
                                            {{ __("View Details") }}
                                        </a>
                                    @else
                                        <a data-type="text" data-old-text="{{ __('Add to cart') }}" href="#1" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}"
                                           class="cmn-btn btn-outline-5 btn-small color-five radius-0 add_to_cart_ajax">
                                            {{ __("Add to cart") }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Popular Porduct area end -->