<div class="filter-style-block-preloader lds-ellipsis">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

@if($products->count() < 1)
    <h2 class="title text-center w-100 py-5">No Product Found</h2>
@endif

@foreach($products as $item)
    <div class="custom-col px-2 pb-3">
        <x-frontend.product.product_filter_style_two_items :item="$item" />
    </div>
@endforeach