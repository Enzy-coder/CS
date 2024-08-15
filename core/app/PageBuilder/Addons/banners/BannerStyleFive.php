<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\MediaUpload;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleFive extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 05');
    }

    public function preview_image()
    {
        return 'banners/style-05.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'image',
            'label' => __('Banner Image'),
            'value' => $widget_saved_values['banner_image'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Banner Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'sub_title',
            'label' => __('Banner Sub Title'),
            'value' => $widget_saved_values['sub_title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'button_text',
            'label' => __('Banner Button Text'),
            'value' => $widget_saved_values['button_text'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Banner Button URL'),
            'value' => $widget_saved_values['button_url'] ?? null,
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
        $image = SanitizeInput::esc_html($all_settings['image']);
        $title = SanitizeInput::esc_html($all_settings['title']);
        $sub_title = SanitizeInput::esc_html($all_settings['sub_title']);
        $button_text = SanitizeInput::esc_html($all_settings['button_text']);
        $button_url = SanitizeInput::esc_html($all_settings['button_url']);

        return $this->renderBlade("banners/style-05", compact("padding_top","padding_bottom", "image","title","sub_title","button_url","button_text"));
    }
}