@php
    $wishlist = $wishlist ?? false;
@endphp

<div class="cart-area">
    <div class="container container-one">
        <div class="cart-wrapper">
            <div class="row g-4">
                <div class="col-xl-8 mt-4 m-auto">
                    <div class="table-list-content table-cart-clear">
                        <div class="table-responsive table-responsive--md">
                            <table class="custom--table table-border radius-10">
                                <thead class="head-bg">
                                    <tr>
                                        <th> {{ __('Product Name') }} </th>
                                        <th> {{ __('Unite Price') }} </th>
                                        <th> {{ __('Quantity') }} </th>
                                        <th> {{ __('Total Price') }} </th>
                                        <th> {{ __('Action') }} </th>
                                    </tr>
                                </thead>
                                <tbody class="cart-table-body">
                                    @foreach ($all_cart_items as $key => $cart_item)
                                        <tr class="table-cart-row" data-product_hash_id="{{ $cart_item->rowId }}"
                                            data-product-id="{{ $key }}"
                                            data-varinat-id="{{ $cart_item?->options?->variant_id ?? 'admin' }}">
                                            <td data-label="Product Name">
                                                <div class="product-name-table">
                                                    <a
                                                        href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                                        <div class="thumbs bg-image radius-10"
                                                            style="background-image: url({{ render_image($cart_item?->options['image'] ?? 0, render_type: 'path') }});">
                                                        </div>
                                                    </a>

                                                    <div class="carts-contents">
                                                        <a
                                                            href="{{ route('frontend.products.single', $cart_item->options->slug ?? '') }}">
                                                            <span class="name-title">{{ $cart_item->name }}</span>
                                                        </a>

                                                        <p>
                                                            @if (!empty($cart_item?->options['color_name'] ?? null))
                                                                {{ __('Color:') }}
                                                                {{ $cart_item?->options['color_name'] }} ,
                                                            @endif

                                                            @if (!empty($cart_item?->options['size_name'] ?? null))
                                                                {{ __('Size:') }}
                                                                {{ $cart_item?->options['size_name'] ?? null }} ,
                                                            @endif

                                                            @if (!empty($cart_item?->options?->attributes ?? null))
                                                                @foreach ($cart_item?->options?->attributes as $key => $value)
                                                                    @if ($loop->last)
                                                                        {{ $key }} : {{ $value }}
                                                                    @else
                                                                        {{ $key }} : {{ $value }} ,
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        </p>

                                                    </div>
                                                </div>
                                            </td>
                                            <td class="price-td text-center" data-label="Unite Price">
                                                {{ amount_with_currency_symbol($cart_item->price) }} </td>
                                            <td data-label="Quantity">
                                                <div class="product-quantity">
                                                    <span class="substract"><i class="las la-minus"></i></span>
                                                    <input class="quantity-input" type="number"
                                                        value="{{ $cart_item->qty }}"><span class="plus"><i
                                                            class="las la-plus"></i></span>
                                                </div>
                                            </td>
                                            <td class="color-one price-td text-center" data-label="Total Price">
                                                {{ amount_with_currency_symbol($cart_item->price * $cart_item->qty ?? 0) }}
                                            </td>
                                            <td data-label="Close">
                                                @if ($wishlist)
                                                    <a data-label="Move" data-type="tr"
                                                        data-product_hash_id="{{ $cart_item->rowId }}" href="#1"
                                                        class="ff-jost move-cart px-3 btn btn-info">
                                                        <span class="icon-close text-light">
                                                            <i class="las la-shopping-cart"></i>
                                                        </span>
                                                    </a>
                                                    <a data-label="Close" data-type="tr"
                                                        data-product_hash_id="{{ $cart_item->rowId }}" href="#1"
                                                        class="ff-jost remove-wishlist px-3 btn btn-danger">
                                                        <span class="icon-close text-light">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </a>
                                                @else
                                                    <a data-label="Move" data-type="tr"
                                                        data-product_hash_id="{{ $cart_item->rowId }}" href="#1"
                                                        class="ff-jost move-wishlist px-3 btn btn-info">
                                                        <span class="icon-close text-light">
                                                            <i class="lar la-heart"></i>
                                                        </span>
                                                    </a>
                                                    <a data-label="Close" data-type="tr"
                                                        data-product_hash_id="{{ $cart_item->rowId }}" href="#1"
                                                        class="ff-jost remove-cart px-3 btn btn-danger">
                                                        <span class="icon-close">
                                                            <i class="las la-trash-alt"></i>
                                                        </span>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @if (!$wishlist)
                            <div class="table-update-btn margin-top-40 gap-4">
                                <a href="#1" class="btn-update text-white btn-info cart-update-table btn-table btn-border-1">
                                    {{ __('Update Cart') }}
                                </a>

                                <a href="{{ route('frontend.checkout') }}" class="btn-table btn-border-1 btn-success text-light">
                                    {{ __('Checkout') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
