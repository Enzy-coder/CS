<div class="category-searchbar" style="display: none">
    <div class="d-block">
        <span class="rounded-circle rounded-circle2 bg-white" id="close_search_dropdown">x</span>
    </div>
    <div class="search-suggestions" id="search_suggestions_wrap">
        <div class="search-inner">
            <div class="category-suggestion item-suggestions">
                <h6 class="item-title">{{ __('Category Suggestions') }}</h6>
                <ul class="category-suggestion-list mt-4" id="search_result_categories"></ul>
            </div>
            <div class="product-suggestion item-suggestions">
                <h6 class="item-title d-flex justify-content-between">
                    <span>
                        {{ __('Product Suggestions') }}
                    </span>
                    <a href="#1" target="_blank" id="search_result_all" class="showAll">{{ __('Show all') }}</a>
                </h6>
                <ul class="product-suggestion-list mt-4" id="search_result_products"></ul>
            </div>
            <div class="product-suggestion item-suggestions" style="display:none;" id="no_product_found_div">
                <h6 class="item-title d-flex justify-content-between">
                    <span>
                        {{ __('No Product Found') }}
                    </span>
                </h6>
            </div>
        </div>
    </div>
    @php
        $categories = getAllCategory();
    @endphp
    <div class="category-select">
        <select id="search_selected_category">
            <option value="">{{ __('All Category') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
</div>
