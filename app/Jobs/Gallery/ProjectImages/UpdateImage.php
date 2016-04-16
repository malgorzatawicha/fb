<?php

namespace Fb\Jobs\Gallery\ProjectImages;

use Fb\Http\Requests\Galleries\ProjectImages\EditImageRequest;
use Fb\Jobs\Job;
use Fb\Models\File;
use Fb\Models\Gallery\GalleryProjectImage;
use Fb\Services\StoragePaths\ProjectPath;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Fb\Jobs\File\Create as CreateFile;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Jobs\File\Change as ChangeFile;

class UpdateImage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var array
     */
    private $data = [];
    private $config = [];

    /**
     * @var GalleryProjectImage
     */
    private $image;

    public function __construct(GalleryProjectImage $image, EditImageRequest $request)
    {
        $this->image = $image;
        $this->initialize($request);
    }

    private function initialize(EditImageRequest $request)
    {
        $this->data = [
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'active' => $request->get('active'),
            'watermarked' => $request->get('watermarked'),
            'image' => $request->file('image'),
            'image_exists' => $request->get('image_existing'),
            'thumb' => $request->file('thumb'),
            'thumb_exists' => $request->get('thumb_existing')
        ];

        $this->config = \config('fb.project');
        $this->initializePaths();
    }

    public function handle()
    {
        $this->image->active = $this->data['active'];
        $this->image->watermarked = $this->data['watermarked'];
        $this->image->name = $this->data['name'];
        $this->image->description = $this->data['description'];

        $this->saveBaseImage();
        $this->saveThumbImage();
        $this->image->save();
    }

    private function saveBaseImage()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'] . '/' . $this->image->project->getKey() . '/' . $this->config['image']['subPaths']['base'],
            $this->data['image_exists'],
            $this->data['image'],
            $this->image->imageFile
        );

        $this->image->image_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }
    private function saveThumbImage()
    {
        $fileInDb = $this->saveFile(
            $this->config['path'] . '/' . $this->image->project->getKey() . '/' . $this->config['image']['subPaths']['thumb'],
            $this->data['thumb_exists'],
            $this->data['thumb'],
            $this->image->thumbFile
        );

        $this->image->thumb_id = !empty($fileInDb)?$fileInDb->getKey():null;

    }


    private function saveFile($basePath, $isUploaded = false, UploadedFile $image = null, File $fileInDb=null)
    {
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
        $service = new ProjectPath($this->image->project->getKey());
        $service->initializePaths();
    }
}
