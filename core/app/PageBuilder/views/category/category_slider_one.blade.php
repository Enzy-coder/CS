<div class="category-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-slider-inst">
                    @foreach ($categories as $category)
                        <div class="single-slider-item">
                            <div class="img-box bg" {!! render_image($category->image) !!}>
                                <a href="{{ route('frontend.products.category', $category->slug, $category->id) }}">
                                    {!! render_image($category->image) !!}
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a
                                        href="{{ route('frontend.products.category', [
                                            'id' => optional($category)->id,
                                            'slug' => $category->slug ?? '',
                                        ]) }}">{{ $category->name }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
