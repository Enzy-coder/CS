{{-- ===================================================================================================================== --}}

<div class="header-wrapper-index-03">
    <div class="container custom-container-1720">
        <div class="row">
            <div class="col-lg-12">
                <!-- header area start -->
                <div class="header-area-wrapper">
                    <div class="header-area index-01 index-03">
                        <div class="header-slider-inst-index-01">
                            @foreach ($settings['header_style_three']['background_image_'] as $data)
                                <div class="single-slider-item bg lazy" {!! render_background_image_markup_by_attachment_id(
                                    $settings['header_style_three']['background_image_'][$loop->index],
                                    'full',
                                    true,
                                ) !!}>
                                    <div class="content">
                                        <h5 class="sub-title">
                                            {{ html_entity_decode($settings['header_style_three']['title_'][$loop->index]) }}
                                        </h5>
                                        <h1 class="title">
                                            {{ html_entity_decode($settings['header_style_three']['subtitle_'][$loop->index]) }}
                                        </h1>
                                        <div class="offer-title">
                                            <p>{!! $settings['header_style_three']['description_'][$loop->index] !!}</p>
                                        </div>
                                        <div class="btn-wrapper">
                                            <a href="{{ url($settings['header_style_three']['button_url_'][$loop->index]) }}"
                                                class="btn-default transparent-btn-1">{{ $settings['header_style_three']['button_text_'][$loop->index] }}</a>
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
