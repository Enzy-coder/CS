<?php


namespace App\PageBuilder\Addons\Brand;
use App\Brand;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\Number;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

class BrandLogoStyleOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * @inheritDoc
     */
    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Brand Slider: 01');
    }

    /**
     * @inheritDoc
     */
    public function preview_image()
    {
       return 'brand/01.jpg';
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

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'header_style_one',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'logo_image',
                    'label' => __('Background Image'),
                    'dimensions' => '255×132'
                ],
            ]
        ]);

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 50,
            'max' => 200,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 50,
            'max' => 200,
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
        return $this->renderBlade('brand.brand_style_one');
    }
}