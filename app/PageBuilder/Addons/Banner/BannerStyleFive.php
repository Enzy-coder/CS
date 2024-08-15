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

class BannerStyleFive extends PageBuilderBase
{
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Banner Style: 05');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image() : string
    {
        return 'banner/05.jpg';
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

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'banner_style_five',
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
                    'name' => 'discount_text',
                    'label' => __('Discount Text'),
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
                ],
            ]
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
        $padding_top = SanitizeInput::esc_html($this->setting_item('padding_top'));
        $padding_bottom = SanitizeInput::esc_html($this->setting_item('padding_bottom'));

        return $this->renderBlade('banner.banner_style_five', compact('padding_top','padding_bottom'));
    }
}
