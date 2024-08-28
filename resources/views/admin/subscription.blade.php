@extends('backend.admin-master')
@section('site-title')
    {{ __('Subscription Management') }}
@endsection
@section('content')
    <div class="wrapper-container">
        <div class="col-lg-12 col-ml-12">
            <div class="row">
                <div class="col-12">
                    @include('backend.partials.message')
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Subscription Management') }}</h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="{{ route('admin.general.subscription') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="amount" class="m-2">{{ __('Subscription Amount') }}</label>
                                            <div class="input-group">
                                                <input type="number" name="amount" id="amount" class="form-control  m-2" value="{{ $subscription->amount ?? 0 }}" min="0" step="0.01">
                                                <div class="input-group-append  m-2">
                                                    <button type="submit" id="update" class="cmn_btn btn_bg_profile">
                                                        <i class="fas fa-save"></i> {{ __('Update') }}
                                                    </button>
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
    </div>
@endsection
