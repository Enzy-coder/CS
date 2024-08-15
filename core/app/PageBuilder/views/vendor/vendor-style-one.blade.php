<!-- Trending Porduct end -->
<!-- All Porduct start -->
<section class="allProduct__area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="row">
            <div class="col-lg-12">
                <div class="section__title text-left section_borderBottom">
                    <div class="allProduct__tab">
                        <ul class="tabs tabs_two">
                            <li data-tab-two="top_rated" class="vendor_search_tab tabs_list_two">{{ __("Top Rated") }}</li>
                            <li data-tab-two="top_selling" class="vendor_search_tab tabs_list_two">{{ __("Top Selling") }}</li>
                            <li data-tab-two="weekly_top" class="vendor_search_tab tabs_list_two">{{ __("Weekly Top") }}</li>
                        </ul>
                    </div>
                    <div class="btn_wrapper">
                        <a href="{{ route('frontend.vendors') }}" class="viewAll_btn">{{ __("View All") }}
                            <i class="las la-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="" id="all_vendor_list">
            <div class="row g-4 mt-4">
                @foreach($vendors as $vendor)
                    <x-vendor::style-one :vendor="$vendor" />
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- All Porduct end -->