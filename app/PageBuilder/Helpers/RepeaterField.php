<?php


namespace App\PageBuilder\Helpers;


class RepeaterField
{
    public const TEXT = 'Text';
    public const TEXTAREA = 'Textarea';
    public const EMAIL = 'Email';
    public const ICON_PICKER = 'IconPicker';
    public const COLOR_PICKER = 'ColorPicker';
    public const IMAGE = 'Image';
    public const IMAGE_GALLERY = 'ImageGallery';
    public const NICE_SELECT = 'NiceSelect';
    public const SELECT = 'Select';
    public const SUMMERNOTE = 'Summernote';
    public const SWITCHER = 'Switcher';
    public const NUMBER = 'Number';

    public static function remove_default_fields($all_settings){
        $arr = ['id', 'addon_name','addon_type','addon_location','addon_order','addon_page_id','addon_page_type'];
        foreach($arr as $ar){
            if(isset($all_settings[$ar])){
                unset($all_settings[$ar]);
            }
        }
        //unset($all_settings['id'], $all_settings['addon_name'], $all_settings['addon_type'], $all_settings['addon_location'], $all_settings['addon_order'], $all_settings['addon_page_id'], $all_settings['addon_page_type']);
        return $all_settings;
    }
}