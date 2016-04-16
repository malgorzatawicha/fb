<?php namespace Fb\Jobs\File\Fixed;

use Fb\Jobs\Job;
use Illuminate\Contracts\Bus\SelfHandling;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;
use Fb\Models\File;

class Create extends Job implements SelfHandling
{
    private $image;
    private $path;

    public function __construct(UploadedFile $image, $path)
    {
        $this->image = $image;
        $this->path = $path;
    }

    public function handle()
    {
        if (!empty($this->image)) {

            $fileObject = new File();
            $fileObject->extension = $this->image->getClientOriginalExtension();
            $fileObject->original_filename = $this->image->getClientOriginalName();
            $fileObject->path = $this->dirname($this->path);
            $fileObject->filename = $this->baseName($this->path) . '.' . $fileObject->extension;

            $this->image->move($fileObject->path,  $fileObject->filename);

            chmod($fileObject->path . '/' . $fileObject->filename, 0777);
            $fileObject->save();
            return $fileObject;
        }
        return null;
    }

    private function baseName($path)
    {
        return trim(substr($path, strrpos(trim($path), '/')), '/');
    }

    private function dirname($path)
    {
        return '/' .trim(substr($path, 0, strrpos(trim($path), '/')), '/');
    }
}