<?php namespace Fb\Jobs\File;

use Illuminate\Contracts\Bus\SelfHandling;
use Fb\Jobs\Job;
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
            $file = Image::make($this->image->getRealPath());
            $fileObject = new File();
            $fileObject->extension = $this->image->getClientOriginalExtension();
            $fileObject->original_filename = $this->image->getClientOriginalName();
            $fileObject->path = $this->path;
            $fileObject->filename = $this->generateFileNameInFolder($fileObject);

            $file->save($fileObject->path . '/' . $fileObject->filename);
            chmod($fileObject->path . '/' . $fileObject->filename, 0777);
            $fileObject->save();
            return $fileObject;
        }
        return null;
    }

    private function generateFileNameInFolder(File $file)
    {
        $name = md5($file->original_name . time()) . '.' . $file->extension;

        while(\File::exists($file->path . '/' . $name)) {
            $name = md5($name . time()) . '.' . $file->extension;
        }
        return $name;
    }

}