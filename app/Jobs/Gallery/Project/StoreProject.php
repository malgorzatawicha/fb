<?php

namespace Fb\Jobs\Gallery\Project;

use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryCategory;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Services\SaveFile;

class StoreProject extends Job implements SelfHandling
{
    private $category;
    /**
     * @var array
     */
    private $data = [];

    protected $config = [];

    protected $project;

    protected $filename;

    public function __construct(GalleryCategory $category, Request $request)
    {
        $this->category = $category;
        $this->initialize($request);
    }
    private function initialize(Request $request)
    {
        $this->data = [
            'name' => $request->get('name'),
            'title' => $request->get('title'),
            'description' => $request->get('description'),
            'logo' => $request->file('logo'),
        ];

        $this->config = \config('fb.project.logo');
    }
    public function handle()
    {
        $this->project = new GalleryProject([
            'name' => !empty($this->data['name'])?$this->data['name']:'',
            'title' => !empty($this->data['title'])?$this->data['title']:'',
            'description' => !empty($this->data['description'])?$this->data['description']:'',
            'active' => !empty($this->data['active'])?$this->data['active']:'',
        ]);

        $this->saveLogo();

        $this->category->projects()->save($this->project);
    }

    private function saveLogo()
    {
        $logo = $this->data['logo'];
        $path = $this->config['path'];
        $file = $this->saveImage($logo, $path);
        if (!empty($file)) {
            $this->project->logo_id = $file->getKey();
        }
    }

    protected function saveImage(UploadedFile $image, $basePath)
    {
        $service = new SaveFile($image, $basePath);
        return $service->execute();
    }
}
