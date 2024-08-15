<div class="checkout-page-content-wrapper mt-4">
    @foreach ($carts as $key => $vendor)
        <div class="card checkout__card mb-3">
            @php
                $c_vendor = $vendors->find($key);
                $adminShippingMethod = null;
                $adminShopManage = null;
                $subtotal = null;
                $default_shipping_cost = null;
                $v_tax_total = 0;

                if (empty($key)) {
                    $adminShippingMethod = \Modules\ShippingModule\Entities\AdminShippingMethod::with('zone')->get();
                    $adminShopManage = \App\AdminShopManage::latest()->first();
                }
            @endphp

            @if (empty($key))
                <div class="card-header checkout__card__header">
                    <h4 class="title checkout__card__title">{{ $adminShopManage?->store_name }}</h4>
                </div>
            @endif

            @if (!empty($c_vendor))
                <div class="card-header checkout__card__header">
                    <h4 class="title  checkout__card__title">{{ $c_vendor?->business_name }}</h4>
                </div>
            @endif

            <div class="card-body checkout__card__body">
                @foreach ($vendor as $item)
                    @php
                        $item->options = (object) $item->options;
                        $taxAmount = $taxProducts->where('id', $item->id)->first();
                        if (!empty($taxAmount)) {
                            $taxAmount->tax_options_sum_rate = $taxAmount->tax_options_sum_rate ?? 0;
                            $price = calculatePrice($item->price, $taxAmount);
                            $regular_price = calculatePrice($item->options->regular_price ?? 0, $item->options);
                            $v_tax_total += calculatePrice($item->price, $taxAmount, 'percentage') * $item->qty;
                        } else {
                            $price = calculatePrice($item->price, $item->options);
                            $regular_price = calculatePrice($item->options->regular_price ?? 0, $item->options);
                        }
                    @endphp
                    <div class="checkout__card__wrap check-cart-flex-contents justify-content-between d-flex">
                        <div class="checkout__card__wrap__product">
                            <div class="checkout__card__thumb checkout-cart-thumb">
                                {!! render_image($item?->options?->image ?? 0, class: 'w-100') !!}
                            </div>
                            <div class="checkout__card__contents checkout-cart-img-contents">
                                <h6 class="checkout__card__item__title checkout-cart-title fs-18">
                                    <a href="#1"> {{ Str::words($item->name, 5) }} </a>
                                    <p>
                                        @if (!empty($item?->options?->color_name ?? null))
                                            {{ __('Color') }}: {{ $item?->options?->color_name }} ,
                                        @endif

                                        @if (!empty($item?->options?->size_name ?? null))
                                            {{ __('Size') }}: {{ $item?->options?->size_name ?? null }} ,
                                        @endif

                                        @if (!empty($item?->options?->attributes ?? null))
                                            @foreach ($item?->options?->attributes as $keyInside => $value)
                                                @if ($loop->last)
                                                    {{ $keyInside }} : {{ $value }}
                                                @else
                                                    {{ $keyInside }} : {{ $value }} ,
                                                @endif
                                            @endforeach
                                        @endif
                                    </p>
                                </h6>
                            </div>
                        </div>

                        <span class="checkout__card__qty d-block product-items w-10">
                            {{ $item->qty ?? '0' }} {{ __('QTY') }}
                        </span>

                        <div class="checkout__card__price d-flex gap-2 w-20">
                            <del class="checkout__card__price__del checkout-cart-price color-heading fw-500">
                                {{ amount_with_currency_symbol($regular_price) }}
                            </del>

                            <b
                                class="checkout__card__price__main checkout-cart-price color-heading fw-500 font-weight-bold">
                                {{ amount_with_currency_symbol($price) }}
                            </b>
                        </div>
                    </div>

                    @php
                        $subtotal += $price * $item->qty;
                        $itemsTotal += $price * $item->qty;
                    @endphp
                @endforeach
            </div>

            @if (!empty($c_vendor))
                <div class="card-footer checkout__card__footer">
                    <h6 class="card-title py-2">{{ __('Shipping Cost') }}</h6>
                    <input type="hidden" class="shipping_cost" name="shipping_cost[{{ $c_vendor->id }}]" />
                    <div class="shippingMethod__wrapper shipping-method-wrapper d-flex gap-2 justify-content-start">
                        @foreach ($c_vendor?->shippingMethod ?? [] as $method)
                            @php
                                $method->cost = calculatePrice($method->cost, $shippingTaxClass, 'shipping');
                                if ($method->is_default) {
                                    $default_shipping_cost = $method->cost;
                                }
                            @endphp
                            <div data-shipping-cost-id="{{ $method->id }}" data-shipping-cost="{{ $method->cost }}"
                                data-shipping-percentage="{{ $shippingTaxClass }}"
                                class="shippingMethod__wrapper__item checkout-shipping-method align-items-center gap-3 border-1 d-flex justify-content-between py-2 px-4 {{ $method->is_default ? 'active' : '' }}">
                                <div class="shippingMethod__wrapper__item__left w-90">
                                    <b>
                                        {{ $method?->title }}
                                    </b>
                                    <p>
                                        {{ __('Zone:') }}
                                        {{ $method?->zone?->name }}
                                    </p>
                                </div>
                                <div class="shippingMethod__wrapper__item__right 10">
                                    <h6>
                                        {{ amount_with_currency_symbol(round($method->cost)) }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <hr />
                    <div class="checkout__card__footer__estimate d-flex justify-content-end">
                        <div class="checkout__card__footer__estimate__main">
                            <div class="checkout__card__footer__estimate__list">
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Sub Total') }}</b> <b id="vendor_subtotal"
                                        class="vendor_subtotal">{{ float_amount_with_currency_symbol($subtotal) }}</b>
                                </div>

                                @if ($enableTaxAmount)
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b>{{ __('Tax Amount') }}</b> <b id="vendor_tax_amount"
                                            class="vendor_tax_amount">{{ float_amount_with_currency_symbol($v_tax_total) }}</b>
                                    </div>
                                @else
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b>{{ __('Tax Amount') }}</b> <b id="vendor_tax_amount"
                                            class="vendor_tax_amount">
                                            {{ get_static_option('display_price_in_the_shop') == 'including' ? __('Inclusive Tax') : '' }}
                                        </b>
                                    </div>
                                @endif

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Shipping Cost') }}</b> <b id="vendor_shipping_cost"
                                        class="vendor_shipping_cost">{{ float_amount_with_currency_symbol($default_shipping_cost) }}</b>
                                </div>
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Total') }}</b>
                                    <b
                                        id="vendor_total">{{ float_amount_with_currency_symbol($subtotal + $default_shipping_cost) }}</b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (empty($key))
                <div class="card-footer checkout__card__footer">
                    <h6 class="checkout__card__title card-title py-2">{{ __('Shipping Cost') }}</h6>
                    <input type="hidden" class="shipping_cost" name="shipping_cost[admin]" />

                    <div class="shippingMethod__wrapper shipping-method-wrapper d-flex gap-2 justify-content-start">
                        @foreach ($adminShippingMethod ?? [] as $method)
                            @php
                                $method->cost = calculatePrice($method->cost, $shippingTaxClass, 'shipping');
                                if ($method->is_default) {
                                    $default_shipping_cost = $method->cost;
                                }
                            @endphp

                            <div data-shipping-cost-id="{{ $method->id }}" data-shipping-cost="{{ $method->cost }}"
                                data-shipping-percentage="{{ $shippingTaxClass }}"
                                class="shippingMethod__wrapper__item checkout-shipping-method align-items-center gap-3 border-1 d-flex justify-content-between py-2 px-4 {{ $method->is_default ? 'active' : '' }}">
                                <div class="shippingMethod__wrapper__item__left w-90">
                                    <b>
                                        {{ $method?->title }}
                                    </b>
                                    <p>
                                        {{ __('Zone: ') }}
                                        {{ $method?->zone?->name }}
                                    </p>
                                </div>
                                <div class="shippingMethod__wrapper__item__right 10">
                                    <h6 class="shippingMethod__wrapper__item__right__price">
                                        {{ amount_with_currency_symbol(round($method->cost)) }}
                                    </h6>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <hr />

                    <div class="checkout__card__footer__estimate d-flex justify-content-end">
                        <div class="checkout__card__footer__estimate__main">
                            <div class="checkout__card__footer__estimate__list">
                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Sub Total') }}</b> <b id="vendor_subtotal"
                                        class="vendor_subtotal">{{ float_amount_with_currency_symbol($subtotal) }}</b>
                                </div>

                                @if ($enableTaxAmount)
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b>{{ __('Tax Amount') }}</b>
                                        <b id="vendor_tax_amount" class="vendor_tax_amount">
                                            {{ float_amount_with_currency_symbol($v_tax_total) }}
                                        </b>
                                    </div>
                                @else
                                    <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                        <b>{{ __('Tax Amount') }}</b>
                                        <b id="vendor_tax_amount" class="vendor_tax_amount">
                                            {{ get_static_option('display_price_in_the_shop') == 'including' ? __('Inclusive Tax') : '' }}
                                        </b>
                                    </div>
                                @endif

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Shipping Cost') }}</b>
                                    <b id="vendor_shipping_cost" class="vendor_shipping_cost">
                                        {{ float_amount_with_currency_symbol($default_shipping_cost) }}
                                    </b>
                                </div>

                                <div class="checkout__card__footer__estimate__item d-flex justify-content-between">
                                    <b>{{ __('Total') }}</b>
                                    <b id="vendor_total">
                                        {{ float_amount_with_currency_symbol($subtotal + $default_shipping_cost) }}
                                    </b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
