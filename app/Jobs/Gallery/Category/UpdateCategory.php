<?php

namespace Fb\Jobs\Gallery\Category;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Fb\Services\StoragePaths\CategoryPath;
use Illuminate\Contracts\Bus\SelfHandling;
use Fb\Models\File;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UpdateCategory extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];

    private $config = [];

    /**
     * @var GalleryCategory
     */
    private $category;

    public function __construct(GalleryCategory $galleryCategory, array $data)
    {
        $this->data = $data;
        $this->category = $galleryCategory;
        $this->config = \config('fb.category');
    }

    public function handle()
    {
        $this->category->name = !empty($this->data['name'])?$this->data['name']:'';
        $this->category->title = !empty($this->data['title'])?$this->data['title']:'';
        $this->category->description = !empty($this->data['description'])?$this->data['description']:'';
        $this->category->active = $this->data['active'];
        $this->saveLogo();
        $this->category->save();

        return $this->category;
    }

    private function saveLogo()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'],
            $this->data['logo_exists'],
            $this->data['logo'],
            $this->category->logoFile
        );

        $this->category->logo_id = !empty($fileInDb)?$fileInDb->getKey():null;
    }


    private function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb = null)
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
        $service = new CategoryPath($this->category->getKey());
        $service->initializePaths();
    }
}
