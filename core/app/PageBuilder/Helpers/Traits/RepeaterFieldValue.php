<?php


namespace App\PageBuilder\Helpers\Traits;


use App\PageBuilder\Helpers\RepeaterField;

trait RepeaterFieldValue
{
    public function get_repeater_value($repeater_id){
        $return_val = [];
        $repeater_values = RepeaterField::remove_default_fields($this->get_settings());
        foreach ($repeater_values as $key => $setting) {
            if (is_array($setting)) {
                $this->args['repeater'] = $setting;
                $array_lang_item = $setting[array_key_last($setting)];
                if (!empty($array_lang_item) && is_array($array_lang_item) && count($array_lang_item) > 0) {
                    foreach ($array_lang_item as $index => $value) {
                        $output .= $this->render_slider_markup($index); // for multiple array index
                    }
                } else {
                    $output .= $this->render_slider_markup(); // for only one index of array
                }
            }
        }
    }
}