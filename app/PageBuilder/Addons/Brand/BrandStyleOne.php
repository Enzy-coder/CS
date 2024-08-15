<?php

namespace App\PageBuilder\Addons\Brand;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Modules\Attributes\Entities\Brand;

class BrandStyleOne extends PageBuilderBase
{

    public function preview_image()
    {
        return "brand/style-01.png";
    }

    public function addon_title()
    {
        return __("Brand Style: 01");
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $brands = Brand::select("id","name")->pluck("name", "id")->toArray();


        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $output .= NiceSelect::get([
            'name' => 'brands',
            'multiple' => true,
            'label' => __('Brand'),
            'placeholder' =>  __('Select Brand'),
            'options' => $brands,
            'value' => $widget_saved_values['brands'] ?? null,
            'info' => __('you can select item for brand, if you want to show all brands leave it empty')
        ]);

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
        $brands_ids = $all_settings["brands"] ?? [];

        $brands = Brand::with("logo")->when(!empty($brands_ids), function ($query) use ($brands_ids){
            $query->where("id", $brands_ids)->get();
        })->get();

        return $this->renderBlade("brand/style-01", compact("section_title","padding_top","padding_bottom","brands"));
    }
}