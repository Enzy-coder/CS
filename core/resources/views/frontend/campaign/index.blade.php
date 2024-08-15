@extends('frontend.frontend-page-master')
@section('page-title')
    {{ $campaign->title }}
@endsection
@section('style')
@endsection
@section('content')
    <!-- Shop area end -->
    <section class="shop-area padding-top-100 padding-bottom-100">
        <div class="container container-one">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-5">
                    <div class="shop-left">
                        <div class="single-shops">
                            <ul class="shop-flex-icon tabs">
                                <li class="shop-icons" data-tab="tab-grid">
                                    <a href="#1" class="icon"> <i class="las la-bars"></i> </a>
                                </li>
                                <li class="shop-icons active" data-tab="tab-grid2">
                                    <a href="#1" class="icon"> <i class="las la-border-all"></i> </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab-grid2" class="tab-content-item active">
                <div class="row mt-4">
                    @foreach ($products['items'] as $product)
                        <x-product::frontend.campaign-grid-style-01 :$product />
                    @endforeach
                </div>
            </div>
            <div id="tab-grid" class="tab-content-item">
                <div class="row mt-4">
                    @foreach ($products['items'] as $product)
                        <x-product::frontend.campaign-list-style-01 :$product />
                    @endforeach
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="custom-pagination mt-4 mt-lg-5">
                        <nav>
                            <ul class="pagination justify-content-center">
                                @if ($products['total_page'] > 1)
                                    @if (!empty($products['previous_page'] ?? []))
                                        <li class="page-item disabled" aria-disabled="true" aria-label="« Previous">
                                            <a href="{{ $products['previous_page'] }}" class="page-link"
                                                aria-hidden="true">‹</a>
                                        </li>
                                    @endif
                                    @foreach ($products['links'] as $link)
                                        <li class="page-item {{ $loop->iteration == $products['current_page'] ? 'active' : '' }}"
                                            aria-current="page">
                                            <a href="{{ $link }}" class="page-link">{{ $loop->iteration }}</a>
                                        </li>
                                    @endforeach

                                    @if (!empty($products['next_page'] ?? []))
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $products['next_page'] }}" rel="next"
                                                aria-label="Next »">›</a>
                                        </li>
                                    @endif
                                @endif
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop area end -->
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            loopcounter('campaign-counter');
        });
    </script>
@endsection
