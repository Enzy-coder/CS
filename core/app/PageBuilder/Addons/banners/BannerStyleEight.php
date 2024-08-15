<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\MediaUpload;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class BannerStyleEight extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Banner Style: 08');
    }

    public function preview_image()
    {
        return 'banners/style-08.png';
    }

    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Image::get([
            'name' => 'image',
            'label' => __('Select Image'),
            'value' => $widget_saved_values['image'] ?? null,
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
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
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

//        $output .= $this->paddings($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $all_settings = $this->get_settings();
//        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
//        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $image = SanitizeInput::esc_html($all_settings['image']);
        $title = SanitizeInput::esc_html($all_settings['title']);
        $description = SanitizeInput::esc_html($all_settings['description']);
        $url = SanitizeInput::esc_html($all_settings['url']);
        $icons = $all_settings["icon_images"];
        $images = MediaUpload::whereIn("id", $icons["image_"])->get();

        return $this->renderBlade("banners/style-08", compact("url", "image","title","description","images","icons"));
    }
}