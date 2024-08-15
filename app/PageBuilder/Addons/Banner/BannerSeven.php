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

class BannerSeven extends PageBuilderBase
{
    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Banner: 07');
    }

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     * @since 1.0.0
     * */
    public function preview_image() : string
    {
        return 'banner/banner-07.png';
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

        $output .= "<div class='card card-body p-4'><h3>". __('Section One') ."</h3>";

        $output .= Text::get([
            "name" => "section_title",
            "label" => __("Title"),
            "value" => $widget_saved_values["section_title"] ?? "",
            "info" => __("If you want to wrap word for making bold [b] use this for making bold [/b] and if you want to break line then [/br] use this")
        ]);

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'section_one_repeater',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'section_one_title',
                    'label' => __('Section title'),
                ],
            ]
        ]);

        $output .= Text::get([
            "name" => "section_one_button_text",
            "label" => __("Button Text"),
            "value" => $widget_saved_values["section_one_button_text"] ?? "",
        ]);

        $output .= Text::get([
            "name" => "section_one_button_url",
            "label" => __("Button url"),
            "value" => $widget_saved_values["section_one_button_url"] ?? "",
        ]);

        $output .= Image::get([
            "name" => "section_one_image",
            "label" => __("Section image"),
            "value" => $widget_saved_values["section_one_image"] ?? "",
        ]);

        $output .= "</div><div class='card card-body p-4'><h3>". __('Section Two') ."</h3>";

        $output .= Text::get([
            "name" => "section_two_title",
            "label" => __("Title"),
            "value" => $widget_saved_values["section_two_title"] ?? "",
        ]);

        $output .= Image::get([
            "name" => "section_two_image",
            "label" => __("Section two image"),
            "value" => $widget_saved_values["section_two_image"] ?? "",
        ]);

        $output .= Image::get([
            "name" => "section_two_bg_image",
            "label" => __("Section two image"),
            "value" => $widget_saved_values["section_two_bg_image"] ?? "",
        ]);

        $output .= Text::get([
            "name" => "section_two_button_text",
            "label" => __("Title"),
            "value" => $widget_saved_values["section_two_button_text"] ?? "",
        ]);

        $output .= Text::get([
            "name" => "section_two_button_url",
            "label" => __("Button url"),
            "value" => $widget_saved_values["section_two_button_url"] ?? "",
        ]);

        $output .= "</div><div class='card card-body p-4'><h3>". __('Section Three') ."</h3>";

        $output .= Text::get([
            "name" => "section_three_title",
            "label" => __("Title"),
            "value" => $widget_saved_values["section_three_title"] ?? "",
        ]);

        $output .= Image::get([
            "name" => "section_three_image",
            "label" => __("Section Three image"),
            "value" => $widget_saved_values["section_three_image"] ?? "",
        ]);

        $output .= Text::get([
            "name" => "section_three_button_text",
            "label" => __("Button "),
            "value" => $widget_saved_values["section_three_button_text"] ?? "",
        ]);

        $output .= Text::get([
            "name" => "section_three_button_url",
            "label" => __("Button URL"),
            "value" => $widget_saved_values["section_three_button_url"] ?? "",
        ]);

        $output .= "</div>";

        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    /**
     * frontend_render
     * this method must have to implement by all widgets to render frontend widget content
     * @since 1.0.0
     * */
    public function frontend_render(): string
    {
        $settings = $this->get_settings();

        return $this->renderBlade('banner.banner_style_seven', $settings);
    }
}
