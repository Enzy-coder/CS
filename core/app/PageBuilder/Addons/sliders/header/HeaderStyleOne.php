<?php

namespace App\PageBuilder\Addons\sliders\header;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class HeaderStyleOne extends PageBuilderBase
{

    public function preview_image(): string
    {
        return 'header/05.png';
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
                    'info' => __('If you want to wrap word withing theme color than [cl] example word [/cl] wrap your word with those')
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
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $all_settings = $this->get_settings();
        $sliders = RepeaterField::remove_default_fields($all_settings)["header_slider"] ?? [];

        return $this->renderBlade("sliders/header/style-01", compact("sliders"));
    }

    public function addon_title()
    {
        return __("Header Slider: 01");
    }
}