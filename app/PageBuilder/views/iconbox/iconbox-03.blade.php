<!-- Promo area start -->
<section class="promo_area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="promo__wrapper bg-white">
            <div class="row gy-4 gx-2">
                @foreach(($settings['iconBoxThree']['title_'] ?? []) as $key => $title)
                    <div class="col-xxl-3 col-xl-4 col-md-6">
                    <div class="promo__item">
                        <div class="promo__item__flex">
                            <div class="promo__item__icon">
                                {!! render_image($settings['iconBoxThree']["image_"][$key] ?? 0) !!}
                            </div>
                            <div class="promo__item__contents">
                                <h4 class="promo__item__title">{{ $title }}</h4>
                                <p class="promo__item__para mt-1">
                                    {{ $settings['iconBoxThree']['description_'][$key] ?? '' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- Promo area end -->