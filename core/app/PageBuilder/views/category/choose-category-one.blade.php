<!-- Category Starts -->
<section class="category_area section-bg-2 padding-top-50 padding-bottom-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title text-left">
                    <h2 class="title">{{ $section_title }}</h2>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="category_wrapper">
                <div class="category_wrapper__flex">
                    @foreach ($categories as $category)
                        <div class="category_wrapper__item">
                            <div class="signle_category center-text">
                                <div class="signle_category__thumb">
                                    <a href="{{ route('frontend.products.category', $category->slug) }}">
                                        {!! render_image($category->image) !!}
                                    </a>
                                </div>
                                <div class="signle_category__contents mt-3">
                                    <h6 class="signle_category__title">
                                        <a href="{{ route('frontend.products.category', $category->slug) }}">
                                            {{ $category->name }}
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Category area end -->
