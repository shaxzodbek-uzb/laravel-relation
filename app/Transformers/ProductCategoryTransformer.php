<?php
namespace App\Transformers;

use App\Models\ProductCategory;
use League\Fractal\TransformerAbstract;

class ProductCategoryTransformer extends TransformerAbstract
{
	public function transform(ProductCategory $productCategory) {
        return [
            'id'      => (int) $productCategory->id,
            'name'   => $productCategory->name
        ];
    }
}
