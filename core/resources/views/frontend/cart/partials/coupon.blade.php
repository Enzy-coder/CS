<div class="coupon-wrapper">
    <div class="coupon-title-wrap" id="coupon">
        <p class="query">
            {!! filter_static_option_value('have_coupon_text', $setting_text, __('Have a coupon?')) !!}
            <span class="click">{!! filter_static_option_value('enter_coupon_text', $setting_text, __('Click here to enter your code')) !!}</span>
        </p>
    </div>
    <div class="coupon-content" @if(!isset(request()->coupon)) style="display: none;" @endif>
        <div class="search-form">
            <form action="{{ route('frontend.checkout.apply.coupon') }}" class="discount-coupon">
                <div class="form-group">
                    <input type="text"
                           class="form-control"
                           placeholder="{!! filter_static_option_value('coupon_placeholder', $setting_text, __('Enter your coupon code')) !!}"
                           name="coupon"
                           value="{{ old('coupon') ?? request()->coupon }}"
                    >
                </div>
                <button class="search-btn" type="submit">{!! filter_static_option_value('apply_coupon_btn_text', $setting_text, __('apply coupon')) !!}</button>
            </form>
        </div>
    </div>
</div>
