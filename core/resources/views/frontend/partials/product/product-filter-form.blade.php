<form action="{{ route("frontend.ajax.products.search") }}" method="get" id="search_product" style="display: none">
    @csrf
    @if($vendor ?? null)
        <input type="hidden" id="vendor_username" name="vendor_username" value="{{ $vendor->username ?? '' }}">
    @endif
    <input type="hidden" id="name" name="name" value="{{ request()->name ?? '' }}">
    <input type="hidden" id="brand" name="brand" value="{{ request()->brand ?? '' }}">
    <input type="hidden" id="category" name="category" value="{{ request()->category ?? '' }}">
    <input type="hidden" id="sub_category" name="sub_category" value="{{ request()->sub_category ?? '' }}">
    <input type="hidden" id="child_category" name="child_category" value="{{ request()->child_category ?? '' }}">
    <input type="hidden" id="color" name="color" value="{{ request()->color ?? '' }}">
    <input type="hidden" id="size" name="size" value="{{ request()->size ?? '' }}">
    <input type="hidden" id="delivery_option" name="delivery_option" value="{{ request()->delivery_option ?? '' }}">
    <input type="hidden" id="min_price" name="min_price" value="{{ request()->min_price ?? '' }}">
    <input type="hidden" id="max_price" name="max_price" value="{{ request()->max_price ?? '' }}">
    <input type="hidden" id="rating" name="rating" value="{{ request()->rating ?? '' }}">
    <input type="hidden" id="search_order_by" name="order_by" value="{{ request()->order_by ?? '' }}">
    <input type="hidden" id="search_page" name="page" value="{{ request()->page ?? '' }}">
</form>
