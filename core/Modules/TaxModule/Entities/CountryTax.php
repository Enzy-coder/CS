<?php

namespace Modules\TaxModule\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\CountryManage\Entities\Country;

class CountryTax extends Model
{
    use HasFactory;

    protected $fillable = [
        'country_id',
        'tax_percentage',
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    protected static function newFactory()
    {
        return \Modules\TaxModule\Database\factories\CountryTaxFactory::new();
    }
}
