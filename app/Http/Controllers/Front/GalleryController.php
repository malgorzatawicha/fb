<?php namespace Fb\Http\Controllers\Front;

use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;

use Fb\Http\Controllers\Controller;
use Redirect;

class GalleryController extends Controller
{
    public function category(Page $pages, GalleryCategory $category)
    {
        return view('front.gallery.page', [
            'page' => $pages,
            'pages' => $this->getPages(),
            'categories' => $category->tree(),
            'category' => $category
        ]);
    }

    private function getPages()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'asc')->get();
    }
}
