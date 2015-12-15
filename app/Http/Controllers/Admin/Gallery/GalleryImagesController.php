<?php

namespace Fb\Http\Controllers\Admin\Gallery;

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
        return Redirect::route('admin.gallery.galleries.edit', ['galleries' => $gallery->slug]);
    }

    public function update(EditImageRequest $request, Gallery $gallery, $imageId)
    {
        $image = GalleryImage::findOrFail($imageId);
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
        return Redirect::route('admin.gallery.galleries.edit', ['galleries' => $gallery->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery, $imageId)
    {
        $image = GalleryImage::findOrFail($imageId);
        $this->dispatchFromArray(DestroyImage::class, [
            'gallery' => $gallery,
            'image' => $image,
        ]);
        return Redirect::route('admin.gallery.galleries.edit', ['galleries' => $gallery->slug]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery, $imageId)
    {
        $image = GalleryImage::findOrFail($imageId);
        return view('admin.gallery.galleries.images.show', ['gallery' => $gallery, 'image' => $image]);
    }
}
