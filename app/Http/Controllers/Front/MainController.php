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

        if ($pages->type == 'gallery') {
            return Redirect::route('gallery', ['pages' => $pages->slug]);
        }
        return view('front.main.page', ['page' => $pages, 'pages' => $this->getPages()]);
    }

    public function gallery(Page $pages)
    {
        $pageCategory = $pages->gallery;
        if (empty($pageCategory)) {
            return App::abort(404);
        }
        $category = $pageCategory->galleryCategory;
        return view('front.gallery.page', [
            'page' => $pages,
            'pages' => $this->getPages(),
            'categories' => $category->tree(),
        ]);
    }
}
