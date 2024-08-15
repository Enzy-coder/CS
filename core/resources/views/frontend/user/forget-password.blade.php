@extends('frontend.frontend-page-master')
@section('page-title')
    {{ __('Forget Password') }}
@endsection
@section('content')
    <section class="sign-in-area-wrapper padding-top-100 padding-bottom-50">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="sign-in register">
                        <h2 class="single-title">{{ __('Forget Password ?') }}</h2>
                        <div class="form-wrapper custom__form mt-4">
                            <x-msg.error />
                            <x-msg.success />
                            <form action="{{ route('user.forget.password') }}" method="post" enctype="multipart/form-data"
                                class="register-form">
                                @csrf
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control"
                                        placeholder="{{ __('Username') }}">
                                </div>
                                <div class="form-group btn-wrapper">
                                    <button type="submit"
                                        class="btn-default rounded-btn">{{ __('Send Reset Mail') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
