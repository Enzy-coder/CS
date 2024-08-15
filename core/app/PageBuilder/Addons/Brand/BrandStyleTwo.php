<?php

namespace App\PageBuilder\Addons\Brand;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Modules\Attributes\Entities\Brand;

class BrandStyleTwo extends PageBuilderBase
{

    public function preview_image(): string
    {
        return "brand/style-02.png";
    }

    public function addon_title(): array|string|Translator|Application|null
    {
        return __("Brand Style: 02");
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $brands = Brand::select("id","name")->pluck("name", "id")->toArray();

        $output .= NiceSelect::get([
            'name' => 'brands',
            'multiple' => true,
            'label' => __('Brand'),
            'placeholder' =>  __('Select Brand'),
            'options' => $brands,
            'value' => $widget_saved_values['brands'] ?? null,
            'info' => __('you can select item for brand, if you want to show all brands leave it empty')
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();
        $brands_ids = $all_settings["brands"] ?? [];

        $brands = Brand::with("logo")->when(!empty($brands_ids), function ($query) use ($brands_ids){
            $query->where("id", $brands_ids)->get();
        })->get();

        return $this->renderBlade("brand/style-02", compact("brands"));
    }
}