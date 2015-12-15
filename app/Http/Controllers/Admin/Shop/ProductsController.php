<?php

namespace Fb\Http\Controllers\Admin\Shop;

use Fb\Http\Requests\Shop\Products\EditProductRequest;
use Fb\Jobs\Shop\Products\DestroyProduct;
use Fb\Jobs\Shop\Products\StoreProduct;
use Fb\Jobs\Shop\Products\UpdateProduct;
use Fb\Jobs\Shop\Products\ActivateProduct;
use Fb\Jobs\Shop\Products\DeactivateProduct;
use Fb\Models\Shop\Product;
use Illuminate\Http\Request;

use Fb\Http\Requests\Shop\Products\CreateProductRequest;
use Fb\Http\Controllers\Controller;
use Redirect;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.shop.products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shop.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        $this->dispatchFromArray(StoreProduct::class, ['data' => $request->all()]);

        return Redirect::route('admin.shop.products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('admin.shop.products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.shop.products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditProductRequest  $request
     * @param  Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(EditProductRequest $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $this->dispatchFromArray(
            UpdateProduct::class,
            [
                'product' => $product,
                'data' => $request->all()
            ]
        );

        return Redirect::route('admin.shop.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->dispatchFromArray(DestroyProduct::class,['product' => $product]);

        return Redirect::route('admin.shop.products.index');
    }


    public function activate(Product $product)
    {
        $this->dispatchFromArray(ActivateProduct::class, ['product' => $product]);
        return Redirect::route('admin.shop.products.index');
    }

    public function deactivate(Product $product)
    {
        $this->dispatchFromArray(DeactivateProduct::class, ['product' => $product]);
        return Redirect::route('admin.shop.products.index');
    }
}
