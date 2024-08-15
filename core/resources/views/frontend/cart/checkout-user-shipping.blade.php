@if ($all_user_shipping)
    @foreach ($all_user_shipping as $user_shipping)
        <div class="col-md-12 px-0">
            <div class="card mb-3 user_shipping_address"
                 data-id="{{ $user_shipping->id }}"
                 data-name="{{ $user_shipping->name }}"
                 data-phone="{{ $user_shipping->phone }}"
                 data-email="{{ $user_shipping->email }}"
                 data-address="{{ $user_shipping->address }}"
                 data-country_id="{{ $user_shipping->country_id }}"
                 data-state_id="{{ $user_shipping->state_id }}"
                 data-city="{{ $user_shipping->city }}"
                 data-zip_code="{{ $user_shipping->zip_code }}"
            >
                <div class="card-body">
                    <div class="h5">{{ $user_shipping->name }}</div>
                    <p>{{ Str::limit($user_shipping->address, 20) }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endif
