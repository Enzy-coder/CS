<div class="add-banner-x-long-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="add-banner-x-long">
                    <a href="{{ \App\traits\URL_PARSE::url($button_url) }}">
                        {!! render_image_markup_by_attachment_id($background_image, '', 'full', false) !!}
                    </a>
                    <div class="content-1">
                        <span class="total-wrap">{!! str_replace(['[sp]', '[/sp]'], ['<span class="sale">', '</span>'], $sale_text) !!}</span>
                    </div>
                    <div class="content-2">
                        <h1 class="title">{!! str_replace('[brk]', '<br/>', $title) !!}</h1>
                        <div class="btn-wrapper">
                            <a href="{{ \App\traits\URL_PARSE::url($button_url) }}"
                                class="btn-default transparent-btn-1">{{ $button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
