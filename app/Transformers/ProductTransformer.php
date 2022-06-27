<?php
namespace App\Transformers;

use App\Models\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    // /**
    //  * List of resources to automatically include
    //  *
    //  * @var array
    //  */
    // protected array $defaultIncludes = [
    //     'categories'
    // ];
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = ['categories'];

	public function transform(Product $product) {
        return [
            'id'      => (int) $product->id,
            'name'   => $product->name,
            'links'   => [
                'self' => '/products/'.$product->id,
            ]
        ];
    }
        /**
     * Include Author
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeCategories(Product $product)
    {
        // $author = [];

        return $this->collection($product->productCategories, new ProductCategoryTransformer);
    }
}
