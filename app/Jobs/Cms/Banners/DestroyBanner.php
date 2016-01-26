<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use File;

class DestroyBanner extends Job implements SelfHandling
{
    protected $page;

    protected $banner;

    protected $absolutePath;

    const DST_FOLDER = '/images/pages/';
    const DST_IMAGE = '';

    public function __construct(Page $page, Banner $banner)
    {
        $this->page = $page;
        $this->banner = $banner;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        File::delete($this->getAbsolutePath($this->banner->path) . $this->banner->filename);

        Banner::destroy($this->banner->id);
    }

    protected function getPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }
}
