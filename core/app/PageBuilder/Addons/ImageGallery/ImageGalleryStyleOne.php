<?php

namespace App\PageBuilder\Addons\ImageGallery;

use App\Blog;
use App\Helpers\SanitizeInput;
use App\MediaUpload;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;

class ImageGalleryStyleOne extends PageBuilderBase
{
    public function addon_title()
    {
        return __('Gallery Image: 01');
    }

    public function preview_image(): string
    {
        return 'gallery-image/style-01.jpg';
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'section_title',
            'label' => __('Title'),
            'value' => $widget_saved_values["section_title"] ?? ""
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'gallery_images',
            'fields' => [
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Gallery Image'),
                    'dimensions' => '255×132'
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'url',
                    'label' => __('URL'),
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
        $padding_top = SanitizeInput::esc_html($all_settings['padding_top'] ?? "");
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom'] ?? "");
        $section_title = SanitizeInput::esc_html($all_settings['section_title'] ?? "");
        $gallery_images = $all_settings["gallery_images"] ?? [];

        $images = MediaUpload::whereIn("id",$gallery_images["image_"])->get();

        return $this->renderBlade("gallery-image/style-01", compact("padding_top","padding_bottom","section_title","images","gallery_images"));
    }
}