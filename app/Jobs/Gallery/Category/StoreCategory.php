<?php

namespace Fb\Jobs\Gallery\Category;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Services\StoragePaths\CategoryPath;

class StoreCategory extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];

    private $config;

    private $category;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->config = \config('fb.category');
    }

    public function handle()
    {
        if (!empty($this->data['parent'])) {
            $parent = GalleryCategory::findOrFail($this->data['parent']);
            $this->category = $parent->children()->create([
                'name' => !empty($this->data['name'])?$this->data['name']:'',
            ]);
        } else {
            $this->category = GalleryCategory::create([
                'name' => !empty($this->data['name'])?$this->data['name']:'',
            ]);
        }

        $this->category->title = !empty($this->data['title'])?$this->data['title']:'';
        $this->category->description = !empty($this->data['description'])?$this->data['description']:'';
        $this->category->active = $this->data['active'];
        $this->category->save();
        $this->saveLogo();
        $this->category->save();
    }

    private function saveLogo()
    {
        $this->initializePaths();
        $logo = $this->data['logo'];
        $path = $this->config['path'] . '/' . $this->category->getKey() . '/';

        $file = null;
        if (!empty($logo)) {
            $file = $this->saveImage($logo, $path);
        }
        if (!empty($file)) {
            $this->category->logo_id = $file->getKey();
            $this->category->save();
        }
    }

    private function saveImage(UploadedFile $image, $basePath)
    {
        return $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $basePath]);
    }

    private function initializePaths()
    {
        $service = new CategoryPath($this->category->getKey());
        $service->initializePaths();
    }
}
