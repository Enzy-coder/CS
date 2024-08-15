<div class="category-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="category-slider-inst">
                    @foreach ($categories as $category)
                        <div class="single-slider-item">
                            <div class="img-box bg" {!! render_background_image_markup_by_attachment_id($category->image) !!}>
                                <a
                                    href="{{ route('frontend.products.category', [
                                        'id' => optional($category)->id,
                                        'slug' => \Str::slug(optional($category)->title ?? ''),
                                    ]) }}">
                                    {!! render_image_markup_by_attachment_id($category->image) !!}
                                </a>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a
                                        href="{{ route('frontend.products.category', [
                                            'id' => optional($category)->id,
                                            'slug' => \Str::slug(optional($category)->title ?? ''),
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
