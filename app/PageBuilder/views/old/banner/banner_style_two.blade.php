<div class="add-banner-x-area-wrapper index-01 only">
    <div class="container">
        <div class="row">
            @foreach ($settings['banner_style_two']['subtitle_'] as $key => $subtitle)
                <div class="{{ $settings['banner_style_two']['column_width_'][$key] }} col-sm-6">
                    <div class="add-banner-x-style-01">
                        <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_two']['button_url_'][$key]) }}">
                            {!! render_image_markup_by_attachment_id(
                                $settings['banner_style_two']['background_image_'][$key],
                                '',
                                'full',
                                true,
                            ) !!}
                        </a>

                        <div class="content ex">
                            <span class="sub-title">{{ $subtitle }}</span>
                            <h4 class="title">{!! str_replace('[brk]', '<br/>', $settings['banner_style_two']['title_'][$key]) !!}</h4>
                            <div class="btn-wrapper">
                                <a href="{{ \App\traits\URL_PARSE::url($settings['banner_style_two']['button_url_'][$key]) }}"
                                    class="shop-now-btn-style-01">{{ $settings['banner_style_two']['button_text_'][$key] }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
