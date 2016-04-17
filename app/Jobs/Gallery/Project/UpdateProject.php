<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Fb\Services\StoragePaths\ProjectPath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;
use Fb\Models\File;

class UpdateProject extends Job implements SelfHandling
{
    use DispatchesJobs;
        /**
     * @var array
     */
    private $data = [];

    private $config = [];

    private $project;

    public function __construct(GalleryProject $project, Request $request)
    {
        $this->project = $project;
        $this->initialize($request);
    }
    private function initialize(Request $request)
    {
        $this->data = [
            'name' => $request->get('name'),
            'title' => $request->get('title'),
            'short_title' => $request->get('short_title'),
            'description' => $request->get('description'),
            'logo' => $request->file('logo'),
            'active' => $request->get('active'),
            'logo_exists' => $request->get('logo_existing')
        ];

        $this->config = \config('fb.project');
    }
    public function handle()
    {
        $this->project->name = $this->data['name'];
        $this->project->title = $this->data['title'];
        $this->project->short_title = $this->data['short_title'];
        $this->project->description = $this->data['description'];
        $this->project->active = $this->data['active'];
        $this->project->save();

        $this->saveLogo();
        $this->project->save();
    }

    private function saveLogo()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'],
            $this->data['logo_exists'],
            $this->data['logo'],
            $this->project->logoFile
        );

        $this->project->logo_id = !empty($fileInDb)?$fileInDb->getKey():null;
    }

    private function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb = null)
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
        $service = new ProjectPath($this->project->getKey());
        $service->initializePaths();
    }
}
