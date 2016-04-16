<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Gallery\ProjectImages\DestroyImage;
use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Delete as DeleteFile;

class DestroyProject extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var GalleryProject
     */
    private $project;

    public function __construct(GalleryProject $project)
    {
        $this->project = $project;
    }

    public function handle()
    {
        $file = $this->project->logo;
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }
        foreach ($this->project->images as $image) {
            $this->dispatchFromArray(DestroyImage::class, ['image' => $image]);
        }


        return $this->project->delete();
    }
}
