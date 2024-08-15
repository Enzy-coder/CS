@extends('frontend.frontend-page-master')

@section('page-title')
    {{ __('Wishlist Page') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">
    <style>
        .lds-ellipsis {
            display: inline-block;
            position: fixed;
            width: 80px;
            height: 80px;
            left: 50vw;
            top: 40vh;
            z-index: 50;
            display: none;
        }

        .lds-ellipsis div {
            position: absolute;
            top: 33px;
            width: 13px;
            height: 13px;
            border-radius: 50%;
            background: var(--main-color-one);
            animation-timing-function: cubic-bezier(0, 1, 1, 0);
        }

        .lds-ellipsis div:nth-child(1) {
            left: 8px;
            animation: lds-ellipsis1 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(2) {
            left: 8px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(3) {
            left: 32px;
            animation: lds-ellipsis2 0.6s infinite;
        }

        .lds-ellipsis div:nth-child(4) {
            left: 56px;
            animation: lds-ellipsis3 0.6s infinite;
        }

        @keyframes lds-ellipsis1 {
            0% {
                transform: scale(0);
            }

            100% {
                transform: scale(1);
            }
        }

        @keyframes lds-ellipsis3 {
            0% {
                transform: scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @keyframes lds-ellipsis2 {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(24px, 0);
            }
        }

        tr.disabled.table-cart-row td {
            background: #dddddd;
            cursor: no-drop;
        }


        .only-img-page-wrapper.cart .img-box img {
            height: 100%;
        }

        .only-img-page-wrapper.cart .img-box {
            height: 400px;
            display: flex;
            justify-content: center;
        }
    </style>
@endsection

@section('content')
    <div class=" cart-page-wrapper  padding-top-100 padding-bottom-50">
        @php
            $all_cart_items = \Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content();
            $wishlist = true;
        @endphp
        @if (empty($all_cart_items->count()))
            <x-frontend.page.empty :image="get_static_option('empty_wishlist_image')" :text="get_static_option('empty_wishlist_text')" />
        @else
            <div id="cart-container">
                @include('frontend.cart.cart-partial')
            </div>
        @endif

        <div class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        (function($) {
            'use script'

            $(document).on("click", ".move-cart", function(e) {
                let data = new FormData();
                data.append("rowId", $(this).attr("data-product_hash_id"));
                data.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", data, "{{ route('frontend.products.wishlist.move.to.cart') }}",
            () => {

                }, (data) => {
                    loadHeaderCardAndWishlistArea(data);
                    ajax_toastr_success_message(data);

                    $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                }, (errors) => {
                    prepare_errors(errors)
                })
            });

            $(document).on("click", ".remove-wishlist", function(e) {
                let formData = new FormData();
                formData.append("rowId", $(this).attr("data-product_hash_id"));
                formData.append("_token", "{{ csrf_token() }}");

                send_ajax_request("post", formData, "{{ route('frontend.products.wishlist.ajax.remove') }}",
                () => {

                    }, (data) => {
                        loadHeaderCardAndWishlistArea(data);
                        ajax_toastr_success_message(data);
                        $(".cart-page-wrapper").load(location.href + " .cart-page-wrapper");
                    }, (errors) => {
                        prepare_errors(errors);
                    })
            });
        })(jQuery)
    </script>
@endsection
