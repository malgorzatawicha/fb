<?php

namespace Fb\Http\Controllers\Front;

use Fb\Models\Cms\Page;
use Illuminate\Http\Request;

use Fb\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Redirect;
use Illuminate\Support\Facades\App;

class MainController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.main.index');
    }

    public function page(Page $pages, $isPreview = false)
    {
        if (!$pages->active && (!Auth::check() || !$isPreview)) {
            return App::abort(404);
        }

        return view('front.main.page');
    }
}
