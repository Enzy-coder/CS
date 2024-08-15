
<!-- Best Selling area Starts -->
<section class="bestSelling_area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>

                    <div class="btn-wrapper">
                        <a href="{{ route("frontend.vendors") }}" class="cmn-btn btn-outline-5 btn-small color-five radius-0">{{ __("Explore More") }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 row-cols-xl-6 row-cols-lg-4 row-cols-md-3 row-cols-sm-2 row-cols-vxxs-2 row-cols-1 mt-4">
            @foreach($vendors as $vendor)
                <div class="col wow fadeInUp" data-wow-delay=".{{ $loop->iteration }}s">
                    <div class="bestSelling_shop">
                        <div class="bestSelling_shop__thumb">
                            <a href="{{ route("frontend.vendors.single", $vendor->username) }}" class="bestSelling_shop__thumb__bgImg" style="{{ render_image($vendor->cover_photo, render_type: 'bg') }}">
                            </a>
                        </div>
                        <div class="bestSelling_shop__contents">
                            <div class="bestSelling_shop__brand">
                                <a href="{{ route("frontend.vendors.single", $vendor->username) }}">
                                    {!! render_image($vendor->logo) !!}
                                </a>
                            </div>
                            <h5 class="bestSelling_shop__title mt-1"> <a href="{{ route("frontend.vendors.single", $vendor->username) }}">{{ $vendor->business_name }}</a> </h5>
                            <div class="rating-wrap mt-2">
                                <div class="rating-wrap">
                                    <x-product::frontend.common.rating-markup
                                            :avg-rattings="$vendor->vendor_product_rating_avg_rating"
                                            :rating-count="$vendor->vendor_product_rating_count" />
                                </div>
                            </div>
                            <div class="btn-wrapper mt-2">
                                <a href="{{ route("frontend.vendors.single", $vendor->username) }}" class="bestSelling_shop__btn">{{ __("Visit Store") }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Best Selling area end -->