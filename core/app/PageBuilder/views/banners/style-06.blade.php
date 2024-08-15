<!-- Download area Starts -->
<section class="download-area padding-top-50 padding-bottom-50">
    <div class="row">
        <div class="col-lg-12">
            <div class="download-wrapper">
                <div class="download-left-contents bg-item-two radius-10">
                    <div class="download-wrapper--flex">
                        <div class="download-contents">
                            <span class="span-title fw-500 color-light mb-3 mb-lg-4">{{ $sub_title }}</span>
                            <h2 class="download-title fw-500"> <a href="{{ $url }}"> {{ $title }} </a>
                            </h2>
                            <form action="#" class="download-form color-two mt-4">
                                <div class="single-input radius-10">
                                    <input type="text" class="form--control radius-10" placeholder="Your Email Here">
                                    <button type="submit"> <i class="lar la-paper-plane"></i> </button>
                                </div>
                            </form>
                            <div class="googleplay-btn mt-4">
                                @foreach ($images as $image)
                                    <a href="{{ $icons['url_'][$loop->index] }}" class="googleplay">
                                        {!! render_image($image, size: 'full') !!}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="download-mobile-img">
                            {!! render_image_markup_by_attachment_id($left_image) !!}
                            {!! render_image_markup_by_attachment_id($right_image) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Download area end -->
