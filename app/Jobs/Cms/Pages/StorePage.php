<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;

class StorePage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        $page = new Page();

        $page->title = !empty($this->data['title'])?$this->data['title']:'';
        $page->body =  !empty($this->data['body'])?$this->data['body']:'';
        $page->save();

        return $page;
    }
}
