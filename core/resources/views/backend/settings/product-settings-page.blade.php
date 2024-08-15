@extends('backend.admin-master')
@section('site-title')
    {{ __('Product Settings') }}
@endsection
@section('style')
    <x-media.css />
@endsection
@section('content')
    @can('page-settings-product-details-page')
        <div class="col-lg-12 col-ml-12">
            <div class="row">
                <div class="col-lg-12">
                    <x-msg.success />
                    <x-msg.error />
                    <div class="dashboard__card">
                        <div class="dashboard__card__header">
                            <h4 class="dashboard__card__title">{{ __('Product Settings') }}</h4>
                        </div>
                        <div class="dashboard__card__body custom__form mt-4">
                            <form action="{{ route('admin.page.settings.product.settings.page') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="product_in_stock_limit_set">{{ __('Product Out of Stock Limit') }}</label>
                                            <input type="text" name="product_in_stock_limit_set" class="form-control"
                                                value="{{ get_static_option('product_in_stock_limit_set') }}">
                                            <span class="mt-2 text-warning">{{__('if product stock is low, add stock limit for all products.')}}</span>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <button class="cmn_btn btn_bg_profile">{{ __('Save Settings') }}</button>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <x-media.markup />
    @endcan
@endsection
@section('script')
    <x-media.js />
@endsection
