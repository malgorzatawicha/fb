<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdatePage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var Page
     */
    private $page;

    const DST_FOLDER = '/images/pages/';
    const DST_IMAGE = '';

    protected $absolutePath;

    protected $imageFilename;

    public function __construct(Page $page, array $data)
    {
        $this->data = $data;
        $this->page = $page;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $this->page->name = !empty($this->data['name'])?$this->data['name']:'';
        $this->page->title = !empty($this->data['title'])?$this->data['title']:'';
        $this->page->description = !empty($this->data['description'])?$this->data['description']:'';
        $this->page->body = !empty($this->data['body'])?$this->data['body']:'';
        $this->page->active = $this->data['active'];
        $this->saveLogo();
        $this->page->save();

        return $this->page;
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
