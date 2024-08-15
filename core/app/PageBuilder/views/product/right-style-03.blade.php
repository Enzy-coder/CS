<!-- Featured area Starts -->
<section class="featured-area padding-top-50 padding-bottom-50">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title text-left section-border-bottom">
                <div class="title-left">
                    <h2 class="title">{{ $section_title }}</h2>
                </div>
                <div class="product-list isootope-list">
                    <ul class="product-button isootope-button hover-color-two">
                        <li class="list active" data-filter="*">{{ __('All') }}</li>
                        @foreach ($categories as $category)
                            <li class="list" data-filter=".cat-{{ $category['id'] }}">{{ $category['name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="imageloaded">
        <div class="row grid mt-4">
            @foreach ($products as $product)
                <div class="col-xxl-3 col-xl-3 col-lg-4 col-sm-6 mt-4 grid-item cat-{{ $product?->category?->id }} wow fadeInUp"
                    data-wow-delay=".{{ $loop->iteration }}s">
                    <x-product::frontend.grid-style-02 :filter="true" :$product :$loop />
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Featured area end -->
