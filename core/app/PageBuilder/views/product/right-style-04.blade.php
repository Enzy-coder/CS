<!-- Popular slider area starts -->
<div class="popular-slider-area">
    <div class="row">
        @php
            $category_one = $categories->where("id",$category_one)->first();
            $category_two = $categories->where("id",$category_two)->first();
            $category_three = $categories->where("id",$category_three)->first();
        @endphp

        @foreach([$category_one,$category_two,$category_three] as $category)
            <div class="col-lg-4">
                <div class="popular-sale-area padding-top-50 padding-bottom-50">
                    <div class="section-title text-left section-border-bottom">
                        <div class="title-left">
                            <h2 class="title"> {{ $category->name ?? '' }} </h2>
                        </div>
                    </div>
                    <div class="popular-vertical-slider mt-5">
                        <div class="global-slick-init recent-slider nav-style-one nav-color-two slider-inner-margin" data-infinite="true" data-verticalSwiping="true" data-vertical="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-autoplay="true" data-autoplaySpeed="2000"
                             data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[{"breakpoint": 1800,"settings": {"slidesToShow": 3}},{"breakpoint": 1400,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768, "settings": {"slidesToShow": 3} }]'>
                            @foreach($category?->product?->take($item_count) ?? [] as $product)
                                <x-product::frontend.list-style-02  :$loop :$product />
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!-- Popular slider area end -->