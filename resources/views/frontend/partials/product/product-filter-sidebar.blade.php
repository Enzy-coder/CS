<?php
use Modules\Product\Entities\ProductSubCategory;
$sub_cat_details = ProductSubCategory::with('category')->find(request()->subcat);
$cat = optional(optional($sub_cat_details)->category)->id;
?>

<div class="widget-area-wrapper">
    <div class="widget widget-search">
        <form class="search-from">
            <div class="form-group">
                <input type="search" id="search_query" class="form-control" autocomplete="off" placeholder="search..."
                    value="{{ request()->q }}">
            </div>
            <button type="submit" class="widget-search-btn">
                <i class="las la-search icon"></i>
            </button>
        </form>
    </div>
    <div class="widget widget-category">
        <h5 class="widget-title">{{ __('all categories') }}</h5>
        <div class="category-wrap">
            <div id="accordion">
                @foreach ($all_category as $category)
                    <?php
                    $i = rand(1000, 9999);
                    ?>
                    <div class="card p-0 border-0 custom-category-list">
                        <div class="card-header p-0" id="heading-{{ $i }}">
                            <h5 class="mb-0">
                                <div class="single-checkbox-wrap">
                                    <label>
                                        <input type="radio" name="product_cat" class="radio"
                                            @if (request()->cat == $category->id) checked @endif
                                            value="{{ $category->id }}">
                                        <span class="checkmark">{{ $category->title }}</span>
                                    </label>

                                @if($category->subcategory->count() > 0)
                                    <button class="sub-category-btn py-0 px-0 m-0" data-bs-toggle="collapse"
                                            data-bs-target="#collapse-{{ $i }}"
                                            aria-expanded="true"
                                            aria-controls="collapse-{{ $i }}">
                                            +
                                        </button>
                                    @endif
                                </div>
                            </h5>
                        </div>

                        @if (optional($category->subcategory)->count() > 0)
                            <div id="collapse-{{ $i }}"
                                class="collapse {{ $category->id === $cat ? 'show' : '' }}"
                                aria-labelledby="heading-{{ $i }}" data-parent="#accordion">
                                <div class="card-body p-0">
                                    <div class="widget-check-box checkbox-catagory ml-4">
                                        @foreach ($category->subcategory as $subcategory)
                                            <div class="single-checkbox-wrap">
                                                <label>
                                                    <input type="radio" name="product_subcat" class="radio"
                                                        @if (request()->subcat == $subcategory->id) checked @endif
                                                        value="{{ $subcategory->id }}">
                                                    <span class="checkmark">{{ $subcategory->title }}</span>
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="widget widget-category">
        <h5 class="widget-title">{{ __('all units') }}</h5>
        <div class="category-wrap">
            @foreach ($all_units as $unit)
                <div class="single-category-item">
                    <label class="radio-btn-wrapper">
                        <input type="radio" class="checkbox" name="product_unit" value="{{ $unit->name }}"
                            @if (request()->unt == $unit->name) checked @endif>
                        <span class="checkmark"></span>
                        <span class="content">
                            <span class="left">{{ $unit->name }}</span>
                        </span>
                    </label>
                </div>
            @endforeach
        </div>
    </div>
    <div class="widget widget-range">
        <h5 class="widget-title">{{ __('filter by price') }}</h5>
        <div class="range-wrap">
            <div id="slider-range"></div>
            <div class="range">
                <form>
                    <p class="price-range-wrap">
                        <label for="amount">{{ __('Range') }}:</label>
                        <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;"
                            value="{{ amount_with_currency_symbol($min_price) }} - {{ amount_with_currency_symbol($max_price) }}">
                    </p>
                </form>
            </div>
        </div>
    </div>

    <div class="widget widget-rating">
        <h5 class="widget-title">{{ __('Average rating') }}</h5>
        @php
            $searched_rating = request()->rt ?? 0;
        @endphp
        <input type="hidden">
        <div class="rating-wrap">
            @for ($i = 5; $i >= 1; $i--)
                {!! getProductSearchRatingInput($i, $searched_rating) !!}
            @endfor
        </div>
    </div>

    <div class="widget widget-tag">
        <h5 class="widget-title">{{ __('tags') }}</h5>
        <div class="tag-wrap">
            @foreach ($all_tags as $tag)
                <a href="#1"
                    class="tag-btn @if (isset(request()->t) && request()->t == $tag->tag_text) active @endif">{{ $tag->tag_text ?? $tag->tag }}</a>
            @endforeach
        </div>
    </div>
    @if (!empty($selected_items_display_status))
        <div class="widget widget-recently-added">
            <h5 class="widget-title">{{ $selected_items_name }}</h5>
            <div class="recently-added-wrap">
                @foreach ($selected_items as $selected_item)
                    <div class="single-recent-item">
                        <div class="img-box">
                            {!! render_image_markup_by_attachment_id($selected_item->image, 'grid', true) !!}
                        </div>
                        <div class="content">
                            <h5 class="title">
                                <a
                                    href="{{ route('frontend.products.single', $selected_item->slug) }}">{{ Str::limit($selected_item->title, 25) }}</a>
                            </h5>
                            <span
                                class="product-meta">{{ float_amount_with_currency_symbol($selected_item->sale_price) }}/1kg</span>
                            <div class="ratings">
                                <a href="#1" class="icon-wrap">
                                    {!! render_ratings($selected_item->ratingAvg(), 'icon active') !!}
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
    @if (!empty($featured_section_display_status))
        <div class="widget widget-add">
            <div class="add-banner-y-style-01">
                <a href="{{ url($featured_section_btn_url) }}">
                    {!! render_image_markup_by_attachment_id($featured_section_background_image) !!}
                </a>
                <div class="content">
                    <span class="sub-title">{{ $featured_section_subtitle }}</span>
                    <h4 class="title">{{ $featured_section_title }}</h4>
                    <div class="btn-wrapper">
                        <a href="{{ url($featured_section_btn_url) }}"
                            class="shop-now-btn-style-01">{{ $featured_section_btn_text }}</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
