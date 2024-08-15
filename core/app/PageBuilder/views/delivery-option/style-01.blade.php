<!-- Promo area Starts -->
<section class="promo-area padding-bottom-50 padding-top-25">
    <div class="row">
        @foreach($deliveryOptions as $deliveryOption)
            <div class="col-xxl-12 col-xl-4 col-md-6 mt-4">
                <div class="single-promo sidebar-promo single-border radius-10">
                    <div class="promo-inner">
                        <div class="icon color-two">
                            <i class="{{ $deliveryOption->icon ?? "" }}"></i>
                        </div>
                        <div class="promo-inner-contents">
                            <h4 class="promo-inner-title hover-color-two"> <a href="#1"> {{ $deliveryOption->title ?? "" }} </a> </h4>
                            <p class="promo-inner-para"> {{ $deliveryOption->sub_title }} </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>
<!-- Promo area end -->