<?php

namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Http\Requests\Galleries\ProjectImages\CreateImageRequest;
use Fb\Http\Requests\Galleries\ProjectImages\EditImageRequest;
use Fb\Jobs\Gallery\ProjectImages\StoreImage;
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

    public function update(EditBannerRequest $request, Page $page, $bannerId)
    {
        $banner = Banner::findOrFail($bannerId);
        $this->dispatchFromArray(UpdateBanner::class, [
            'page' => $page,
            'banner' => $banner,
            'data' => [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'image' => $request->file('image'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, $bannerId)
    {
        $banner = Banner::findOrFail($bannerId);
        $this->dispatchFromArray(DestroyBanner::class, [
            'page' => $page,
            'banner' => $banner,
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
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
