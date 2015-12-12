<?php

namespace Fb\Jobs\Shop\ProductImages;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Fb\Models\Shop\ProductImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreImage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];

    protected $product;

    const DST_FOLDER = '/images/products/';
    const DST_IMAGE = '';
    const DST_IMAGE_THUMBNAILS = 'thumbnails/';
    const DST_MOBILE = 'mobile/';
    const DST_MOBILE_THUMBNAILS = 'mobile/thumbnails/';

    private $absolutePath;

    public function __construct(Product $product, array $data)
    {
        $this->product = $product;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $image = $this->createImageObject();
        $this->assignImagePaths($image);

        $this->formatCheckboxValue($image);
        $this->product->images()->save($image);

        $this->saveImage();
        $this->saveMobile();
    }

    private function saveImage()
    {
        $imageFile = Image::make($this->data['image']['file']->getRealPath());
        $this->saveImageFile($imageFile);
        $this->saveImageThumnailFile($imageFile);
    }

    private function saveMobile()
    {
        $mobileFile = Image::make($this->data['mobile']['file']->getRealPath());
        $this->saveMobileFile($mobileFile);
        $this->saveMobileThumnailFile($mobileFile);
    }

    protected function createImageObject()
    {
        $image = new ProductImage([
            'image_name' => $this->data['image']['name'],
            'image_extension' => $this->data['image']['file']->getClientOriginalExtension(),
            'mobile_image_name' => $this->data['mobile']['name'],
            'mobile_extension' => $this->data['mobile']['file']->getClientOriginalExtension(),
            'active' => $this->data['active'],
            'is_featured' => $this->data['is_featured']
        ]);

        return $image;
    }

    protected function assignImagePaths(ProductImage $image)
    {
        $image->image_path = $this->getImagePath();
        $image->image_thumbnail_path = $this->getImageThumbnailPath();
        $image->mobile_path = $this->getMobilePath();
        $image->mobile_thumbnail_path = $this->getMobileThumbnailPath();
        return $image;
    }

    protected function saveImageFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImagePath()) . $this->getImageFileName();
        $image->save($path);
    }

    protected function saveImageThumnailFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImageThumbnailPath()) . $this->getImageThumbnailFileName();
        $image->resize(60, 60)->save($path);
    }

    protected function saveMobileFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobilePath()) . $this->getMobileFileName();
        $image->save($path);
    }

    protected function saveMobileThumnailFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobileThumbnailPath()) . $this->getMobileThumbnailFileName();
        $image->resize(60, 60)->save($path);
    }

    protected function formatCheckboxValue(ProductImage $image)
    {
        $image->active = ($image->active == null) ? 0 : 1;
        $image->is_featured = ($image->is_featured == null) ? 0 : 1;
    }

    private function getImagePath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    private function getImageThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE_THUMBNAILS;
    }

    private function getMobilePath()
    {
        return self::DST_FOLDER . self::DST_MOBILE;
    }

    private function getMobileThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_MOBILE_THUMBNAILS;
    }

    private function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }

    private function getImageFileName()
    {
        $name = $this->data['image']['name'];
        $extension = $this->data['image']['file']->getClientOriginalExtension();
        return $name . '.' . $extension;
    }

    private function getImageThumbnailFileName()
    {
        return 'thumb-' . $this->getImageFileName();
    }

    private function getMobileFileName()
    {
        $name = $this->data['mobile']['name'];
        $extension = $this->data['mobile']['file']->getClientOriginalExtension();
        return $name . '.' . $extension;
    }

    private function getMobileThumbnailFileName()
    {
        return 'thumb-' . $this->getImageFileName();
    }
}
