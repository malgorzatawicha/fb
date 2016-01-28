<?php

namespace Fb\Jobs\Cms\Contacts;

use Fb\Models\Cms\Page;
use Fb\Models\Cms\Contact;
use Illuminate\Contracts\Bus\SelfHandling;

class UpdateContact extends StoreContact implements SelfHandling
{
    protected $contact;

    public function __construct(Page $page, Contact $contact, array $data)
    {
        parent::__construct($page, $data);
        $this->contact = $contact;
    }

    public function handle()
    {
        $this->contact->active = $this->data['active'];
        $this->contact->name = $this->data['name'];
        $this->contact->body = $this->data['body'];

        $this->contact->save();
    }
}
