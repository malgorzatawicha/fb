<?php

namespace Fb\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Fb\Models\Cms\Page;

class PageGallery extends Model
{
    protected $table = 'page_gallery';

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function galleryCategory()
    {
        return $this->belongsTo(GalleryCategory::class);
    }
}
