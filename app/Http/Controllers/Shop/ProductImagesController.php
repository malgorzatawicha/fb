<?php

namespace Fb\Http\Controllers\Shop;

use Fb\Jobs\Shop\ProductImages\DestroyImage;
use Fb\Models\Shop\Product;
use Fb\Models\Shop\ProductImage;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Shop\ProductImages\StoreImage;
use Fb\Http\Requests\Shop\ProductImages\EditImageRequest;
use Fb\Jobs\Shop\ProductImages\UpdateImage;

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
        return Redirect::route('admin.products.edit', ['products' => $product->slug]);
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
    public function edit(Product $product, ProductImage $image)
    {
        return view('shop.product_images.edit', ['product' => $product, 'image' => $image]);
    }

    public function update(EditImageRequest $request, Product $product, ProductImage $image)
    {
        $this->dispatchFromArray(UpdateImage::class, [
            'product' => $product,
            'image' => $image,
            'data' => [
                'image_extension' => $request->file('image')?$request->file('image')->getClientOriginalExtension():null,
                'mobile_extension' => $request->file('mobile_image')?$request->file('mobile_image')->getClientOriginalExtension():null,
                'active' => $request->get('active'),
                'is_featured' => $request->get('is_featured'),
                'image_file' => \Input::file('image'),
                'mobile_file' => \Input::file('mobile_image')
            ]
        ]);
        return Redirect::route('admin.products.images.index', ['products' => $product->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, ProductImage $image)
    {
        $this->dispatchFromArray(DestroyImage::class, [
            'product' => $product,
            'image' => $image,
        ]);
        return Redirect::route('admin.products.images.index', ['products' => $product->slug]);
    }
}
