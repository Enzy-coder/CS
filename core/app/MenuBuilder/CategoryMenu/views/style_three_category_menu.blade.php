<ul class="sub-menu mega-menu-inner category-megamenu">
    <li class="mega-menu-single-section">
        <ul class="mega-menu-main">
            <li>
                <h5 class="menu-title">{{ html_entity_decode($title) }}</h5>
            </li>
            @foreach($mega_menu_items as $item)
                <li class="round-menu-product">
                    <a href="{{ route("frontend.products.subcategory",["id" => $item->id,"slug" => $item->slug]) }}">
                        {{ html_entity_decode($item->name) }}
                    </a>
                </li>
            @endforeach
        </ul>
    </li>
</ul>