<div class="category-megamenu">
    @foreach($mega_menu_items as $item)
        <div class="single-category-megamenu text-center border-1">
            <ul class="mega-menu-main">
                <li class="round-menu-product">
                    <a href="{{ route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug]) }}">
                        @if(!empty($item->image))
                            {!! render_image($item->image) !!}
                        @else
                            <img src="{{ asset('assets/uploads/no-image.png') }}">
                        @endif
                    </a>
                </li>
                <li>
                    <a href="{{ route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug]) }}">
                        <h5 class="menu-title-x style-two-category-heading">{{ $item->name }}</h5>
                    </a>
                </li>
            </ul>
        </div>
    @endforeach
</div>
