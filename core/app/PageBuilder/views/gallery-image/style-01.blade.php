<!-- Instagram area starts -->
<section class="instagram padding-top-50 padding-bottom-50">
    <div class="sidebar-wrapper single-border radius-10">
        <div class="news-wrapper">
            <h3 class="sidebar-title fw-500"> {{ $section_title }} </h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="instagram-flex-wrapper">
                        @foreach($gallery_images["image_"] as $image)
                            @php
                                $render_image = $images->where("id",$image)->first();
                            @endphp
                            <div class="single-instagram">
                                <div class="instagram-thumb radius-10">
                                    <a href="{{ $gallery_images["url_"][$loop->index] ?? "#1" }}">
                                        {!! render_image($render_image) !!}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Instagram area end -->