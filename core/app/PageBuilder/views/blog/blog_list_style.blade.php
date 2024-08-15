<div class="blog-list-area-wrapper padding-top-100 padding-bottom-100">
    <div class="container">
        <div class="row g-4 row-reverse justify-content-around">
            <div class="col-md-8 col-lg-9">
                <div class="row g-4">
                    @foreach ($all_blogs as $blog)
                        <div class="col-lg-12">
                            <x-frontend.blog.list :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                        </div>
                    @endforeach
                </div>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="pagination-default">
                            {!! $all_blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
