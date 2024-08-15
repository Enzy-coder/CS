<?php


namespace App\PageBuilder\Addons\Brand;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\NiceSelect;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Modules\Attributes\Entities\Brand;

class ChooseBrandOne extends PageBuilderBase
{
    use RepeaterHelper;
    /**
     * @inheritDoc
     */
    public function preview_image(): string
    {
       return 'brand/choose-brand-one.png';
    }

    /**
     * @inheritDoc
     */
    public function addon_title()
    {
        return __('Choose Brand: 01');
    }

    /**
     * @inheritDoc
     */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Write Section Title'),
            'value' => $widget_saved_values['section_title'] ?? null,
        ]);

        $brands = Brand::select("id", "name")->pluck('name','id')->toArray();
        $output .= NiceSelect::get([
            'name' => 'brands',
            'multiple' => true,
            'label' => __('Brands'),
            'placeholder' =>  __('Select Brand'),
            'options' => $brands,
            'value' => $widget_saved_values['brands'] ?? null,
            'info' => __('you can select item for brands, if you want to show like demo brands then leave it empty')
        ]);

        // add padding option
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * @inheritDoc
     */
    public function frontend_render()
    {
        $settings = $this->get_settings();
        $section_title = SanitizeInput::esc_html($settings['section_title']);
        $selected_brands = $settings['brands'] ?? [];

        $brands = Brand::withCount("products")->with("logo")->when(!empty($selected_brands), function ($brandQuery) use (
            $selected_brands
        ) {
            $brandQuery->whereIn("id", $selected_brands);
        })->when(empty($selected_brands), function ($brandQuery) use (
            $selected_brands
        ) {
            $brandQuery->limit(8);
        })->orderByDesc("products_count")->get();


        return $this->renderBlade("brand.choose-brand-one", compact("brands","section_title"));
    }
}