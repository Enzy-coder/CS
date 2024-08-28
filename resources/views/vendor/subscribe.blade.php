@extends('backend.admin-master')
@section('site-title')
    {{ __('Subscription Renewal') }}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12">
        <div class="row">
            <div class="col-12">
                @include('backend.partials.message')
                <div class="dashboard__card">
                    <div class="dashboard__card__header">
                        <h4 class="dashboard__card__title">{{ __('Subscription Renewal') }}</h4>
                    </div>
                    <div class="dashboard__card__body custom__form mt-4">
                        <form action="{{ route('vendor.process_subscription', ['id' => $id]) }}" method="POST">
                            @csrf
                            <div class="row g-4">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="amount">{{ __('Subscription Amount') }}</label>
                                        <input type="number" name="amount" id="amount" class="form-control" min="0" step="0.01" value="{{ $subscription->amount ?? 0 }}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <button type="submit" class="cmn_btn btn_bg_profile">{{ __('Subscribe') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
