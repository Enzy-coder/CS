<?php


namespace App\PageBuilder\Addons\Banner;


use App\Helpers\LanguageHelper;
use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\ColorPicker;
use App\PageBuilder\Fields\IconPicker;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Fields\Slider;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Fields\Textarea;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class BannerStyleNine extends PageBuilderBase
{
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Banner Style: 09');
    }

    /**
     * preview_image
     * this method must have to implement by all widgets to show a preview image at an admin panel so that user knows about the design which he wants to use
     * @since 1.0.0
     * */
    public function preview_image() : string
    {
        return 'banner/07.jpg';
    }

    /**
     * admin_render
     * this method must have to implement by all widgets to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render() : string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();
        
        $output .= "<h3>". __("Section One") ."</h3>";

        $output .= Text::get([
            'name' => 'section_one_title',
            'label' => __('Title'),
            'value' => $widget_saved_values['section_one_title'] ?? null,
            'placeholder' => __("Section one title")
        ]);

        $output .= Text::get([
            'name' => 'section_one_sub_title',
            'label' => __('Sub title'),
            'value' => $widget_saved_values['section_one_sub_title'] ?? null,
            'placeholder' => __("Section one sub title")
        ]);

        $output .= Text::get([
            'name' => 'section_one_button_text',
            'label' => __('Button text'),
            'value' => $widget_saved_values['section_one_button_text'] ?? null,
            'placeholder' => __("Section one button text")
        ]);

        $output .= Text::get([
            'name' => 'section_one_button_url',
            'label' => __('Button url'),
            'value' => $widget_saved_values['section_one_button_url'] ?? null,
            'placeholder' => __("Section one button url")
        ]);

        $output .= Image::get([
            'name' => 'section_one_image',
            'label' => __('Image'),
            'value' => $widget_saved_values['section_one_image'] ?? null,
            'info'  => __("Recommended image size 264X276px")
        ]);

        $output .= "<h3>". __("Section Two") ."</h3>";

        $output .= Text::get([
            'name' => 'section_two_title',
            'label' => __('Title'),
            'value' => $widget_saved_values['section_two_title'] ?? null,
        ]);

        $output .= Text::get([
            'name' => 'section_two_sub_title',
            'label' => __('Sub title'),
            'value' => $widget_saved_values['section_two_sub_title'] ?? null,
        ]);


        $output .= Image::get([
            'name' => 'section_two_image',
            'label' => __('Image'),
            'value' => $widget_saved_values['section_two_image'] ?? null,
            'info'  => __("Recommended image size 465X253px")
        ]);

        $output .= "<h3>". __("Section Three") ."</h3>";

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'banner_style_nine_repeater',
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
                    'name' => 'button_text',
                    'label' => __('Button Text'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'button_url',
                    'label' => __('Button URL'),
                    'info' => 'If you want to use root path like <br><b><span style="color: #00B106">domain-name.com/Your URL</span></b> use this tag <b>[url/]</b>'
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'background_image',
                    'label' => __('Background Image'),
                    'info'=>__('Recommended image size 510X712px'),
                ],
            ]
        ]);

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widget to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();
        $section_one_title = SanitizeInput::esc_html($this->setting_item('section_one_title'));
        $section_one_sub_title = SanitizeInput::esc_html($this->setting_item('section_one_sub_title'));
        $section_one_button_text = SanitizeInput::esc_html($this->setting_item('section_one_button_text'));
        $section_one_button_url = SanitizeInput::esc_html($this->setting_item('section_one_button_url'));
        $section_one_image = SanitizeInput::esc_html($this->setting_item('section_one_image'));
        $section_two_title = SanitizeInput::esc_html($this->setting_item('section_two_title'));
        $section_two_sub_title = SanitizeInput::esc_html($this->setting_item('section_two_sub_title'));
        $section_two_image = SanitizeInput::esc_html($this->setting_item('section_two_image'));
        $repeater = $settings['banner_style_nine_repeater'] ?? [];
 
        return $this->renderBlade('banner.banner_style_nine', compact(
            'section_one_title',
            'section_one_sub_title',
            'section_one_button_text',
            'section_one_button_url',
            'section_one_image',
            'section_two_title',
            'section_two_sub_title',
            'section_two_image',
            'settings', 'repeater'));
    }
}
