<?php

namespace Fb\Jobs\Site;

use Fb\Jobs\Job;
use Fb\Models\Site;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateSite extends Job implements SelfHandling
{
    protected $site;

    /**
     * @var array
     */
    protected $data = [];

    const DST_FOLDER = '/images/site/';
    const DST_IMAGE = '';

    protected $absolutePath;

    protected $faviconName = 'favicon.ico';
    protected $bannerName = 'banner';

    public function __construct(Site $site, array $data)
    {
        $this->site = $site;
        $this->data = $data;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        $this->site->title = $this->data['title'];
        $this->site->description = $this->data['description'];
        $this->site->keywords = $this->data['keywords'];
        $this->site->footer = $this->data['footer'];
        $this->saveFavicon();
        $this->saveBanner();
        $this->site->save();
    }

    private function saveFavicon()
    {
        if (!empty($this->data['favicon'])) {
            $this->data['favicon']->move($this->absolutePath, $this->faviconName);
        }
    }

    private function saveBanner()
    {
        if (!empty($this->data['banner'])) {

            $imageFile = Image::make($this->data['banner']->getRealPath());
            $imagePath = $this->saveImageFile($imageFile);

            $this->site->banner_filename = basename($imagePath);
            $this->site->banner_path = $this->getImagePath();
        }
    }

    protected function saveImageFile(\Intervention\Image\Image $image)
    {
        $path = $this->getAbsolutePath($this->getImagePath()) . $this->getBannerFileName();
        $image->save($path);
        return $path;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }

    protected function getImagePath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getBannerFileName()
    {
        $extension =  $this->data['banner']->getClientOriginalExtension();
        return $this->bannerName . '.' . $extension;
    }
}
