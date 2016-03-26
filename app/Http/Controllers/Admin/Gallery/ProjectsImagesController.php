<?php

namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\GalleryProject;
use Fb\Models\Gallery\GalleryProjectImage;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Http\Requests\Galleries\ProjectImages\CreateImageRequest;
use Fb\Http\Requests\Galleries\ProjectImages\EditImageRequest;
use Fb\Jobs\Gallery\ProjectImages\StoreImage;
use Fb\Jobs\Gallery\ProjectImages\UpdateImage;
use Fb\Jobs\Gallery\ProjectImages\DestroyImage;

class ProjectsImagesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateImageRequest  $request
     * @param GalleryCategory $categories
     * @param GalleryProject $projects
     * @return \Illuminate\Http\Response
     */
    public function store(CreateImageRequest $request, GalleryCategory $categories, GalleryProject $projects)
    {
        $this->dispatchFromArray(StoreImage::class, [
            'project' => $projects,
            'request' => $request
        ]);
        return Redirect::route('admin.gallery.categories.projects.edit', ['categories' => $categories, 'projects' => $projects]);
    }

    public function update(EditImageRequest $request, GalleryCategory $categories, GalleryProject $projects, $imageId)
    {
        $image = GalleryProjectImage::findOrFail($imageId);
        $this->dispatchFromArray(UpdateImage::class, [
            'project' => $projects,
            'image' => $image,
            'request' => $request
        ]);
        return Redirect::route('admin.gallery.categories.projects.edit', ['categories' => $categories, 'projects' => $projects]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $imageId
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryCategory $categories, GalleryProject $projects, $imageId)
    {
        $image = GalleryProjectImage::findOrFail($imageId);
        $this->dispatchFromArray(DestroyImage::class, ['image' => $image]);
        return Redirect::route('admin.gallery.categories.projects.edit', ['categories' => $categories, 'projects' => $projects]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page, $bannerId)
    {
        $banner = Banner::findOrFail($bannerId);
        return view('admin.cms.pages.banners.show', ['page' => $page, 'banner' => $banner]);
    }
}
