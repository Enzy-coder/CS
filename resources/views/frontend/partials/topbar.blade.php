@php
    //    $page_details , $navbar_type those two variable are come from header.blade.php file
    $page_container = $navbar_type == 1 ? 'custom-container-1318' : 'custom-container-1720';
@endphp

<!-- Topbar area Starts -->
<div class="topbar-area hover-color-two topbar-bg-1">
    <div class="container container-one">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-4 col-md-12">
                <div class="topbar-left-contents">
                    <div class="topbar-left-flex">
                        <ul class="topbar-social">
                            @if (!empty($all_social_item) && $all_social_item->count())
                                @foreach ($all_social_item as $social_item)
                                    <li class="link-item">
                                        <a href="{{ $social_item->url }}">
                                            <i class="{{ $social_item->icon }} icon"></i>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-12">
                <div class="topbar-right-contents">
                    <div class="topbar-right-flex">
                        <ul class="list">
                            {!! render_frontend_menu(get_static_option('topbar_menu')) !!}

                            <li class="ml-2"><a
                                    href="{{ route('frontend.products.track.order') }}">{{ __('Tracking order') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar area Ends -->
