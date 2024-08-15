<div class="header-and-menu-area-wrapper index-01">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">

            </div>
            <div class="col-lg-9">
                <!-- header area start -->
                <div class="header-area-wrapper">
                    <div class="header-area index-01">
                        <div class="header-slider-inst-index-01">
                            @php $data = $settings['header_style_one']; @endphp
                            @foreach ($data['subtitle_'] as $key => $subtitle)
                                <div class="single-slider-item bg lazy" {!! render_background_image_markup_by_attachment_id($data['background_image_'][$key], 'full', true) !!}>
                                    <div class="content">
                                        <h5 class="sub-title">{{ $data['subtitle_'][$key] }}</h5>
                                        <h1 class="title">{{ $data['title_'][$key] }}</h1>
                                        <p class="offer-title">{{ $data['offer_text_'][$key] }}</p>
                                        <div class="btn-wrapper">
                                            <a href="{{ \App\traits\URL_PARSE::url($data['button_url_'][$key]) }}"
                                                class="btn-default transparent-btn-1">{{ $data['button_text_'][$key] }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- header area end -->
            </div>
        </div>
    </div>
</div>
