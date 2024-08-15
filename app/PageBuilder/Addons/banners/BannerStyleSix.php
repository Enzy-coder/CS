<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\MediaUpload;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleSix extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 06');
    }

    public function preview_image()
    {
        return 'banners/style-06.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'left_image',
            'label' => __('Left Image'),
            'value' => $widget_saved_values['left_image'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'right_image',
            'label' => __('Right Image'),
            'value' => $widget_saved_values['right_image'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'url',
            'label' => __('Title URL'),
            'value' => $widget_saved_values['url'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'sub_title',
            'label' => __('Sub Title'),
            'value' => $widget_saved_values['sub_title'] ?? null,
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'icon_images',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Icon Image'),
                    'dimensions' => '255×132'
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('Icon Image URL'),
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
        $left_image = SanitizeInput::esc_html($all_settings['left_image']);
        $right_image = SanitizeInput::esc_html($all_settings['right_image']);
        $title = SanitizeInput::esc_html($all_settings['title']);
        $sub_title = SanitizeInput::esc_html($all_settings['sub_title']);
        $url = SanitizeInput::esc_html($all_settings['url']);
        $icons = $all_settings["icon_images"];
        $images = MediaUpload::whereIn("id", $icons["image_"])->get();

        return $this->renderBlade("banners/style-06", compact("padding_top","padding_bottom","url", "left_image", "right_image","title","sub_title","images","icons"));
    }
}