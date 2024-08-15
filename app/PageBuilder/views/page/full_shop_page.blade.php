@section('page-title')
    {{ $page_title }}
@endsection
<!-- shop grid area start -->
<div class="shop-grid-area-wrapper left-sidebar top-product-wrapper padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid-wrapper row g-4 gy-5 mt-0">
                @foreach ($all_products as $product)
                    <div class="col-md-3 col-sm-6">
                        <x-product::frontend.card-style-01 :$product />
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination">
                        {!! $all_products->withQueryString()->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- shop grid area end -->
