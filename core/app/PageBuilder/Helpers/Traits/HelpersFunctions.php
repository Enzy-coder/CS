<?php

namespace App\PageBuilder\Helpers\Traits;

use App\AdminShopManage;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;

trait HelpersFunctions
{
    public function paddings($widget_saved_values){
        $output = Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 290,
            'max' => 500,
        ]);

        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 303,
            'max' => 500,
        ]);

        return $output;
    }

    public function product_order_item_query($products, $settings)
    {
        $order_by = SanitizeInput::esc_html($settings['order_by'] ?? 'id');
        $order = SanitizeInput::esc_html($settings['order'] ?? 'asc');
        $items = SanitizeInput::esc_html($settings['items'] ?? '');

        $all_products = $products->orderBy($order_by, $order);
        if (!empty($items)) {
            $all_products = $products->take($items)->get();
        } else {
            $all_products =  $products->get();
        }

        return $all_products->transform(function ($item) {
            if(!empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address') {
                $vendorAddress = $item->vendorAddress;
                $item = tax_options_sum_rate($item, $vendorAddress?->country_id, $vendorAddress?->state_id, $vendorAddress?->city_id);
            }elseif(empty($item->vendor_id) && get_static_option("calculate_tax_based_on") == 'vendor_shop_address'){
                $vendorAddress = AdminShopManage::select("id","country_id", "state_id","city as city_id")->first();
                $item = tax_options_sum_rate($item, $vendorAddress?->country_id, $vendorAddress?->state_id, $vendorAddress?->city_id);
            }
            return $item;
        });
    }

    public function product_order_item($widget_saved_values): string
    {

        $output = Select::get([
            'name' => 'order_by',
            'label' => __('Order By'),
            'options' => [
                'id' => __('ID'),
                'created_at' => __('Date'),
                'sale_price' => __('Price'),
            ],
            'value' => $widget_saved_values['order_by'] ?? null,
            'info' => __('set order by')
        ]);

        $output .= Select::get([
            'name' => 'order',
            'label' => __('Order'),
            'options' => [
                'asc' => __('Ascending'),
                'desc' => __('Descending'),
            ],
            'value' => $widget_saved_values['order'] ?? 'asc',
            'info' => __('set product order')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? 10,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);

        return $output;
    }
}