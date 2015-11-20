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

    const DESTINATION_FOLDER = '/images/products/';
    const DESTINATION_MOBILE = '/images/products/mobile/';
    const DESTINATION_THUMBNAILS = '/images/products/thumbnails/';

    public function __construct(Product $product, array $data)
    {
        $this->product = $product;
        $this->data = $data;
    }

    public function handle()
    {
        $image = $this->createImageObject();
        $this->assignImagePaths($image);

        $this->formatCheckboxValue($image);
        $this->product->images()->save($image);

        $imageFile = Image::make($this->data['image_file']->getRealPath());
        $this->saveImageFile($imageFile);
        $this->saveThumnailFile($imageFile);

        $mobileFile = Image::make($this->data['mobile_file']->getRealPath());
        $this->saveMobileFile($mobileFile);
    }

    protected function createImageObject()
    {
        $image = new ProductImage([
            'image_name' => $this->data['image_name'],
            'image_extension' => $this->data['image_extension'],
            'mobile_image_name' => $this->data['mobile_image_name'],
            'mobile_extension' => $this->data['mobile_extension'],
            'active' => $this->data['active'],
            'is_featured' => $this->data['is_featured']
        ]);

        return $image;
    }

    protected function assignImagePaths(ProductImage $image)
    {
        $image->image_path = self::DESTINATION_FOLDER;
        $image->mobile_image_path = self::DESTINATION_MOBILE;
        return $image;
    }

    protected function saveImageFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['image_name'];
        $extension = $this->data['image_extension'];

        $path = public_path() . self::DESTINATION_FOLDER . $name . '.' . $extension;

        $image->save($path);
    }

    protected function saveThumnailFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['image_name'];
        $extension = $this->data['image_extension'];

        $path = public_path() . self::DESTINATION_THUMBNAILS . 'thumb-' . $name . '.' . $extension;

        $image->resize(60, 60)->save($path);
    }

    protected function saveMobileFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['mobile_image_name'];
        $extension = $this->data['mobile_extension'];

        $path = public_path() . self::DESTINATION_MOBILE . $name . '.' . $extension;

        $image->save($path);
    }

    protected function formatCheckboxValue(ProductImage $image)
    {
        $image->active = ($image->active == null) ? 0 : 1;
        $image->is_featured = ($image->is_featured == null) ? 0 : 1;
    }

}
