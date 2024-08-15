@php
    $attributes = $product?->inventory_detail_count ?? null;
    $campaign_product = $product->campaign_product ?? null;
    $campaignProductEndDate = $product->campaign->end_date ?? $product->campaign->end_date->end_date ?? '';
    $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
    $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
    $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
    $campaignSoldCount = $product?->campaign_sold_product;
    $stock_count = $campaign_product ? $campaign_product->units_for_sale - optional($campaignSoldCount)->sold_count ?? 0 : optional($product->inventory)->stock_count;
    $stock_count = $stock_count > (int) get_static_option('product_in_stock_limit_set') ? $stock_count : 0;
    $filter = $filter ?? false;
    $product_img_url = render_image($product->image,render_type: 'url');
    $randomCountDown = rand(1111111,9999999);
@endphp
<div class="modal-dialog modal-xl">
    <div class="modal-content quick-view-modal p-2 py-4 p-sm-4">
        <div class="quick-view-close-btn-wrapper quick-view-details">
            <button class="quick-view-close-btn"><i class="las la-times"></i></button>
        </div>
        <!-- Shop Details area end -->
        <section class="shop-details-area">
            <div class="container container-one">
                <div class="row justify-content-center">
                    <div class="col-xxl-12 col-xl-12">
                        <div class="row g-4">
                            <div class="col-lg-6 col-xl-6">
                                <div class="shop-details-top-slider big-product-image">

                                    <div class="quick-view-shop-details-thumb-wrapper text-center bg-item-five quick-view-product-image"
                                            data-img-src="{{ render_image($product->image,class: 'lazyloads',render_type: 'url') }}">
                                        <div class="shop-details-thums">
                                            {!! render_image($product->image,class: 'lazyloads') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="shop-details-bottom-slider-area mt-4">
                                    <div class="global-slick-quick-view-init shop-details-click-img dot-style-one banner-dots dot-absolute slider-inner-margin"
                                         data-infinite="true" data-slidesToShow="4" data-dots="true"
                                         data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                                         data-autoplaySpeed="3000"
                                        data-autoplay="true" data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
                                        <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                            <div class="shop-details-thums shop-details-thums-small">
                                                {!! render_image($product->image,class: 'lazyloads') !!}
                                            </div>
                                        </div>

                                        @foreach($product->gallery_images as $image)
                                            <div class="shop-details-thumb-wrapper text-center bg-item-five">
                                                <div class="shop-details-thums shop-details-thums-small">
                                                    {!! render_image($image,class: 'lazyloads') !!}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xl-5">
                                <div class="single-shop-details-wrapper">
                                    <h2 class="details-title">{{ $product->name }}</h2>
                                    <div class="rating-wrap">
                                        {!! view('product::components.frontend.common.rating-markup', compact('product')) !!}
                                    </div>

                                    @if($stock_count > 0)
                                        <span data-stock-text="{{ $stock_count }}" class="quick-view-availability text-success">{{ filter_static_option_value('product_in_stock_text', $setting_text, __('In stock')) }} ({{ $stock_count }})</span>
                                    @else
                                        <span data-stock-text="{{ $stock_count }}" class="quick-view-availability text-danger">{{ filter_static_option_value('product_out_of_stock_text', $setting_text, __('Out of stock')) }}</span>
                                    @endif

                                    <div class="price-update-through mt-4">
                                        <h3 class="ff-rubik flash-prices color-one price"
                                            data-main-price="{{ $sale_price }}"
                                            data-currency-symbol="{{ site_currency_symbol() }}"
                                            data-price-percentage="{{ \Modules\TaxModule\Services\CalculateTaxServices::pricesEnteredWithTax() ? $product->tax_options_sum_rate : 0 }}"
                                            id="quick-view-price"> {{ float_amount_with_currency_symbol(calculatePrice($sale_price, $product)) }} </h3>
                                        <span class="fs-22 flash-old-prices" id="deleted_price" data-deleted-price="{{ calculatePrice($deleted_price, $product) }}">
                                            {{ float_amount_with_currency_symbol(calculatePrice($deleted_price, $product)) }}
                                        </span>
                                    </div>

                                    <div class="short-description mt-3">
                                        <p class="info">{!! $product->summary !!}</p>
                                    </div>

                                    @if($productSizes->count() > 0 && !empty(current(current($productSizes))))
                                        <div class="quick-view-value-input-area margin-top-15 size_list">
                                            <span class="input-list">
                                                <strong class="color-light">{{ __('Size:') }}</strong>
                                                <input class="form--input value-size" name="size" type="text" value="">
                                                <input type="hidden" id="quick_view_selected_size">
                                            </span>
                                            <ul class="quick-view-size-lists" data-type="Size">
                                                @foreach($productSizes as $product_size)
                                                    @if(!empty($product_size))
                                                        <li class=""
                                                            data-value="{{ optional($product_size)->id }}"
                                                            data-display-value="{{ optional($product_size)->name }}"
                                                        > {{ optional($product_size)->name }} </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if($productColors->count() > 0 && current(current($productColors)))
                                        <div class="quick-view-value-input-area mt-4 color_list">
                                            <span class="input-list">
                                                <strong class="color-light">{{ __('Color:') }}</strong>
                                                <input class="form--input value-size" disabled name="color" type="text" value="">
                                                <input type="hidden" id="quick_view_selected_color">
                                            </span>

                                            <ul class="quick-view-size-lists color-list" data-type="Color">
                                                @foreach($productColors as $product_color)
                                                    @if(!empty($product_color))
                                                        <li style="background: {{ optional($product_color)->color_code }}"
                                                            class="radius-percent-50"
                                                            data-value="{{ optional($product_color)->id }}"
                                                            data-display-value="{{ optional($product_color)->name }}">
                                                            <span class="color-list-overlay"></span>
                                                            <span style="background: {{ optional($product_color)->color_code }}"></span>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @foreach($available_attributes as $attribute => $options)
                                        <div class="quick-view-value-input-area margin-top-15 attribute_options_list">
                                        <span class="input-list">
                                            <strong class="color-light">{{ $attribute }}</strong>
                                            <input class="form--input value-size" type="text" value="">
                                            <input type="hidden" id="selected_attribute_option"
                                                    name="selected_attribute_option">
                                        </span>
                                            <ul class="quick-view-size-lists" data-type="{{ $attribute }}">
                                                @foreach($options as $option)
                                                    <li class="" data-value="{{ $option }}"
                                                        data-display-value="{{ $option }}" > {{ $option }} </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endforeach

                                    <div class="quantity-area mt-4">
                                        <div class="quantity-flex">
                                            <span class="quantity-title color-light"> {{__("Quantity:")}} </span>
                                            <div class="product-quantity">
                                                <span class="substract"><i class="las la-minus"></i></span><input class="quantity-input" id="quick-view-quantity" type="number" value="01"><span class="plus"><i class="las la-plus"></i></span>
                                            </div>

                                            <span data-stock-text="{{ $stock_count }}" class="quick-view-stock-available {{ $stock_count ? "text-success" : "text-danger" }}"> {{ $stock_count ? "In Stock ($stock_count)" : "Out of stock" }} </span>
                                        </div>
                                        <div class="quantity-btn margin-top-40">
                                            <div class="btn-wrapper">
                                                <a href="#1" data-id="{{ $product->id }}" class="cmn-btn btn-bg-1 radius-0 cart-loading add_to_cart_single_page_quick_view"> {{ __("Add to Cart") }} </a>
                                            </div>
                                            <a href="#1" data-id="{{ $product->id }}" class="heart-btn add_to_wishlist_single_page_quick_view fs-32 color-one radius-0"> <i class="lar la-heart"></i> </a>
                                        </div>
                                    </div>
                                    <div class="wishlist-compare">
                                        <div class="wishlist-compare-btn mt-4">
                                            <a href="#1" data-id="{{ $product->id }}" class="btn-wishlist buy_now_single_page_quick_view btn-details btn-buyNow"> <i class="lar la-cart-arrow-down"></i> {{ __("Buy now") }} </a>
                                            <a href="#1" data-id="{{ $product->id }}" class="btn-wishlist add_to_compare_single_page_quick_view btn-details btn-addCompare"> <i class="las la-retweet"></i> {{ __("Add Compare") }} </a>
                                        </div>
                                    </div>
                                    <div class="shop-details-stock shop-border-top pt-4 mt-4">
                                        <div class="details-checkout-shop">
                                            <span class="guaranteed-checkout fw-500 color-light"> {{ __("Guaranteed Safe Checkout") }} </span>
                                            <div class="global-slick-quick-view-init mt-4 payment-slider nav-style-two dot-style-one slider-inner-margin"
                                                 data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="5" data-swipeToSlide="true"
                                                 data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                                                 data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                                        data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 5}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 4,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 2} }]'>
                                                @foreach($paymentGateways as $gateway)
                                                <div class="slick-item">
                                                    <div class="payment-slider-item">
                                                        {!! render_image($gateway->oldImage) !!}
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <ul class="stock-category mt-4">
                                            <li class="category-list">
                                                <strong> {{ __("Category:") }} </strong>
                                                <a class="list-item" href="{{ route("frontend.products.category", $product?->category?->slug) }}"> {{ $product?->category?->name }} </a>
                                            </li>
                                            <li class="category-list">
                                                <strong> {{ __("Sub Category:") }} </strong>
                                                <a class="list-item" href="{{ route("frontend.products.subcategory", $product?->subCategory?->slug) }}"> {{ $product?->subCategory?->name }} </a>
                                            </li>
                                            <li class="category-list">
                                                <strong> {{ __("Child Category:") }} </strong>
                                                @foreach($product?->childCategory ?? [] as $childCategory)
                                                    <a class="list-item" href="{{ route("frontend.products.child-category", $childCategory?->slug) }}"> {{ $childCategory?->name }} </a>
                                                @endforeach
                                            </li>
                                            <li class="category-list">
                                                <strong> {{{ __("Sku:") }}} </strong>
                                                <label class="list-item"> {{ $product->inventory?->sku }} </label>
                                            </li>
                                        </ul>

                                        @if($product->tag?->isNotEmpty())
                                            <div class="tags-area-shop shop-border-top pt-4 mt-4">
                                                <span class="tags-span color-light"> <strong> {{ __("Tags:") }} </strong> </span>
                                                <ul class="tags-shop-list">
                                                    @foreach($product->tag as $tag)
                                                        <li class="list">
                                                            <a href="{{ route('frontend.products.all', ['tag-name' => $tag->tag_name]) }}"> {{ $tag->tag_name }} </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-12 col-xl-12">
                        <div class="shop-details-right-sidebar">
                            @if($reward ?? "" == true)
                                <div class="single-sidebar-details single-border">
                                    <div class="shop-details-gift center-text">
                                        <a href="#1" class="gift-icon"> <i class="las la-gifts"></i> </a>
                                        <h5 class="reward-title fw-500"> {{ __("Reward Point: 300") }} </h5>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-xl-4 col-md-6">@if($product->vendor)
                                        <div class="single-sidebar-details single-border margin-top-40">
                                            <div class="shop-details-sold center-text">
                                                <h5 class="title-sidebar-global"> {{__("Sold BY:")}} </h5>
                                                <div class="best-seller-sidebar mt-4">
                                                    <a href="#1" class="thumb-brand">
                                                        {!! render_image($product->vendor?->vendor_shop_info?->logo) !!}
                                                    </a>
                                                    <div class="best-seller-contents mt-3">
                                                        <h5 class="common-title-two">
                                                            <a href="#1"> {{ $product->vendor->business_name }} </a>
                                                        </h5>

                                                        <div class="rating-wrap mt-2">
                                                            <div class="rating-wrap">
                                                                <x-product::frontend.common.rating-markup
                                                                        :avg-rattings="$product->vendor->vendor_product_rating_avg_product_ratingsrating"
                                                                        :rating-count="$product->vendor->vendor_product_rating_count" />
                                                            </div>
                                                        </div>

                                                        <a href="{{ route("frontend.vendor.product", $product->vendor->username) }}" class="color-stock d-block fs-16 fw-500 mt-3">
                                                            {{ $product->vendor?->product_count ?? 0 }}{{ __(" Products") }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif</div>
                                <div class="col-xl-4 col-md-6"><div class="single-sidebar-details single-border margin-top-40 px-2">
                                        <div class="shop-details-share center-text px-0">
                                            <h5 class="title-sidebar-global"> {{ __("Share") }}: </h5>
                                            <ul class="share-list mt-4">
                                                {!! single_post_share(route('frontend.products.single', purify_html($product->slug)), purify_html($product->name), $product_img_url) !!}
                                            </ul>
                                        </div>
                                    </div></div>
                                <div class="col-xl-4 col-md-6">@if($product->productDeliveryOption?->isNotEmpty())
                                        <div class="single-sidebar-details single-border margin-top-40">
                                            <div class="shop-details-list">
                                                <ul class="promo-list">
                                                    @foreach($product->productDeliveryOption ?? [] as $option)
                                                        <li class="list">
                                                            <div class="icon"> <i class="{{ $option->icon }}"></i> </div>
                                                            <div class="promon-icon-contents">
                                                                <h6 class="promo-title fw-500"> {{ $option->title }} </h6>
                                                                <span class="promo-para"> {{ $option->sub_title }} </span>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif</div>
                            </div>

                            @if($product->vendor?->product_count > 0)
                                <div class="single-sidebar-details single-border margin-top-40">
                                    <div class="shop-product-slider center-text">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <h5 class="title-sidebar-global text-left"> {{__("Seller's Products")}} </h5>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-lg-12">
                                                <div class="global-slick-quick-view-init deal-slider nav-style-two dot-style-one slider-inner-margin"
                                                     data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-swipeToSlide="true"
                                                     data-rtl="{{get_user_lang_direction() == 'rtl' ? 'true' : 'false'}}"
                                                     data-autoplay="true" data-autoplaySpeed="2500" data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                                                        data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 1}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2,"arrows": false,"dots": true}},{"breakpoint": 768, "settings": {"slidesToShow": 2} },{"breakpoint": 576, "settings": {"slidesToShow": 1} }]'>
                                                    @foreach($product->vendor->product as $product)
                                                        <div class="slick-slider-items wow fadeInUp" data-wow-delay=".{{ $loop->iteration }}s">
                                                            <x-product::frontend.grid-style-03 :$product />
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

{{-- new product modal - end --}}

<script>

    @php
        $product_inventory_set = current($product_inventory_set) ?? "";
    @endphp

    // check condition if those variable are declared than no need to declare again
    window.quick_view_attribute_store = JSON.parse('{!! json_encode($product_inventory_set) !!}');
    window.quick_view_additional_info_store = JSON.parse('{!! json_encode($additional_info_store) !!}');
    window.quick_view_available_options = $('.quick-view-value-input-area');

    loopcounter('flash-countdown-product-quick-view-{{ $randomCountDown }}');
</script>
