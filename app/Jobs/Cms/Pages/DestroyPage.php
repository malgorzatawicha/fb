<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Cms\Banners\DestroyBanner;
use Fb\Jobs\Cms\Contacts\DestroyContact;
use Fb\Jobs\Cms\Friends\DestroyFriend;
use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Fb\Jobs\File\Delete as DeleteFile;

class DestroyPage extends Job implements SelfHandling
{
    use DispatchesJobs;
    /**
     * @var Page
     */
    private $page;

    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    public function handle()
    {
        $file = $this->page->logoFile;
        if (!empty($file)) {
            $this->dispatchFromArray(DeleteFile::class, ['file' => $file]);
        }
        foreach ($this->page->banners as $banner) {
            $this->dispatchFromArray(DestroyBanner::class, ['banner' => $banner]);
        }
        foreach ($this->page->contacts as $contact) {
            $this->dispatchFromArray(DestroyContact::class, ['contact' => $contact]);
        }
        foreach ($this->page->friends as $friend) {
            $this->dispatchFromArray(DestroyFriend::class, ['friend' => $friend]);
        }

        $gallery = $this->page->gallery;
        if (!empty($gallery)) {
            $gallery->delete();
        }

        return $this->page->delete();
    }
}
