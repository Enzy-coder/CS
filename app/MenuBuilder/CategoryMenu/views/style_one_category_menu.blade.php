<div class="category-megamenu">
    @foreach($mega_menu_items as $item)
        <div class="single-megamenu">
            <h5 class="submenu-title"> {{ $item->name }} </h5>
                <?php
                    $sub_category_id = $item->id;

                    $products = $item->product;
                ?>
                @if($products->isNotEmpty())
                    @foreach($products ?? [] as $product)
                        <div class="single-category-megamenu text-center border-1">
                            <?php
                            $campaign_product = !is_null($product->campaignProduct) ? $product->campaignProduct : getCampaignProductById($product->id);
                            $sale_price = $campaign_product ? optional($campaign_product)->campaign_price : $product->sale_price;
                            $deleted_price = !is_null($campaign_product) ? $product->sale_price : $product->price;
                            $campaign_percentage = !is_null($campaign_product) ? getPercentage($product->sale_price, $sale_price) : false;
                            ?>
                            <h5 class="submenu-title">{{ $product->name }}</h5>
                            <div class="image-contents">
                                <div class="category-thumb">
                                    <a href="{{ route('frontend.products.single', $product->slug) }}">
                                        {!! render_image($product->image) !!}
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
        </div>
    @endforeach
</div>