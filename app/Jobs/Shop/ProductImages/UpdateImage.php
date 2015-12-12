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
        $this->image->is_active = $this->data['is_active'];
        $this->image->is_featured = $this->data['is_featured'];
        $this->formatCheckboxValue();

        $this->saveImage();
        $this->saveMobile();

        $this->image->save();
    }
}
