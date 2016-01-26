<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateBanner extends StoreBanner implements SelfHandling
{
    protected $banner;

    public function __construct(Page $page, Banner $banner, array $data)
    {
        parent::__construct($page, $data);
        $this->banner = $banner;
    }

    public function handle()
    {
        $this->banner->active = $this->data['active'];
        $this->banner->name = $this->data['name'];
        $this->banner->description = $this->data['description'];

        $this->saveImage();

        $this->banner->save();
    }
}
