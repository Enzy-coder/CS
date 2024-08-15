<!-- Header area Starts -->
<header class="header-style-01">
    <!-- Topbar area Starts -->
    <div class="topbar-area topbar-four topbar-bg-4">
        <div class="container {{ $containerClass ?? "" }}">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="topbar-left-contents">
                        <ul class="topbar-social">
                            @if (!empty($all_social_item) && $all_social_item->count())
                                @foreach ($all_social_item as $social_item)
                                    <li class="link-item">
                                        <a href="{{ $social_item->url }}">
                                            <i class="{{ $social_item->icon }} icon"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <div class="topbar-right-contents">
                        <div class="topbar-right-flex align-items-center">
                            <div class="topbar-right-offer">

                            </div>
                            <div class="topbar-right-offer">
                                <ul class="list">
                                    @if(get_static_option("enable_vendor_registration") === 'on')
                                        <li class="ml-2">
                                            <a class="btn btn-sm btn-warning text-dark become-a-seller-button" href="{{ route('vendor.register') }}">
                                                {{ __('Become a seller') }}
                                            </a>
                                        </li>
                                    @endif
                                    <li class="ml-2">
                                        <a href="{{ route('vendor.login') }}">
                                            {{ __('Seller login') }}
                                        </a>
                                    </li>
                                    {!! render_frontend_menu(get_static_option('topbar_menu')) !!}
                                    <li class="ml-2">
                                        <a href="{{ route('frontend.products.track.order') }}">
                                            {{ __('Tracking order') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar area Ends -->
    <!-- Topbar bottom area Starts -->
    <div class="topbar-bottom-area topbar-bottom-four">
        <div class="container {{ $containerClass ?? "" }}">
            <div class="row align-items-center">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="topbar-logo">
                        <a href="{{ route('homepage') }}">
                            @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                            @else
                                <h2 class="site-title">
                                    {{ filter_static_option_value('site_title', $global_static_field_data) }}</h2>
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="category-searchbar">
                        <form action="#" class="single-searchbar searchbar-suggetions">
                            <input autocomplete="off" class="form--control radius-5" id="search_form_input"
                                type="text" placeholder="{{ 'Search For Products' }}">
                            <button type="submit" class="right-position-button margin-2 radius-5"> <i
                                    class="las la-search"></i> </button>
                            <div class="search-suggestions" id="search_suggestions_wrap">
                                <div class="search-inner">
                                    <div class="category-suggestion item-suggestions">
                                        <h6 class="item-title">{{ __('Category Suggestions') }}</h6>
                                        <ul id="search_result_categories" class="category-suggestion-list mt-4">

                                        </ul>
                                    </div>
                                    <div class="product-suggestion item-suggestions">
                                        <h6 class="item-title">{{ __('Product Suggestions') }}</h6>
                                        <ul id="search_result_products" class="product-suggestion-list mt-4">

                                        </ul>
                                    </div>

                                    <div class="product-suggestion item-suggestions" style="display:none;"
                                        id="no_product_found_div">
                                        <h6 class="item-title d-flex justify-content-between">
                                            <span>
                                                {{ __('No Product Found') }}
                                            </span>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="topbar-bottom-right-content">
                        <div class="topbar-bottom-right-flex">
                            <div class="track-icon-list">
                                @if(auth('web')->check())
                                    <div class="track-icon-list-item">
                                        <a href="{{ route('user.product.order.all') }}" class="track-icon-single">
                                            <span class="icon">
                                                <i class="las la-shopping-bag"></i>
                                            </span> {{ __('Order') }}
                                        </a>
                                    </div>
                                @endif

                                <div class="track-icon-list-item">
                                    <a href="{{ route('frontend.products.track.order') }}" class="track-icon-single">
                                        <span class="icon">
                                            <i class="las la-map-marker-alt"></i>
                                        </span>
                                        {{ __('Order Tracking') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar bottom area Ends -->
    <!-- Menu area Starts -->
    <nav class="navbar navbar-area nav-five navbar-expand-lg">
        <div class="container nav-container  {{ $containerClass ?? "" }}">
            <div class="navbar-inner-all">
                <div class="navbar-inner-all--left">
                    <div class="nav-category category_bars">
                        <span class="nav-category-bars"><i class="las la-bars"></i> {{ __('Categories') }}</span>
                    </div>
                    <div class="responsive-mobile-menu d-lg-none d-block">
                        <div class="logo-wrapper">
                            <a href="{{ route('homepage') }}">
                                @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                    {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                                @else
                                    <h2 class="site-title">
                                        {{ filter_static_option_value('site_title', $global_static_field_data) }}</h2>
                                @endif
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#mares_main_menu">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="show-nav-right-contents">
                            <i class="las la-ellipsis-v"></i>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="mares_main_menu">
                    <ul class="navbar-nav">
                        {!! render_frontend_menu($primary_menu) !!}
                    </ul>
                </div>
                <div class="navbar-right-content">
                    <div class="single-right-content">
                        <div class="track-icon-list header-card-area-content-wrapper">
                            @include('frontend.partials.header.navbar.card-and-wishlist-area')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- Menu area end -->

    <!-- Category nav wrapper  -->
    <div class="categoryNav_overlay"></div>
    <div class="categoryNav">
        <div class="categoryNav__close"><i class="las la-times"></i></div>
        <div class="categoryNav_sidebar">
            <h3 class="categoryNav__title">{{ __('All Category') }}</h3>
            <div class="categoryNav__inner mt-3">
                <ul class="categoryNav__list parent_menu menu_visible">
                    {!! render_frontend_menu(get_static_option('megamenu'), 'category_menu') !!}
                </ul>
            </div>
        </div>
    </div>
</header>
<!-- Header area end -->
