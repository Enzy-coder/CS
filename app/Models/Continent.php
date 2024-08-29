<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\CountryManage\Entities\Country;

class Continent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'description', 
        'status', 
        'header_image'
    ];
    public function regions()
    {
        return $this->hasMany(Country::class)->orderby('continent_id','asc')->limit(5);
    }
}
