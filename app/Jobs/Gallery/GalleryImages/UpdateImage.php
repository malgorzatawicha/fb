<?php

namespace Fb\Jobs\Gallery\GalleryImages;

use Fb\Models\Gallery\Gallery;
use Fb\Models\Gallery\GalleryImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateImage extends StoreImage implements SelfHandling
{
    protected $image;

    public function __construct(Gallery $gallery, GalleryImage $image, array $data)
    {
        parent::__construct($gallery, $data);
        $this->image = $image;
    }

    public function handle()
    {
        $this->image->is_active = $this->data['is_active'];
        $this->formatCheckboxValue();
        $this->saveImage();
        $this->saveMobile();
        $this->image->save();
    }
}
