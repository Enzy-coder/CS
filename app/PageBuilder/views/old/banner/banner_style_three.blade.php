<div class="add-banner-x-area-wrapper index-02">
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-6 col-lg-6">
                <div class="add-banner-x-style-01">
                    <a href="{{ \App\traits\URL_PARSE::url($left_button_url) }}">
                        {!! render_image_markup_by_attachment_id($left_background_image, '', 'full', true) !!}
                    </a>
                    <div class="content">
                        <span class="offer-title">{{ $left_subtitle }}</span>
                        <h4 class="title">{!! str_replace('[brk]', '<br/>', $left_title) !!}</h4>
                        <span class="sub-title">{{ $left_discount_text }}</span>
                        <div class="btn-wrapper">
                            <a href="{{ \App\traits\URL_PARSE::url($left_button_url) }}"
                                class="">{{ $left_button_text }} <i class="las la-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-9 col-md-6 col-lg-6">
                <div class="add-banner-x-style-01">
                    <a href="{{ url($right_button_url) }}">
                        {!! render_image_markup_by_attachment_id($right_background_image, '', 'full', true) !!}
                    </a>
                    <div class="content">
                        <span class="offer-title">{{ $right_subtitle }}</span>
                        <h4 class="title">{!! str_replace('[brk]', '<br/>', $right_title) !!}</h4>
                        <span class="sub-title">{{ $right_discount_text }}</span>
                        <div class="btn-wrapper">
                            <a href="{{ \App\traits\URL_PARSE::url($right_button_url) }}"
                                class="">{{ $right_button_text }} <i class="las la-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
