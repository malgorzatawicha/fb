<?php namespace Fb\Http\Controllers\Front;

use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;

use Fb\Http\Controllers\Controller;
use Fb\Models\Gallery\GalleryProject;
use Fb\Models\File;
use Intervention\Image\Facades\Image;
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

    public function image($imageId, $width, $height)
    {
        $file = File::findOrFail($imageId);
        $location = $file->path . '/' . $file->filename;
        return Image::make($location)->resize($width, $height)->response($file->extension);
    }

    private function getPages()
    {
        return Page::where('active', '=', 1)->orderBy('position', 'asc')->get();
    }
}
