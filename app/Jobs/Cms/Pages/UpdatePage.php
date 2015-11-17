<?php

namespace Fb\Jobs\Cms\Pages;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdatePage extends Job implements SelfHandling
{
    /**
     * @var array
     */
    private $data = [];

    /**
     * @var Page
     */
    private $page;

    public function __construct(Page $page, array $data)
    {
        $this->data = $data;
        $this->page = $page;
    }

    public function handle()
    {
        $this->page->title = !empty($this->data['title'])?$this->data['title']:'';
        $this->page->body =  !empty($this->data['body'])?$this->data['body']:'';
        $this->page->save();

        return $this->page;
    }
}
