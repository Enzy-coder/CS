<div class="blog-list-area-wrapper blog-grid-area-wrapper padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="blog-list-inner-wrap">
                    @foreach ($all_blogs as $blog)
                        <x-frontend.blog.list :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                    @endforeach
                </div>
                <div class="row g-4 justify-content-center margin-top-30">
                    <div class="col-lg-6">
                        <div class="pagination-default">
                            {!! $all_blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="widget-area-wrapper">
                    {!! render_frontend_sidebar('blog', ['column' => false]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
