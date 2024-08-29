<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
        {{ get_static_option('site_title') }} -
        @if (request()->path() == 'admin-home')
            {{ get_static_option('site_tag_line') }}
        @else
            @yield('site-title')
        @endif
        {{ __('Subscription Management') }}
    </title>
    @php
        $site_favicon = get_attachment_image_by_id(get_static_option('site_favicon'), 'full', false);
    @endphp
    @include('frontend.partials.css-variable')
    @if (!empty($site_favicon))
        <link rel="icon" href="{{ $site_favicon['img_url'] }}" type="image/png">
        {!! render_favicon_by_id($site_favicon['img_url']) !!}
    @endif
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap5.min.css') }}">
    <!-- animate -->
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <!-- slick carousel  -->
    <link rel="stylesheet" href="{{ asset('assets/css/slick.css') }}">
    <!-- LineAwesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
    <!-- Plugins css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.css') }}">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <!-- Vendor Signin area Starts -->
    <div class="vendor-signin-area padding-top-100 padding-bottom-100">
        <div class="container container-one">
            <div class="vendor-signin-wrapper">
                <div class="vendor-signin-wrapper-inner">
                    <h5 class="welcome-title center-text">{{ __('Welcome Back!') }}</h5>
                    <h2 class="main-title center-text fw-500 mt-3">{{ __('Subscription Management') }}</h2>
                    <div class="dashboard-form mt-4">
                        <form id="paypal-payment-form" action="{{ route('vendor.paypal.subscription') }}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" id="user_id" value="{{ $user->id }}">
                            <input type="hidden" name="amount" id="amount" value="{{ $amount }}">
                            
                            <!-- Hidden fields for PayPal response data -->
                            <input type="hidden" name="transaction_id" id="transaction_id">
                            <input type="hidden" name="payer_email" id="payer_email">
                            <input type="hidden" name="payer_name" id="payer_name">

                            <div class="form-group">
                                <label for="amount">{{ __('Amount to be Paid') }}</label>
                                <p class="form-control-static">${{ number_format($amount, 2) }}</p>
                            </div>
                            <div id="paypal-button-container" class="mt-4"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Necessary Scripts -->
    <script src="{{$link}}/sdk/js?client-id={{$client_id}}&currency=USD"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            paypal.Buttons({
                createOrder: function (data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: document.getElementById('amount').value
                            }
                        }]
                    });
                },
                onApprove: function (data, actions) {
                    return actions.order.capture().then(function (details) {
                        // Capture PayPal return data and populate hidden fields
                        document.getElementById('transaction_id').value = details.id;
                        document.getElementById('payer_email').value = details.payer.email_address;
                        document.getElementById('payer_name').value = details.payer.name.given_name + ' ' + details.payer.name.surname;

                        // Submit the form with PayPal data
                        document.getElementById('paypal-payment-form').submit();
                    });
                },
                onCancel: function (data) {
                    alert('Payment was cancelled. Please try again.');
                },
                onError: function (err) {
                    alert('An error occurred during the payment process. Please try again later.');
                    console.error('PayPal error:', err);
                }
            }).render('#paypal-button-container');
        });
    </script>
</body>

</html>
