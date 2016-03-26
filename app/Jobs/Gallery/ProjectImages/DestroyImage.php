<?php

namespace Fb\Jobs\Gallery\ProjectImages;

use Fb\Jobs\Job;
use Fb\Models\File;
use Fb\Models\Gallery\GalleryProjectImage;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Delete as DeleteFile;

class DestroyImage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var GalleryProjectImage
     */
    protected $image;

    public function __construct(GalleryProjectImage $image)
    {
        $this->image = $image;
    }

    public function handle()
    {
        $this->deleteImage($this->image->imageFile);
        $this->deleteImage($this->image->thumbFile);
        $this->image->delete();
    }

    protected function deleteImage(File $file = null)
    {
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }
    }
}
