<div class="about-area-wrapper padding-top-100 padding-bottom-50">
    <div class="container">
        <div class="row g-4 sec custom-reverse @if ($image_position == 'left') flex-row-reverse @endif">
            <div class="col-lg-6">
                <div class="content-box">
                    <h4 class="title">{{ html_entity_decode($title) }}</h4>
                    <p class="info mt">{!! str_replace(["<script", "</script>"], ["<span>", "</span>"],$description) !!}</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="img-box">
                    {!! render_image($section_image) !!}
                </div>
            </div>
        </div>
    </div>
</div>
