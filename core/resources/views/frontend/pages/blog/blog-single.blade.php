@extends('frontend.frontend-page-master')
@php
    $post_img = null;
    $blog_image = get_attachment_image_by_id($blog_post->image, 'full', false);
    $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
@endphp

@section('style')
    @if (!empty(get_static_option('site_disqus_key')))
        <script id="dsq-count-scr" src="//{{ get_static_option('site_disqus_key') }}.disqus.com/count.js" async></script>
    @endif
@endsection
@section('og-meta')
    <meta name="og:title" content="{{ purify_html($blog_post->og_meta_title) }}">
    <meta name="og:description" content="{{ purify_html($blog_post->og_meta_description) }}">
    {!! render_og_meta_image_by_attachment_id($blog_post->og_meta_image) !!}
    <meta name="og:tags" content=" {{ purify_html($blog_post->meta_tags) }}">
@endsection

@section('page-meta-data')
    <meta name="description" content="{{ purify_html($blog_post->meta_description) }}">
    <meta name="tags" content="{{ purify_html($blog_post->meta_tag) }}">
@endsection
@section('site-title')
    {{ purify_html($blog_post->title) }}
@endsection
@section('page-title')
    {{ purify_html($blog_post->title) }}
@endsection
@section('content')
    <div class="blog-details-area-wrapper padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row row-reverse justify-content-around">
                <div class="col-xxl-9 col-lg-8">
                    <div class="blog-details-area-inner">
                        <div class="img-box main-img">
                            @if (!empty($blog_image))
                                <img src="{{ $blog_image['img_url'] }}" alt="{{ purify_html($blog_post->title) }}">
                            @endif
                        </div>

                        <div class="content">
                            <h4 class="main-title">{!! $blog_post->title !!} </h4>
                            <div class="post-meta">
                                <ul class="post-meta-list">
                                    <li class="post-meta-item">
                                        <a href="#1">
                                            <i class="lar la-calendar icon"></i>
                                            <span class="text">{{ date_format($blog_post->created_at, 'Y F Y') }}</span>
                                        </a>
                                    </li>
                                    <li class="post-meta-item">
                                        <a
                                            href="{{ route('frontend.blog.category', ['id' => optional($blog_post->category)->id, 'name' => optional($blog_post->category)->title]) ?? '' }}">
                                            <i class="las la-tag icon"></i>
                                            <span class="text">{{ optional($blog_post->category)->name }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <p class="info info-1">
                                {!! $blog_post->blog_content !!}
                            </p>
                        </div>

                        <!-- Tag and social link area start -->
                        <div class="blog-details-tag-and-social-link mt-5">
                            @php $all_tags = explode(',', purify_html($blog_post->tags)); @endphp
                            @if (count($all_tags) > 1)
                                <div class="tag">
                                    <p class="name">{{ get_static_option('blog_single_page_tags_title') }}:</p>
                                    @foreach ($all_tags as $tag)
                                        @php $slug = Str::slug($tag); @endphp
                                        <a href="{{ route('frontend.blog.tags.page', ['name' => $slug]) }}"
                                            class="tag-btn">{{ $tag }}</a>
                                    @endforeach
                                </div>
                            @endif
                            <div class="social-link-wrap">
                                <p class="name">{{ get_static_option('blog_single_page_share_title') }}:</p>
                                <div class="social-link">
                                    <ul class="social-link-list">
                                        {!! single_post_share(
                                            route('frontend.blog.single', purify_html($blog_post->slug)),
                                            purify_html($blog_post->title),
                                            $post_img,
                                        ) !!}
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Tag and social link area end -->
                        <div class="disqus-comment-area margin-top-40">
                            <div id="disqus_thread"></div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-lg-4">
                    <div class="widget-area-wrapper">
                        {!! render_frontend_sidebar('blog', ['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @if (!empty(get_static_option('site_disqus_key')))
        <div id="disqus_thread"></div>
        <script>
            /**
             *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
             *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
            /*
            var disqus_config = function () {
            this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
            this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
            };
            */
            (function() { // DON'T EDIT BELOW THIS LINE
                var d = document,
                    s = d.createElement('script');
                s.src = 'https://{{ get_static_option('site_disqus_key') }}.disqus.com/embed.js';
                s.setAttribute('data-timestamp', +new Date());
                (d.head || d.body).appendChild(s);
            })();
        </script>
    @endif
@endsection
