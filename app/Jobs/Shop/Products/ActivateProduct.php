<?php

namespace Fb\Jobs\Shop\Products;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Illuminate\Contracts\Bus\SelfHandling;

class ActivateProduct extends Job implements SelfHandling
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function handle()
    {
        $this->product->active = true;
        $this->product->save();

        return $this->product;
    }
}
