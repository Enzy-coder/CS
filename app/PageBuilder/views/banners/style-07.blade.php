
<!-- Updated area Starts -->
<section class="updatedOffer_area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row g-4">
            @for($i = 0; $i < $loopLength; $i++)
                <div class="col-xl-4 col-lg-6 col-md-6">
                    <div class="updatedOffer" style="background: {{ $banners["background_"][$i] ?? "" }}">
                        <div class="updatedOffer__flex">
                            <div class="updatedOffer__contents">
                                <span class="updatedOffer__subtitle color-heading">{{ $banners["sub_title_"][$i] }}</span>
                                <h2 class="updatedOffer__title mt-2"> {{ $banners["title_"][$i] }} </h2>
                                <p class="updatedOffer__para mt-2">{{ $banners["description_"][$i] }}</p>
                                <div class="btn-wrapper mt-3">
                                    <a href="{{ $banners["btn_url_"][$i] }}" class="cmn-btn btn-outline-5 btn-small radius-0">{{ $banners["btn_text_"][$i] }}</a>
                                </div>
                            </div>
                            <div class="updatedOffer__thumb">
                                {!! render_image_markup_by_attachment_id($banners["image_"][$i]) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>
<!-- Updated area end -->