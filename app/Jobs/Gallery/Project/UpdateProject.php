<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\GalleryProject;
use Fb\Services\StorageProjectPath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;

class UpdateProject extends Job implements SelfHandling
{
    use DispatchesJobs;
        /**
     * @var array
     */
    private $data = [];

    protected $config = [];

    protected $project;

    protected $filename;

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
            'description' => $request->get('description'),
            'logo' => $request->file('logo'),
            'active' => $request->get('active'),
        ];

        $this->config = \config('fb.project');
    }
    public function handle()
    {
        $this->project->name = $this->data['name'];
        $this->project->title = $this->data['title'];
        $this->project->description = $this->data['description'];
        $this->project->active = $this->data['active'];
        $this->project = new GalleryProject([
            'name' => !empty($this->data['name'])?$this->data['name']:'',
            'title' => !empty($this->data['title'])?$this->data['title']:'',
            'description' => !empty($this->data['description'])?$this->data['description']:'',
            'active' => !empty($this->data['active'])?$this->data['active']:'',
        ]);
        $this->category->projects()->save($this->project);

        $this->saveLogo();

    }

    private function saveLogo()
    {
        $this->initializePaths();
        $logo = $this->data['logo'];
        $path = $this->config['path'] . '/' . $this->project->getKey() . '/' . $this->config['logo']['subPath'];

        $file = null;
        if (!empty($logo)) {
            $file = $this->saveImage($logo, $path);
        }
        if (!empty($file)) {
            $this->project->logo_id = $file->getKey();
            $this->project->save();
        }
    }

    protected function saveImage(UploadedFile $image, $basePath)
    {
        return $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $basePath]);
    }

    protected function initializePaths()
    {
        $service = new StorageProjectPath($this->project->getKey());
        $service->initializePaths();
    }
}
