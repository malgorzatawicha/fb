<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\File;
use Fb\Services\StoragePaths\PagePath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdatePage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];

    private $config = [];
    /**
     * @var Page
     */
    private $page;


    public function __construct(Page $page, array $data)
    {
        $this->data = $data;
        $this->page = $page;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->page->name = !empty($this->data['name'])?$this->data['name']:'';
        $this->page->title = !empty($this->data['title'])?$this->data['title']:'';
        $this->page->description = !empty($this->data['description'])?$this->data['description']:'';
        $this->page->body = !empty($this->data['body'])?$this->data['body']:'';
        $this->page->active = $this->data['active'];
        $this->page->type = $this->data['type'];
        $this->saveLogo();
        $this->page->save();

        return $this->page;
    }

    private function saveLogo()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'],
            $this->data['logo_exists'],
            $this->data['logo'],
            $this->page->logoFile
        );

        $this->page->logo_id = !empty($fileInDb)?$fileInDb->getKey():null;
    }

    protected function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb = null)
    {
        if (empty($isUploaded) && empty($image) && !empty($fileInDb)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $fileInDb]);
            $fileInDb = false;
        } else if(!empty($isUploaded) && !empty($image)) {
            if (empty($fileInDb)) {
                $fileInDb = $this->dispatchFromArray(CreateFile::class, ['image'=> $image, 'path' => $basePath]);
            } else {
                $fileInDb = $this->dispatchFromArray(ChangeFile::class, ['image'=> $image, 'file' => $fileInDb]);
            }
        }
        return $fileInDb;
    }

    protected function initializePaths()
    {
        $service = new PagePath($this->page->getKey());
        $service->initializePaths();
    }
}
