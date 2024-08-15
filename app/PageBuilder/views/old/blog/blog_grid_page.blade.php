<div class="blog-grid-area-wrapper">
    <div class="container">
        <div class="row g-4 row-reverse justify-content-around">
            <div class="col-md-8 col-lg-9">
                <div class="row g-4 col-control">
                    @foreach ($all_blogs as $blog)
                        <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                            <x-frontend.blog.grid :blog="$blog" :readMoreBtnText="$readMoreBtnText" />
                        </div>
                    @endforeach
                </div>
                <div class="row g-4">
                    <div class="col-lg-12">
                        <div class="pagination">
                            {!! $all_blogs->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
