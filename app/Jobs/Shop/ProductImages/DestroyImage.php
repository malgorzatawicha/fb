<?php

namespace Fb\Jobs\Shop\ProductImages;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Fb\Models\Shop\ProductImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use File;

class DestroyImage extends Job implements SelfHandling
{
    protected $product;

    protected $image;

    protected $absolutePath;

    const DST_FOLDER = '/images/products/';
    const DST_IMAGE = '';
    const DST_IMAGE_THUMBNAILS = 'thumbnails/';
    const DST_MOBILE = 'mobile/';
    const DST_MOBILE_THUMBNAILS = 'mobile/thumbnails/';

    public function __construct(Product $product, ProductImage $image)
    {
        $this->product = $product;
        $this->image = $image;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $thumbPath = $this->image->image_path.'thumbnails/';

        File::delete($this->getAbsolutePath($this->getImagePath()) . $this->image->image_filename);
        File::delete($this->getAbsolutePath($this->getImageThumbnailPath()) . $this->image->image_thumbnail_filename);
        File::delete($this->getAbsolutePath($this->getMobilePath()) . $this->image->mobile_filename);
        File::delete($this->getAbsolutePath($this->getMobileThumbnailPath()) . $this->image->mobile_thumbnail_filename);

        ProductImage::destroy($this->image->id);
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
