<?php

namespace Fb\Jobs\Gallery\GalleryImages;

use Fb\Jobs\Job;
use Fb\Models\Gallery\Gallery;
use Fb\Models\Gallery\GalleryImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class StoreImage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];

    protected $gallery;

    protected $image;

    const DST_FOLDER = '/images/galleries/';
    const DST_IMAGE = '';
    const DST_IMAGE_THUMBNAILS = 'thumbnails/';
    const DST_MOBILE = 'mobile/';
    const DST_MOBILE_THUMBNAILS = 'mobile/thumbnails/';

    protected $absolutePath;

    protected $thumbnailSize = [
        'w' => 60,
        'h' => 60
    ];

    protected $imageFilename;
    protected $mobileFilename;

    public function __construct(Gallery $gallery, array $data)
    {
        $this->gallery = $gallery;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $this->image = new GalleryImage([
            'is_active' => $this->data['is_active']
        ]);
        $this->formatCheckboxValue();
        $this->saveImage();
        $this->saveMobile();

        $this->gallery->images()->save($this->image);
    }

    protected function saveImage()
    {
        if (!empty($this->data['image']) && !empty($this->data['image']['file'])) {
            $imageFile = Image::make($this->data['image']['file']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);
            $thumbPath = $this->saveImageThumnailFile($imageFile);

            $this->image->image_name = $this->data['image']['name'];
            $this->image->image_extension = $this->data['image']['file']->getClientOriginalExtension();
            $this->image->image_filename = basename($imagePath);
            $this->image->image_path = $this->getImagePath();
            $this->image->image_thumbnail_extension = $this->data['image']['file']->getClientOriginalExtension();
            $this->image->image_thumbnail_filename = basename($thumbPath);
            $this->image->image_thumbnail_path = $this->getImageThumbnailPath();
        }
    }

    protected function saveMobile()
    {
        if (!empty($this->data['mobile']) && !empty($this->data['mobile']['file'])) {
            $mobileFile = Image::make($this->data['mobile']['file']->getRealPath());
            $mobilePath = $this->saveMobileFile($mobileFile);
            $thumbPath = $this->saveMobileThumnailFile($mobileFile);

            $this->image->mobile_name = $this->data['mobile']['name'];
            $this->image->mobile_extension = $this->data['mobile']['file']->getClientOriginalExtension();
            $this->image->mobile_filename = basename($mobilePath);
            $this->image->mobile_path = $this->getMobilePath();
            $this->image->mobile_thumbnail_extension = $this->data['mobile']['file']->getClientOriginalExtension();
            $this->image->mobile_thumbnail_filename = basename($thumbPath);
            $this->image->mobile_thumbnail_path = $this->getMobileThumbnailPath();
        }
    }

    protected function saveImageFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImagePath()) . $this->getImageFileName();
        $image->save($path);
        return $path;
    }

    protected function saveImageThumnailFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImageThumbnailPath()) . $this->getImageThumbnailFileName();
        $image->resize($this->thumbnailSize['w'], $this->thumbnailSize['h'])->save($path);
        return $path;
    }

    protected function saveMobileFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobilePath()) . $this->getMobileFileName();
        $image->save($path);
        return $path;
    }

    protected function saveMobileThumnailFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getMobileThumbnailPath()) . $this->getMobileThumbnailFileName();
        $image->resize($this->thumbnailSize['w'], $this->thumbnailSize['h'])->save($path);
        return $path;
    }

    protected function formatCheckboxValue()
    {
        $this->image->is_active = ($this->image->is_active == null) ? 0 : 1;
    }

    protected function getImagePath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getImageThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE_THUMBNAILS;
    }

    protected function getMobilePath()
    {
        return self::DST_FOLDER . self::DST_MOBILE;
    }

    protected function getMobileThumbnailPath()
    {
        return self::DST_FOLDER . self::DST_MOBILE_THUMBNAILS;
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

    protected function getImageFileName()
    {
        if (empty($this->imageFilename)) {
            $extension = $this->data['image']['file']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getImagePath(),
                $this->data['image']['file']->getClientOriginalName(),
                $extension
            );

            $this->imageFilename = $name;
        }
        return $this->imageFilename;
    }

    protected function getImageThumbnailFileName()
    {
        return 'thumb-' . $this->getImageFileName();
    }

    protected function getMobileFileName()
    {
        if (empty($this->mobileFilename)) {
            $extension = $this->data['mobile']['file']->getClientOriginalExtension();

            $name = $this->generateFileNameInFolder(
                $this->getMobilePath(),
                $this->data['mobile']['file']->getClientOriginalName(),
                $extension
            );

            $this->mobileFilename = $name;
        }
        return $this->mobileFilename;
    }

    protected function getMobileThumbnailFileName()
    {
        return 'thumb-' . $this->getImageFileName();
    }
}
