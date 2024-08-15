
<!-- header area start -->
<div class="container custom-container-1618">
    <div class="row nav-reverse">
        <div class="col-lg-3">
            <div class="side-menu-wrapper position-relative">
                <nav class="navbar navbar-area nav-style-03 side-menu">
                    <div class="container nav-container">
                        <div class="responsive-mobile-menu">
                            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="" aria-expanded="false"
                                        aria-label="Toggle navigation">
                                <span class="text">{{ html_entity_decode($title) }}</span>
                            </button>
                        </div>
						
						
                        <div class="navbar-collapse index-03-catg show" id="bizcoxx_main_menu_two"
                             style="">
                            <ul class="navbar-nav">
                                {!! render_frontend_menu($category,'category_menu') !!}
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="new-header-area-wrapper new-style-1 slick-main global-slick-init arrow-style-01  arrow-v-02"
                 data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="1"
                 data-slidesToScroll="1" data-swipeToSlide="true" data-autoplay="false" data-autoplaySpeed="2500"
                 data-prevArrow='<div class="prev-icon"><i class="las la-arrow-left"></i></div>'
                 data-nextArrow='<div class="next-icon"><i class="las la-arrow-right"></i></div>' data-responsive='[
        {"breakpoint": 1200,"settings": {"slidesToShow": 1}},
        {"breakpoint": 992,"settings": {"slidesToShow": 1}},
        {"breakpoint": 768, "settings": {"slidesToShow": 1}}
        ]'>
                {!! $output !!}
            </div>
        </div>
    </div>
</div>
<!-- header area end -->
