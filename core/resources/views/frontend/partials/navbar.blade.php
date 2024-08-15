<!-- Topbar bottom area Starts -->
<div class="topbar-bottom-area index-02 color-two">
    <div class="container container-one">
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
            <div class="col-lg-5">
                <div class="category-searchbar">
                    <form action="#" class="single-searchbar searchbar-suggetions">
                        <input autocomplete="off" class="form--control radius-5" id="search_form_input" type="text"
                            placeholder="{{ 'Search For Products' }}">
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

            <div class="col-lg-4">
                <div class="topbar-bottom-right-content navbar-right-flex">
                    <div class="topbar-bottom-right-flex">
                        <div class="track-icon-list header-card-area-content-wrapper">
                            @include('frontend.partials.header.navbar.card-and-wishlist-area')
                        </div>
                        <div class="login-account">
                            @if (auth('web')->check())
                                <a class="accounts" href="#1"> {{ auth('web')->user()->name }} <i
                                        class="las la-user"></i> </a>
                                <ul class="account-list-item">
                                    <li class="list"><a href="{{ route('user.home') }}">{{ __('Dashboard') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('user.home.edit.profile') }}">{{ __('Edit Profile') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('user.home.change.password') }}">{{ __('Change Password') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('user.product.order.all') }}">{{ __('My Orders') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('user.shipping.address.all') }}">{{ __('Shipping Address') }}</a>
                                    </li>
                                    <li class="list"><a
                                            href="{{ route('user.home.support.tickets') }}">{{ __('Support Ticket') }}</a>
                                    </li>
                                    <li class="list">
                                        <a href="{{ route('user.logout') }}"
                                            onclick="event.preventDefault();document.getElementById('menu_logout_submit_btn').dispatchEvent(new MouseEvent('click'));">
                                            {{ __('Logout') }}
                                        </a>
                                        <form action="{{ route('user.logout') }}" method="POST"
                                            style="display: none;">
                                            @csrf
                                            <button id="menu_logout_submit_btn" type="submit"></button>
                                        </form>
                                    </li>
                                </ul>
                            @else
                                <a class="accounts" href="#1"> <i class="las la-user"></i> </a>
                                <ul class="account-list-item">
                                    <li class="list"> <a href="{{ route('user.login') }}"> {{ __('Sign In') }} </a>
                                    </li>
                                    <li class="list"> <a href="{{ route('user.register') }}"> {{ __('Sign Up') }}
                                        </a> </li>
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar bottom area Ends -->
