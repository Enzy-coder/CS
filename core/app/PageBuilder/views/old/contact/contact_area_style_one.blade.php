<div class="contact-us-area-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-lg-4 col-xl-3">
                <div class="address-wrapper">
                    <div class="title-section">
                        <h4 class="title">{{ $title }}</h4>
                    </div>
                    <ul class="address-list">
                        @foreach ($settings['contact_page_contact_info_01']['title_'] as $title)
                            <li class="single-address-item">
                                <div class="icon-box">
                                    <i
                                        class="{{ $settings['contact_page_contact_info_01']['icon_'][$loop->index] }} icon"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title">{{ $title }}</h5>
                                    <p class="info">
                                        {{ $settings['contact_page_contact_info_01']['description_'][$loop->index] }}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-7 col-lg-8 col-xl-9">
                <div class="get-in-touch-wrapper">
                    <h3 class="title">{{ $form_title }}</h3>

                    <div class="w-100">
                        @if (session('msg') !== null && session('type') !== null)
                            <div class="alert alert-{{ session('type') }}">{{ session('msg') }}</div>
                        @endif
                    </div>

                    @if (!empty($custom_form_id))
                        @php $form_details = App\FormBuilder::find($custom_form_id); @endphp
                        {!! App\Helpers\FormBuilderCustom::render_form(optional($form_details)->id, null, null, 'btn-default') !!}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
