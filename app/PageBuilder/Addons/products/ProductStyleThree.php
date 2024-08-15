<?php

namespace App\PageBuilder\Addons\products;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Product\Entities\Product;

class ProductStyleThree extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'product/right-style-02.png';
    }

    public function admin_render()
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

        $output .= Text::get([
            'name' => 'tooltip_text',
            'label' => __('Tooltip Text'),
            'value' => $widget_saved_values['tooltip_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'button_text',
            'label' => __('Right Button Text'),
            'value' => $widget_saved_values['button_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Right Button URL'),
            'value' => $widget_saved_values['button_url'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'name' => 'products',
            'multiple' => true,
            'label' => __('Product'),
            'placeholder' =>  __('Select Products'),
            'options' => $products,
            'value' => $widget_saved_values['products'] ?? null,
            'info' => __('Please select product if you not select than system will take 3 product randomly.')
        ]);

        $output .= $this->product_order_item($widget_saved_values);
        $output .= $this->paddings($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $section_title = SanitizeInput::esc_html($all_settings['section_title']);
        $tooltip_text = SanitizeInput::esc_html($all_settings['tooltip_text']);
        $button_text = SanitizeInput::esc_html($all_settings['button_text']);
        $button_url = SanitizeInput::esc_html($all_settings['button_url']);
        $prd_ids = $all_settings["product"] ?? [];

        $products = addonProductInstance();

        $products->when(!empty($prd_ids), function ($query) use ($prd_ids){
            $query->whereIn("id", $prd_ids);
        })->when(empty($prd_ids), function ($query){
            $query->limit(10);
        });

        $products = $this->product_order_item_query($products, $all_settings);

        return $this->renderBlade("product/right-style-02", compact("section_title","padding_top","padding_bottom","products","tooltip_text","button_text","button_url"));
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Right side product: 03");
    }
}