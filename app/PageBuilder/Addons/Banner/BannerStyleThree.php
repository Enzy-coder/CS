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

class BannerStyleThree extends PageBuilderBase
{
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Banner Style: 03');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image() : string
    {
        return 'banner/03.png';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render() : string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

//        left
        $output .= '<div class="all-field-wrap">';
        $output .= Text::get([
            'name' => 'left_subtitle',
            'label' => __('Left Subtitle'),
            'value' => $widget_saved_values['left_subtitle'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'left_title',
            'label' => __('Left Title'),
            'value' => $widget_saved_values['left_title'] ?? null,
            'info' => __('To break line use ') . '<b>[brk]</b>',
        ]);
        $output .= Text::get([
            'name' => 'left_discount_text',
            'label' => __('Left Discount Text'),
            'value' => $widget_saved_values['left_discount_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'left_button_text',
            'label' => __('Left Button Text'),
            'value' => $widget_saved_values['left_button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'left_button_url',
            'label' => __('Left Button URL'),
            'value' => $widget_saved_values['left_button_url'] ?? null,
            'info' => 'If you want to use root path like <br><b><span style="color: #00B106">domain-name.com/Your URL</span></b> use this tag <b>[url/]</b>'
        ]);
        $output .= Image::get([
            'name' => 'left_background_image',
            'label' => __('Left Background Image'),
            'value' => $widget_saved_values['left_background_image'] ?? null,
        ]);
        $output .= '</div>';

//        right
        $output .= '<div class="all-field-wrap">';
        $output .= Text::get([
            'name' => 'right_subtitle',
            'label' => __('Right Subtitle'),
            'value' => $widget_saved_values['right_subtitle'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'right_title',
            'label' => __('Right Title'),
            'value' => $widget_saved_values['right_title'] ?? null,
            'info' => __('To break line use ') . '<b>[brk]</b>',
        ]);
        $output .= Text::get([
            'name' => 'right_discount_text',
            'label' => __('Right Discount Text'),
            'value' => $widget_saved_values['right_discount_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'right_button_text',
            'label' => __('Right Button Text'),
            'value' => $widget_saved_values['right_button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'right_button_url',
            'label' => __('Right Button URL'),
            'value' => $widget_saved_values['right_button_url'] ?? null,
            'info' => 'If you want to use root path like <br><b><span style="color: #00B106">domain-name.com/Your URL</span></b> use this tag <b>[url/]</b>'
        ]);
        $output .= Image::get([
            'name' => 'right_background_image',
            'label' => __('Right Background Image'),
            'value' => $widget_saved_values['right_background_image'] ?? null,
        ]);
        $output .= '</div>';

        $output .= Slider::get([
            'name' => 'padding_top',
            'label' => __('Padding Top'),
            'value' => $widget_saved_values['padding_top'] ?? 290,
            'max' => 500,
        ]);
        $output .= Slider::get([
            'name' => 'padding_bottom',
            'label' => __('Padding Bottom'),
            'value' => $widget_saved_values['padding_bottom'] ?? 303,
            'max' => 500,
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
        $section_data = [
            'left_subtitle' => SanitizeInput::esc_html($this->setting_item('left_subtitle')),
            'left_title' => SanitizeInput::esc_html($this->setting_item('left_title')),
            'left_discount_text' => SanitizeInput::esc_html($this->setting_item('left_discount_text')),
            'left_button_text' => SanitizeInput::esc_html($this->setting_item('left_button_text')),
            'left_button_url' => SanitizeInput::esc_html($this->setting_item('left_button_url')),
            'left_background_image' => SanitizeInput::esc_html($this->setting_item('left_background_image')),
            'right_subtitle' => SanitizeInput::esc_html($this->setting_item('right_subtitle')),
            'right_title' => SanitizeInput::esc_html($this->setting_item('right_title')),
            'right_discount_text' => SanitizeInput::esc_html($this->setting_item('right_discount_text')),
            'right_button_text' => SanitizeInput::esc_html($this->setting_item('right_button_text')),
            'right_button_url' => SanitizeInput::esc_html($this->setting_item('right_button_url')),
            'right_background_image' => SanitizeInput::esc_html($this->setting_item('right_background_image')),
            'padding_top' => SanitizeInput::esc_html($this->setting_item('padding_top')),
            'padding_bottom' => SanitizeInput::esc_html($this->setting_item('padding_bottom')),
        ];

        return $this->renderBlade('banner.banner_style_three', $section_data);
    }
}
