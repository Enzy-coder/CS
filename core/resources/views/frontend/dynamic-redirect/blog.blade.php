@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Blog') }}
@endsection
@section('content')
    <div class="blog-grid-area-wrapper padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row g-4 col-control">
                @foreach ($all_blogs as $blog)
                    <div class="col-md-6 col-xl-4">
                        <x-frontend.blog.grid :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                    </div>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="pagination-default">
                        {!! $all_blogs->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
