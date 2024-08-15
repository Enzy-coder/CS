<!-- All Product area Start -->
<section class="counter__area counter__shadow padding-top-50 padding-bottom-50 margin-top-50">
    <div class="container container_1608">
        <div class="row g-4">
            @foreach($settings['iconBoxThree']['title_'] as $key => $title)
                <div class="col-lg-4 col-sm-6">
                    <div class="counter__item text-center">
                        <div class="counter__item__icon">
                            {!! render_image($settings['iconBoxThree']["image_"][$key] ?? 0) !!}
                        </div>
                        <div class="counter__item__contents mt-3">
                            <h3 class="counter__item__title">{{ $title }}</h3>
                            <p class="counter__item__para mt-2">
                                {{ $settings['iconBoxThree']['description_'][$key] ?? '' }}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
<!-- All Product area ends -->