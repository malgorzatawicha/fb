<?php

namespace Fb\Jobs\Cms\Contacts;

use Fb\Jobs\Job;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Contact;
use Illuminate\Contracts\Bus\SelfHandling;

class DestroyContact extends Job implements SelfHandling
{
    protected $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function handle()
    {
        Contact::destroy($this->contact->getKey());
    }
}
