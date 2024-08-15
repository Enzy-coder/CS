<?php

namespace Modules\Blog\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogTag extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    protected static function newFactory()
    {
        return \Modules\Blog\Database\factories\BlogtagFactory::new();
    }
}
