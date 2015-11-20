<?php

namespace Fb\Http\Controllers\Shop;

use Fb\Models\Shop\Product;
use Fb\Models\Shop\ProductImage;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Shop\ProductImages\StoreImage;

class ProductImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        return view('shop.product_images.index', ['product' => $product]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Product $product)
    {
        return view('shop.product_images.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Product $product)
    {
        $this->dispatchFromArray(StoreImage::class, [
            'product' => $product,
            'data' => [
                'image_name' => $request->get('image_name'),
                'image_extension' => $request->file('image')->getClientOriginalExtension(),
                'mobile_image_name' => $request->get('mobile_image_name'),
                'mobile_extension' => $request->file('mobile_image')->getClientOriginalExtension(),
                'active' => $request->get('active'),
                'is_featured' => $request->get('is_featured'),
                'image_file' => \Input::file('image'),
                'mobile_file' => \Input::file('mobile_image')
            ]
        ]);
        return Redirect::route('admin.products.images.index', ['products' => $product->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, ProductImage $image)
    {
        return view('shop.product_images.show', ['product' => $product, 'image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
