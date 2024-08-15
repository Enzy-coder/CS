<div class="about-area-wrapper padding-top-100 padding-bottom-50">
    <div class="container">
        <div class="row sec custom-reverse @if ($image_position == 'left') flex-row-reverse @endif">
            <div class="col-lg-6">
                <div class="content-box">
                    <h4 class="title">{{ html_entity_decode($title) }}</h4>
                    <p class="info mt">{!! $description !!}</p>
                    <div class="btn-wrapper">
                        <a href="{{ \App\traits\URL_PARSE::url($button_url) }}"
                            class="btn-default rounded-btn">{{ $button_text }}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img-box">
                    {!! render_image_markup_by_attachment_id($section_image) !!}
                </div>
            </div>
        </div>
    </div>
</div>
