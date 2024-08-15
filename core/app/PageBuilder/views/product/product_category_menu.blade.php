<div class="product-filter-for-index-03">
    <div class="container custom-container-1720">
        <div class="row g-4">
            <div class="col-md-4 col-lg-3">
                <div class="side-menu-wrapper position-relative index-03">
                    <nav class="navbar navbar-area nav-style-03 side-menu">
                        <div class="container nav-container">
                            <div class="responsive-mobile-menu index-03">
                                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#bizcoxx_main_menu_two" aria-expanded="false"
                                    aria-label="Toggle navigation">
                                    <i class="fas fa-bars icon"></i>
                                    <span class="text">{{ $category_header_title }}</span>
                                    <i class="fas fa-caret-down icon"></i>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse index-03-catg show" id="bizcoxx_main_menu_two">
                                <ul class="navbar-nav">
                                    {!! render_frontend_menu($category, 'category_menu') !!}
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-8 col-lg-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-list-wrapper">
                            <ul class="btn-list btn-wrapper">
                                <li data-filter="new-items" class="product_filter_style_two active">
                                    {{ __('New items') }}</li>
                                <li data-filter="top-rated" class="product_filter_style_two">{{ __('Top Rated') }}</li>
                                <li data-filter="top-selling" class="product_filter_style_two">{{ __('Top Sellin') }}g
                                </li>
                                <li data-filter="campaign" class="product_filter_style_two">{{ __('Campaign') }}</li>
                                <li data-filter="discounted" class="product_filter_style_two">{{ __('Discounted') }}
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--        This $items variable for product items limit        --}}
                <div class="custom-row product-filter-two-wrapper" data-item-limit="{{ $items }}">
                    <div class="filter-style-block-preloader lds-ellipsis">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>

                    @foreach ($all_products as $item)
                        <div class="custom-col px-2 pb-3">
                            <x-frontend.product.product_filter_style_two_items :item="$item" />
                        </div>
                    @endforeach
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="btn-wrapper text-center margin-top-60 see-all">
                            <a href="{{ url('shop-page')() }}"
                                class="btn-default rounded-btn semi-bold">{{ __('see all') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
