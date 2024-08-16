@extends('frontend.frontend-page-master')
@section('page-meta-data')
    
@endsection

@section("style")
    <style>
        .breadcrumb-area {
            display: none;
        }
        .continent-name {
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
            .continent-name {
                right: 160px;
                top: 29px;
            }
        }
        @media (max-width: 425px) {
            .continent-name {
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
            box-shadow: 1px 2px 4px #ccc;
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
        .continent-heading{
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
        .country-name{
            color: #EA2839;
            font-size: 16px;
            text-transform: uppercase;
        }
    </style>
@endsection

@section('content')
@if($continent)
    <div class="row">
        <div class="col-md-12 relative">
            <h1 class="continent-name">{{$continent->name}}</h1>
            <img class="continent-banner" src="{{$continent->header_image ? asset('storage/'.$continent->header_image) : '/storage/uploads/continents/default_image.png'}}">
        </div>
        <h4 class="text-center description" >
            {{ $continent->description }}
        </h4>
    </div>

    <div class="container mb-5">
        <div class="col-md-12">
            <h2 class="text-center continent-heading" >
                {{ strtoupper($continent->name) }}'S COUNTIRES
                <div class="line"></div>
            </h2>
            <div class="row country-main-block">
                @foreach ($countries as $country)
                    <a  class="col-md-2 text-center country-block" href="{{route('countries.categories',[$country->id])}}">
                        <div>
                            <img class="country-flag" src="/continents/flags/{{$country->slug}}.svg">
                            <b class="country-name"> {{$country->name}} </b>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="pagination-default">
                    {!! $countries->links() !!}
                </div>
            </div>
        </div>
        @if($countries->total() < 1)
            <div class="cart-page-wrapper padding-top-100 padding-bottom-50">
                <x-frontend.page.empty :image="get_static_option('empty_cart_image')" :text="__('No product found!')" />
            </div>
        @endif
    </div>
    <div class="shop-grid-area-wrapper left-sidebar mt-5" id="shop">
        <div class="container mb-5">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="text-center continent-heading" >
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
