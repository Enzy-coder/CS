<?php

namespace App\PageBuilder\Addons\banners;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Repeater;
use App\PageBuilder\Helpers\RepeaterField;
use App\PageBuilder\PageBuilderBase;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;

class BannerStyleSeven extends PageBuilderBase
{
    public function addon_title(): array|string|Translator|Application|null
    {
        return __('Banner Style: 07');
    }

    public function preview_image(): string
    {
        return 'banners/style-07.png';
    }

    public function admin_render(): string
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Repeater::get([
            'multi_lang' => false,
            'settings' => $widget_saved_values,
            'id' => 'banner_seven',
            'fields' => [
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'title',
                    'label' => __('Title'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'sub_title',
                    'label' => __('Sub Title'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'description',
                    'label' => __('Sort Description'),
                ],
                [
                    'type' => RepeaterField::IMAGE,
                    'name' => 'image',
                    'label' => __('Icon Image'),
                    'dimensions' => '255×132',
                ],
                [
                    'type' => RepeaterField::COLOR_PICKER,
                    'name' => 'background',
                    'label' => __('Select Color'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_text',
                    'label' => __('Button Text'),
                ],
                [
                    'type' => RepeaterField::TEXT,
                    'name' => 'btn_url',
                    'label' => __('Button URL'),
                ],
            ],
        ]);

        $output .= $this->paddings($widget_saved_values);
        $output .= $this->admin_form_submit_button();
        $output .= $this->admin_form_end();
        $output .= $this->admin_form_after();

        return $output;
    }

    public function frontend_render(): string
    {
        $all_settings = $this->get_settings();

        $padding_top = SanitizeInput::esc_html($all_settings['padding_top']);
        $padding_bottom = SanitizeInput::esc_html($all_settings['padding_bottom']);
        $banners = $all_settings['banner_seven'] ?? [];
        $loopLength = count($banners['title_']) ?? 0;

        return $this->renderBlade('banners/style-07', compact('padding_top', 'padding_bottom', 'banners', 'loopLength'));
    }
}
