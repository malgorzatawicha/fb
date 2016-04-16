<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Jobs\Job;
use Fb\Models\Cms\Banner;
use Fb\Models\File;
use Fb\Services\StoragePaths\PagePath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;

class UpdateBanner extends Job implements SelfHandling
{
    use DispatchesJobs;

    private $data = [];
    private $config = [];
    private $banner;

    public function __construct(Banner $banner, array $data)
    {
        $this->data = $data;
        $this->banner = $banner;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->banner->active = $this->data['active'];
        $this->banner->watermarked = $this->data['watermarked'];
        $this->banner->name = $this->data['name'];
        $this->banner->description = $this->data['description'];

        $this->saveImage();

        $this->banner->save();
    }

    private function saveImage()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'] . '/' . $this->banner->page->getKey() . '/' . $this->config['banner']['subPath'],
            $this->data['file_exists'],
            $this->data['file'],
            $this->banner->logoFile
        );

        $this->banner->file_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }

    private function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb=null)
    {
        $this->initializePaths();
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

    private function initializePaths()
    {
        $service = new PagePath($this->banner->page->getKey());
        $service->initializePaths();
    }
}
