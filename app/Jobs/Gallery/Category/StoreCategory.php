<?php

namespace Fb\Jobs\Gallery\Category;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreCategory extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    const DST_FOLDER = '/images/galleries/categories/';
    const DST_IMAGE = '';

    protected $absolutePath;

    protected $imageFilename;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        if (!empty($this->data['parent'])) {
            $parent = GalleryCategory::findOrFail($this->data['parent']);
            $category = $parent->children()->create([
                'name' => !empty($this->data['name'])?$this->data['name']:'',
            ]);
        } else {
            $category = GalleryCategory::create([
                'name' => !empty($this->data['name'])?$this->data['name']:'',
            ]);
        }

        $category->title = !empty($this->data['title'])?$this->data['title']:'';
        $category->description = !empty($this->data['description'])?$this->data['description']:'';
        $category->active = $this->data['active'];
        $this->saveLogo($category);
        $category->save();

        return $category;
    }

    private function saveLogo(GalleryCategory $category)
    {
        if (!empty($this->data['logo'])) {
            $imageFile = Image::make($this->data['logo']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);

            $category->logo_filename = basename($imagePath);
            $category->logo_path = $this->getImagePath();
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
