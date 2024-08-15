<?php

namespace Modules\Vendor\Http\Services;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class DummyVendorDeleteServices{
    private static array $vendors = [201,202,203,204,205,206,207,208,209,210,211,212,213,214,215,216,217,218,219,220,224,225,226,227,228,229,230,231,232,233,234,235];


    public static function dummyVendorId(): array
    {
        return self::$vendors;
    }

    public static function destroy(): bool
    {
        $delete=DB::table("vendors")->whereIn('id',self::dummyVendorId())->delete();
        if($delete){
            return true;
        }
        return false;
    }
}