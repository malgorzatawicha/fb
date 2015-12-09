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
    /**
     * @var array
     */
    protected $data = [];

    protected $product;

    protected $image;

    const DESTINATION_FOLDER = '/images/products/';
    const DESTINATION_MOBILE = '/images/products/mobile/';
    const DESTINATION_THUMBNAILS = '/images/products/thumbnails/';

    public function __construct(Product $product, ProductImage $image, array $data)
    {
        $this->product = $product;
        $this->image = $image;
        $this->data = $data;
    }

    public function handle()
    {
        $thumbPath = $this->image->image_path.'thumbnails/';

        File::delete(public_path($this->image->image_path).
            $this->image->image_name . '.' .
            $this->image->image_extension);

        File::delete(public_path($this->image->mobile_image_path).
            $this->image->mobile_image_name . '.' .
            $this->image->mobile_extension);
        File::delete(public_path($thumbPath). 'thumb-' .
            $this->image->image_name . '.' .
            $this->image->image_extension);

        ProductImage::destroy($this->image->id);
    }

}
