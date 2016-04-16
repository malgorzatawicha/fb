<?php

namespace Fb\Jobs\Cms\Friends;

use Fb\Jobs\Job;
use Fb\Jobs\File\Delete as DeleteFile;
use Fb\Models\Cms\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;

class DestroyFriend extends Job implements SelfHandling
{
    use DispatchesJobs;

    protected $friend;

    public function __construct(Friend $friend)
    {
        $this->friend = $friend;
    }

    public function handle()
    {
        $file = $this->friend->logoFile;
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }

        Friend::destroy($this->friend->getKey());
    }
}
