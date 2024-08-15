@extends('vendor.vendor-master')
@section('site-title')
    {{ __('Vendor Create') }}
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/backend/css/colorpicker.css') }}">
    <x-media.css />
    <x-datatable.css />
    <x-bulk-action.css />
    <x-select2.select2-css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-lg-12">
                <x-msg.error />
                <x-msg.flash />
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Create Vendor') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form id="vendor-create-form" data-action-url="{{ route('vendor.profile.update', $vendor->id) }}">
                            <div class="toast toast-success"></div>
                            @csrf
                            <input name="id" value="{{ $vendor->id }}" type="hidden" />
                            <div class="d-flex flex-wrap gap-3 justify-content-between">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                            data-bs-target="#basic-info" type="button" role="tab"
                                            aria-controls="basic-info" aria-selected="true">Basic
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#address" type="button" role="tab" aria-controls="address"
                                            aria-selected="false">Address
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#shop-info" type="button" role="tab"
                                            aria-controls="shop-info" aria-selected="false">Shop Info
                                        </button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab"
                                            data-bs-target="#bank-info" type="button" role="tab"
                                            aria-controls="bank-info" aria-selected="false">Bank Info
                                        </button>
                                    </li>
                                </ul>

                                <div class="submit_button">
                                    <button type="submit" class="cmn_btn btn_bg_profile">Submit</button>
                                </div>
                            </div>

                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="basic-info" role="tabpanel"
                                    aria-labelledby="home-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-6">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title"> Basic Info* </h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Owner Name
                                                                </label>
                                                                <input name="owner_name" type="text"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor->owner_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Business Name
                                                                </label>
                                                                <input name="business_name" type="text"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor->business_name }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2">
                                                                    Username</label>
                                                                <input name="username" type="text"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor->username }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Business
                                                                    Category </label>
                                                                <div class="nice-select-two">
                                                                    <select id="business_type" name="business_type_id"
                                                                        style="display: none;">
                                                                        @foreach ($business_type as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $item->id == $vendor->business_type_id ? 'selected' : '' }}>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Description') }}
                                                                </label>
                                                                <textarea name="description" class="form--control form--message radius-10" style="height: 100px">{{ $vendor->description }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->logo" :title="__('Logo')" :name="'logo_id'"
                                                :dimentions="'200x200'" type="vendor" />
                                            <x-media.media-upload :old-image="$vendor?->vendor_shop_info?->cover_photo" :title="__('Cover Photo')" :name="'cover_photo_id'"
                                                :dimentions="'200x200'" type="vendor" />
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">{{ __('Address') }}</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Country') }}
                                                                </label>
                                                                <div class="nice-select-two country_wrapper">
                                                                    <select  class="form-control" id="country_id" name="country_id">
                                                                        <option value="">Select Country</option>
                                                                        @foreach ($country as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                {{ $vendor?->vendor_address?->country_id == $item->id ? 'selected' : '' }}>
                                                                                {{ $item->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @php
                                                            $states = $vendor?->vendor_address?->country_id ? \Modules\CountryManage\Entities\State::where('country_id', $vendor?->vendor_address?->country_id)->get() : [];
                                                        @endphp
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('State') }} </label>
                                                                <div class="nice-select-two state_wrapper">
                                                                    <select class="form-control" id="state_id" name="state_id">
                                                                        <option value="">Select State</option>
                                                                        @foreach ($states as $state)
                                                                            <option value="{{ $state->id }}"
                                                                                {{ $vendor?->vendor_address?->state_id == $state->id ? 'selected' : '' }}>
                                                                                {{ $state->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        @php
                                                            $cities = $vendor?->vendor_address?->state_id ? \App\City::where('state_id', $vendor?->vendor_address?->state_id)->get() : [];
                                                        @endphp

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('City') }} </label>
                                                                <div class="nice-select-two city_wrapper">
                                                                    <select class="form-control" id="city_id" name="city_id">
                                                                        <option value="">Select City</option>
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                {{ $vendor?->vendor_address?->city_id == $city->id ? 'selected' : '' }}>
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Zip Code') }}
                                                                </label>
                                                                <input type="text" name="zip_code"
                                                                    class="form--control radius-10"
                                                                    value="{{ $vendor?->vendor_address?->zip_code }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Address') }}
                                                                </label>
                                                                <textarea name="address" type="text" class="form--control radius-10"
                                                                    value="">{{ $vendor?->vendor_address?->address }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Google Map Location') }}</label>
                                                                <textarea name="google_map_location" type="text" class="form--control radius-10" value="">
                                                                    @if(!empty($vendor?->vendor_address?->google_map_location))
                                                                         {!! $location_iframeHtml !!}
                                                                    @endif
                                                                </textarea>
                                                                <span class="mt-3">{{ __('Example: Google Map Embed Code.') }}</span><pre><code>  &lt;iframe src="https://www.example.com" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"&gt;&lt;/iframe&gt;</code></pre>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="shop-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">{{ __('Shop Info') }}</h4>
                                                </div>
                                                <div class="dashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Location') }}
                                                                </label>
                                                                <input value="{{ $vendor?->vendor_shop_info?->location }}"
                                                                    name="location" type="url"
                                                                    class="form--control radius-10"
                                                                    placeholder="Set Location From Map">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Number') }}
                                                                </label>
                                                                <input value="{{ $vendor?->vendor_shop_info?->number }}"
                                                                    name="number" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Number">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> {{ __('Email Address') }}
                                                                </label>
                                                                <input value="{{ $vendor?->vendor_shop_info?->email }}"
                                                                    type="text" name="email"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Facebook Link
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_shop_info?->facebook_url }}"
                                                                    type="url" name="facebook_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Facebook Link">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Website
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_shop_info?->website_url }}"
                                                                    type="url" name="website_url"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Website">
                                                            </div>
                                                        </div>


                                                        <!--color settings start -->
                                                        <span class="label-title color-light mt-3"> {{ __('Store Color Settings') }}</span>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_color">{{ __('Main Color') }}</label>
                                                                <input type="text" name="store_color"
                                                                       style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_color'] ?? '' }};color: #fff;"
                                                                       class="form-control" value="{{ $vendor?->vendor_shop_info?->colors['store_color'] ?? '' }}"
                                                                       id="store_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_secondary_color">{{ __('Secondary Color') }}</label>
                                                                <input type="text" name="store_secondary_color"
                                                                       style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? '' }};color: #fff;"
                                                                       class="form-control" value="{{ $vendor?->vendor_shop_info?->colors['store_secondary_color'] ?? '' }}"
                                                                       id="store_secondary_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_heading_color">{{ __('Heading Color') }}</label>
                                                                <input type="text" name="store_heading_color"
                                                                       style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_heading_color'] ?? '' }};color: #fff;"
                                                                       class="form-control" value="{{ $vendor?->vendor_shop_info?->colors['store_heading_color'] ?? '' }}"
                                                                       id="store_heading_color">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <div class="form-group">
                                                                <label for="store_paragraph_color">{{ __('Paragraph Color') }}</label>
                                                                <input type="text" name="store_paragraph_color"
                                                                       style="background-color: {{ $vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? '' }};color: #fff;"
                                                                       class="form-control" value="{{ $vendor?->vendor_shop_info?->colors['store_paragraph_color'] ?? '' }}"
                                                                       id="store_paragraph_color">
                                                                <small>{{ __('you can change site paragraph color from there') }}</small>
                                                            </div>
                                                        </div>
                                                        <!--color settings end -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="bank-info" role="tabpanel" aria-labelledby="contact-tab">
                                    <div class="row g-4 mt-1">
                                        <div class="col-lg-12">
                                            <div class="dashboard__card">
                                                <div class="dashboard__card__header">
                                                    <h4 class="dashboard__card__title">Bank Info</h4>
                                                </div>
                                                <div class="sdashboard__card__body mt-4">
                                                    <div class="row g-4">
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Name </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_name }}"
                                                                    name="bank_name" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Email </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_email }}"
                                                                    name="bank_email" type="text"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Email">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Bank Code
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->bank_code }}"
                                                                    name="bank_code" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Code">
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="single-input">
                                                                <label class="label-title color-light mb-2"> Account Number
                                                                </label>
                                                                <input
                                                                    value="{{ $vendor?->vendor_bank_info?->account_number }}"
                                                                    name="account_number" type="tel"
                                                                    class="form--control radius-10"
                                                                    placeholder="Type Account Number">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="body-overlay-desktop"></div>

    <x-media.markup type="vendor" />
@endsection
@section('script')
    <script src="{{ asset('assets/backend/js/colorpicker.js') }}"></script>
    <x-datatable.js />
    <x-media.js type="vendor" />
    <x-table.btn.swal.js />
    <x-select2.select2-js/>
    <script>
        $('#country_id,#state_id,#city_id').select2()
        $(document).on("submit", "#vendor-create-form", function(e) {
            e.preventDefault();
            let url = $(this).data("action-url"),
                data = new FormData(e.target);

            send_ajax_request("post", data, url, () => {
                // write some code for preloader <i class="las la-spinner"></i>
                $(".submit_button button").append('<i class="las la-spinner"></i>');
                toastr.warning("Request Send.. Please Wait...");
            }, (data) => {
                $("#state_id").html(data.option);
                $(".state_wrapper .list").html(data.li);
                $(".submit_button button i").remove()
                toastr.success("Vendor account updated successfully....");
            }, (data) => {
                toastr.error("Some error found.");
                prepare_errors(data);
                $(".submit_button button i").remove()
            });
        });

        $(document).on("change", "#country_id", function() {
            let data = new FormData();

            data.append("country_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('vendor.get.state') }}", function() {}, (data) => {
                option="<option value=''>Select an state</option>";
                option+=data.option;
                $("#state_id").html(option);
                $(".state_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("change", "#state_id", function() {
            let data = new FormData();

            data.append("country_id", $("#country_id").val());
            data.append("state_id", $(this).val());
            data.append("_token", "{{ csrf_token() }}");

            send_ajax_request("post", data, "{{ route('vendor.get.city') }}", function() {}, (data) => {
                option="<option value=''>Select an city</option>";
                option+=data.option;
                
                $("#city_id").html(option);
                $(".city_wrapper .list").html(data.li);
            }, (data) => {
                prepare_errors(data);
            })
        });

        $(document).on("keyup keydown click change", "input[name=username]", function() {
            $(this).val(convertToSlug($(this).val()))
        });
    </script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                initColorPicker('#store_color');
                initColorPicker('#store_secondary_color');
                initColorPicker('#store_main_color_two');
                initColorPicker('#store_heading_color');
                initColorPicker('#store_paragraph_color');
                initColorPicker('input[name="portfolio_home_color"');
                initColorPicker('input[name="logistics_home_color"');

                function initColorPicker(selector) {
                    $(selector).ColorPicker({
                        color: '#852aff',
                        onShow: function(colpkr) {
                            $(colpkr).fadeIn(500);
                            return false;
                        },
                        onHide: function(colpkr) {
                            $(colpkr).fadeOut(500);
                            return false;
                        },
                        onChange: function(hsb, hex, rgb) {
                            $(selector).css('background-color', '#' + hex);
                            $(selector).val('#' + hex);
                        }
                    });
                }
            });
        }(jQuery));
    </script>

@endsection
