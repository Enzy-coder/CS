@php
    $productPageSlug = \App\Page::select("slug")->where("id", get_static_option("product_page"))->first();
@endphp

<!-- Choose Brand area Start -->
<section class="chooseBrand_area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            @foreach($brands as $brand)
                <div class="col-xxl-3 col-lg-4 col-sm-6">
                    <div class="chooseBrand">
                        <div class="chooseBrand__flex">
                            <div class="chooseBrand__icon">
                                <a href="{{ route("frontend.dynamic.page", $productPageSlug->slug) }}?brand={{ $brand->name }}">
                                    {!! render_image($brand->logo) !!}
                                </a>
                            </div>
                            <div class="chooseBrand__contents">
                                <h6 class="chooseBrand__title">
                                    <a href="{{ route("frontend.dynamic.page", $productPageSlug->slug) }}?brand={{ $brand->name }}">{{ $brand->name }}</a>
                                </h6>
                                @if($brand->products_count > 0)
                                    <p class="chooseBrand__para mt-1">{{ $brand->products_count }}+ {{ __("Available Product") }}</p>
                                @else
                                    <p class="chooseBrand__para mt-1">{{ __("No product found") }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Choose Brand area end -->