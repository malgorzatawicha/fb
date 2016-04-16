<?php

namespace Fb\Jobs\Cms\Friends;

use Fb\Models\Cms\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use Fb\Jobs\Job;
use Fb\Models\File;
use Fb\Services\StoragePaths\PagePath;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;

class UpdateFriend extends Job implements SelfHandling
{
    use DispatchesJobs;

    private $data = [];
    private $config = [];
    private $friend;

    public function __construct(Friend $friend, array $data)
    {
        $this->data = $data;
        $this->friend = $friend;
        $this->config = \config('fb.page');
    }

    public function handle()
    {
        $this->friend->active = $this->data['active'];
        $this->friend->name = $this->data['name'];
        $this->friend->description = $this->data['description'];
        $this->friend->url = $this->data['url'];

        $this->saveImage();

        $this->friend->save();
    }

    private function saveImage()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'] . '/' . $this->friend->page->getKey() . '/' . $this->config['friend']['subPath'],
            $this->data['file_exists'],
            $this->data['file'],
            $this->friend->logoFile
        );

        $this->friend->file_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }

    private function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb=null)
    {
        $this->initializePaths();
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
    private function initializePaths()
    {
        $service = new PagePath($this->friend->page->getKey());
        $service->initializePaths();
    }

}
