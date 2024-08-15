@php
    $modal = $modal ?? false;
@endphp

<div class="checkout-inner mt-4">
    <h4 class="title"> {{ __("Billing Details") }} </h4>
    <div class="checkout-contents">
        <div class="checkout-form mt-2">

            @if(!$modal)
                @endif
                @if($modal)
                    <div class="input-flex-item">
                        <div class="single-input mt-4">
                            <label class="label-title mb-3"> {{ __("Shipping Address Name") }} </label>
                            <input class="form--control" type="text" name="shipping_address_name" value="{{ old("shipping_address_name") ?? "" }}" placeholder="{{ __("Shipping Address Name.") }}">
                        </div>
                    </div>
                @endif

                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Full Name") }} </label>
                        <input class="form--control" id="{{ !$modal ? "name" : "modal_name" }}" type="text" name="full_name" value="{{ old("full_name") ?? "" }}" placeholder="{{ __("Type First Name") }}">
                    </div>
                </div>

                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Address") }} </label>
                        <input class="form--control" type="text" name="address" value="{{ old("address") ?? "" }}" id="{{ !$modal ? "address" : "modal_address" }}" placeholder="{{ __("Type Address") }}">
                    </div>
                </div>

                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Country") }} </label>
                        <select  @class(['form--control', 'modal-country' => !$modal ]) id="{{ !$modal ? "country_id" : "modal_country_id" }}" type="text" name="country_id">
                            <option value="">{{ __("Select an Country") }}</option>
                            @foreach($countries as $country)
                                <option {{ (old('country_id') ?? 0) == $country->id ? "selected" : ""  }} value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("State") }} </label>
                        <select id="{{ !$modal ? "state_id" : "modal_state_id" }}" @class([
                            'form--control select-state',
                             'modal-states' => !$modal
                        ]) type="text" name="state_id">
                            <option value="">{{ __("Select country first...") }}</option>
                        </select>
                    </div>
                </div>

                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("City/Town") }} </label>
                        <select id="{{ !$modal ? "city_id" : "modal_city_id" }}" @class([
                            'form--control select-state',
                             'modal-cities' => !$modal
                        ]) type="text" name="city">
                            <option value="">{{ __("Select state first...") }}</option>
                        </select>
                    </div>
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Zip Code") }} </label>
                        <input class="form--control" type="text" name="zip_code" value="{{ old("zip_code") ?? "" }}" id="{{ !$modal ? "zipcode" : "modal_zipcode" }}" placeholder="{{ __("Type Zip Code") }}">
                    </div>
                </div>

                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Mobile Number") }} </label>
                        <input class="form--control" type="tel" name="phone" value="{{ old("phone") ?? "" }}" id="{{ !$modal ? "phone" : "modal_phone" }}" placeholder="{{ __("Type Mobile Number") }}">
                    </div>
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Email Address") }} </label>
                        <input class="form--control" type="text" name="email" value="{{ old("email") ?? "" }}" id="{{ !$modal ? "email" : "modal_email" }}" placeholder="{{ __("Type Email") }}">
                    </div>
                </div>

            @if(!$modal)
                <div class="input-flex-item">
                    <div class="single-input mt-4">
                        <label class="label-title mb-3"> {{ __("Order Notes") }} </label>
                        <textarea class="form--control form--message" name="note" id="message" placeholder="{{ __("Type Messages") }}">{{ old("note") ?? "" }}</textarea>
                    </div>
                </div>

                @include('frontend.cart.partials.create-account')
            @else
                <button class="btn btn-info mt-4">{{ __("Create Shipping Address") }}</button>
            @endif
        </div>
    </div>
</div>
