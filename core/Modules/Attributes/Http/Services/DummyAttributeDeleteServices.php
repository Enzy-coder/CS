<?php

namespace Modules\Attributes\Http\Services;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DummyAttributeDeleteServices{

    private static $attributes = [25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40];


    public static function dummyAttributeId()
    {
        return self::$attributes;
    }

    public static function destroy()
    {
        $delete=DB::table("product_attributes")->whereIn('id',self::dummyAttributeId())->delete();
        if($delete){
            return true;
        }
        return false;
    }
}