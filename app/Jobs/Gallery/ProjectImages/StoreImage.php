<?php

namespace Fb\Jobs\Gallery\ProjectImages;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Fb\Models\Gallery\GalleryProjectImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreImage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];

    protected $project;

    protected $image;

    const DST_FOLDER = '/images/galleries/project_images/';
    const DST_BASE_IMAGE = '/base/';
    const DST_BIG_IMAGE = '/big/';
    const DST_MOBILE_IMAGE = '/mobile/';
    const DST_MOBILE_THUMB_IMAGE = '/mobile_thumb/';
    const DST_THUMB_IMAGE = '/thumb/';

    protected $absolutePath;

    protected $thumbnailSize = [
        'w' => 60,
        'h' => 60
    ];

    protected $baseFilename;
    protected $bigFilename;
    protected $mobileFilename;
    protected $mobileThumbFilename;
    protected $thumbFilename;

    public function __construct(GalleryProject $project, array $data)
    {
        $this->project = $project;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $this->image = new GalleryProjectImage([
            'active' => $this->data['active'],
            'name' => $this->data['name'],
            'description' => $this->data['description']
        ]);
        $this->saveBaseImage();
        $this->saveBigImage();
        $this->saveMobileImage();
        $this->saveMobileThumbImage();
        $this->saveThumbImage();
        $this->project->images()->save($this->image);
    }

    protected function saveBaseImage()
    {
        if (!empty($this->data['base_image'])) {
            $file = Image::make($this->data['base_image']->getRealPath());
            $path = $this->saveBaseFile($file);

            $this->image->base_filename = basename($path);
            $this->image->base_path = $this->getBasePath();
        }
    }
    protected function saveBigImage()
    {
        if (!empty($this->data['big_image'])) {
            $file = Image::make($this->data['big_image']->getRealPath());
            $path = $this->saveBigFile($file);

            $this->image->big_filename = basename($path);
            $this->image->big_path = $this->getBigPath();
        }
    }

    protected function saveMobileImage()
    {
        if (!empty($this->data['mobile_image'])) {
            $file = Image::make($this->data['mobile_image']->getRealPath());
            $path = $this->saveMobileFile($file);

            $this->image->mobile_filename = basename($path);
            $this->image->mobile_path = $this->getMobilePath();
        }
    }
    protected function saveMobileThumbImage()
    {
        if (!empty($this->data['mobile_thumb_image'])) {
            $file = Image::make($this->data['mobile_thumb_image']->getRealPath());
            $path = $this->saveMobileThumbFile($file);

            $this->image->mobile_thumb_filename = basename($path);
            $this->image->mobile_thumb_path = $this->getMobileThumbPath();
        }
    }
    protected function saveThumbImage()
    {
        if (!empty($this->data['thumb_image'])) {
            $file = Image::make($this->data['thumb_image']->getRealPath());
            $path = $this->saveThumbFile($file);

            $this->image->thumb_filename = basename($path);
            $this->image->thumb_path = $this->getThumbPath();
        }
    }
    protected function saveBaseFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getBasePath()) . $this->getBaseFileName();
        $image->save($path);
        return $path;
    }
    protected function saveBigFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getBigPath()) . $this->getBigFileName();
        $image->save($path);
        return $path;
    }
    protected function saveMobileFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobilePath()) . $this->getMobileFileName();
        $image->save($path);
        return $path;
    }
    protected function saveMobileThumbFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobileThumbPath()) . $this->getMobileThumbFileName();
        $image->save($path);
        return $path;
    }
    protected function saveThumbFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getThumbPath()) . $this->getThumbFileName();
        $image->save($path);
        return $path;
    }
    protected function getBasePath()
    {
        return self::DST_FOLDER . self::DST_BASE_IMAGE;
    }

    protected function getBigPath()
    {
        return self::DST_FOLDER . self::DST_BIG_IMAGE;
    }

    protected function getMobilePath()
    {
        return self::DST_FOLDER . self::DST_MOBILE_IMAGE;
    }

    protected function getMobileThumbPath()
    {
        return self::DST_FOLDER . self::DST_MOBILE_THUMB_IMAGE;
    }

    protected function getThumbPath()
    {
        return self::DST_FOLDER . self::DST_THUMB_IMAGE;
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

    protected function getBaseFileName()
    {
        if (empty($this->baseFilename)) {
            $extension = $this->data['base_image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getBasePath(),
                $this->data['base_image']->getClientOriginalName(),
                $extension
            );

            $this->baseFilename = $name;
        }
        return $this->baseFilename;
    }

    protected function getBigFileName()
    {
        if (empty($this->bigFilename)) {
            $extension = $this->data['big_image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getBigPath(),
                $this->data['big_image']->getClientOriginalName(),
                $extension
            );

            $this->bigFilename = $name;
        }
        return $this->bigFilename;
    }

    protected function getMobileFileName()
    {
        if (empty($this->mobileFilename)) {
            $extension = $this->data['mobile_image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getMobilePath(),
                $this->data['mobile_image']->getClientOriginalName(),
                $extension
            );

            $this->mobileFilename = $name;
        }
        return $this->mobileFilename;
    }

    protected function getMobileThumbFileName()
    {
        if (empty($this->mobileThumbFilename)) {
            $extension = $this->data['mobile_thumb_image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getMobileThumbPath(),
                $this->data['mobile_thumb_image']->getClientOriginalName(),
                $extension
            );

            $this->mobileThumbFilename = $name;
        }
        return $this->mobileThumbFilename;
    }

    protected function getThumbFileName()
    {
        if (empty($this->thumbFilename)) {
            $extension = $this->data['thumb_image']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getThumbPath(),
                $this->data['thumb_image']->getClientOriginalName(),
                $extension
            );

            $this->thumbFilename = $name;
        }
        return $this->thumbFilename;
    }
}
