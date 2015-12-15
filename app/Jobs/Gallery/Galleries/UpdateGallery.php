<?php

namespace Fb\Jobs\Gallery\Galleries;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateGallery extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var Gallery
     */
    private $gallery;

    public function __construct(Gallery $gallery, array $data)
    {
        $this->data = $data;
        $this->gallery = $gallery;
    }

    public function handle()
    {
        $this->gallery->name = !empty($this->data['name'])?$this->data['name']:'';
        $this->gallery->description =  !empty($this->data['description'])?$this->data['description']:'';
        $this->gallery->save();

        return $this->gallery;
    }
}
