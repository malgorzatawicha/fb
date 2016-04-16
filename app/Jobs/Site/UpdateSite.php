<?php

namespace Fb\Jobs\Site;

use Fb\Jobs\Job;
use Fb\Models\File;
use Fb\Models\Site;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Image;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Fixed\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Fixed\Change as ChangeFile;

class UpdateSite extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    protected $data = [];
    protected $config = [];

    protected $site;
    protected $favicon;
    protected $banner;

    public function __construct(Site $site, array $data)
    {
        $this->site = $site;
        $this->data = $data;
        $this->config = \config('fb.site');
    }

    public function handle()
    {
        $this->site->title = $this->data['title'];
        $this->site->description = $this->data['description'];
        $this->site->keywords = $this->data['keywords'];
        $this->site->footer = $this->data['footer'];
        $this->site->breadcrumb = $this->data['breadcrumb'];
        $this->saveFavicon();
        $this->saveBanner();
        $this->site->save();
    }

    protected function saveFavicon()
    {
        $fileInDb = $this->saveFile(
            $this->config['favicon']['path'],
            $this->data['favicon_exists'],
            $this->data['favicon'],
            $this->site->faviconFile
        );

        $this->site->favicon_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }
    protected function saveBanner()
    {
        $fileInDb = $this->saveFile(
            $this->config['banner']['path'],
            $this->data['banner_exists'],
            $this->data['banner'],
            $this->site->bannerFile
        );

        $this->site->banner_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }
    protected function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb = null)
    {
        if (empty($isUploaded) && empty($image) && !empty($fileInDb)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $fileInDb]);
            $fileInDb = false;
        } else if(!empty($isUploaded) && !empty($image)) {
            if (empty($fileInDb)) {
                $fileInDb = $this->dispatchFromArray(CreateFile::class, ['image'=> $image, 'path' => $basePath]);
            } else {
                $fileInDb = $this->dispatchFromArray(ChangeFile::class, ['image'=> $image, 'file' => $fileInDb]);
            }
        }
        return $fileInDb;
    }
}
