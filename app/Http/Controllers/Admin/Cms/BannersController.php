<?php

namespace Fb\Http\Controllers\Admin\Cms;

use Fb\Jobs\Cms\Banners\DestroyBanner;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Cms\Banners\StoreBanner;
use Fb\Http\Requests\Cms\Banners\EditBannerRequest;
use Fb\Http\Requests\Cms\Banners\CreateBannerRequest;
use Fb\Jobs\Cms\Banners\UpdateBanner;

class BannersController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBannerRequest $request, Page $page)
    {
        $this->dispatchFromArray(StoreBanner::class, [
            'page' => $page,
            'data' => [
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'image' => $request->file('image'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
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
