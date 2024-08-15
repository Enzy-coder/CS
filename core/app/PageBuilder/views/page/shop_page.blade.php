@section('page-title')
    {{ $page_title }}
@endsection
@php
    $item_width = $sidebar_position == 'hide' ? 'col-lg-3' : 'col-lg-4';
@endphp
<div class="shop-grid-area-wrapper left-sidebar">
    <div class="container">
        <div class="row @if($sidebar_position == 'right') flex-row-reverse @endif">
            <div class="col-md-4 col-lg-3" @if($sidebar_position == 'hide') style="display: none" @endif>
                @include('frontend.partials.product.product-filter-sidebar')
            </div>
            <div class="col-md-8 @if ($sidebar_position == 'hide') col-lg-12 @else col-lg-9 @endif">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="toolbox-wrapper">
                            <div class="toolbox-left">
                                <div class="toolbox-item">
                                    @php
                                        $pagination_summary = getPaginationSummaryText($all_products);
                                    @endphp
                                    <p class="showing">{{ __('Showing') }}
                                        {{ $pagination_summary['start'] }}–{{ $pagination_summary['end'] }}
                                        {{ __('of') }} {{ $pagination_summary['total'] }} {{ __('results') }}</p>
                                </div>
                            </div>
                            <div class="toolbox-right">
                                <div class="toolbox-item toolbox-sort">
                                    <select id="set_item_sort_by" class="select-box">
                                        <option value="default" @if (isset($sort_by) && $sort_by == 'default') selected @endif>
                                            {{ __('Default sorting') }}</option>
                                        <option value="popularity" @if (isset($sort_by) && $sort_by == 'popularity') selected @endif>
                                            {{ __('Sort by popularity') }}</option>
                                        <option value="rating" @if (isset($sort_by) && $sort_by == 'rating') selected @endif>
                                            {{ __('Sort by rating') }}</option>
                                        <option value="latest" @if (isset($sort_by) && $sort_by == 'latest') selected @endif>
                                            {{ __('Sort by latest') }}</option>
                                        <option value="price_low" @if (isset($sort_by) && $sort_by == 'price_low') selected @endif>
                                            {{ __('Sort by price: low to high') }}</option>
                                        <option value="price_high" @if (isset($sort_by) && $sort_by == 'price_high') selected @endif>
                                            {{ __('Sort by price: high to low') }}</option>
                                    </select>
                                </div>
                                <div class="toolbox-item toolbox-layout">
                                    <ul class="layout-list">
                                        <li class="layout-item">
                                            <a href="{{ route('frontend.products.all', ['s' => 'grid']) }}"
                                                class="grid-layout @if ($item_style == 'grid') current @endif"
                                                data-style="grid">
                                                <i class="las la-border-all icon"></i>
                                            </a>
                                        </li>
                                        <li class="layout-item">
                                            <a href="{{ route('frontend.products.all', ['s' => 'list']) }}"
                                                class="list-layout @if ($item_style == 'list') current @endif"
                                                data-style="list">
                                                <i class="las la-list icon"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row col-control">
                    @foreach ($all_products as $product)
                        @if ($item_style == 'grid')
                            <div class="col-6 col-sm-6 col-md-6 {{ $item_width }}">
                                <x-frontend.product.product-card-03 :product="$product" />
                            </div>
                        @else
                            <div class="col-sm-6 col-md-12 col-lg-12">
                                <x-frontend.product.product-list :product="$product" />
                            </div>
                        @endif
                    @endforeach
                </div>

                <div class="frontend-pagination-wrapper">
                    <div class="pagination">
                        <ul class="pagination-list">
                            @if(isset($all_products['links']))
                                @foreach ($all_products['links'] as $link)
                                    @if(isset($link))
                                        <li><a href="{{ $link }}"
                                                class="page-number {{ $loop->iteration == $products['current_page'] ? 'current' : '' }}">{{ $loop->iteration }}</a>
                                        </li>
                                    @endif
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('frontend.partials.product.product-filter-form')
@section('script')
    @include('frontend.partials.product.product-filter-script')
@endsection
