<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Transformers\ProductTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Manager;

class ProductController extends Controller
{

    public function __construct() {
        $this->middleware('permission:index-products')->only('index');
        $this->middleware('permission:update-products')->only(['edit', 'update']);
        $this->middleware('permission:store-products')->only('store');

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $user->hasPermission('product-index');
        // $response = Gate::inspect('viewAny', Product::class);
        // if(!$response->allowed()) {
        //     return redirect()->route('home')->with([
        //         'errors' => 
        //             'You do not have permission to access this page'
        //         ]);
        // }
        // $paginator = Product::paginate();
        // $products = $paginator->getCollection();   

        // $resource = new Collection($products, new  ProductTransformer);
        // $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        
        // return app(Manager::class)->createData($resource)->toArray();

        $products = Product::paginate();
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->all());
        return $product;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        $resource = new Item($product,new  ProductTransformer);
        
        return app(Manager::class)->createData($resource)->toArray();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if (! Gate::allows('update-product', $product)) {
            return redirect()->route('home')->with([
                'errors' => 
                    'You do not have permission to access this page'
                ]);
        }
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->update($request->all());
        return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return $product;
    }


}
