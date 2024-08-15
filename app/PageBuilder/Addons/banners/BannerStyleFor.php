<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\MediaUpload;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleFor extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 04');
    }

    public function preview_image()
    {
        return 'banners/style-04.png';
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
            'id' => 'banner_style_for',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Banner Image'),
                    'dimensions' => '405×250'
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('Banner URL'),
                ],
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
        $banner_style_for = $all_settings['banner_style_for'];

        $images = MediaUpload::whereIn("id", $banner_style_for["image_"] ?? [0])->get();

        return $this->renderBlade("banners/style-04", compact("padding_top","padding_bottom", "banner_style_for","images"));
    }
}