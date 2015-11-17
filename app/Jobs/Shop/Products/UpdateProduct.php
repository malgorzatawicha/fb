<?php

namespace Fb\Jobs\Shop\Products;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateProduct extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product, array $data)
    {
        $this->data = $data;
        $this->product = $product;
    }

    public function handle()
    {
        $this->product->name = !empty($this->data['name'])?$this->data['name']:'';
        $this->product->description =  !empty($this->data['description'])?$this->data['description']:'';
        $this->product->save();

        return $this->product;
    }
}
