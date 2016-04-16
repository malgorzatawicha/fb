<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Services\StoragePaths\PagePath;

class StorePage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];

    private $config;

    private $page;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->page = new Page([
            'name' => !empty($this->data['name'])?$this->data['name']:'',
            'title' =>!empty($this->data['title'])?$this->data['title']:'',
            'description' =>!empty($this->data['description'])?$this->data['description']:'',
            'body' => !empty($this->data['body'])?$this->data['body']:'',
            'active' =>$this->data['active'],
            'type' => $this->data['type'],
        ]);

        $this->page->save();
        $this->saveLogo();

        return $this->page;
    }

    private function saveLogo()
    {
        $this->initializePaths();
        $logo = $this->data['logo'];
        $path = $this->config['path'] . '/' . $this->page->getKey() . '/' . $this->config['logo']['subPath'];

        $file = null;
        if (!empty($logo)) {
            $file = $this->saveImage($logo, $path);
        }
        if (!empty($file)) {
            $this->page->logo_id = $file->getKey();
            $this->page->save();
        }
    }

    protected function saveImage(UploadedFile $image, $basePath)
    {
        return $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $basePath]);
    }

    protected function initializePaths()
    {
        $service = new PagePath($this->page->getKey());
        $service->initializePaths();
    }
}
