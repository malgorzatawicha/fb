<?php

namespace Fb\Jobs\Gallery\Galleries;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Illuminate\Contracts\Bus\SelfHandling;

class DestroyGallery extends Job implements SelfHandling
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
        return $this->gallery->delete();
    }
}
