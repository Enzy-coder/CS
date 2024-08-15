<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleTwo extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 02');
    }

    public function preview_image()
    {
        return 'banners/02.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'banner_title',
            'label' => __('Title'),
            'value' => $widget_saved_values["banner_title"] ?? ""
        ]);

        $output .= Text::get([
            'name' => 'banner_sub_title',
            'label' => __('Sub Title'),
            'value' => $widget_saved_values["banner_sub_title"] ?? ""
        ]);

        $output .= Image::get([
            'name' => 'banner_image',
            'label' => __('Banner Image'),
            'value' => $widget_saved_values["banner_image"] ?? ""
        ]);

        $output .= Text::get([
            'name' => 'btn_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values["btn_text"] ?? ""
        ]);

        $output .= Text::get([
            'name' => 'btn_url',
            'label' => __('Button URL'),
            'value' => $widget_saved_values["btn_url"] ?? ""
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
        $banner_title = SanitizeInput::esc_html($all_settings['banner_title']);
        $banner_sub_title = SanitizeInput::esc_html($all_settings['banner_sub_title']);
        $banner_image = SanitizeInput::esc_html($all_settings['banner_image']);
        $btn_text = SanitizeInput::esc_html($all_settings['btn_text']);
        $btn_url = SanitizeInput::esc_html($all_settings['btn_url']);

        return $this->renderBlade("banners/style-02", compact("padding_top","padding_bottom","banner_image","banner_title","banner_sub_title","btn_text","btn_url"));
    }
}