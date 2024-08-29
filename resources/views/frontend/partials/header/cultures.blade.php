@php 
    $cultures = cultures()->groupby('culture_name');
@endphp
@foreach ($cultures as $continent_name => $culture_data)
    <li class="cate-list menu-item-has-children current-menu-item"> 
        <a href="#">{{$continent_name}}</a>
        <div class="category-megamenu">
            @php 
                $link = false;
            @endphp
            @foreach ($culture_data as $region)
                @php 
                    $link = "<a href='/continents/".$region->culture_slug."/countries'>See More</a>";
                @endphp
                <div class="single-megamenu">
                    <div class="single-category-megamenu text-center border-1">
                        <div class="image-contents">
                            <div class="category-thumb">
                                <a href="/countries/categories/{{$region->id}}">
                                    <img alt="" src="{{asset('continents/flags/'.$region->country_slug.'.svg')}}" class="">
                                </a>
                            </div>
                        </div>
                        <h5 class="submenu-title">{{$region->country_name}}</h5>
                    </div>
                </div>
            @endforeach
            <span>{!! $link ?? '' !!}</span>
        </div>
    </li>
@endforeach
                                        