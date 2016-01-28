<?php

namespace Fb\Jobs\Cms\Contacts;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Contact;
use Illuminate\Contracts\Bus\SelfHandling;

class StoreContact extends Job implements SelfHandling
{
    /**
     * @var array
     */
    protected $data = [];

    protected $page;

    protected $contact;

    public function __construct(Page $page, array $data)
    {
        $this->page = $page;
        $this->data = $data;
    }

    public function handle()
    {
        $this->contact = new Contact([
            'active' => $this->data['active'],
            'name' => $this->data['name'],
            'body' => $this->data['body']
        ]);
        $this->page->contacts()->save($this->contact);
    }
}
