<div class="faq-area-wrapper padding-top-100 padding-bottom-50">
    <div class="container">
        <div class="row g-4 gx-5">
            <div class="col-md-6 col-lg-6">
                <div class="faq-accordion">
                    <div class="accordion" id="faq_accordion">
                        @foreach ($faq_items as $faq)
                            <div class="card">
                                <div class="card-header" id="heading{{ $faq->id }}">
                                    <h5 class="mb-0">
                                        <a href="#1"
                                            class="accordion-btn btn-link @if ($loop->iteration != 2) collapsed @endif"
                                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id }}"
                                            aria-expanded="<?php echo $loop->first ? 'true' : 'false'; ?>"
                                            aria-controls="collapse{{ $faq->id }}">
                                            {{ $faq->title }}
                                            <span class="faq__icons color-1">
                                                <i class="las la-plus open"></i>
                                                <i class="las la-minus close"></i>
                                            </span>
                                        </a>
                                    </h5>
                                </div>

                                <div id="collapse{{ $faq->id }}"
                                    class="collapse @if ($loop->iteration == 2) show @endif"
                                    aria-labelledby="heading{{ $faq->id }}" data-parent="#faq_accordion">
                                    <div class="card-body">
                                        <p class="info">{{ $faq->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6">
                <div class="faq-form-wrapper">
                    <h3 class="faq-form-title">{{ $ask_question_form_title }}</h3>
                    <div class="faq_container mt-4">
                        {!! $custom_form_markup !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
