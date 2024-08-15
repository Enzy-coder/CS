<!-- News Update area starts -->
<section class="news-area padding-top-20 padding-bottom-50">
    <div class="sidebar-wrapper single-border radius-10">
        <div class="news-wrapper">
            <h3 class="sidebar-title fw-500"> {{ $section_title }} </h3>
            <div class="row">
                @foreach($blogs as $blog)
                    <div class="col-xxl-12 col-xl-4 col-md-6 mt-4">
                        <x-frontend.blog.lsit-style-01 :$blog />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
<!-- News Update area end -->