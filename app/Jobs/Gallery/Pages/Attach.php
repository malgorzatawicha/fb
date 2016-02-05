<?php namespace Fb\Jobs\Gallery\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\PageGallery;
use Illuminate\Contracts\Bus\SelfHandling;

class Attach extends Job implements SelfHandling
{
    private $page;
    private $galleryCategory;
    public function __construct(Page $page, GalleryCategory $category)
    {
        $this->page = $page;
        $this->galleryCategory = $category;
    }

    public function handle()
    {
        $pageGallery = $this->page->gallery;
        if (empty($pageGallery)) {
            $pageGallery = new PageGallery();
            $pageGallery->page_id = $this->page->getKey();
        }
        $pageGallery->gallery_category_id = $this->galleryCategory->getKey();
        $pageGallery->save();

    }
}
