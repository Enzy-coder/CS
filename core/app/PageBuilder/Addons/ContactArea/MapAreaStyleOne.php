<?php

namespace App\PageBuilder\Addons\ContactArea;

use App\Helpers\SanitizeInput;
use App\PageBuilder\Fields\Image;
use App\PageBuilder\Fields\Text;
use App\PageBuilder\Helpers\Traits\RepeaterHelper;
use App\PageBuilder\PageBuilderBase;

class MapAreaStyleOne extends PageBuilderBase
{
    use RepeaterHelper;

    /**
     * preview_image
     * this method must have to implement by all widget to show a preview image at admin panel so that user know about the design which he want to use
     *
     * @since 1.0.0
     * */
    public function preview_image()
    {
        return 'map-area/01.png';
    }

    /**
     * widget_title
     * this method must have to implement by all widget to register widget title
     *
     * @since 1.0.0
     * */
    public function addon_title()
    {
        return __('Map Area: 01');
    }

    /**
     * admin_render
     * this method must have to implement by all widget to render admin panel widget content
     *
     * @since 1.0.0
     * */
    public function admin_render()
    {
        $output = $this->admin_form_before();
        $output .= $this->admin_form_start();
        $output .= $this->default_fields();
        $widget_saved_values = $this->get_settings();

        $output .= Text::get([
            'name' => 'location',
            'label' => __('Location'),
            'value' => $widget_saved_values['location'] ?? null,
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
        $all_settings = $this->get_settings();
        $location = SanitizeInput::esc_html($all_settings['location']);
        $location = sprintf(
            '<div class="container elementor-custom-embed"><iframe class="w-100" src="https://maps.google.com/maps?q=%s&amp;t=m&amp;z=%d&amp;output=embed&amp;iwloc=near" aria-label="%s"></iframe></div>',
            rawurlencode($location),
            10,
            $location
        );

        return <<<HTML
        <div class="google-map-area padding-top-50 padding-bottom-100">
            {$location}
        </div>
HTML;
    }
}
