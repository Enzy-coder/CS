<div class="nav-area-wrapper">
    <div class="container custom-container-1720">
        <div class="row nav-reverse">
            <div class="col-lg-12">
                <nav class="navbar navbar-area navbar-expand-lg has-topbar nav-style-01 index-01 only-menu extra">
                    <div class="container nav-container custom-container-1720 padding-x-0">
                        <div class="responsive-mobile-menu">
                            <div class="logo-wrapper">
                                <div class="logo">
                                    <a href="{{ route('homepage') }}">
                                        @if(!empty(filter_static_option_value('site_logo', $global_static_field_data)))
                                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo', $global_static_field_data)) !!}
                                        @else
                                            <h2 class="site-title">{{filter_static_option_value('site_title', $global_static_field_data)}}</h2>
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#bizcoxx_main_menu" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse" id="bizcoxx_main_menu">
                            <ul class="navbar-nav">
                                {!! render_frontend_menu($primary_menu) !!}
                            </ul>
                        </div>
                        <div class="right-content extra-menu-right-content">
                            <ul class="short-control">
                                <x-.frontend.user-menu/>
                                <li class=" cart cart2">
                                    <span class="cart-badge" id="wishlist_badge">0</span>
                                    <a href="#1">
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
                            <div class="search-form style-02">
                                <form action="{{ route('frontend.products.all') }}">
                                    <div class="form-group">
                                        <input type="text"
                                               name="q"
                                               class="form-control"
                                               id="search_form_input"
                                               placeholder="{{__('Search...')}}"
                                               autocomplete="off"
                                        >
                                    </div>
                                    <button class="search-btn" type="submit">
                                        <i class="las la-search"></i>
                                    </button>
                                    @include('frontend.partials.search-result')
                                </form>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
