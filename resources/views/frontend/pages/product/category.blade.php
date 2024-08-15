@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('site-title')
    {{__('Category:')}} {{$category_name}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')}}">
@endsection

@section("style")
    <style>
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
<div class="shop-grid-area-wrapper left-sidebar mt-5" id="shop">
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @foreach ($all_products as $product)
                        <x-product::frontend.grid-style-05 :product="$product" :$loop />
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="pagination-default">
                            {!! $all_products->links() !!}
                        </div>
                    </div>
                </div>
                @if($all_products->total() < 1)
                    <div class="cart-page-wrapper padding-top-100 padding-bottom-50">
                        <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="__('No product found!')" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
