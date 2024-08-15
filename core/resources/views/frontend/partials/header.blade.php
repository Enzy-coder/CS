<!DOCTYPE html>
<html class="no-js" lang="{{ App\Helpers\LanguageHelper::user_lang_slug() }}"
    dir="{{ App\Helpers\LanguageHelper::user_lang_dir() }}">

<head>
    @include('frontend.partials.google-analytics')

    @if (empty($global_static_field_data))
        @php
            $global_static_field_data = [];
        @endphp
    @endif

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (request()->routeIs('homepage'))
        <meta name="description"
            content="{{ filter_static_option_value('site_meta_description', $global_static_field_data) }}">
        <meta name="tags" content="{{ filter_static_option_value('site_meta_tags', $global_static_field_data) }}">
    @else
        @yield('page-meta-data')
    @endif
    {!! render_favicon_by_id(filter_static_option_value('site_favicon', $global_static_field_data)) !!}
    {!! load_google_fonts() !!}

    @include('frontend.partials.css-variable')
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.min.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.cs') }}s">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @yield('style')

    <link rel="stylesheet" href="{{ asset('assets/common/css/toastr.css') }}">

    @if (!empty(filter_static_option_value('site_rtl_enabled', $global_static_field_data)) || get_user_lang_direction() == 'rtl')
        <link rel="stylesheet" href="{{ asset('assets/frontend/css/rtl.css') }}">
    @endif

    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">
    @include('frontend.partials.og-meta')
    <script>
        let siteurl = "{{ url('/') }}";
    </script>
    {!! filter_static_option_value('site_third_party_tracking_code', $global_static_field_data) !!}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

@php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant', $global_static_field_data);
@endphp

<body>
    <!-- Header area Starts -->
    <header class="header-style-01">
        @php
            $page_details = $page_details ?? ($page_post ?? '');
            $navbar_type = $page_details->navbar_variant ?? (get_static_option('global_navbar_variant') ?? 1);
        @endphp

        @include('frontend.partials.preloader')

        @if ($navbar_type == 3 || $navbar_type == 2)
            @include('frontend.partials.header.header-variant-03', ['containerClass' => $navbar_type == 2 ? "container_1608" : ""])
        @else
            @include('frontend.partials.topbar')
            @include('frontend.partials.navbar')
            @include('frontend.partials.navbar-menu')
        @endif
    </header>
    <div class="body-overlay"></div>
    <div class="body-overlay-desktop"></div>
