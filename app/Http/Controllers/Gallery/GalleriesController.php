<?php

namespace Fb\Http\Controllers\Gallery;

use Fb\Http\Requests\Galleries\Gallery\EditGalleryRequest;
use Fb\Jobs\Gallery\Galleries\DestroyGallery;
use Fb\Jobs\Gallery\Galleries\StoreGallery;
use Fb\Jobs\Gallery\Galleries\UpdateGallery;
use Fb\Jobs\Gallery\Galleries\ActivateGallery;
use Fb\Jobs\Gallery\Galleries\DeactivateGallery;
use Fb\Models\Gallery\Gallery;
use Illuminate\Http\Request;

use Fb\Http\Requests\Galleries\Gallery\CreateGalleryRequest;
use Fb\Http\Controllers\Controller;
use Redirect;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('gallery.galleries.index', ['galleries' => Gallery::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gallery.galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateGalleryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateGalleryRequest $request)
    {
        $this->dispatchFromArray(StoreGallery::class, ['data' => $request->all()]);

        return Redirect::route('admin.galleries.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return view('gallery.galleries.show', ['gallery' => $gallery]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        return view('gallery.galleries.edit', ['gallery' => $gallery]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditGalleryRequest  $request
     * @param  Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(EditGalleryRequest $request, Gallery $gallery)
    {
        $this->dispatchFromArray(
            UpdateGallery::class,
            [
                'gallery' => $gallery,
                'data' => $request->all()
            ]
        );

        return Redirect::route('admin.galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Gallery $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $this->dispatchFromArray(DestroyGallery::class,['gallery' => $gallery]);

        return Redirect::route('admin.galleries.index');
    }


    public function activate(Gallery $gallery)
    {
        $this->dispatchFromArray(ActivateGallery::class, ['gallery' => $gallery]);
        return Redirect::route('admin.galleries.index');
    }

    public function deactivate(Gallery $gallery)
    {
        $this->dispatchFromArray(DeactivateGallery::class, ['gallery' => $gallery]);
        return Redirect::route('admin.galleries.index');
    }
}
