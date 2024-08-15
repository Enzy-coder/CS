<div class="support-bar-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="support-bar-inner">
                    <div class="logo">
                        <a href="{{ route('homepage') }}">
                            @if (!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                            @else
                                <h2 class="site-title">
                                    {{ filter_static_option_value('site_title', $global_static_field_data) }}</h2>
                            @endif
                        </a>
                    </div>
                    <div class="center-content">
                        <div class="search-form">
                            <form action="{{ route('frontend.products.all') }}">
                                <div class="form-group">
                                    <input type="text" name="q" class="form-control" id="search_form_input"
                                        placeholder="Search..." autocomplete="off">
                                </div>
                                <button class="search-btn" type="submit">{{ __('search') }}</button>
                                @include('frontend.partials.search-result')
                            </form>
                        </div>
                    </div>
                    <div class="right-content">
                        <ul class="short-control">
                            <x-.frontend.user-menu />
                            <li class="cart">
                                <a href="{{ route('frontend.products.compare') }}">
                                    <i class="las la-retweet icon"></i>
                                </a>
                            </li>
                            <li class=" cart cart2">
                                <span class="cart-badge" id="wishlist_badge">0</span>
                                <a href="{{ route('frontend.products.wishlist') }}">
                                    <i class="lar la-heart icon"></i>
                                </a>
                                <div class="mini-cart-wrapper" id="top_wishlist_container"></div>
                            </li>
                            <li class="cart">
                                <span class="cart-badge" id="cart_badge">0</span>
                                <a href="{{ route('frontend.products.cart') }}" class="active">
                                    <i class="las la-shopping-bag icon"></i>
                                </a>
                                <div class="mini-cart-wrapper" id="top_minicart_container"></div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
