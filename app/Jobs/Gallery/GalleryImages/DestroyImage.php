<?php

namespace Fb\Jobs\Gallery\GalleryImages;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Fb\Models\Gallery\GalleryImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use File;

class DestroyImage extends Job implements SelfHandling
{
    protected $gallery;

    protected $image;

    protected $absolutePath;

    const DST_FOLDER = '/images/galleries/';
    const DST_IMAGE = '';
    const DST_IMAGE_THUMBNAILS = 'thumbnails/';
    const DST_MOBILE = 'mobile/';
    const DST_MOBILE_THUMBNAILS = 'mobile/thumbnails/';

    public function __construct(Gallery $gallery, GalleryImage $image)
    {
        $this->gallery = $gallery;
        $this->image = $image;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        File::delete($this->getAbsolutePath($this->getImagePath()) . $this->image->image_filename);
        File::delete($this->getAbsolutePath($this->getImageThumbnailPath()) . $this->image->image_thumbnail_filename);
        File::delete($this->getAbsolutePath($this->getMobilePath()) . $this->image->mobile_filename);
        File::delete($this->getAbsolutePath($this->getMobileThumbnailPath()) . $this->image->mobile_thumbnail_filename);

        $this->image->delete();
    }

    protected function getImagePath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getImageThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE_THUMBNAILS;
    }

    protected function getMobilePath()
    {
        return self::DST_FOLDER . self::DST_MOBILE;
    }

    protected function getMobileThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_MOBILE_THUMBNAILS;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }


}
