<?php

namespace Fb\Http\Controllers\Admin;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Redirect;
use Fb\Models\Site;

class SiteController extends Controller
{
    public function edit()
    {
        return view('admin.site.edit', ['site' => Site::first()]);
    }

    public function update()
    {
    }
}