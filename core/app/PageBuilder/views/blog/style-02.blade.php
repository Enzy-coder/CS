<!-- Top Sale area start -->
<section class="topSale_area padding-top-50 padding-bottom-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            @foreach($blogs as $blog)
                <div class="col-xl-3 col-lg-4 col-md-6 wow fadeInUp" data-wow-delay=".{{ $loop->iteration }}s">
                    <div class="blogFour">
                        <div class="blogFour__thumb">
                            <a href="{{ route("frontend.blog.single", $blog->slug) }}">
                                {!! render_image($blog->blogImage) !!}
                            </a>
                            <div class="blogFour__thumb__tag">
                                <a href="{{ route("frontend.blog.category", $blog->category->id) }}" class="tag_item bg-5">{{ $blog->category->name }}</a>
                            </div>
                        </div>
                        <div class="blogFour__contents">
                            <h5 class="blogFour__title"> <a href="{{ route("frontend.blog.single", $blog->slug) }}">{{ $blog->title }}</a> </h5>
                            <p class="blogFour__para mt-3">
                                {{ str(strip_tags($blog->blog_content))->limit(100) }}
                            </p>
                            <div class="btn-wrapper mt-3">
                                <a href="{{ route("frontend.blog.single", $blog->slug) }}" class="blogFour__btn">{{ __("Read More") }}</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Top Sale area end -->