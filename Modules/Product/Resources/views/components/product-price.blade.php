<?php
if (!isset($product)) {
    $product = null;
}

$taxClasses = $taxClasses ?? [];
?>

<div class="general-info-wrapper dashboard__card">
    <div class="dashboard__card__header">
        <h4 class="dashboard__card__title"> {{ __('Price Manage') }} </h4>
    </div>
    <div class="general-info-form dashboard__card__body custom__form">
        <div class="row g-3 mt-2">
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> {{ __('Base Cost') }} </label>
                    <input type="text" class="form--control radius-10" value="{{ $product?->cost }}" name="cost"
                        placeholder="{{ __('Base Cost...') }}">
                    <p>{{ __('Purchase price of this product.') }}</p>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> {{ __('Regular Price') }} </label>
                    <input type="text" class="form--control radius-10" value="{{ $product?->price }}" name="price"
                        placeholder="{{ __('Enter Regular Price...') }}">
                    <small>{{ __('This price will display like this') }} <del>( {{ site_currency_symbol() }}
                            10)</del></small>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="dashboard-input">
                    <label class="dashboard-label color-light mb-2"> {{ __('Sale Price') }} </label>
                    <input type="text" class="form--control radius-10" value="{{ $product?->sale_price }}"
                        name="sale_price" placeholder="{{ __('Enter Sale Price...') }}">
                    <small>{{ __('This will be your product selling price') }}</small>
                </div>
            </div>

            @if (get_static_option('tax_system') == 'advance_tax_system')
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> {{ __('Is Taxable') }} </label>
                        <select class="form--control radius-10" name="is_taxable">
                            <option value="">{{ __('Select is taxable') }}</option>
                            <option {{ $product?->is_taxable == 1 ? 'selected' : '' }} value="1">
                                {{ __('Taxable') }}</option>
                            <option {{ $product?->is_taxable == 0 ? 'selected' : '' }} value="0">
                                {{ __('Non-Taxable') }}</option>
                        </select>
                        <small>{{ __('If you designate your product as taxable, it implies that applicable taxes will be levied on the product.') }}</small>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="dashboard-input">
                        <label class="dashboard-label color-light mb-2"> {{ __('Tax class') }} </label>

                        <select class="form--control radius-10" name="tax_class_id">
                            <option value="">{{ __('Select a tax class for this product') }}</option>
                            @foreach ($taxClasses as $tax_class)
                                <option {{ $product?->tax_class_id == $tax_class->id ? 'selected' : '' }}
                                    value="{{ $tax_class->id }}">{{ $tax_class->name }}</option>
                            @endforeach
                        </select>

                        <small>{{ __('If you select taxable then you need to select tax class') }}</small>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
