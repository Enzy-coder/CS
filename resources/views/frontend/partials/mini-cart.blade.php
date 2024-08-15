<ul class="cart-item-wrap">
    @foreach ($all_cart_items as $key => $item)
        @php
            $product = $products->find($key);
            $pid = $product_stock_attributes
                                        ->where('id', $key)
                                        ->where('attribute_name', 'Color')
                                        ->where('attribute_value', 'Green');
            $pid_id = $pid->count() ? $pid->first()->inventory_details_id : null;
        @endphp

        @foreach ($item as $cart_item)
            @php
                $price = $cart_item['attributes']['price'] ?? $product->sale_price;
                $deleted_price = $product->price ?? null;
                if (!empty($cart_item['attributes']['price'])) {
                    if ($cart_item['attributes']['price'] != $product->sale_price) {
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
                                {{ $product->title }} {{ getItemAttributesName($cart_item['attributes']) }}
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
                    <span class="number-of-product"> ({{ $cart_item['quantity'] }})</span>
                    <div class="del-icon">
                        <a href="#1" class="remove_cart_item"
                           data-id="{{ $cart_item['id'] }}"
                           data-attr="{{ json_encode($cart_item['attributes']) }}"
                           @if(isset($pid_id) && $pid_id) data-pid_id="{{ $pid_id }}" @endif
                        >
                            <i class="lar la-trash-alt"></i>
                        </a>
                    </div>
                </div>
            </li>
        @endforeach
    @endforeach
</ul>
<div class="total-price">
    <span class="text">{{ __('Subtotal') }}</span>
    <span class="text sum">{{ float_amount_with_currency_symbol($subtotal) }}</span>
</div>
<div class="btn-section">
    <div class="btn-wrapper">
        <a href="{{ route('frontend.products.cart') }}" class="btn-default">{{ __('Shopping Cart') }}</a>
        <a href="{{ route('frontend.checkout') }}" class="btn-default">{{ __('Checkout') }}</a>
    </div>
</div>
