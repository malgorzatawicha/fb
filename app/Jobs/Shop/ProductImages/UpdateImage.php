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
        $this->image = $image;
    }

    public function handle()
    {
        $image = $this->changeImageObject();
        $this->assignImagePaths($image);

        $this->formatCheckboxValue($image);
        $image->save();

        if (!empty($this->data['image']['file'])) {
            $this->saveImage();
        }

        if (!empty($this->data['mobile']['file'])) {
            $this->saveMobile();
        }
    }

    protected function changeImageObject()
    {
        $this->image->image_name = $this->data['image']['name'];
        $this->image->image_extension = $this->data['image']['file']->getClientOriginalExtension();
        $this->image->mobile_name = $this->data['mobile']['name'];
        $this->image->mobile_extension = $this->data['mobile']['file']->getClientOriginalExtension();
        $this->image->is_active = $this->data['is_active'];
        $this->image->is_featured = $this->data['is_featured'];

        return $this->image;
    }
}
