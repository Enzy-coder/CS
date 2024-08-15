@include('frontend.partials.header')
@include('frontend.partials.breadcrumb')
@yield('content')

<!-- Left Right area starts -->
<div class="left-right-area">
    <div class="container container-one">
        <div class="row flex-xxl-row flex-column-reverse">
            <div class="col-xxl-3">
                @yield('left_side_content')
            </div>
            <div class="col-xxl-9">
                @yield('right_side_content')
            </div>
        </div>
    </div>
</div>
<!-- Left Right area ends -->

<!-- back to top area start -->
<div class="back-to-top bg-color-two">
    <span class="back-top"> <i class="las la-angle-up"></i> </span>
</div>
<!-- back to top area end -->

@include('frontend.partials.footer')
