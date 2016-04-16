<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Delete as DeleteFile;

class DestroyBanner extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $banner;

    public function __construct( Banner $banner)
    {
        $this->banner = $banner;
    }

    public function handle()
    {
        $file = $this->banner->logoFile;
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }

        Banner::destroy($this->banner->id);
    }
}
