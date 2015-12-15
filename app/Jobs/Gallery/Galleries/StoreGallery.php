<?php

namespace Fb\Jobs\Gallery\Galleries;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Illuminate\Contracts\Bus\SelfHandling;

class StoreGallery extends Job implements SelfHandling
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
        $gallery = new Gallery();

        $gallery->name = !empty($this->data['name'])?$this->data['name']:'';
        $gallery->description =  !empty($this->data['description'])?$this->data['description']:'';
        $gallery->save();

        return $gallery;
    }
}
