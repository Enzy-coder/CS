<div class="brand-area-wrapper index-01 padding-top-50 padding-bottom-50">

    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="brand-item-wrap_ brand-item-slider-inst">

                    @if (isset($settings['header_style_one']))

                        @foreach ($settings['header_style_one']['logo_image_'] as $key => $logo_image)
                            <div class="single-brand-item">

                                {!! render_image_markup_by_attachment_id($logo_image) !!}

                            </div>
                        @endforeach

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>
