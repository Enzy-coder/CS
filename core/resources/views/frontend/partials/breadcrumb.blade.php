@php
    $visibility_class = '';

    if (request()->routeIs('frontend.dynamic.page')) {
        if (isset($page_post) && !$page_post->breadcrumb_status) {
            $visibility_class = 'd-none';
        }
    }

    if (request()->routeIs('homepage')) {
        $visibility_class = 'd-none';
        if (isset($page_details) && $page_details->breadcrumb_status) {
            $visibility_class = '';
        }
    } elseif (request()->routeIs('frontend.vendors.single')) {
        $visibility_class = 'd-none';
    }
@endphp


@if(Route::currentRouteName() != 'frontend.products.single')
    <!-- Breadcrumb area Starts -->
    <div class="breadcrumb-area breadcrumb-padding bg-item-badge {{ $visibility_class }}">
        <div class="breadcrumb-shapes">
            <img src="{{ asset('assets/img/shop/badge-s1.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s2.png') }}" alt="">
            <img src="{{ asset('assets/img/shop/badge-s3.png') }}" alt="">
        </div>

        <div class="container container-one">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-contents">
                        <h2 class="breadcrumb-title">
                             @yield('page-title')
                        </h2>

                        <ul class="breadcrumb-list">
                            @if (Route::currentRouteName() === 'frontend.dynamic.page')
                                <li class="list">
                                    <a href="{{ route('homepage') }}">
                                        {{ $page_post->title ?? ($page_name ?? '') }}
                                    </a>
                                </li>
                            @elseif(Route::currentRouteName() === 'frontend.products.single')
                                @yield('product-category')
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb area end -->
@endif