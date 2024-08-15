@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Register') }}
@endsection
@section('content')
    <section class="sign-in-area-wrapper padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-6">
                    <div class="sign-in register">
                        <h4 class="single-title">{{ __('Create Account') }}</h4>
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.flash />
                            <form action="{{ route('user.register') }}" method="post" enctype="multipart/form-data"
                                class="account-form">
                                @csrf
                                <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control"
                                        placeholder="{{ __('Name') }}" value="{{ old("name") ?? "" }}">
                                </div>
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="{{ __('Username') }}" value="{{ old("username") ?? "" }}">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" class="form-control"
                                        placeholder="{{ __('Email') }}" value="{{ old("email") ?? "" }}">
                                </div>
                                <div class="form-group">
                                    <select id="country" class="form-control" name="country">
                                        @foreach ($all_country as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control"
                                        placeholder="{{ __('Password') }}">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password_confirmation" class="form-control"
                                        placeholder="{{ __('Confirm Password') }}">
                                </div>
                                <div class="form-group">
                                    <div class="box-wrap form-check">
                                        <div class="left">
                                            <input type="checkbox" class="form-check-input" id="toc_and_privacy"
                                                name="agree_terms" required>
                                            <label class="form-check-label" for="toc_and_privacy">
                                                {{ __('Accept all') }}
                                                <a href="{{ url(get_static_option('toc_page_link')) }}"
                                                   class="text-active">{{ __('Terms and Conditions') }}</a> &amp;
                                                <a href="{{ url(get_static_option('privacy_policy_link')) }}"
                                                   class="text-active">{{ __('Privacy Policy') }}</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-wrapper">
                                    <button type="submit" class="btn-submit w-100">{{ __('Create Account') }}</button>
                                </div>
                            </form>
                            <div class="signin__account__para d-flex justify-content-center mt-4">
                                <p class="info">{{ __('Already Have account?') }}</p>
                                <a href="{{ route('user.login') }}" class="active">
                                    <strong>{{ __('Sign in') }}</strong>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script
        src="https://www.google.com/recaptcha/api.js?render={{ get_static_option('site_google_captcha_v3_site_key') }}">
    </script>
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute("{{ get_static_option('site_google_captcha_v3_site_key') }}", {
                action: 'homepage'
            }).then(function(token) {
                document.getElementById('gcaptcha_token').value = token;
            });
        });
    </script>
@endsection
