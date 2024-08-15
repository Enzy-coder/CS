<ul class="cart-item-wrap">
    @foreach ($all_wishlist_items as $key => $item)
        @php $product = $products->find($key); @endphp
        @foreach ($item as $wishlist_item)
            @php
                $price = $wishlist_item['attributes']['price'] ?? $product->sale_price;
                $deleted_price = $product->price ?? null;
                if (!empty($wishlist_item['attributes']['price'])) {
                    if ($wishlist_item['attributes']['price'] != $product->sale_price) {
                        $deleted_price = $product->sale_price;
                    }
                }
            @endphp
            <li class="single-cart-item">
                <div class="first-content">
                    <div class="cart-img">
                        <a href="{{ route('frontend.products.single', $product->slug) }}">
                            {!! render_image_markup_by_attachment_id($product->image, '', 'grid') !!}
                        </a>
                    </div>
                    <div class="cart-content">
                        <h4 class="product-title">
                            <a href="{{ route('frontend.products.single', $product->slug) }}">
                                {{ $product->title }} {{ getItemAttributesName($wishlist_item['attributes']) }}
                            </a>
                        </h4>
                        <div class="cart-price">
                            <span class="new">{{ float_amount_with_currency_symbol($price) }}</span>
                            @if($deleted_price)
                            <span><del>{{ float_amount_with_currency_symbol($deleted_price) }}</del></span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="second-content">
                    <span class="number-of-product"> ({{ $wishlist_item['quantity'] }})</span>
                    <div class="del-icon">
                        <a href="#1" class="remove_wishlist_item" data-id="{{ $wishlist_item['id'] }}" data-attr="{{ json_encode($wishlist_item['attributes']) }}">
                            <i class="lar la-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    @endforeach
</ul>
<div class="btn-section">
    <div class="btn-wrapper">
        <a href="{{ route('frontend.products.wishlist') }}" class="btn-default">{{ __('view wishlist') }}</a>
    </div>
</div>
