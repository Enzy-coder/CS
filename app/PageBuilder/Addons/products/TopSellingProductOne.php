<?php

namespace App\PageBuilder\Addons\products;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\Category;
use Modules\Product\Entities\Product;

class TopSellingProductOne extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product/popular-product.png';
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $products = Product::select("id","name")->when(get_static_option('vendor_enable', 'on') != 'on', function ($query){
            $query->whereNull("vendor_id");
        })->pluck("name", "id")->toArray();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'name' => 'products',
            'multiple' => true,
            'label' => __('Select Products'),
            'placeholder' =>  __('Select Products'),
            'options' => $products,
            'value' => $widget_saved_values['products'] ?? null
        ]);

        $output .= Number::get([
            'name' => 'item_count',
            'label' => __('Product Limit'),
            'value' => $widget_saved_values['item_count'] ?? null,
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $section_title = SanitizeInput::esc_html($all_settings['section_title']);
        $selected_product = $all_settings['products'] ?? [];
        $item_count = SanitizeInput::esc_html($all_settings['item_count']);

        $products = addonProductInstance();

        $products = $products->when(!empty($selected_product), function ($query) use ($selected_product){
            $query->whereIn("id", $selected_product);
        })->when(empty($selected_product), function ($query) {
            $query->orderBy("order_items_count", "DESC");
        })->take(!empty($item_count) ? $item_count : 6)->get();

        return $this->renderBlade("product/popular-product", compact("section_title","products"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Popular product: 01");
    }
}