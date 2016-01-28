<?php

namespace Fb\Jobs\Cms\Contacts;

use Fb\Jobs\Job;
use Fb\Models\Cms\Contact;
use Illuminate\Contracts\Bus\SelfHandling;

class DeactivateContact extends Job implements SelfHandling
{
    /**
     * @var Contact
     */
    private $contact;

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function handle()
    {
        $this->contact->active = false;
        $this->contact->save();

        return $this->contact;
    }
}
