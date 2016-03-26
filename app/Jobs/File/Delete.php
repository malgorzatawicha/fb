<?php namespace Fb\Jobs\File;

use Illuminate\Contracts\Bus\SelfHandling;
use Fb\Jobs\Job;
use Image;
use Fb\Models\File;

class Delete extends Job implements SelfHandling
{
    private $file;

    public function __construct(File $file)
    {
        $this->file = $file;
    }

    public function handle()
    {
        @unlink($this->file->path . '/' . $this->file->filename);
        $this->file->delete();
    }
}