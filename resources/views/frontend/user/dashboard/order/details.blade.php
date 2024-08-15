@extends('frontend.frontend-master')
@section('style')
    <style>
        /* End Contract Css */
        .end-contract-single {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .end-contract-single:not(:first-child) {
            margin-top: 24px;
        }

        .end-contract-single-select {
            display: -ms-grid;
            display: grid;
        }

        .end-contract-feedback-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--heading-color);
        }

        .end-contract-feedback-para {
            font-size: 16px;
            color: var(--paragraph-color);
            line-height: 24px;
        }

        .end-contract-feedback-single {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
        }

        .end-contract-feedback-single:not(:first-child) {
            margin-top: 24px;
        }

        .end-contract-feedback-single-title {
            font-size: 20px;
            font-weight: 600;
            line-height: 28px;
            color: var(--heading-color);
        }

        .end-contract-feedback-single-title-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: justify;
            -ms-flex-pack: justify;
            justify-content: space-between;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 15px 10px;
        }

        .end-contract-reaction {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            gap: 20px;
        }

        .end-contract-reaction-item {
            border: 1px solid var(--border-color);
            padding: 0px 15px;
            border-radius: 30px;
            line-height: 42px;
            cursor: pointer;
            position: relative;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-item:hover,
        .end-contract-reaction-item.active {
            border-color: var(--secondary-color);
            color: var(--secondary-color);
            background-color: rgba(var(--secondary-color-rgb), 0.1);
        }

        .end-contract-reaction-item:hover .end-contract-reaction-item-tooltip,
        .end-contract-reaction-item.active .end-contract-reaction-item-tooltip {
            visibility: visible;
            opacity: 1;
            z-index: 9;
        }

        .end-contract-reaction-item:hover .end-contract-reaction-icon,
        .end-contract-reaction-item.active .end-contract-reaction-icon {
            border-color: var(--secondary-color);
        }

        .end-contract-reaction-item:hover .end-contract-reaction-review-star,
        .end-contract-reaction-item.active .end-contract-reaction-review-star {
            color: var(--secondary-color);
        }

        .end-contract-reaction-item-tooltip {
            position: absolute;
            top: -30px;
            left: 0;
            text-align: center;
            background: var(--secondary-color);
            color: #fff;
            padding: 3px 12px;
            line-height: 20px;
            border-radius: 3px;
            font-size: 12px;
            display: -webkit-inline-box;
            display: -ms-inline-flexbox;
            display: inline-flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-transition: 0.3s;
            transition: 0.3s;
            visibility: hidden;
            opacity: 0;
        }

        .end-contract-reaction-item-tooltip::before {
            content: "";
            position: absolute;
            left: auto;
            right: auto;
            bottom: -10px;
            height: 0;
            width: 0;
            border-right: 10px solid transparent;
            border-left: 10px solid transparent;
            border-top: 20px solid var(--secondary-color);
            border-radius: 5px;
            z-index: -1;
        }

        .end-contract-reaction-item-flex {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
        }

        .end-contract-reaction-icon {
            border-right: 1px solid var(--border-color);
            padding-right: 10px;
            margin-right: 10px;
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-review-star {
            font-size: 15px;
            color: var(--body-color);
            -webkit-transition: 0.3s;
            transition: 0.3s;
        }

        .end-contract-reaction-review-star:not(:last-child) {
            margin-right: 2px;
        }

        /* start Contract widget Css */
        .end-contract-widget-item {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
        }

        .end-contract-widget-list {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .end-contract-widget-list-item {
            font-size: 16px;
            line-height: 30px;
            position: relative;
            text-align: left;
            z-index: 2;
            padding: 5px 10px 5px 40px;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            border-radius: 5px;
            border: 1px solid var(--border-color);
        }

        .end-contract-widget-list-item:not(:last-child) {
            margin-bottom: 10px;
        }

        .end-contract-widget-list-item.active {
            background-color: rgba(var(--success-color-rgb), 0.1);
            color: var(--success-color);
            border-color: var(--success-color);
        }

        .end-contract-widget-list-item.active::after {
            content: "\f00c";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            background: var(--success-color);
            border-color: var(--success-color);
        }

        .end-contract-widget-list-item::after {
            content: "";
            position: absolute;
            height: 22px;
            width: 22px;
            border: 1px solid var(--border-color);
            left: 10px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            background: none;
            border-radius: 3px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            font-size: 12px;
            color: #fff;
            cursor: pointer;
            -webkit-transition: all 0.3s;
            transition: all 0.3s;
            border-radius: 50%;
        }

        .overall-score {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 15px;
        }

        .overall-score-para {
            font-size: 16px;
            line-height: 24px;
            color: var(--paragraph-color);
        }

        .overall-score-review {
            border: 1px solid var(--border-color);
            padding: 3px 10px;
            border-radius: 3px;
            font-size: 16px;
            line-height: 24px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: 5px;
        }

        .overall-score-review-icon {
            color: var(--secondary-color);
            font-size: 15px;
        }

        .overall-score-review-para {
            color: var(--paragraph-color);
            font-size: 16px;
            line-height: 24px;
        }

        .profile-border-top {
            border-top: 1px solid #EAECF0;
            padding-top: 20px;
            margin-top: 20px;
        }

        .profile-border-bottom {
            border-bottom: 1px solid #EAECF0;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        /* btn profile */
        .btn-profile {
            color: var(--paragraph-color);
            font-size: 16px;
            font-weight: 500;
            font-family: var(--body-font);
            display: inline-block;
            border-radius: 5px;
            text-align: center;
            cursor: pointer;
            line-height: 24px;
            padding: 7px 20px;
            white-space: nowrap;
            -webkit-transition: all 0.3s ease-in;
            transition: all 0.3s ease-in;
        }

        @media only screen and (max-width: 575.98px) {
            .btn-profile {
                padding: 6px 20px;
                font-size: 15px;
            }
        }

        @media only screen and (max-width: 375px) {
            .btn-profile {
                padding: 5px 15px;
                font-size: 14px;
            }
        }

        .btn-profile.btn-bg-1 {
            background-color: var(--main-color-one);
            color: #fff;
        }

        .btn-profile.btn-bg-1:hover {
            background-color: rgba(var(--main-color-one-rgb), 0.8);
        }

        .btn-profile.btn-outline-gray {
            border: 1px solid var(--border-color);
            padding: 6px 19px;
        }

        .btn-profile.btn-outline-gray:hover {
            background-color: var(--main-color-one);
            border-color: var(--main-color-one);
            color: #fff;
        }

        @media only screen and (max-width: 575.98px) {
            .btn-profile.btn-outline-gray {
                padding: 5px 15px;
            }
        }

        @media only screen and (max-width: 375px) {
            .btn-profile.btn-outline-gray {
                padding: 4px 15px;
            }
        }
    </style>
@endsection
@section('page-title')
    {{ __('Payment Success') }}
@endsection

@php
    use Modules\DeliveryMan\Entities\DeliveryManRating;
@endphp

@section('content')
    <div>
        <x-msg.flash />
    </div>

    <div class="patment-success-area padding-top-100 padding-bottom-100">
        @if(moduleExists("DeliveryMan"))
            @if (!empty($payment_details->deliveryMan) && DeliveryManRating::where('delivery_man_id', $payment_details->deliveryMan?->delivery_man_id)->count() < 1)
                <!-- End Contract area Starts -->
                <div class="end-contract-area section-bg-2">
                    <div class="container">
                        <div class="row gy-4 justify-content-center">
                            <div class="col-lg-8">
                                <div class="end-contract">
                                    <div class="end-contract-feedback mt-4 padding-bottom-50">
                                        <h4 class="end-contract-feedback-title">{{ __('Provide Feedback') }}</h4>
                                        <div class="end-contract-feedback-contents mt-4">
                                            <div data-reaction-type="communication" class="end-contract-feedback-single">
                                                <div class="end-contract-feedback-single-title-flex">
                                                    <h4 class="end-contract-feedback-single-title">
                                                        {{ __('Rate delivery man service') }} </h4>
                                                </div>
                                                <div class="end-contract-feedback-single-contents profile-border-top">
                                                    <form action="{{ route('user.product.order.delivery-man-ratting', $item) }}"
                                                          method="post">
                                                        @csrf
                                                        <input id="delivery-man-ratting-input" type="hidden" name="ratting"
                                                               value="" />

                                                        <div class="end-contract-reaction">
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="1">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip">{{ __('Very sad') }}</span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="{{ asset("assets/img/icons/sad_reaction.svg") }}"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="2">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip">{{ __('Not Good') }}</span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="{{ asset("assets/img/icons/not_good_reaction.svg") }}"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="3">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip">{{ __("It's Ok") }}</span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="{{ asset("assets/img/icons/its_ok_reaction.svg") }}"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="4">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip">{{ __("I'm Happy") }}</span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="{{ asset("assets/img/icons/happy_reaction.svg") }}"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="end-contract-reaction-item reaction-list"
                                                                 data-ratting-number="5">
                                                            <span
                                                                    class="end-contract-reaction-item-tooltip">{{ __('Very Happy') }}</span>
                                                                <div class="end-contract-reaction-item-flex">
                                                                    <div class="end-contract-reaction-icon">
                                                                        <img src="{{ asset("assets/img/icons/very_happy_reaction.svg") }}"
                                                                             alt="">
                                                                    </div>
                                                                    <div class="end-contract-reaction-review">
                                                                    <span class="end-contract-reaction-review-star"><i
                                                                                class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                        <span class="end-contract-reaction-review-star"><i
                                                                                    class="las la-star"></i></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group delivery-man-rating-button d-none">
                                                            <label
                                                                    for="comment">{{ __('Write comment') }}({{ __('optional') }})</label>
                                                            <textarea name="review" id="comment" cols="30" rows="5"></textarea>
                                                        </div>

                                                        <div class="form-group">

                                                            <button class="btn btn-info delivery-man-rating-button d-none"
                                                                    type="submit">{{ __('Submit Rating') }}</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Contract area end -->
            @endif
        @endif

        <div class="container">
            <div class="row g-4 gx-5">
                <div class="col-lg-6">
                    <div class="order__details__single">
                        <div class="payment-success-wrapper">
                            <div class="payment-contents">
                                <h4 class="title__two"> {{ __('Payment Details') }} </h4>
                                <ul class="payment-list margin-top-40">
                                    <li>
                                        <span class="payment-list-left">{{ __('Payment Gateway:') }}</span>
                                        <span class="payment-list-right">{{ render_payment_gateway_name($payment_details->payment_gateway) }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left">{{ __('Phone:') }}</span>
                                        <span class="payment-list-right">
                                            {{ $payment_details->address->phone }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left">{{ __('Name:') }}</span>
                                        <span class="payment-list-right">{{ $payment_details->address->name }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left">{{ __('Email:') }}</span>
                                        <span class="payment-list-right">{{ $payment_details->address->email }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="order__details__single">
                        <div class="payment-success-wrapper">
                            <div class="payment-contents">
                                <h4 class="title__two"> {{ __('Order Details') }} </h4>
                                <ul class="payment-list payment-list-two margin-top-30">
                                    <li>
                                        <span class="payment-list-left list-bold">{{ __('Amount Paid:') }} </span>
                                        <span class="payment-list-right payment-bold">
                                            {{ float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount) }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold">{{ __('Payment Status:') }} </span>
                                        <span class="payment-list-right payment-bold">
                                            {{ ucfirst($payment_details->payment_status) }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold">{{ __('Order Status:') }} </span>
                                        <span class="payment-list-right payment-bold">
                                            {{ ucfirst($payment_details->order_status) }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left list-bold">{{ __('Order Track:') }} </span>
                                        <span class="payment-list-right payment-bold"> {{ ucfirst(str_replace(['-','_'],' ',$orderTrack->name)) }}</span>
                                    </li>
                                    <li>
                                        <span class="payment-list-left">{{ __('Transaction ID:') }}</span>
                                        <span class="payment-list-right">{{ $payment_details->transaction_id }}</span>
                                    </li>
                                </ul>

                                <div class="btn-wrapper margin-top-40">
                                    <a href="{{ route('user.home') }}"
                                        class="cmn_btn btn_bg_2">{{ __('Go to Dashboard') }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 padding-top-60">
                    <div class="order__details__single">
                        <h4 class="title__two">{{ __('Order details View') }}</h4>
                        <div class="order__details__wrap checkout-page-content-wrapper margin-top-20">
                            @php
                                $adminShopManage = \App\AdminShopManage::first();
                                $itemsTotal = null;
                            @endphp
                            <div class="row g-4">
                                @foreach ($orders as $order)
                                    <div class="col-lg-12">
                                        <div class="order__details__item">
                                            <div class="order__item">
                                                @foreach ($order?->orderItem as $orderItem)
                                                    @php
                                                        $prd_image = $orderItem->product?->image;

                                                        if (!empty($orderItem->variant?->attr_image)) {
                                                            $prd_image = $orderItem->variant->attr_image;
                                                        }
                                                    @endphp
                                                    <div class="order__item__single">
                                                        <div class="order__item__single__flex">
                                                            <div class="order__item__product">
                                                                <div
                                                                    class="order__item__product__thumb checkout-cart-thumb">
                                                                    {!! render_image($prd_image, class: 'w-100') !!}
                                                                </div>
                                                                <div
                                                                    class="order__item__product__contents checkout-cart-img-contents">
                                                                    <h6
                                                                        class="order__item__product__name checkout-cart-title">
                                                                        <a href="#1">
                                                                            {{ Str::words($orderItem->product?->name, 5) }}
                                                                        </a>
                                                                        <p>
                                                                            {{ $orderItem?->variant?->productColor ? __('Color:') . $orderItem?->variant?->productColor?->name . ' , ' : '' }}
                                                                            {{ $orderItem?->variant?->productSize ? __('Size:') . $orderItem?->variant?->productSize?->name . ' , ' : '' }}
                                                                            @foreach ($orderItem?->variant?->attribute ?? [] as $attr)
                                                                                {{ $attr->attribute_name }}
                                                                                : {{ $attr->attribute_value }}

                                                                                @if (!$loop->last)
                                                                                    ,
                                                                                @endif
                                                                            @endforeach
                                                                        </p>
                                                                    </h6>
                                                                    @php
                                                                        $subtotal = null;
                                                                        $default_shipping_cost = null;
                                                                    @endphp

                                                                    <p class="order__item__product__span mt-2">
                                                                        <span
                                                                            class="order__item__product__span__left">{{ __('Sold By:') }}</span>
                                                                        <span
                                                                            class="order__item__product__span__right">{{ $order->vendor?->business_name ?? $adminShopManage?->store_name }}</span>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <p class="d-block product-items">
                                                                <span>{{ __('QTY:') }}</span>
                                                                <strong
                                                                    class="color-heading">{{ $orderItem->quantity ?? '0' }}</strong>
                                                            </p>
                                                            <div class="d-flex gap-2">
                                                                <s class="checkout-cart-price">
                                                                    {{ amount_with_currency_symbol($orderItem->sale_price) }}
                                                                </s>
                                                                <strong class="color-heading">
                                                                    {{ amount_with_currency_symbol($orderItem->price) }}
                                                                </strong>
                                                            </div>
                                                        </div>

                                                        @php
                                                            $subtotal += $orderItem->sale_price * $orderItem->quantity;
                                                            $itemsTotal += $orderItem->sale_price * $orderItem->quantity;
                                                        @endphp
                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="order__item__footer">
                                                @if($order->order_status === 'order_cancelled')
                                                    <h4 class="py-2 text-danger text-center pt-4">{{ __("This order is cancelled by the seller") }}</h4>
                                                @else
                                                    <div class="order__item__estimate">
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span>{{ __('Sub Total') }}</span>
                                                            <strong id="vendor_subtotal">
                                                                {{ float_amount_with_currency_symbol($payment_details->paymentMeta?->sub_total) }}
                                                            </strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between mt-3">
                                                            <span>{{ __('Discount Amount') }}</span>
                                                            <strong id="vendor_tax_amount">{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->coupon_amount) }}</strong>
                                                        </div>
                                                        <div
                                                                class="order__item__estimate__single d-flex justify-content-between">
                                                            <span>{{ __('Tax Amount') }}</span>
                                                            <strong id="vendor_tax_amount">{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->tax_amount) }}</strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span>{{ __('Shipping Cost') }}</span>
                                                            <strong id="vendor_shipping_cost">{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost) }}</strong>
                                                        </div>
                                                        <div class="order__item__estimate__single d-flex justify-content-between">
                                                            <span>{{ __('Total') }}</span>
                                                            <strong id="vendor_total">{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount) }}</strong>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.bodyUser_overlay', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
            });
            $(document).on('click', '.mobile_nav', function() {
                $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
            });
        });

        $(document).on('click', '.reaction-list', function() {
            $(this).siblings().removeClass("active");
            $(this).addClass("active");

            // check .delivery-man-rating-button this button is contain class d-none then remove this class from this button
            if ($('.delivery-man-rating-button').hasClass('d-none'))
                $('.delivery-man-rating-button').removeClass('d-none')

            // now update current rating amount in ratting input field
            $('#delivery-man-ratting-input').val($(this).attr("data-ratting-number"));
        });

        $(document).on('click', '.click-skip', function() {
            $(this).parent().parent().find(".reaction-list.active").removeClass("active");
        });
    </script>
@endsection
