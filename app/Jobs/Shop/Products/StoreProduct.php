<?php

namespace Fb\Jobs\Shop\Products;

use Fb\Jobs\Job;
use Fb\Models\Shop\Product;
use Illuminate\Contracts\Bus\SelfHandling;

class StoreProduct extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $product = new Product();

        $product->name = !empty($this->data['name'])?$this->data['name']:'';
        $product->description =  !empty($this->data['description'])?$this->data['description']:'';
        $product->save();

        return $product;
    }
}
