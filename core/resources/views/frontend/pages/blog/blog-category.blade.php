@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Category:') }} {{ ' ' . $category_name }}
@endsection
@section('site-title')
    {{ __('Category:') }} {{ ' ' . $category_name }}
@endsection

@section('content')
    <section class="blog-content-area padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    @forelse($all_blogs as $data)
                        <x-frontend.blog.list :blog="$data" :readMoreBtnText="__('Read More')" />
                    @empty
                        <div class="alert alert-danger">
                            {{ __('No Post Available In ') . $category_name . __(' Category') }}
                        </div>
                    @endforelse
                    <div class="pagination-default">
                        {!! $all_blogs->links() !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area-wrapper">
                        {!! render_frontend_sidebar('blog', ['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
