<!-- Gift Voucher area starts -->
<section class="gift-voucher-area padding-top-50 padding-bottom-50">
    <div class="row justify-content-center">
        <div class="col-xxl-12 col-lg-6">
            <div class="gift-voucher-inner center-text radius-10">
                <div class="gift-voucher-thumb radius-10">
                    <a href="{{ $btn_url }}">
                        {!! render_image_markup_by_attachment_id($banner_image) !!}
                    </a>
                </div>
                <div class="gift-voucher-contents">
                    <h2 class="gift-voucher-title white-color fw-500">
                        <a href="{{ $btn_url }}"> {{ $banner_title }} <span class="voucher-small"> {{ $banner_sub_title }} </span> </a>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Gift Voucher area end -->