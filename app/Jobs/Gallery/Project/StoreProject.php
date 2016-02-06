<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreProject extends Job implements SelfHandling
{
    private $category;
    /**
     * @var array
     */
    private $data = [];

    const DST_FOLDER = '/images/galleries/projects/';
    const DST_IMAGE = '';

    protected $absolutePath;

    protected $imageFilename;

    public function __construct(GalleryCategory $category, array $data)
    {
        $this->category = $category;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $project = $this->category->projects()->create([
            'name' => !empty($this->data['name'])?$this->data['name']:'',
            'title' => !empty($this->data['title'])?$this->data['title']:'',
            'description' => !empty($this->data['description'])?$this->data['description']:'',
            'active' => !empty($this->data['active'])?$this->data['active']:'',
        ]);

        $this->saveLogo($project);
        $project->save();

        return $project;
    }

    private function saveLogo(GalleryProject $project)
    {
        if (!empty($this->data['logo'])) {
            $imageFile = Image::make($this->data['logo']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);

            $project->logo_filename = basename($imagePath);
            $project->logo_path = $this->getImagePath();
        }
    }

    protected function saveImageFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImagePath()) . $this->getImageFileName();
        $image->save($path);
        return $path;
    }

    protected function getImagePath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }

    protected function getImageFileName()
    {
        if (empty($this->imageFilename)) {
            $extension = $this->data['logo']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getImagePath(),
                $this->data['logo']->getClientOriginalName(),
                $extension
            );

            $this->imageFilename = $name;
        }
        return $this->imageFilename;
    }

    protected function generateFileNameInFolder($path, $basename, $ext)
    {
        $name = md5($basename . time()) . '.' . $ext;

        while(\File::exists($path . '/' . $name)) {
            $name = md5($name . time()) . '.' . $ext;
        }
        return $name;

    }
}
