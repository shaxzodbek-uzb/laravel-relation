<?php

namespace App\CacheManager;

use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class ProductStatistics{
    public static function clear()
    {
        Cache::forget('countProducts');
    }

    public static function write()
    {
        $items = Product::with('prices')->get();
        $countProducts = $items->count();
        Cache::put('countProducts', $countProducts);
    }

    public static function read()
    {
        $countProducts = Cache::get('countProducts');
        if(is_null($countProducts)){
            self::write();
            $countProducts = Cache::get('countProducts');
        }
        return [
            'countProducts' => $countProducts
        ];
    }
}