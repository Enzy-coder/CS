<?php

namespace App\PageBuilder\Addons\Example;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\PageBuilderBase;

class ExampleAddonStyleOne extends PageBuilderBase
{
    public function preview_image(): string
    {
        return 'example/example-style-01.jpg';
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
        ]);

        $output .= Summernote::get([
            'name' => 'description',
            'label' => __('Description'),
            'value' => $widget_saved_values['description'] ?? null,
        ]);

        $output .= Image::get([
            'name' => 'section_image',
            'label' => __('Section Image'),
            'value' => $widget_saved_values['section_image'] ?? null,
        ]);

        $output .= Select::get([
            'name' => 'image_position',
            'label' => __('Image Position'),
            'value' => $widget_saved_values['image_position'] ?? null,
            'options' => [
                'right' => __('Right'),
                'left' => __('Left'),
            ],
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render()
    {
        $settings = $this->get_settings();

        $section_data = [
            'title' => SanitizeInput::esc_html($settings['title']),
            'description' => SanitizeInput::kses_basic($settings['description']),
            'section_image' => SanitizeInput::esc_html($settings['section_image']),
            'image_position' => SanitizeInput::esc_html($settings['image_position']),
        ];

        return $this->renderBlade('example.example-style-one', $section_data);
    }

    public function addon_title()
    {
        return __('Example Addon');
    }
}
