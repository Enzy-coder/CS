<!-- Winter Product start -->
<section class="winterProduct__area padding-top-50 padding-bottom-50">
    <div class="container container_1608">
        <div class="row g-4">
            <div class="col-xl-7">
                <div class="winterProduct radius-10 winter__bg1">
                    <div class="row align-items-end">
                        <div class="col-md-6">
                            <div class="winterProduct__contents">
                                <div class="winterProduct__subtitle">
                                    {!! str_replace(['[b]','[/b]','[/br]'],['<h2 class="winterProduct__title">','</h2>','</br>'], $section_title) !!}
                                </div>

                                <div class="winterProduct__list mt-4">
                                    @foreach($section_one_repeater['section_one_title_'] ?? [] as $title)
                                        <span class="winterProduct__list__item">{{ $title }}</span>
                                    @endforeach
                                </div>

                                <div class="btn_wrapper mt-5">
                                    <a href="{{ url("/" . ($section_one_button_url ?? "")) }}" class="cmn_btn btn_bg_3 radius-5">{{ $section_one_button_text ?? "" }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="winterProduct__thumb">
                                {!! render_image($section_one_image ?? 0) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="winterProduct">
                    <div class="row g-4">
                        <div class="col-xl-12 col-md-6">
                            <div class="winterProduct__single radius-10 winter__bg2">
                                <div class="row align-items-center flex-row-reverse">
                                    <div class="col-lg-6 col-md-12 col-sm-6">
                                        <div class="winterProduct__single__contents text-center">
                                            <h3 class="winterProduct__single__contents__title">
                                                {{ $section_two_title ?? "" }}
                                            </h3>
                                            <div class="btn_wrapper mt-4">
                                                <a href="{{ $section_two_button_url ?? "" }}"
                                                   class="cmn_btn btn_bg_2 radius-5">{{ $section_two_button_text ?? "" }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-6">
                                        <div class="winterProduct__single__thumb bg_image"
                                             style="background-image: url('{{ render_image($section_two_bg_image ?? 0, render_type: 'path') }}');">
                                            {!! render_image($section_two_image ?? 0) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-md-6">
                            <div class="winterProduct__single radius-10 winter__bg3">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 col-md-12 col-sm-6">
                                        <div class="winterProduct__single__contents text-center">
                                            <h3 class="winterProduct__single__contents__title">
                                                {{ $section_three_title ?? "" }}
                                            </h3>
                                            <div class="btn_wrapper mt-4">
                                                <a href="{{ url($section_three_button_url ?? "") }}"
                                                   class="cmn_btn btn_bg_black radius-5">{{ $section_three_button_text ?? "" }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-6">
                                        <div class="winterProduct__single__thumb">
                                            {!! render_image($section_three_image) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Winter Product end -->