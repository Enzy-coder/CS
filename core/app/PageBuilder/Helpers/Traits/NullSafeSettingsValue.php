<?php


namespace App\PageBuilder\Helpers\Traits;


trait NullSafeSettingsValue
{
    public function setting_item($item){
        $settings = $this->get_settings();
        return $settings[$item] ?? null;
    }
}