<?php

namespace App\PageBuilder\Services;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use Illuminate\Database\Eloquent\Collection;
use LaravelIdea\Helper\Modules\Product\Entities\_IH_Product_C;
use Modules\Product\Entities\Product;
use Modules\Product\Entities\ProductCategory;

class ProductRenderServices
{
    public static function admin($widget_saved_values = null)
    {
        $output = "";

        $products = Product::where(['status' => 'publish'])->get()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'products',
            'multiple' => true,
            'label' => __('Product'),
            'placeholder' => __('Select Product'),
            'options' => $products,
            'value' => $widget_saved_values['products'] ?? null,
            'info' => __('you can select products that you want to show, if you want to show all the products leave it empty')
        ]);

        $categories = ProductCategory::where('status', 'publish')->get()->pluck('title', 'id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'product_categories',
            'multiple' => true,
            'label' => __('Category'),
            'placeholder' => __('Select Category'),
            'options' => $categories,
            'value' => $widget_saved_values['product_categories'] ?? null,
            'info' => __('You can select category that you want to show, if you want to show all the products leave it empty')
        ]);

        $output .= Select::get([
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
            'value' => $widget_saved_values['order'] ?? null,
            'info' => __('set product order')
        ]);

        $output .= Number::get([
            'name' => 'items',
            'label' => __('Items'),
            'value' => $widget_saved_values['items'] ?? null,
            'info' => __('enter how many item you want to show in frontend, leave it empty if you want to show all products'),
        ]);

        return $output;
    }

    public static function frontend($settings,$soldCampaign)
    {
        $order_by = SanitizeInput::esc_html($settings['order_by'] ?? "") ?? null;
        $order = SanitizeInput::esc_html($settings['order'] ?? "") ?? null;
        $items = SanitizeInput::esc_html($settings['items'] ?? "") ?? null;
        $product_items = $settings['products'] ?? [];

        // check product selected or not
        if(is_array($settings) && array_key_exists('product_items',$settings)){
            $product_items = $settings['product_items'] ?? '';
        }

        if($soldCampaign){
            $products = Product::query()
                ->withCount('ratings','inventoryDetail')
                ->withAvg('ratings','rating')
                ->withSum('taxOptions','rate')
                ->with('inventory', 'campaign_product', 'campaign_sold_product')->where(['status_id' => 1]);
        }else{
            $products = Product::query()
                ->withCount('ratings','inventoryDetail')
                ->withAvg('ratings','rating')
                ->withSum('taxOptions','rate')
                ->with('inventory', 'campaign_product','campaign_sold_product')->where(['status_id' => 1]);
        }

        $products = $products->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
            $query->whereNull("vendor_id");
        });

        if (!empty($product_items)) {
            $products->whereIn('id', $product_items);
        }
        $all_products = "";

        if ($order_by === 'rating') {
            $products = $products->with(['ratings','campaign_product'])
                ->orderBy('ratings_count', 'desc')->get();
            $all_products = $products;
        } else {
            $order_by = empty($order_by) ? "id" : $order_by;
            $order = empty($order) ? "asc" : $order;
           
            $products->orderBy($order_by, $order);
        }

        if (!empty($items)) {
            $all_products = $products->take($items)->get();
        } else {
            $all_products = $products->get();
        }

        return $all_products;
    }

    public static function new_products($limit): Collection|_IH_Product_C|array
    {
        return Product::where('status_id',1)
            ->withCount('ratings')
            ->withAvg('ratings', 'rating')
            ->with('inventory','campaign_product','ratings')
            ->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
                $query->whereNull("vendor_id");
            })
            ->orderBy('created_at', 'DESC')
            ->take($limit)
            ->get();
    }
}