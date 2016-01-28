<?php

namespace Fb\Jobs\Cms\Friends;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;
use File;

class DestroyFriend extends Job implements SelfHandling
{
    protected $page;

    protected $friend;

    protected $absolutePath;

    const DST_FOLDER = '/images/pages/';
    const DST_IMAGE = '';

    public function __construct(Page $page, Friend $friend)
    {
        $this->page = $page;
        $this->friend = $friend;
        $this->absolutePath = public_path();
    }

    public function handle()
    {
        File::delete($this->getAbsolutePath($this->friend->path) . $this->friend->filename);

        Friend::destroy($this->friend->getKey());
    }

    protected function getPath()
    {
        return self::DST_FOLDER . self::DST_IMAGE;
    }

    protected function getAbsolutePath($relativePath)
    {
        return $this->absolutePath . $relativePath;
    }
}
