<?php

namespace Fb\Jobs\Gallery\ProjectImages;

use Fb\Http\Requests\Galleries\ProjectImages\CreateImageRequest;
use Fb\Jobs\Job;
use Fb\Models\Gallery\GalleryProject;
use Fb\Models\Gallery\GalleryProjectImage;
use Fb\Services\SaveFile;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class StoreImage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];
    protected $config = [];

    /**
     * @var GalleryProject
     */
    protected $project;

    /**
     * @var GalleryProjectImage
     */
    protected $image;

    protected $filename;

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

        $this->config = \config('fb.project.image');
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

    protected function saveBaseImage()
    {
        $image = $this->data['image'];
        $basePath = $this->config['paths']['base'] . '/' . $this->project->getKey();
        if (!file_exists($basePath)) {
            mkdir($basePath);
            chmod($basePath, 0777);
        }
        $file = $this->saveImage($image, $basePath);
        if (!empty($file)) {
            $this->image->image_id = $file->getKey();
        }
    }
    protected function saveThumbImage()
    {
        $image = $this->data['thumb'];
        $basePath = $this->config['paths']['thumb'] . '/' . $this->project->getKey();
        if (!file_exists($basePath)) {
            mkdir($basePath, 0777, true);
        }
        $file = $this->saveImage($image, $basePath);
        if (!empty($file)) {
            $this->image->thumb_id = $file->getKey();
        }
    }

    protected function saveImage(UploadedFile $image, $basePath)
    {
        $service = new SaveFile($image, $basePath);
        return $service->execute();
    }
  
}
