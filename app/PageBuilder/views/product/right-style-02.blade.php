<!-- Deal area Starts -->
<section class="deal-area padding-top-50 padding-bottom-50">
    <div class="row">
        <div class="col-lg-12">
            <div class="section-title text-left section-border-bottom">
                <div class="title-left">
                    <h2 class="title"> {{ $section_title }} </h2>
                    @if(!empty($tooltip_text)) <span class="hot-deal bg-color-two radius-5"> {{ $tooltip_text }} </span> @endif
                </div>
                @if(!empty($button_text))
                    <a href="{{ $button_url ?? route("frontend.products.all") }}">
                        <span class="see-all hover-color-two fs-18"> {{ $button_text }} </span>
                    </a>
                @endif
            </div>
        </div>
    </div>
    <div class="row mt-4">
        @foreach($products as $product)
            <x-product::frontend.grid-style-02 :$product :$loop />
        @endforeach
    </div>
</section>
<!-- Deal area end -->