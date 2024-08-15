@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Checkout') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/payment.css') }}">
    <x-loader.css />
    <style>
        .user-shipping-address-item.active .btn-outline-primary {
            color: #fff !important;
            background-color: #0d6efd;
            border-color: #0d6efd;
        }

        .checkout-shipping-method:hover {
            cursor: pointer;
        }

        .shippingMethod__wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }

        .shippingMethod__wrapper__item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            padding: 20px;
            border: 1px solid var(--border-color);
            background-color: var(--white);
        }

        .shippingMethod__wrapper__item.active {
            background-color: var(--main-color-one);
            border-color: var(--main-color-one);
            color: var(--white);
        }

        .shippingMethod__wrapper__item.active h6 {
            color: var(--white);
        }

        .shippingMethod__wrapper__item.active p {
            color: var(--white);
        }

        .checkout__card__footer__estimate__main {
            width: 230px;
            max-width: 300px;
        }

        .checkout__card__footer__estimate__item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 16px;
            font-weight: 400;
            line-height: 20px;
            color: var(--paragraph-color);
        }

        .checkout__card__footer__estimate__item:not(:last-child) {
            margin-bottom: 12px;
        }

        .shippingMethod__wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            flex-wrap: wrap;
        }
    </style>
@endsection

@php
    $carts = Cart::instance('default')->content();
    $itemsTotal = null;
    $enableTaxAmount = !\Modules\TaxModule\Services\CalculateTaxServices::isPriceEnteredWithTax();
    $shippingTaxClass = \Modules\TaxModule\Entities\TaxClassOption::where('class_id', get_static_option('shipping_tax_class'))->sum('rate');
    $tax = Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress::init();
    $uniqueProductIds = $carts
    ->pluck('id')
    ->unique()
    ->toArray();

    $country_id = old('country_id') ?? 0;
    $state_id = old('state_id') ?? 0;
    $city_id = old('city') ?? 0;

    if (empty($uniqueProductIds)) {
    $taxProducts = collect([]);
    } else {
    if (\Modules\TaxModule\Services\CalculateTaxBasedOnCustomerAddress::is_eligible()) {
    $taxProducts = $tax
        ->productIds($uniqueProductIds)
        ->customerAddress($country_id, $state_id, $city_id)
        ->generate();
    } else {
    $taxProducts = collect([]);
    }
    }

    $carts = $carts->groupBy('options.vendor_id');

    $vendors = \Modules\Vendor\Entities\Vendor::with('shippingMethod', 'shippingMethod.zone')
    ->whereIn('id', $carts->keys())
    ->get();
@endphp

@section('content')
    @if ($all_cart_items->count() > 0)
        <div class="checkout-area-wrapper padding-top-100 padding-bottom-50">
            <div class="container">
                @if(!auth('web')->check())
                    @include('frontend.cart.partials.login')
                @endif
                <form action="{{ route('frontend.checkout') }}" class="billing-form checkout-billing-form" method="POST"
                    id="billing_info" enctype="multipart/form-data">
                    @csrf
                    <div class="row g-4">
                        <div class="col-md-7 col-lg-7">
                            <x-msg.stock_error />
                            <x-msg.flash />
                            <x-msg.error />

                            <div class="checkout-inner-content">
                                <div class="billing-details-area-wrapper">
                                    @if (auth('web')->check())
                                        <div class="btn-wrapper">
                                            <button type="button"
                                                class="cmn-btn btn-bg-1 billing_details_click btn-small">{{ __('New Shipping Address') }}</button>
                                        </div>
                                    @endif
                                        <div class="flex-start mt-4 user-shipping-address-wrapper d-flex position-relative">
                                            @foreach ($all_user_shipping ?? [] as $shipping_address)
                                                @include('frontend.cart.partials.shipping-address-option')
                                            @endforeach
                                        </div>
                                    @csrf

                                    <input type="hidden" name="coupon" id="coupon_code"
                                        value="{{ old('coupon') ?? request()->coupon }}">
                                    <input type="hidden" name="tax_amount">
                                    <input type="hidden" name="ship_to_another_address" id="ship_to_another_address">
                                    <input type="hidden" name="selected_shipping_option"
                                        value="{{ $default_shipping->id }}">
                                    <input type="hidden" name="selected_payment_gateway"
                                        value="{{ get_static_option('site_default_payment_gateway') }}">
                                    <input type="hidden" name="agree" id="term_agree">
                                    <input type="file" name="cheque_payment_input" id="cheque_payment" class="d-none">
                                    <input type="file" name="bank_transfer_input" id="bank_transfer" class="d-none">
                                    @include('frontend.cart.partials.billing-info')
                                </div>

                                <div class="cart-items-wrapper">
                                    @include('frontend.cart.cart-items.cart-items-wrapper')
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 col-lg-5">
                            @include('frontend.cart.partials.order-summary')
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="row padding-top-100 padding-bottom-100">
            <div class="col-md-8 m-auto">
                <x-msg.stock_error />
                <x-msg.flash />
                <x-msg.error />

                <div class="w-50 m-auto">
                    <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="filter_static_option_value(
                        'checkout_page_no_product_text',
                        $setting_text,
                        __('No products in your cart!'),
                    )" />
                </div>
            </div>
        </div>

    @endif

    <div class="popup_modal_checkout_overlay"></div>

    <div class="checkout-inner-content popup_modal_checkout">
        <div class="billing-details-area-wrapper position-relative">
            <div class="d-flex justify-content-end position-absolute top-0 right-0 w-100">
                <h3 class="title d-none">
                    {{ filter_static_option_value('checkout_billing_section_title', $setting_text, __('Billing details')) }}
                </h3>
                <div class="checkout_modal_close"><i class="las la-times"></i> </div>
            </div>
            <form action="{{ route('frontend.checkout') }}" class="billing-form" method="POST" id="shopping_address"
                enctype="multipart/form-data">
                @csrf

                @php
                    $modal = true;
                @endphp

                @include('frontend.cart.partials.billing-info')
            </form>
        </div>
    </div>
    <x-loader.html />
    <input type="hidden" value="" id="checkout_tax_percentage" />
@endsection

@section('script')
    <script>
        @if (get_static_option('tax_system') == 'advance_tax_system')
            $(document).on("change", "#country_id", function() {
                let country_id = $(this).val();

                send_ajax_request("get", "",
                    `{{ route('frontend.get-tax-based-on-billing-address') }}?country_id=${country_id}&state_id=&city_id=`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);

                        let statehtml = "<option value=''> {{ __('Select an state') }} </option>";
                        data?.states?.forEach((state) => {
                            statehtml += "<option value='" + state.id + "'>" + state.name + "</option>";
                        });

                        $(this).parent().parent().find(".select-state").html(statehtml);
                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            $(document).on("change", "#state_id", function() {
                let country_id = $("#country_id").val();
                let state_id = $("#state_id").val();

                send_ajax_request("get", "",
                    `{{ route('frontend.get-tax-based-on-billing-address') }}?country_id=${country_id}&state_id=${state_id}&city_id=`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);

                        let cityhtml = "<option value=''> {{ __('Select an city') }} </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name + "</option>";
                        });

                        $("#city_id").html(cityhtml);

                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            $(document).on("change", "#city_id", function() {
                let country_id = $("#country_id").val();
                let state_id = $("#state_id").val();
                let city_id = $("#city_id").val();

                send_ajax_request("get", "",
                    `{{ route('frontend.get-tax-based-on-billing-address') }}?country_id=${country_id}&state_id=${state_id}&city_id=${city_id}`,
                    () => {}, (data) => {
                        // do success action hare
                        $('.cart-items-wrapper').html(data.cart_items);
                        calculateOrderSummeryForAdvanceTax();
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });

            function getTotalTax() {
                let totalAmount = 0;

                $(".vendor_tax_amount").each(function() {
                    let st = $(this).text();

                    if (st.includes("Inclusive Tax")) {
                        totalAmount += 0;
                    } else {
                        totalAmount += replaceSymbol(st);
                    }
                });

                return totalAmount;
            }

            function calculateOrderSummeryForAdvanceTax() {
                let discountAmount = Number($("#coupon_amount").text().trim().replace("{{ site_currency_symbol() }}", ""))
                let subTotal = getSubTotals();
                let totalTax = getTotalTax();
                let totalShippingCost = getTotalShippingCost();
                let decimalPoint = 1;

                let vendorTaxAmount = '';

                $(".vendor_tax_amount").each(function() {
                    let st = $(this).text();

                    if (st.includes("{{ __('Inclusive Tax') }}")) {
                        vendorTaxAmount = "{{ __('Inclusive Tax') }}";
                    } else {
                        vendorTaxAmount = 0;
                    }
                });

                @if($enableTaxAmount)
                    $("#checkout_tax_amount").text(amount_with_currency_symbol(totalTax.toFixed(decimalPoint)))
                @else
                    $("#checkout_tax_amount").text("{{ __('Inclusive Tax') }}")
                @endif

                $("#checkout_items_total").text(amount_with_currency_symbol(subTotal.toFixed(decimalPoint)))
                $("#checkout_delivery_cost").text(amount_with_currency_symbol(totalShippingCost.toFixed(decimalPoint)));
                $("#total_payment_amount").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                    totalShippingCost).toFixed(decimalPoint)));
                $("#checkout_total").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                    totalShippingCost).toFixed(decimalPoint)));
            }
        @endif

        @if (get_static_option('tax_system') == 'zone_wise_tax_system')
            $(document).on("change", "#country_id", function() {
                // first i need to get all states
                // get all shipping methods
                // insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let country_id = $(this).val();
                let data = new FormData();
                data.append("id", country_id);
                data.append("type", "country");
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("POST", data, "{{ route('frontend.shipping.module.methods') }}", () => {

                }, (data) => {
                    if (data.success) {
                        let statehtml = "<option value=''> {{ __('Select an state') }} </option>";
                        data?.states?.forEach((state) => {
                            statehtml += "<option value='" + state.id + "'>" + state.name +
                                "</option>";
                        });

                        $("#checkout_tax_percentage").val(data.tax_amount);
                        // Now first i need to get all orders tax filed and insert tax amount
                        // After those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");
                        $(this).parent().parent().find(".select-state").html(statehtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
            });

            $(document).on("change", "#state_id", function() {
                // first, i need to get all states
                // to get all shipping methods
                // to insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let state_id = $(this).val();
                let data = new FormData();
                data.append("id", state_id);
                data.append("type", "state");
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("POST", data, "{{ route('frontend.shipping.module.methods') }}", () => {

                }, (data) => {
                    if (data.success) {
                        $("#checkout_tax_percentage").val(data.tax_amount);

                        // now first i need to get all orders tax filed and insert tax amount
                        // after those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");

                        let cityhtml = "<option value=''> {{ __('Select an city') }} </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name +
                                "</option>";
                        });

                        $("#city_id").html(cityhtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
            });
        @endif

        function getSubTotals() {
            let totalAmount = 0;

            $(".vendor_subtotal").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });

            return totalAmount;
        }

        function getTotalShippingCost() {
            let totalAmount = 0;

            $(".vendor_shipping_cost").each(function() {
                totalAmount += replaceSymbol($(this).text());
            });

            return totalAmount;
        }

        function replaceSymbol(text) {
            return parseFloat(text.replace("{{ site_currency_symbol() }}", ""));
        }

        let defaultGateway = $('#site_global_payment_gateway').val();

        $('.payment-gateway-wrapper ul li[data-gateway="' + defaultGateway + '"]').addClass('selected');

        $(document).on("click", ".wallet-payment-input", function() {
            if ($(this).is(':checked')) {
                $('.payment-card').fadeOut();
                $('.payment-gateway-wrapper').find(('input')).val('Wallet');
                $('.payment_gateway_passing_clicking_name').val('Wallet');
            } else {
                $('.payment-card').fadeIn();
                $('.payment-gateway-wrapper').find(('input')).val('');
                $('.payment_gateway_passing_clicking_name').val('');
            }
        });

        $(document).on('click', '.payment-gateway-wrapper > ul > li', function(e) {
            e.preventDefault();

            let gateway = $(this).data('gateway');
            if (gateway === 'manual_payment') {
                $('.manual_transaction_id').removeClass('d-none');
            } else {
                $('.manual_transaction_id').addClass('d-none');
            }

            $(this).addClass('selected').siblings().removeClass('selected');
            $('.payment-gateway-wrapper').find(('input')).val($(this).data('gateway'));
            $('.payment_gateway_passing_clicking_name').val($(this).data('gateway'));
        });

        $(document).on("click", ".user-shipping-address-item", function() {
            let states = JSON.parse($(this).attr("data-states"));
            let statehtml = "<option value=''>Please Select State</option>";
            let selectedState = $(this).attr('data-state');

            states.forEach((state) => {
                if (state.id == selectedState) {
                    statehtml += "<option " + 'selected' + " value='" + state.id + "'>" + state.name +
                        "</option>";
                } else {
                    statehtml += "<option  value='" + state.id + "'>" + state.name + "</option>";
                }
            });

            $(".modal-states").html(statehtml);

            $("#country_id option:selected").attr("selected", false)
            $("#country_id option[value=" + $(this).attr("data-country") + "]").attr("selected", true)
            $(".billing-form #name").val($(this).data('name'));
            $(".billing-form #address").val($(this).data('address'));
            $(".billing-form #city").val($(this).data('city'));
            $(".billing-form #zipcode").val($(this).data('zipcode'));
            $(".billing-form #phone").val($(this).data('phone'));
            $(".billing-form #email").val($(this).data('email'));

            $(".checkout_modal_close").trigger("click");

            $(".user-shipping-address-item").removeClass("active");
            $(this).toggleClass("active");
        });

        $(document).ready(function() {
            @if (get_static_option('tax_system') == 'advance_tax_system')
                calculateOrderSummeryForAdvanceTax();
            @else
                // calculate order summary according to cart items
                calculateOrderSummary();
            @endif

            // now get default shipping cost
            selectDefaultShippingMethod();
        });

        $(document).on("click", ".checkout-shipping-method", function() {
            let shippingTax = Number($(this).attr("data-shipping-percentage"));
            let shippingCost = Number($(this).attr("data-shipping-cost"));
            let shippingCostId = $(this).attr("data-shipping-cost-id");
            let currencySymbol = "{{ site_currency_symbol() }}";
            let subTotal = $(this).parent().parent().find("#vendor_subtotal").text().replace(currencySymbol, "");
            let total = parseFloat(subTotal) + parseFloat(shippingCost);

            if ($(this).hasClass("active")) {

            } else {
                $(this).parent().find(".checkout-shipping-method").removeClass("active");
                $(this).addClass("active");
                $(this).parent().parent().find("#vendor_shipping_cost").html(amount_with_currency_symbol(shippingCost))
                $(this).parent().parent().find("#shipping_cost").val(shippingCostId);

                calculateAmount();
                @if (get_static_option('tax_system') == 'advance_tax_system')
                    calculateOrderSummeryForAdvanceTax()
                @else
                    calculateOrderSummary();
                @endif
            }
        });


        $(document).on('click', '#terms_check', function() {
            $('#billing_info input[name=agree]').val(1);
        });

        $(document).on('click', '#place_order', function(e) {
            e.preventDefault();

            selectDefaultShippingMethod();

            $('.checkout-billing-form').trigger('submit');
        });

        $(document).on("click", ".apply-coupon", function() {
            let url = $(this).attr('data-action');
            let coupon = $(this).parent().find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon); // for shipping code
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("{{ site_currency_symbol() }}" + 0);

            submitCoupon(url, coupon);
        });

        $(document).on("submit", "#discount-coupon", function(e) {
            e.preventDefault();

            let url = $(this).attr('action');
            let coupon = $(this).find('input[name=coupon]').val();

            $('.lds-ellipsis').show();
            $('#coupon_code').val(coupon); // for shipping code
            $('#discount_summery').hide();
            $('#discount_summery #coupon_amount').html("{{ site_currency_symbol() }}" + 0);

            submitCoupon(url, coupon);
        })

        function submitCoupon(url, coupon) {
            $.ajax({
                url: url,
                type: 'GET',
                data: {
                    coupon: coupon,
                },
                success: function(data) {
                    $('.lds-ellipsis').hide();
                    if (data.type == 'success') {
                        toastr.success('{{ __('Coupon applied') }}');
                        $('#coupon_amount').text(amount_with_currency_symbol(data.coupon_amount));
                        $('#coupon_code').val(coupon);
                        $('#discount_summery').show();
                    } else {
                        toastr.error('{{ __('Coupon invalid') }}');
                    }

                    @if (get_static_option('tax_system') == 'advance_tax_system')
                        calculateOrderSummeryForAdvanceTax();
                    @else
                        calculateOrderSummary();
                    @endif
                },
                error: function(err) {
                    $('.lds-ellipsis').hide();
                    toastr.error('{{ __('Something went wrong') }}');
                }
            });
        }

        // please make sure this method is called before submitting checkout form
        function selectDefaultShippingMethod() {
            $(".card-footer .checkout-shipping-method.active").each(function() {
                let shippingCost = $(this).attr("data-shipping-cost");
                let shippingCostId = $(this).attr("data-shipping-cost-id");

                $(this).parent().parent().find(".vendor_shipping_cost").text(amount_with_currency_symbol(
                    shippingCost));
                $(this).parent().parent().find(".shipping_cost").val(shippingCostId);
            })
        }

        function calculateAmount(data) {
            let currencySymbol = "{{ site_currency_symbol() }}";

            $(".card #vendor_tax_amount").each(function() {
                let subTotal = parseFloat($(this).parent().parent().find("#vendor_subtotal").text().trim().replace(
                    currencySymbol, ""));
                let shippingCost = parseFloat($(this).parent().parent().find("#vendor_shipping_cost").text().trim()
                    .replace(currencySymbol, ""))
                let taxAmount = null;
                let mainSubTotal = 0;
                @if (get_static_option('tax_system') !== 'advance_tax_system')
                    taxAmount = data?.tax_amount ?? parseFloat($(this).parent().parent().find("#vendor_tax_amount")
                        .text().trim().replace("%", "").replace(currencySymbol, ''));
                    // now calculate subtotal with tax amount

                    $(this).text(taxAmount + "%")

                    mainSubTotal = subTotal * taxAmount / 100;
                @endif

                $(this).parent().parent().find("#vendor_total").text(amount_with_currency_symbol((subTotal +
                    shippingCost + mainSubTotal).toFixed(1)))
            });
        }

        function calculateOrderSummary() {
            let taxAmount = $("#checkout_tax_percentage").val();
            let discountAmount = $("#coupon_amount").text().trim().replace("{{ site_currency_symbol() }}", "");

            discountAmount = parseFloat(discountAmount === '' ? 0 : discountAmount);
            taxAmount = taxAmount == '' ? parseFloat("0") : parseFloat(taxAmount);

            let subTotal = getSubTotals();
            let totalTax = (subTotal - discountAmount) * taxAmount / 100;
            let totalShippingCost = getTotalShippingCost();

            @if ($enableTaxAmount)
                $("#checkout_tax_amount").text(amount_with_currency_symbol(totalTax.toFixed(2)))
            @endif

            $("#checkout_items_total").text(amount_with_currency_symbol(subTotal.toFixed(2)))
            $("#checkout_delivery_cost").text(amount_with_currency_symbol(totalShippingCost.toFixed(2)));
            $("#total_payment_amount").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                totalShippingCost).toFixed(2)));
            $("#checkout_total").text(amount_with_currency_symbol(((subTotal - discountAmount) + totalTax +
                totalShippingCost).toFixed(2)));
        }
    </script>
    @if (moduleExists('ShippingModule'))
        @include('shippingmodule::frontend.shipping-charge')
    @endif
    <script>
        $(document).on("submit", "#shopping_address", function(e) {
            e.preventDefault();
            let currentForm = $(this);
            send_ajax_request("POST", new FormData(e.target), "{{ route('frontend.shipping.address.store') }}",
                () => {}, (data) => {
                    ajax_toastr_success_message(data);

                    $(".user-shipping-address-wrapper").append(data.option)
                    currentForm.trigger("reset");
                },
                function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
        })

        $(document).on("change", "#modal_country_id", function() {
            let country_id = $(this).val();
            let data = new FormData();
            data.append("country_id", country_id);

            send_ajax_request("get", "", "{{ route('frontend.get-states') }}/" + country_id, () => {}, (data) => {
                if (data.success) {
                    $(this).parent().parent().find("#modal_state_id").html(data.data);
                }
            }, function(xhr) {
                ajax_toastr_error_message(xhr);
            })
        });
        $(document).on("change", "#modal_state_id", function() {
            // first, i need to get all states
                // to get all shipping methods
                // to insert all shipping methods on .all-shipping-options hare
                // Add tax amount to all the orders
                let state_id = $(this).val();
                let data = new FormData();
                data.append("id", state_id);
                data.append("type", "state");
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("POST", data, "{{ route('frontend.shipping.module.methods') }}", () => {

                }, (data) => {
                    if (data.success) {
                        $("#checkout_tax_percentage").val(data.tax_amount);

                        // now first i need to get all orders tax filed and insert tax amount
                        // after those data we need to calculate every order
                        $('#tax_amount').html(data.tax_amount + "%");

                        let cityhtml = "<option value=''> {{ __('Select an city') }} </option>";
                        data?.cities?.forEach((city) => {
                            cityhtml += "<option value='" + city.id + "'>" + city.name +
                                "</option>";
                        });

                        $("#modal_city_id").html(cityhtml);

                        calculateAmount(data);
                        calculateOrderSummary();
                    }
                }, function(xhr) {
                    ajax_toastr_error_message(xhr);
                })
        });

        $(document).on('click', '.billing_details_click', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').toggleClass('show');
        });

        $(document).on('click', '.popup_modal_checkout_overlay, .checkout_modal_close', function() {
            $('.popup_modal_checkout, .popup_modal_checkout_overlay').removeClass('show');
        });
        $(document).on("click",".create-accounts",function(){
            if($(this).hasClass("active")){
                $("input[name='create_account']").val('');
                $("input[name='password']").val('');
                $("input[name='password_confirmation']").val('');
            }else{
                $("input[name='create_account']").val(1);
            }
        })
    </script>
@endsection
