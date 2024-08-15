<!-- Trending Product area starts -->
<section class="trending-product-area padding-top-50 padding-bottom-50">
    <div class="sidebar-wrapper single-border radius-10">
        <div class="trendy-product-wrapper">
            <h3 class="sidebar-title fw-500"> {{ $section_title }} </h3>
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xxl-12 col-xl-4 col-md-6 mt-4">
                        <x-product::frontend.list-style-01 :$product />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Trending Product area end -->