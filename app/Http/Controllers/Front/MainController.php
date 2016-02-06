<?php namespace Fb\Http\Controllers\Front;

use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;
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

    private function getPages()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'asc')->get();
    }
    private function getMainPage()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'asc')->first();
    }

    public function page(Page $pages, $isPreview = false)
    {
        if (!$pages->active && (!Auth::check() || !$isPreview)) {
            return App::abort(404);
        }
        $gallery = $pages->gallery;
        if ($pages->type == 'gallery' && !empty($gallery)) {
            return Redirect::route('gallery', ['pages' => $pages->slug, 'galleryCategory' => $pages->gallery->galleryCategory->slug]);
        }
        return view('front.main.page', ['page' => $pages, 'pages' => $this->getPages()]);
    }
}
