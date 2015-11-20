<?php

namespace Fb\Jobs\Shop\ProductImages;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Fb\Models\Shop\ProductImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateImage extends StoreImage implements SelfHandling
{
    protected $image;

    public function __construct(Product $product, ProductImage $image, array $data)
    {
        parent::__construct($product, $data);
    }

    public function handle()
    {
        $image = $this->createImageObject();
        $this->assignImagePaths($image);

        $this->formatCheckboxValue($image);
        $image->save();

        if (!empty($this->data['image_file'])) {
            $imageFile = Image::make($this->data['image_file']->getRealPath());
            $this->saveImageFile($imageFile);
            $this->saveThumnailFile($imageFile);
        }

        if (!empty($this->data['mobile_file'])) {
            $mobileFile = Image::make($this->data['mobile_file']->getRealPath());
            $this->saveMobileFile($mobileFile);
        }
    }

    protected function createImageObject()
    {
        $image = new ProductImage([
            'image_extension' => $this->data['image_extension'],
            'mobile_extension' => $this->data['mobile_extension'],
            'active' => $this->data['active'],
            'is_featured' => $this->data['is_featured']
        ]);

        return $image;
    }

    private function saveImageFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['image_name'];
        $extension = $this->data['image_extension'];

        $path = public_path() . self::DESTINATION_FOLDER . $name . '.' . $extension;

        $image->save($path);
    }

    private function saveThumnailFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['image_name'];
        $extension = $this->data['image_extension'];

        $path = public_path() . self::DESTINATION_THUMBNAILS . 'thumb-' . $name . '.' . $extension;

        $image->resize(60, 60)->save($path);
    }

    private function saveMobileFile(\Intervention\Image\Image $image)
    {
        $name = $this->data['mobile_image_name'];
        $extension = $this->data['mobile_extension'];

        $path = public_path() . self::DESTINATION_MOBILE . $name . '.' . $extension;

        $image->save($path);
    }
}
