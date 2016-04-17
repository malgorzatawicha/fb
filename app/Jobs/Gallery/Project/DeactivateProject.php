<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Contracts\Bus\SelfHandling;

class DeactivateProject extends Job implements SelfHandling
{
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
        $this->project->active = false;
        $this->project->save();

        return $this->project;
    }
}
