<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StorePage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    const DST_FOLDER = '/images/pages/';
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
        $page = new Page();
        $page->name = !empty($this->data['name'])?$this->data['name']:'';
        $page->title = !empty($this->data['title'])?$this->data['title']:'';
        $page->description = !empty($this->data['description'])?$this->data['description']:'';
        $page->body = !empty($this->data['body'])?$this->data['body']:'';
        $page->active = $this->data['active'];
        $page->type = $this->data['type'];
        $this->saveLogo($page);
        $page->save();

        return $page;
    }

    private function saveLogo(Page $page)
    {
        if (!empty($this->data['logo'])) {
            $imageFile = Image::make($this->data['logo']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);

            $page->logo_filename = basename($imagePath);
            $page->logo_path = $this->getImagePath();
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
