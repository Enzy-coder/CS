@extends('frontend.frontend-page-master')
@section('page-meta-data')
    
@endsection

@section("style")
    <style>
        .breadcrumb-area {
            display: none;
        }
        .country-name {
            position: absolute;
            right: 190px;
            top: 83px;
            text-transform: uppercase;
            color: #FFA31E;
            font-size: 5rem;
            font-family: system-ui;
            font-weight: 700;
        }
        @media (max-width: 782px) {
            .country-name {
                right: 160px;
                top: 29px;
            }
        }
        @media (max-width: 425px) {
            .country-name {
                right: 27px;
                top: 29px;
            }
        }
        .country-flag{
            border-radius: 50%;
            width: 100px;
            height: 100px;
            object-fit: cover;
            display: block;
            border: 1px solid #ccc;
        }
        .country-block{
            width: 125px;
        }
        .country-main-block{
            margin-top:40px;
            gap:59px;
        }
        .description {
            margin: 40px 20px;
            color: #303030;
            font-size: 21px;
            font-weight: 400;
            font-family: sans-serif;
        }
        .country-heading{
            color:#D42E41;
            font-weight: bolder;
            display: grid;
            justify-items: center;
        }
        .line{
            width: 150px;
            border: 1.6px solid #f7f71d;
            height: 1px;
        }
        .country-name {
            color: #fff;
            font-size: 5rem;
            text-transform: uppercase;
        }
        .category-name{
            color: #403434;
        }
        .cat-block{
            height: 90px;
            width: 90px;
            object-fit: contain;
            border-radius: 50%;
            background: #fbfaf4;
        }
        .cats{
            margin-top: 12px;
            justify-content: space-between;
        }
    </style>
@endsection

@section('content')
@if($country)
    <div class="row">
        <div class="col-md-12 relative">
            <h1 class="country-name">{{$country->name}}</h1>
            <img class="country-banner" style="width:100%;max-height:343px;max-width:1363px" src="{{asset('storage/'.$country->header)}}">
        </div>
        <h4 class="text-center description" >
            {{ $country->description }}
        </h4>
    </div>
    <!-- catgs -->
    <div class="shop-grid-area-wrapper left-sidebar mt-5" id="shop">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center country-heading" >
                        {{__('CHOICE CATEGORIES')}}
                        <div class="line"></div>
                    </h2>
                    <div class="row cats">
                        @foreach ($product_categories as $product_category)
                            <div class="col-md-1 text-center cat-click cursor-pointer" data-id="{{$product_category->category_id}}"
                                data-slug="{{optional($product_category->category)->slug}}">
                                <div class="cat-block">
                                    <img src="{{asset('assets/uploads/media-uploader/'.optional($product_category->category->image)->path)}}" class="cat-image">
                                </div>
                                <b class="category-name">
                                    {{optional($product_category->category)->name}}
                                </b>
                            </div>
                        @endforeach
                    </div>
                    @if($product_categories->count() == 0)
                        <div class="cart-page-wrapper padding-top-100 padding-bottom-50">
                            <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="__('No Category Found!')" />
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- catgs ends -->
    <div class="shop-grid-area-wrapper left-sidebar mt-5" id="shop">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center country-heading" >
                        {{__('CULTURAL PRODUCTS')}}
                        <div class="line"></div>
                    </h2>
                    <div class="row" style="margin-top:12px;">
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
    @else
    <div class="cart-page-wrapper padding-top-100 padding-bottom-50">
        <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="__('No Countries against this Culture!')" />
    </div>
    @endif
@endsection
@section('scripts')
    <script>
        $(document).on('click','.cat-click',function(){
            let id = $(this).attr('data-id');
            let slug = $(this).attr('data-slug');
            window.location = '/shop-page/category/' + slug + '?id=' + id;
        })
    </script>
@endsection