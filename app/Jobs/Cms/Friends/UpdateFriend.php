<?php

namespace Fb\Jobs\Cms\Friends;

use Fb\Models\Cms\Page;
use Fb\Models\Cms\Friend;
use Illuminate\Contracts\Bus\SelfHandling;
use Image;

class UpdateFriend extends StoreFriend implements SelfHandling
{
    protected $friend;

    public function __construct(Page $page, Friend $friend, array $data)
    {
        parent::__construct($page, $data);
        $this->friend = $friend;
    }

    public function handle()
    {
        $this->friend->active = $this->data['active'];
        $this->friend->name = $this->data['name'];
        $this->friend->description = $this->data['description'];

        $this->saveImage();

        $this->friend->save();
    }
}
