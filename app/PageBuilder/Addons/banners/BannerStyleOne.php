<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleOne extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 01');
    }

    public function preview_image()
    {
        return 'banners/01.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'header_slider',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'subtitle',
                    'label' => __('Subtitle'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_text',
                    'label' => __('Button Text'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_url',
                    'label' => __('Button Url'),
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Slider Image'),
                ],
//                [
//                    'type' => RepeaterField::COLOR_PICKER,
//                    'name' => 'bg_color',
//                    'label' => __('Background Color'),
//                ],
//                [
//                    'type' => RepeaterField::COLOR_PICKER,
//                    'name' => 'shape_color',
//                    'label' => __('Shape Color'),
//                ],
            ]
        ]);

        $output .= $this->paddings($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $all_settings = $this->get_settings();
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $banners = RepeaterField::remove_default_fields($all_settings)["header_slider"] ?? [];

        return $this->renderBlade("banners/style-01", compact("banners"));
    }
}