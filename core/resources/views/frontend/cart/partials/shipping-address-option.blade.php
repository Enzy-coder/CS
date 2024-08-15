<div class="user-shipping-address-item"
     data-name="{{ $shipping_address->name }}"
     data-email="{{ $shipping_address->email }}"
     data-address="{{ $shipping_address->address }}"
     data-country="{{ $shipping_address->country_id }}"
     data-state="{{ $shipping_address->state_id }}"
     data-city="{{ $shipping_address->city }}"
     data-phone="{{ $shipping_address->phone }}"
     data-zipcode="{{ $shipping_address->zip_code }}"
     data-states="{{ json_encode($shipping_address?->get_states?->toArray() ?? []) }}"
>
    <div class="before-hover btn btn-outline-secondary">
        {{ $shipping_address->shipping_address_name ?? $shipping_address->name }}
    </div>

    <div class="after-hover position-absolute top-0 bg-color-one text-light d-none">
        <p>{{ __("Shipping Address Name") }}: <b>{{ $shipping_address->shipping_address_name }}</b></p>
        <p>{{ __("Name") }}: <b>{{ $shipping_address->name }}</b></p>
        <p>{{ __("Email") }}: <b>{{ $shipping_address->email }}</b></p>
        <p>{{ __("Address") }}: <b>{{ $shipping_address->address }}</b></p>
        <p>{{ __("Country") }}: <b>{{ $shipping_address?->country?->name }}</b></p>
        <p>{{ __("State") }}: <b>{{ $shipping_address?->state?->name }}</b></p>
        <p>{{ __("City") }}: <b>{{ $shipping_address->city }}</b></p>
        <p>{{ __("Mobile") }}: <b>{{ $shipping_address->phone }}</b></p>
    </div>
</div>