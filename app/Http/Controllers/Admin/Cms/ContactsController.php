<?php

namespace Fb\Http\Controllers\Admin\Cms;

use Fb\Jobs\Cms\Contacts\DestroyContact;
use Fb\Jobs\Cms\Contacts\ActivateContact;
use Fb\Jobs\Cms\Contacts\DeactivateContact;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\Contact;
use Illuminate\Http\Request;
use Redirect;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Jobs\Cms\Contacts\StoreContact;
use Fb\Http\Requests\Cms\Contacts\EditContactRequest;
use Fb\Http\Requests\Cms\Contacts\CreateContactRequest;
use Fb\Jobs\Cms\Contacts\UpdateContact;

class ContactsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateContactRequest $request, Page $page)
    {
        $this->dispatchFromArray(StoreContact::class, [
            'page' => $page,
            'data' => [
                'name' => $request->get('name'),
                'body' => $request->get('body'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }

    public function update(EditContactRequest $request, Page $page, $contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $this->dispatchFromArray(UpdateContact::class, [
            'page' => $page,
            'contact' => $contact,
            'data' => [
                'name' => $request->get('name'),
                'body' => $request->get('body'),
                'active' => $request->get('active')
            ]
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page, $contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $this->dispatchFromArray(DestroyContact::class, [
            'page' => $page,
            'contact' => $contact,
        ]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }

    public function activate(Page $page, $contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $this->dispatchFromArray(ActivateContact::class, ['contact' => $contact]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }

    public function deactivate(Page $page, $contactId)
    {
        $contact = Contact::findOrFail($contactId);
        $this->dispatchFromArray(DeactivateContact::class, ['contact' => $contact]);
        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }
}
