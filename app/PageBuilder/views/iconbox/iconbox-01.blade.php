<div class="support-area-wrapper index-01">
    <div class="container {{ $settings['container_type'] ?? 'custom-container-1318' }}">
        <div class="row support-item-wrap">
            @foreach ($settings['header_eleven']['title_'] as $key => $title)
                <div class="col-sm-6 col-md-3 col-lg-3">
                    <div class="single-support-item">
                        <div class="icon-box">
                            <i class="{{ $settings['header_eleven']['button_icon_'][$key] }} icon"></i>
                        </div>
                        <div class="content">
                            <h5 class="title">{{ $title }}</h5>
                            <p class="info">{{ $settings['header_eleven']['description_'][$key] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
