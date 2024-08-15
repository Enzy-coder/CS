<div class="category-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-slider-inst">
                    @foreach ($product_categories as $category)
                        <div class="single-slider-item">
                            <div class="img-box bg" {!! render_background_image_markup_by_attachment_id($category->image, 'grid', true) !!}>
                                <a
                                    href="{{ route('frontend.products.category', [
                                        'id' => $category->id,
                                        'slug' => \Str::slug($category->title ?? ''),
                                    ]) }}">
                                    {!! render_image_markup_by_attachment_id($category->image, '', 'grid', true) !!}
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a
                                        href="{{ route('frontend.products.category', [
                                            'id' => $category->id,
                                            'slug' => \Str::slug($category->title ?? ''),
                                        ]) }}">{{ $category->title }}</a>
                                </h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
