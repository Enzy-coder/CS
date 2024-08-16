<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Attributes\Entities\Category;

class ProductCategory extends Model
{
    use HasFactory;

    protected $fillable = ["category_id","product_id",'country_id'];

    public $timestamps = false;

    public function product(){
        return $this->belongsTo(Product::class, "product_id", "id");
    }
    public function category(){
        return $this->belongsTo(Category::class, "category_id", "id");
    }
}
