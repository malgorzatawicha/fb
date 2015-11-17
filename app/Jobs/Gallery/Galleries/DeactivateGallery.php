<?php

namespace Fb\Jobs\Gallery\Galleries;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Illuminate\Contracts\Bus\SelfHandling;

class DeactivateGallery extends Job implements SelfHandling
{
    /**
     * @var Gallery
     */
    private $gallery;

    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    public function handle()
    {
        $this->gallery->active = false;
        $this->gallery->save();

        return $this->gallery;
    }
}
