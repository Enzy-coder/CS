@extends('frontend.frontend-master')
@section("style")
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');
        .card {position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;-webkit-box-orient: vertical;-webkit-box-direction: normal;-ms-flex-direction: column;flex-direction: column;min-width: 0;word-wrap: break-word;background-color: #fff;background-clip: border-box;border: 1px solid rgba(0, 0, 0, 0.1);border-radius: 0.10rem }
        .card-header:first-child {border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0 }
        .card-header {padding: 0.75rem 1.25rem;margin-bottom: 0;background-color: #fff;border-bottom: 1px solid rgba(0, 0, 0, 0.1) }
        .track {position: relative;background-color: #ddd;height: 5px;display: -webkit-box;display: -ms-flexbox;display: flex;margin-top: 30px;}
        .track .step {-webkit-box-flex: 1;-ms-flex-positive: 1;flex-grow: 1;width: 25%;margin-top: -13px;text-align: center;position: relative }
        .track .step.active:before {background: #FF5722 }.track .step::before {height: 5px;position: absolute;content: "";width: 100%;left: 0;top: 13px;}
        .track .step.active .icon {background: #ee5435;color: #fff }
        .track .icon {display: inline-block;width: 30px;height: 30px;line-height: 30px;position: relative;border-radius: 100%;background: #ddd }
        .track .step.active .text {font-weight: 400;color: #000 }
        .track .text {display: block;margin-top: 7px }.itemside {position: relative;display: -webkit-box;display: -ms-flexbox;display: flex;width: 100% }
        .itemside .aside {position: relative;-ms-flex-negative: 0;flex-shrink: 0 }.img-sm {width: 80px;height: 80px;padding: 7px }
        ul.row, ul.row-sm {list-style: none;padding: 0 }.itemside .info {padding-left: 15px;padding-right: 7px }
        .itemside .title {display: block;margin-bottom: 5px;color: #212529 }p {margin-top: 0;margin-bottom: 1rem }
        .btn-warning {color: #ffffff;background-color: #ee5435;border-color: #ee5435;border-radius: 1px }
        .btn-warning:hover {color: #ffffff;background-color: #ff2b00;border-color: #ff2b00;border-radius: 1px }
        .d-flex.gap-4.justify-content-center .form-group {
            width: 25%;
        }
        .dashboard__card{
            display: flex;
            align-items: center;
            flex-direction: column;
            width: 100%;
        }

        .dashboard__card > div {
            width: 100%
        }
    </style>
@endsection

@section('page-title')
    {{__('Payment Success')}}
@endsection

@section('content')
    <div class="patment-success-area padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row padding-bottom-50">
                <div class="col-lg-12">
                    <div class="content text-center">
                        <img src="{{ asset('assets/frontend/img/icon/check-icon.svg') }}" alt="icon">
                        <h2 class="page-status-title margin-top-40">{{ __('Your order is Completed!') }}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="payment-success-wrapper">
                        <div class="payment-contents">
                            <h4 class="title"><div class="icon"> {{ __('Payment Successful') }}  <i class="las la-check text-success"></i> </div>
                            </h4>

                            <ul class="payment-list margin-top-40">
                                <li>{{ __('Payment Gateway') }}: <span class="payment-strong">{{ render_payment_gateway_name($payment_details->payment_gateway)  }}</span></li>
                                <li>{{ __('Phone') }}: <span class="payment-strong">{{ $payment_details->address->phone }}</span></li>
                                <li>{{ __('Name') }}: <span class="payment-strong">{{ $payment_details->address->name }}</span></li>
                                <li>{{ __('Email') }}: <span class="payment-strong">{{ $payment_details->address->email }}</span></li>
                            </ul>

                            <ul class="payment-list payment-list-two margin-top-30">
                                <li><span class="list-bold">{{ __('Amount Paid') }}: </span> <span class="payment-strong payment-bold">{{ float_amount_with_currency_symbol($payment_details->paymentMeta->total_amount) }}</span></li>
                                <li>{{ __('Transaction ID') }}: <span class="payment-strong">{{ $payment_details->transaction_id }}</span></li>
                            </ul>

                            <div class="btn-wrapper margin-top-40">
                                @if(auth('web')->check())
                                    <a href="{{ route('user.home') }}" class="default-btn color-one">{{ __('Go to Dashboard') }}</a>
                                @else
                                    <a href="{{ route('homepage') }}" class="btn btn-primary outline-one">{{ __('Back to Home') }}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                    {{-- Admin can update order track status --}}
                    <x-order::order-track :order="$payment_details" :disable-form="true" />
                </div>
            </div>
        </div>
    </div>

    <div class="order-completed-area-wrapper padding-top-50 padding-bottom-100">
        <div class="container">
            <div class="row padding-bottom-50">
                <div class="col-lg-12">
                    <div class="order-data">
                        <table class="table table-responsive">
                            <thead>
                                <tr>
                                    <th>{{ __('order number') }}</th>
                                    <th>{{ __('date') }}</th>
                                    <th>{{ __('Sub Total') }}</th>
                                    <th>{{ __('Shipping Cost') }}</th>
                                    <th>{{ __('Tax Amount') }}</th>
                                    <th>{{ __('Discount amount') }}</th>
                                    <th>{{ __('Payable Amount') }}</th>
                                    <th>{{ __('payment method') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#{{ $payment_details->id }}</td>
                                    <td>{{ $payment_details->created_at->format('d/m/Y') }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->sub_total) }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost) }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->tax_amount) }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->coupon_amount) }}</td>
                                    <td>{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->total_amount) }}</td>
                                    <td>{{ str_replace('_', ' ', render_payment_gateway_name($payment_details->payment_gateway)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="order-complete-wrap">
                        <h4 class="title">{{ __('order details') }}</h4>

                        <div class="checkout-page-content-wrapper mt-4">
                            @php
                                $adminShopManage = \App\AdminShopManage::first();
                                $itemsTotal = null;
                            @endphp

                            @foreach($orders as $order)
                                <div class="card mb-3">
                                    @php
                                        $subtotal = null;
                                        $default_shipping_cost = null;

                                    @endphp

                                    <div class="card-header">
                                        {{ __("ITEM") }} {{ $order?->orderItem?->count() }} <br>
                                        {{ __("Sold By:") }} {{ $order->vendor?->business_name ?? $adminShopManage?->store_name }}
                                    </div>

                                    <div class="card-body">
                                        @foreach($order?->orderItem as $orderItem)
                                            @php
                                                $prd_image = $orderItem->product->image;

                                                if(!empty($orderItem->variant?->attr_image)){
                                                    $prd_image = $orderItem->variant->attr_image;
                                                }
                                            @endphp

                                            <div class="check-cart-flex-contents justify-content-between d-flex mb-2">
                                                <div class="checkout-cart-thumb" style="width: 80px">
                                                    {!! render_image($prd_image, class: 'w-100') !!}
                                                </div>
                                                <div class="checkout-cart-img-contents">
                                                    <h6 class="checkout-cart-title fs-18"> <a href="#1"> {{Str::words($orderItem->product->name, 5)}} </a>
                                                        <p>
                                                            {{ $orderItem?->variant?->productColor ? __("Color:") . $orderItem?->variant?->productColor?->name . ' , ' : "" }}
                                                            {{ $orderItem?->variant?->productSize ? __("Size:") . $orderItem?->variant?->productSize?->name . ' , ' : "" }}
                                                            @foreach($orderItem?->variant?->attribute ?? [] as $attr)
                                                                {{ $attr->attribute_name }}
                                                                : {{ $attr->attribute_value }}

                                                                @if(!$loop->last)
                                                                    ,
                                                                @endif
                                                            @endforeach
                                                        </p>
                                                    </h6>
                                                </div>
                                                <span class="d-block product-items w-10"> {{ $orderItem->quantity ?? "0" }} {{ __("QTY") }} </span>

                                                <div class="d-flex gap-2 w-20">
                                                    <del class="checkout-cart-price color-heading fw-500"> {{ amount_with_currency_symbol($orderItem->sale_price) }} </del>
                                                    <b class="checkout-cart-price color-heading fw-500 font-weight-bold"> {{ amount_with_currency_symbol($orderItem->price) }} </b>
                                                </div>
                                            </div>

                                            @php
                                                $subtotal += $orderItem->sale_price * $orderItem->quantity;
                                                $itemsTotal += $orderItem->sale_price * $orderItem->quantity;
                                            @endphp
                                        @endforeach
                                    </div>

                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end">
                                            <div style="width: 30%">
                                                <div class="">
                                                    <div class="d-flex justify-content-between">
                                                        <b>{{ __("Sub Total") }}</b> <b id="vendor_subtotal">{{ float_amount_with_currency_symbol($order->total_amount) }}</b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b>{{ __("Tax Amount") }}</b> <b id="vendor_tax_amount">
                                                            @if($order->tax_type == "inclusive_price")
                                                                {{ __("Inclusive Tax") }}
                                                            @else
                                                                {{ float_amount_with_currency_symbol($order->tax_amount) }}
                                                            @endif
                                                        </b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b>{{ __("Shipping Cost") }}</b> <b id="vendor_shipping_cost">{{ float_amount_with_currency_symbol($payment_details->paymentMeta?->shipping_cost) }}</b>
                                                    </div>
                                                    <div class="d-flex justify-content-between">
                                                        <b>{{ __("Total") }}</b> <b id="vendor_total">{{ float_amount_with_currency_symbol($order->total_amount + $payment_details->paymentMeta?->shipping_cost + $order->tax_amount) }}</b>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="btn-wrapper text-right">
                        <a href="{{ route('homepage') }}" class="btn btn-success rounded-btn semi-bold">{{ __('back to home') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection