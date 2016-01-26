<?php

namespace Fb\Jobs\Cms\Banners;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Banner;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreBanner extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];

    protected $page;

    protected $banner;

    const DST_FOLDER = '/images/pages/';
    const DST_IMAGE = '';
    const DST_IMAGE_THUMBNAILS = 'thumbnails/';

    protected $absolutePath;

    protected $thumbnailSize = [
        'w' => 60,
        'h' => 60
    ];

    protected $filename;


    public function __construct(Page $page, array $data)
    {
        $this->page = $page;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $this->banner = new Banner([
            'active' => $this->data['active'],
            'name' => $this->data['name'],
            'description' => $this->data['description']
        ]);
        $this->saveImage();

        $this->page->banners()->save($this->banner);
    }

    protected function saveImage()
    {
        if (!empty($this->data['image'])) {
            $file = Image::make($this->data['image']->getRealPath());
            $path = $this->saveFile($file);

            $this->banner->filename = basename($path);
            $this->banner->path = $this->getPath();

        }
    }

    protected function saveFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getPath()) . $this->getFileName();
        $image->save($path);
        return $path;
    }

    protected function getPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }

    protected function generateFileNameInFolder($path, $basename, $ext)
    {
            $name = md5($basename . time()) . '.' . $ext;

            while(\File::exists($path . '/' . $name)) {
                $name = md5($name . time()) . '.' . $ext;
            }
            return $name;

    }

    protected function getFileName()
    {
        if (empty($this->filename)) {
            $extension = $this->data['image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getPath(),
                $this->data['image']->getClientOriginalName(),
                $extension
            );

            $this->filename = $name;
        }
        return $this->filename;
    }
}
