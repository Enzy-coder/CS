@extends('frontend.user.dashboard.user-master')
@section('style')
    <x-datatable.css />
    <style>
        @import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

        body {
            background-color: #eeeeee;
            font-family: 'Open Sans', serif
        }

        .card {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 0.10rem
        }

        .card-header:first-child {
            border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
        }

        .card-header {
            padding: 0.75rem 1.25rem;
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1)
        }

        .track {
            position: relative;
            background-color: unset;
            height: 5px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            margin-top: 50px;
            height: auto;
        }

        .track .step {
            -webkit-box-flex: 1;
            -ms-flex-positive: 1;
            flex-grow: 1;
            width: 25%;
            margin-top: -13px;
            text-align: center;
            position: relative
        }

        .track .step.active:before {
            background: #FF5722
        }

        .track .step::before {
            height: 5px;
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            top: 13px;
            background-color: #ddd;
        }

        .track .step.active .icon {
            background: #ee5435;
            color: #fff
        }

        .track .icon {
            display: inline-block;
            width: 30px;
            height: 30px;
            line-height: 30px;
            position: relative;
            border-radius: 100%;
            background: #ddd
        }

        .track .step.active .text {
            font-weight: 400;
            color: #000
        }

        .track .text {
            display: block;
            margin-top: 7px
        }

        .itemside {
            position: relative;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            width: 100%
        }

        .itemside .aside {
            position: relative;
            -ms-flex-negative: 0;
            flex-shrink: 0
        }

        .img-sm {
            width: 80px;
            height: 80px;
            padding: 7px
        }

        ul.row,
        ul.row-sm {
            list-style: none;
            padding: 0
        }

        .itemside .info {
            padding-left: 15px;
            padding-right: 7px
        }

        .itemside .title {
            display: block;
            margin-bottom: 5px;
            color: #212529
        }

        p {
            margin-top: 0;
            margin-bottom: 1rem
        }

        .btn-warning {
            color: #ffffff;
            background-color: #ee5435;
            border-color: #ee5435;
            border-radius: 1px
        }

        .btn-warning:hover {
            color: #ffffff;
            background-color: #ff2b00;
            border-color: #ff2b00;
            border-radius: 1px
        }

        .stepDetails {
            /*display: none;*/
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            height: 0;
        }

        .stepDetails.show {
            /*display: block;*/
            visibility: visible;
            opacity: 1;
            height: auto;
        }
    </style>
@endsection

@php
    $order = $request->order;
@endphp

@section('site-title')
    {{ __('Request View') }}
@endsection
@section('section')
    <div class="dashboard__card">
        <div class="dashboard__card__header">
            <h3 class="dashboard__card__title">{{ __('Request Details') }}</h3>
        </div>
        <div class="dashboard__card__body mt-4">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="dashboard__card card__two">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Orders Details') }}</h4>
                        </div>
                        <div class="dashboard__card__body">
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Order ID') }}</span>
                                <p class="orderRequest__item__right">#{{ $order->id }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Transaction ID') }}</span>
                                <p class="orderRequest__item__right">{{ $order->transaction_id }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Payment Gateway') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ ucwords(str_replace(['_', '-'], ' ', $order->payment_gateway)) }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Payment Status') }}</span>
                                <p class="orderRequest__item__right">{{ str($order->order_status)->ucfirst() }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Total Product') }}</span>
                                <p class="orderRequest__item__right">{{ $order->order_items_count }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Items Total') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ float_amount_with_currency_symbol($order?->paymentMeta?->sub_total) }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Discount Amount') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ float_amount_with_currency_symbol($order?->paymentMeta?->coupon_amount) }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Shipping Cost') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ float_amount_with_currency_symbol($order?->paymentMeta?->shipping_cost) }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Tax Amount') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ float_amount_with_currency_symbol($order?->paymentMeta?->tax_amount) }}</p>
                            </div>
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Total Amount') }}</span>
                                <p class="orderRequest__item__right">
                                    {{ float_amount_with_currency_symbol($order?->paymentMeta?->total_amount) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="dashboard__card card__two">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Refund Request Information') }}</h4>
                        </div>
                        <div class="dashboard__card__body">
                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Request Id') }}</span>
                                <p class="orderRequest__item__right">{{ $request?->id }}</p>
                            </div>

                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Additional info') }}: </span>
                                <p class="orderRequest__item__right">{{ $request->additional_information }}</p>
                            </div>

                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Preferred Option') }}</span>
                                <p class="orderRequest__item__right">{{ $request?->preferredOption?->name }}</p>
                            </div>

                            <div class="orderRequest__item">
                                <span class="orderRequest__item__left">{{ __('Total Product') }}</span>
                                <p class="orderRequest__item__right">{{ $request->order?->order_items_count }}</p>
                            </div>

                            @if (json_decode($request->preferred_option_fields))
                                <div class="orderRequest__item">
                                    <span class="orderRequest__item__left">{{ $request?->preferredOption?->name }}: </span>
                                    <p class="orderRequest__item__right">
                                        @foreach (json_decode($request->preferred_option_fields) ?? [] as $key => $value)
                                            <span>{{ $key }}: </span><b>{{ $value }}</b>
                                        @endforeach
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">
                                {{ $request->order?->order_items_count > 1 ? __('Refund request Items') : __('Refund request Item') }}
                            </h4>
                        </div>
                        <div class="dashboard__card__body mt-4">
                            <div class="table-wrapper dashboard-table table-wrap">
                                <table class="table table-responsive">
                                    <thead>
                                        <tr>
                                            <th>{{ __('SL NO:') }}</th>
                                            <th style="width: 60px">{{ __('Image') }}</th>
                                            <th>{{ __('Info') }}</th>
                                            <th>{{ __('QTY') }}</th>
                                            <th>{{ __('Price') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($request->requestProduct as $item)
                                            @php
                                                $product = $request->products->find($item->product_id);
                                                $variant = $request->productVariant->find($item->variant_id);
                                            @endphp

                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{!! render_image($product->image, class: 'w-100 h-100') !!}</td>
                                                <td>
                                                    <h6>{{ $product->name }}</h6>
                                                    @if ($variant)
                                                        <p>
                                                            @if ($variant->productColor)
                                                                {{ $variant->productColor->name }},
                                                            @endif
                                                            @if ($variant->productSize)
                                                                {{ $variant->productSize->name }}
                                                            @endif

                                                            @foreach ($variant->attribute as $attr)
                                                                , {{ $attr->attribute_name }}:
                                                                {{ $attr->attribute_value }}
                                                            @endforeach
                                                        </p>
                                                    @endif
                                                </td>
                                                <td>
                                                    {{ $item->quantity }}
                                                </td>
                                                <td>{{ float_amount_with_currency_symbol($item->amount) }}</td>
                                                <td>{{ float_amount_with_currency_symbol($item->amount * $item->quantity) }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4">
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h3 class="dashboard__card__title">{{ __('Request Track view') }}</h3>
                        </div>
                        <div class="dashboard__card__body">
                            <div class="track">
                                @foreach ($request->requestTrack as $track)
                                    @php
                                        $trackCondition = $track->reason->count() > 0 || $track->deductedAmount->count() > 0;
                                    @endphp
                                    <div class="step active">
                                        <span class="icon">
                                            <i class="las la-check "></i>
                                        </span>
                                        <small class="text" style="{{ $trackCondition ? 'font-weight: bold' : '' }}">
                                            {{ ucwords(str_replace(['-', '_'], ' ', $track->name)) }}
                                            @if ($trackCondition)
                                                <i class="las la-question-circle {{ $trackCondition ? 'stepText' : '' }}"
                                                    data-type="{{ $trackCondition ? ($track->deductedAmount->count() > 0 ? 'deductedAmount' : 'reason') : '' }}"
                                                    data-collection="{{ $trackCondition ? json_encode($track->deductedAmount?->count() > 0 ? $track->deductedAmount?->toArray() : $track->reason?->toArray()) : '' }}"
                                                    data-refund_fee="{{ $request->refund_fee }}"></i>
                                            @endif
                                        </small>
                                    </div>
                                @endforeach
                            </div>
                            <div class="stepDetails">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/js/sweetalert2.js') }}"></script>

    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                $(document).on('click', '.bodyUser_overlay', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').removeClass('show');
                });
                $(document).on('click', '.mobile_nav', function() {
                    $('.user-dashboard-wrapper, .bodyUser_overlay').addClass('show');
                });

                $(document).on("click", ".stepText", function() {
                    let requestTrackJson = JSON.parse($(this).attr("data-collection"));
                    let requestTrackType = $(this).attr("data-type");
                    let refundFee = $(this).attr("data-refund_fee");
                    let requestTrackHTML = ``;
                    if (requestTrackType === 'deductedAmount') {
                        requestTrackHTML =
                            `<table class='table table-responsive'><thead><tr><th>{{ __('Cause') }}</th><th>{{ __('Amount') }}</th></tr></thead><tbody>`
                    }

                    Object.keys(requestTrackJson).forEach(function(key) {
                        let item = requestTrackJson[key] ?? [];

                        // hare need to check request track type
                        if (requestTrackType == 'reason') {
                            requestTrackHTML += `<p>${item.reason}</p>`;
                        } else if (requestTrackType == 'deductedAmount') {
                            requestTrackHTML += `
                        <tr>
                            <td>${item.reason}</td>
                            <td>${item.amount}</td>
                        </tr>
                    `;
                        }
                    });


                    if (requestTrackType === 'deductedAmount') {
                        requestTrackHTML += `
                        <tr>
                            <td>{{ __('Refund fee') }}</td>
                            <td>${refundFee}</td>
                        </tr>
                    `;
                        requestTrackHTML += `</tbody></table>`;
                    }

                    $('.stepDetails').toggleClass('show');
                    $('.stepDetails').html(requestTrackHTML);
                });
            })
        })(jQuery)
    </script>

    <x-datatable.js />
@endsection
