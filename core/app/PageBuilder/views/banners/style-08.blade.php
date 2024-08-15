
<!-- Best Seller area Starts -->
<section class="app_area padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row gy-5 align-items-center justify-content-center">
            <div class="col-xl-4 col-lg-5">
                <div class="mobileApp">
                    <div class="mobileApp__thumb mobileApp__bgShape">
                        {!! render_image_markup_by_attachment_id($image) !!}
                    </div>
                </div>
            </div>
            <div class="col-xxl-5 col-xl-6 col-lg-6">
                <div class="mobileApp__contents">
                    <h3 class="mobileApp__title">{{ $title }}</h3>
                    <p class="mobileApp__para">
                        {{ $description }}
                    </p>
                    <div class="btn-wrapper btn_flex mt-4">
                        @foreach($images as $image)
                            <a href="{{ $icons["url_"][$loop->index] }}" class="googleplay">
                                {!! render_image($image,size: 'full') !!}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Best Seller area end -->