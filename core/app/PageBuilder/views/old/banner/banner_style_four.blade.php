<div class="count-down-area-wrapper bg" {!! render_background_image_markup_by_attachment_id($background_image, 'full', false) !!}>
    <div class="top-shape" style="background-image: url({{ asset('assets/frontend/img/banner/countdown-top.png') }})">
    </div>
    <div class="bottom-shape"
        style="background-image: url({{ asset('assets/frontend/img/banner/countdown-bottom.png') }})">
    </div>
    <div class="left-shape">
        {!! render_image_markup_by_attachment_id($left_front_image, '', 'full', true) !!}
    </div>
    <div class="right-shape">
        {!! render_image_markup_by_attachment_id($right_front_image, '', 'full', true) !!}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="count-down-inner">
                    <div class="content">
                        <span class="offer">{{ $subtitle }}</span>
                        <h3 class="title">{{ str_replace('[brk]', '<br/>', $title) }}</h3>

                        <div class="flash-countdown-1 flash-countdown-style-1"
                            data-date="{{ \Carbon\Carbon::parse($end_date)->format('Y-m-d h:i:s') }}">
                            <div class="single-box">
                                <span class="counter-days item time">00</span>
                                <span class="label item">{{ __('Day') }}</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-hours item time">00</span>
                                <span class="label item">{{ __('Hour') }}</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-minutes item time">00</span>
                                <span class="label item">{{ __('Min') }}</span>
                            </div>
                            <div class="colon-wrap">
                                <span class="colon">:</span>
                            </div>
                            <div class="single-box">
                                <span class="counter-seconds item time">00</span>
                                <span class="label item">{{ __('Sec') }}</span>
                            </div>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{ \App\traits\URL_PARSE::url($button_url) }}"
                                class="btn-default shop-now-btn-style-01 rounded-btn">{{ $button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
