<?php

namespace Fb\Http\Controllers\Admin;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Redirect;
use Fb\Models\Site;
use Fb\Http\Requests\Site\EditSiteRequest;
use Fb\Jobs\Site\UpdateSite;

class SiteController extends Controller
{
    public function edit()
    {
        return view('admin.site.edit', ['site' => $this->getSite()]);
    }

    public function update(EditSiteRequest $request)
    {
        $site = $this->getSite();
        $this->dispatchFromArray(UpdateSite::class, [
            'site' => $site,
            'data' => [
                'title' => $request->get('title'),
                'description' => $request->get('description'),
                'keywords' => $request->get('keywords'),
                'breadcrumb' => $request->get('breadcrumb', 'Home'),
                'footer' => $request->get('footer'),
                'favicon' => $request->file('favicon'),
                'favicon_exists' => $request->get('favicon_existing'),
                'banner' => $request->file('banner'),
                'banner_exists' => $request->get('banner_existing'),
            ]
        ]);
        return Redirect::route('admin.site.edit');
    }

    private function getSite()
    {
        return Site::firstOrNew([]);
    }
}