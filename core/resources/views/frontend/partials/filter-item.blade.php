@if($products->count() < 1)
    <h2 class="title text-center w-100 py-5">{{ __("No Product Found") }}</h2>
@endif
@foreach ($products as $item)
    @if(((int) request()->card_style) === 2)
        <x-product::frontend.grid-style-05 :product="$item" />
    @else
        <div class="single-grid">
            <x-frontend.product.product-card-03 :product="$item" :isAjax="true" />
        </div>
    @endif
@endforeach
