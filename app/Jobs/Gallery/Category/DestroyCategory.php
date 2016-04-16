<?php

namespace Fb\Jobs\Gallery\Category;

use Fb\Jobs\Gallery\Project\DestroyProject;
use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Delete as DeleteFile;

class DestroyCategory extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var GalleryCategory
     */
    private $category;

    public function __construct(GalleryCategory $category)
    {
        $this->category = $category;
    }

    public function handle()
    {
        $file = $this->category->logoFile;
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }
        foreach ($this->category->projects as $project) {
            $this->dispatchFromArray(DestroyProject::class, ['project' => $project]);
        }

        $page = $this->category->page;
        if (!empty($page)) {
            $page->delete();
        }
        return $this->category->delete();
    }
}
