<?php

namespace Fb\Http\Controllers\Gallery;

use Fb\Jobs\Gallery\GalleryImages\DestroyImage;
use Fb\Models\Gallery\Gallery;
use Fb\Models\Gallery\GalleryImage;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Gallery\GalleryImages\StoreImage;
use Fb\Http\Requests\Gallery\GalleryImages\EditImageRequest;
use Fb\Jobs\Gallery\GalleryImages\UpdateImage;

class GalleryImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Gallery $gallery)
    {
        return view('shop.gallery_images.index', ['gallery' => $gallery]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Gallery $gallery)
    {
        return view('shop.gallery_images.create', ['gallery' => $gallery]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Gallery $gallery)
    {
        $this->dispatchFromArray(StoreImage::class, [
            'gallery' => $gallery,
            'data' => [
                'image' => [
                    'name' => $request->get('image_name'),
                    'file' => $request->file('image'),
                ],
                'mobile' => [
                    'name' => $request->get('mobile_name'),
                    'file' => $request->file('mobile')
                ],
                'is_active' => $request->get('is_active'),
                'is_featured' => $request->get('is_featured'),
            ]
        ]);
        return Redirect::route('admin.galleries.edit', ['galleries' => $gallery->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, GalleryImage $image)
    {
        return view('shop.gallery_images.show', ['gallery' => $gallery, 'image' => $image]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery, GalleryImage $image)
    {
        return view('shop.gallery_images.edit', ['gallery' => $gallery, 'image' => $image]);
    }

    public function update(EditImageRequest $request, Gallery $gallery, GalleryImage $image)
    {
        $this->dispatchFromArray(UpdateImage::class, [
            'gallery' => $gallery,
            'image' => $image,
            'data' => [
                'image' => [
                    'name' => $request->get('image_name'),
                    'file' => $request->file('image')?$request->file('image')->getClientOriginalExtension():null
                ],
                'mobile' => [
                    'name' => $request->get('mobile_name'),
                    'file' => $request->file('mobile')?$request->file('mobile')->getClientOriginalExtension():null
                ],
                'is_active' => $request->get('is_active'),
            ]
        ]);
        return Redirect::route('admin.galleries.edit', ['galleries' => $gallery->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, GalleryImage $images)
    {
        $this->dispatchFromArray(DestroyImage::class, [
            'gallery' => $gallery,
            'image' => $image,
        ]);
        return Redirect::route('admin.galleries.edit', ['galleries' => $gallery->slug]);
    }
}
