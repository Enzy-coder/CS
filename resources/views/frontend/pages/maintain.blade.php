<!DOCTYPE html>
<html lang="{{get_default_language()}}" dir="{{get_user_lang_direction()}}">
<head>
    @if(!empty(get_static_option('site_google_analytics')))
        <script>
            window.dataLayer = window.dataLayer || [];
        </script>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="{{get_static_option('site_meta_description')}}">
    <meta name="tags" content="{{get_static_option('site_meta_tags')}}">
    <link rel="icon" href="{{asset('assets/uploads/'.get_static_option('site_favicon'))}}" type="image/png">
    {!! load_google_fonts() !!}
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/bootstrap.min-v4.6.0.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/line-awesome.min-v1.3.0.css') }}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    @include('frontend.partials.css-variable')
    <style>
        .maintenance-page-content-area {
            width: 100%;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            z-index: 0;
            background-size: cover;
            background-position: center;
        }
        .maintenance-page-content-area:after {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: -1;
            content: '';
        }
        .page-content-wrap {
            text-align: center;
        }
        .page-content-wrap .logo-wrap {
            margin-bottom: 30px;
        }
        .page-content-wrap .maintain-title {
            font-size: 45px;
            font-weight: 700;
            color: #fff;
            line-height: 50px;
            margin-bottom: 20px;
        }
        .page-content-wrap p {
            font-size: 16px;
            line-height: 28px;
            color: rgba(255, 255, 255, .7);
            font-weight: 400;
        }
        .page-content-wrap .subscriber-form {
            position: relative;
            z-index: 0;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 40px;
        }
        .page-content-wrap .subscriber-form .submit-btn {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 60px;
            height: 50px;
            text-align: center;
            border: none;
            background-color: var(--main-color-one);
            color: #fff;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
        }
        .page-content-wrap .subscriber-form .form-group .form-control {
            height: 50px;
            padding: 0 20px;
            padding-right: 80px;
        }
    </style>
    @yield('style')
    @if(!empty(get_static_option('site_rtl_enabled')) || get_user_lang_direction() === 'rtl')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif
    @if(request()->is('blog/*') || request()->is('work/*') || request()->is('service/*'))
        @yield('og-meta')
        <title>@yield('site-title')</title>
    @elseif(request()->is('about') || request()->is('service') || request()->is('work') || request()->is('team') || request()->is('faq') || request()->is('blog') || request()->is('contact') || request()->is('p/*') || request()->is('blog/*') || request()->is('services/*'))
        <title>@yield('site-title') - {{get_static_option('site_title')}} </title>
    @else
        <title>{{get_static_option('site_title')}}
            - {{get_static_option('site_tag_line')}}</title>
    @endif
</head>
<body>

<div class="maintenance-page-content-area"
        {!! render_background_image_markup_by_attachment_id(get_static_option('maintain_page_background_image')) !!}
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="maintenance-page-inner-content">
                    <div class="page-content-wrap">
                        <div class="logo-wrap">
                            {!! render_image_markup_by_attachment_id(get_static_option('maintain_page_logo')) !!}
                        </div>
                        <h2 class="maintain-title">{{get_static_option('maintain_page_title')}}</h2>
                        <p>{{get_static_option('maintain_page_description')}}</p>
                        <x-counter :countdown-time="get_static_option('maintain_page_datepicker')" />

                        <div class="subscriber-form">
                            @include('backend.partials.message')
                            @include('backend.partials.error')
                            <div class="newsletter-form-wrap">
                                <div class="form-message-show"></div>
                                <form action="{{route('frontend.subscribe.newsletter')}}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" placeholder="{{__('Enter your email')}}"
                                               class="form-control">
                                    </div>
                                    <button type="submit" class="submit-btn"><i class="las la-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/frontend/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/jquery-migrate.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/bootstrap.min-v4.6.0.js') }}"></script>
<script src="{{ asset('assets/frontend/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/slick.min.js') }}"></script>
<script src="{{ asset('assets/frontend/js/loopcounter.js') }}"></script>

@include('frontend.partials.twakto')
<!--Start of Tawk.to Script-->
<script>
    (function ($) {
        $(document).ready(function () {
            "use strict";

            $(document).on('click', '.newsletter-form-wrap .submit-btn', function (e) {
                e.preventDefault();
                var email = $('.newsletter-form-wrap input[type="email"]').val();
                var newsCont = $('.newsletter-widget .form-message-show,.newsletter-form-wrap .form-message-show')
                newsCont.html('');
                $.ajax({
                    url: "{{route('frontend.subscribe.newsletter')}}",
                    type: "POST",
                    data: {
                        _token: "{{csrf_token()}}",
                        email: email
                    },
                    success: function (data) {
                        newsCont.html('<div class="alert alert-success">' + data + '</div>');
                    },
                    error: function (data) {
                        var errors = data.responseJSON.errors;
                        newsCont.html('<div class="alert alert-danger">' + errors.email[0] + '</div>');
                    }
                });
            });

            loopcounter('flash-countdown');
        });
    })(jQuery)
</script>
</body>
</html>
