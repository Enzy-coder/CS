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
use App\PageBuilder\Fields\TimePicker;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class BannerStyleFour extends PageBuilderBase
{
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Banner Style: 04');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'banner/04.jpg';
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= '<div class="all-field-wrap">';

        $output .= Text::get([
            'name' => 'subtitle',
            'label' => __('Subtitle'),
            'value' => $widget_saved_values['subtitle'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'title',
            'label' => __('Title'),
            'value' => $widget_saved_values['title'] ?? null,
            'info' => __('To break line use') . ' <b>[brk]</b>',
        ]);
        $output .= TimePicker::get([
            'name' => 'end_date',
            'label' => __('End Date'),
            'value' => $widget_saved_values['end_date'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'button_text',
            'label' => __('Button Text'),
            'value' => $widget_saved_values['button_text'] ?? null,
        ]);
        $output .= Text::get([
            'name' => 'button_url',
            'label' => __('Button URL'),
            'value' => $widget_saved_values['button_url'] ?? null,
            'info' => 'If you want to use root path like <br><b><span style="color: #00B106">domain-name.com/Your URL</span></b> use this tag <b>[url/]</b>'
        ]);
        $output .= Image::get([
            'name' => 'background_image',
            'label' => __('Background Image'),
            'value' => $widget_saved_values['background_image'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'left_front_image',
            'label' => __('Left Front Image'),
            'value' => $widget_saved_values['left_front_image'] ?? null,
        ]);
        $output .= Image::get([
            'name' => 'right_front_image',
            'label' => __('Right Front Image'),
            'value' => $widget_saved_values['right_front_image'] ?? null,
        ]);

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

        $output .= '</div>';

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

        $section_data = [
            'subtitle' => SanitizeInput::esc_html($this->setting_item('subtitle')),
            'title' => SanitizeInput::esc_html($this->setting_item('title')),
            'end_date' => SanitizeInput::esc_html($this->setting_item('end_date')),
            'background_image' => SanitizeInput::esc_html($this->setting_item('background_image')),
            'left_front_image' => SanitizeInput::esc_html($this->setting_item('left_front_image')),
            'right_front_image' => SanitizeInput::esc_html($this->setting_item('right_front_image')),
            'button_text' => SanitizeInput::esc_html($this->setting_item('button_text')),
            'button_url' => SanitizeInput::esc_html($this->setting_item('button_url')),
            'padding_top' => SanitizeInput::esc_html($this->setting_item('padding_top')),
            'padding_bottom' => SanitizeInput::esc_html($this->setting_item('padding_bottom')),
        ];

        return $this->renderBlade('banner.banner_style_four', $section_data);
    }
}
