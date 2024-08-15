@extends('frontend.frontend-page-master')
@section('page-meta-data')
    <meta name="description" content="{{ $page_post->meta_description }}">
    <meta name="tags" content="{{ $page_post->meta_tags }}">
@endsection

@section('site-title')
    {{ $page_post->title }}
@endsection

@section('page-title')
    {{ $page_post->title }}
@endsection

@section('og-meta')
    <meta name="og:title" content="{{ $page_post->title }}">
    <meta name="og:description" content="{{ $page_post->meta_description }}">
@endsection

@section('content')
    @if ($page_post->page_builder_status == 0)
        <div class="container padding-top-100 padding-bottom-50">
            {!! $page_post->content !!}
        </div>
    @else
        @include('frontend.partials.pages-portion.dynamic-page-builder-part', ['page_post' => $page_post])
    @endif
@endsection
@section('left_side_content')
    {!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page(
        'dynamic_page_left_sidebar',
        $page_post->id,
    ) !!}
@endsection
@section('right_side_content')
    {!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_for_dynamic_page(
        'dynamic_page_right_sidebar',
        $page_post->id,
    ) !!}
@endsection
