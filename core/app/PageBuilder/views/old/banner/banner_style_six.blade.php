

<!-- add-x area start -->
<div class="add-banner-x-area-wrapper index-03">
    <div class="container custom-container-1720">
        <div class="row">
            @foreach($settings['banner_style_six']['background_image_'] as $key => $image)
                <div class="col-sm-6 col-md-6 col-lg-4">
                    <div class="add-banner-x-style-01">
                        <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_six']['button_url_'][$key]) }}">
                            {!! render_image_markup_by_attachment_id($image, '', 'full', true, false) !!}
                        </a>
                        <div class="content">
                            <h4 class="title">{{ $settings['banner_style_six']['title_'][$key] }}</h4>
                            <span class="sub-title">{{ $settings['banner_style_six']['subtitle_'][$key] }}</span>
                            <div class="btn-wrapper">
                                <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_six']['button_url_'][$key]) }}" class="shop-now-btn-style-01">{{ $settings['banner_style_six']['button_text_'][$key] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- add-x area end -->
