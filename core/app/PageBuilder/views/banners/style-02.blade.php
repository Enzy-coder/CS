<!-- Discount area starts -->
<section class="sidebar-discount-area padding-top-50 padding-bottom-50">
    <div class="row justify-content-center">
        <div class="col-xxl-12 col-lg-6">
            <div class="discount-banner-area bg-item-two center-text radius-10">
                <div class="discount-banner-contents">
                    <h2 class="percent-descount-title color-heading fw-500"> <span class="percent-title color-two"> {{ $banner_title }} </span>
                        {{ $banner_sub_title }} </h2>
                    <a href="{{ $btn_url }}" class="btn-shop color-heading hover-color-two mt-3"> {{ $btn_text }} </a>
                </div>
                <div class="ad_thumb">
                    {!! render_image_markup_by_attachment_id($banner_image) !!}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Discount area end -->