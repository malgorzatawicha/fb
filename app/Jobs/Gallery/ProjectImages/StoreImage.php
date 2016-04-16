<?php

namespace Fb\Jobs\Gallery\ProjectImages;

use Fb\Http\Requests\Galleries\ProjectImages\CreateImageRequest;
use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Fb\Models\Gallery\GalleryProjectImage;
use Fb\Services\StoragePaths\ProjectPath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Create as CreateFile;

class StoreImage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];
    private $config = [];

    /**
     * @var GalleryProject
     */
    private $project;

    /**
     * @var GalleryProjectImage
     */
    private $image;

    public function __construct(GalleryProject $project, CreateImageRequest $request)
    {
        $this->project = $project;
        $this->initialize($request);
    }

    private function initialize(CreateImageRequest $request)
    {
        $this->data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'active' => $request->get('active'),
            'watermarked' => $request->get('watermarked'),
            'image' => $request->file('image'),
            'thumb' => $request->file('thumb')
        ];

        $this->config = \config('fb.project');
        $this->initializePaths();
    }

    public function handle()
    {
        $this->image = new GalleryProjectImage([
            'active' => $this->data['active'],
            'watermarked' => $this->data['watermarked'],
            'name' => $this->data['name'],
            'description' => $this->data['description']
        ]);
        $this->saveBaseImage();
        $this->saveThumbImage();
        $this->project->images()->save($this->image);
    }

    private function saveBaseImage()
    {
        $image = $this->data['image'];
        $path = $this->config['path'] . '/' . $this->project->getKey() . '/' . $this->config['image']['subPaths']['base'];

        $file = null;
        if (!empty($image)) {
            $file = $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $path]);
        }
        if (!empty($file)) {
            $this->image->image_id = $file->getKey();
        }
    }
    private function saveThumbImage()
    {
        $image = $this->data['thumb'];
        $path = $this->config['path'] . '/' . $this->project->getKey() . '/' . $this->config['image']['subPaths']['thumb'];
        $file = null;
        if (!empty($image)) {
            $file = $this->dispatchFromArray(CreateFile::class, ['image' => $image, 'path' => $path]);
        }

        if (!empty($file)) {
            $this->image->thumb_id = $file->getKey();
        }
    }

    private function initializePaths()
    {
        $service = new ProjectPath($this->project->getKey());
        $service->initializePaths();
    }
  
}
