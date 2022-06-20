<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'url',
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function products()
    {
        return $this->morphedByMany(Product::class, 'imageble');
    }

    public function productCategories()
    {
        return $this->morphedByMany(ProductCategory::class, 'imageble');
    }
}
