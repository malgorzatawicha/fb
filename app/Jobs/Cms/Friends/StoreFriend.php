<?php

namespace Fb\Jobs\Cms\Friends;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Services\StoragePaths\PagePath;

class StoreFriend extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];

    private $config = [];

    private $page;

    private $friend;

    public function __construct(Page $page, array $data)
    {
        $this->page = $page;
        $this->data = $data;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->friend = new Friend([
            'active' => $this->data['active'],
            'name' => $this->data['name'],
            'description' => $this->data['description'],
            'url' => $this->data['url']
        ]);
        $this->saveImage();

        $this->page->friends()->save($this->friend);
    }

    private function saveImage()
    {
        $image = $this->data['file'];
        $path = $this->config['path'] . '/' . $this->page->getKey() . '/' . $this->config['friend']['subPath'];

        $file = null;
        if (!empty($image)) {
            $this->initializePaths();
            $file = $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $path]);
        }
        if (!empty($file)) {
            $this->friend->file_id = $file->getKey();
        }
    }

    private function initializePaths()
    {
        $service = new PagePath($this->page->getKey());
        $service->initializePaths();
    }
}
