<?php

namespace Fb\Jobs\Gallery\Category;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateCategory extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var GalleryCategory
     */
    private $category;

    const DST_FOLDER = '/images/galleries/categories';
    const DST_IMAGE = '';

    protected $absolutePath;

    protected $imageFilename;

    public function __construct(GalleryCategory $galleryCategory, array $data)
    {
        $this->data = $data;
        $this->category = $galleryCategory;
        $this->absolutePath = public_path();
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
        // @todo manage logo deleting
        if (!empty($this->data['logo'])) {
            $imageFile = Image::make($this->data['logo']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);

            $this->page->logo_filename = basename($imagePath);
            $this->page->logo_path = $this->getImagePath();
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
