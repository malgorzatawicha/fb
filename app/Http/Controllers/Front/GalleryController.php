<?php namespace Fb\Http\Controllers\Front;

use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;

use Fb\Http\Controllers\Controller;
use Fb\Models\Gallery\GalleryProject;
use Redirect;

class GalleryController extends Controller
{
    public function category(Page $pages, GalleryCategory $galleryCategory)
    {
        return view('front.gallery.page', [
            'page' => $pages,
            'pages' => $this->getPages(),
            'categories' => $pages->gallery->galleryCategory->tree(),
            'category' => $galleryCategory
        ]);
    }

    public function project(Page $pages, GalleryCategory $galleryCategory, GalleryProject $galleryProject)
    {
        return view('front.gallery.project', [
            'page' => $pages,
            'pages' => $this->getPages(),
            'categories' => $pages->gallery->galleryCategory->tree(),
            'category' => $galleryCategory,
            'project' => $galleryProject
        ]);
    }

    private function getPages()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'asc')->get();
    }
}
