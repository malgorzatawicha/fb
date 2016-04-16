<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Fb\Services\StoragePaths\PagePath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Fb\Jobs\File\Create as CreateFile;


class StoreBanner extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    protected $data = [];

    private $config = [];

    protected $page;

    protected $banner;

    public function __construct(Page $page, array $data)
    {
        $this->page = $page;
        $this->data = $data;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->banner = new Banner([
            'active' => $this->data['active'],
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'watermarked' => $this->data['watermarked'],
        ]);
        $this->saveImage();

        $this->page->banners()->save($this->banner);
    }

    protected function saveImage()
    {
        $image = $this->data['file'];
        $path = $this->config['path'] . '/' . $this->page->getKey() . '/' . $this->config['banner']['subPath'];

        $file = null;
        if (!empty($image)) {
            $file = $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $path]);
        }
        if (!empty($file)) {
            $this->banner->file_id = $file->getKey();
        }
    }

    protected function initializePaths()
    {
        $service = new PagePath($this->page->getKey());
        $service->initializePaths();
    }
}
