<?php

namespace App\PageBuilder\Addons\AboutSection;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Select;
use App\PageBuilder\Fields\Summernote;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

class AboutSectionStyleOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     *
     * @since 1.0.0
     * */
    public function preview_image(): string
    {
        return 'about-section/01.png';
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     *
     * @since 1.0.0
     * */
    public function addon_title(): array|string|Translator|Application|null
    {
        return __('About Area: 01');
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     *
     * @since 1.0.0
     * */
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

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     *
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        $section_data = [
            'title' => SanitizeInput::esc_html($settings['title']),
            'description' => SanitizeInput::kses_basic($settings['description']),
            'section_image' => SanitizeInput::esc_html($settings['section_image']),
            'image_position' => SanitizeInput::esc_html($settings['image_position']),
        ];

        return $this->renderBlade('about.about_style_one', $section_data);
    }
}
