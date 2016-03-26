<?php namespace Fb\Jobs\File;

use Illuminate\Contracts\Bus\SelfHandling;
use Fb\Jobs\Job;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Image;
use Fb\Models\File;

class Change extends Job implements SelfHandling
{
    private $image;
    private $file;

    public function __construct(File $file, UploadedFile $image)
    {
        $this->image = $image;
        $this->file = $file;
    }

    public function handle()
    {
        if (!empty($this->image)) {
            @unlink($this->file->path . '/' . $this->file->filename);

            $file = Image::make($this->image->getRealPath());
            $this->file->extension = $this->image->getClientOriginalExtension();
            $this->file->original_filename = $this->image->getClientOriginalName();
            $this->file->filename = $this->generateFileNameInFolder($this->file);

            $file->save($this->file->path . '/' . $this->file->filename);
            chmod($this->file->path . '/' . $this->file->filename, 0777);
            $this->file->save();
            return $this->file;
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