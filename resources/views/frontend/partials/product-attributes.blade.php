<div class="user-select-option">
    @if($product->attributes && $product->attributes != 'null')
        @php $product_attributes = decodeProductAttributesOld($product->attributes); @endphp
        @foreach ($product_attributes as $attribute)
        <div class="size section attribute_row">
            <span class="name">{{ $attribute['name'] }}</span>
            <div class="checkbox-color ">
                @foreach ($attribute['terms'] as $term)
                <div class="single-checkbox-wrap attribute">
                    <label>
                        <input type="radio" name="attr_{{ $attribute['name'] }}" data-attr="{{ json_encode($term) }}" class="checkbox">
                        <span data-name="{{ $attribute['name'] }}" data-extra="{{ $term['additional_price'] }}" class="size-code">
                            {{ $term['name'] }} @if (isset($term['additional_price']) && $term['additional_price'] > 0) (+{{ float_amount_with_currency_symbol($term['additional_price']) }}) @endif
                        </span>
                    </label>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
</div>
@endif
<div class="d-flex">
    <div class="input-group">
        <input class="quantity form-control" type="number" min="1" max="10000000" value="1" id="quantity_single_quick_view_btn">
    </div>
    <div class="btn-wrapper">
        <a href="#1" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="btn-default rounded-btn add-cart-style-02 add_to_cart_ajax">
            {{ __('add to cart') }}
        </a>

        <a href="#1" data-attributes="{{ $product->attributes }}" data-id="{{ $product->id }}" class="btn-default rounded-btn add-cart-style-02 buy_now_single_quick_view_btn">
            {{ __('Buy now') }}
        </a>
    </div>
</div>
