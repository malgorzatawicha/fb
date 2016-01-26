<?php namespace Fb\Http\Controllers\Front;

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
        $mainPage = $this->getMainPage();
        if (empty($mainPage)) {
            return App::abort(404);
        }
        return Redirect::route('page', ['pages' => $mainPage->slug]);
    }

    private function getMainPage()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'DESC')->first();
    }

    public function page(Page $pages, $isPreview = false)
    {
        if (!$pages->active && (!Auth::check() || !$isPreview)) {
            return App::abort(404);
        }

        return view('front.main.page', ['page' => $pages]);
    }
}
