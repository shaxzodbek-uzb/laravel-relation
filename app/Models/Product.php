<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];
    // attach observer
    protected static function booted()
    {
        static::observe(ProductObserver::class);
    }
    public function productDetail()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }
    public function currentPrice()
    {
        return $this->hasOne(Price::class)->latestOfMany();
    }

    public function productCategories()
    {
        return $this->belongsToMany(ProductCategory::class);
    }
    
    public function images()
    {
        return $this->morphToMany(Image::class, 'imageble');
    }

}
