
<!-- Banner area Starts -->
<div class="banner-area banner-four section-bg">
    <div class="container">
        <div class="global-slick-init dot-style-one dot-color-five" data-infinite="true" data-arrows="true" data-dots="true"
             data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
             data-autoplaySpeed="3000" data-autoplay="true">
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
                @endphp
                <div class="banner-slider-item">
                    <div class="row gy-5 align-items-center">
                        <div class="col-lg-6">
                            <div class="middle-content">
                                <h2 class="banner-middle-title">
                                    <a href="{{ route("frontend.products.single", $product->slug) }}">
                                        {{ $product->name }}
                                    </a>
                                </h2>
                                <span class="middle-para mt-4">
                                    {{ $product->sumarry }}
                                </span>
                                <h5 class="middle-price mt-4">{{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }} <s>{{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}</s></h5>
                                <div class="btn-wrapper btn_flex mt-4">

                                    @if($product?->inventory_detail_count > 0)
                                        <a href="javacript:void(0)" data-action-route="{{ route('frontend.products.single-quick-view', $product->slug) }}" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="cmn-btn btn-bg-5 radius-0 product-quick-view-ajax">{{ __("Shop Now") }}</a>
                                    @else
                                        <a href="javacript:void(0)" data-id="{{ $product->id }}" class="cmn-btn btn-bg-5 radius-0 add_to_buy_now_ajax">{{ __("Shop Now") }}</a>
                                    @endif
                                    <a href="{{ route("frontend.products.single", $product->slug) }}" class="cmn-btn btn-outline-5 color-five radius-0">{{ __("Explore More") }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="banner-wrapper">
                                <div class="banner-wrapper-offer">
                                    <span class="banner-wrapper-offer-shape">
                                        <img src="{{ asset("assets/img/banner/offer-shape.png") }}" alt="">
                                    </span>
                                    <div class="banner-wrapper-offer-inner">
                                        <span class="parcent">{{ round($campaign_percentage) }}%</span>
                                        <span class="off">{{ __("off") }}</span>
                                    </div>
                                </div>
                                <div class="banner-wrapper-thumb">
                                    {!! render_image($product->image) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Banner area end -->