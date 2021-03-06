<?php

namespace Fb\Http\Controllers\Admin\Cms;

use Fb\Http\Requests\Cms\Pages\EditPageRequest;
use Fb\Jobs\Cms\Pages\StorePage;
use Fb\Jobs\Cms\Pages\UpdatePage;
use Fb\Jobs\Cms\Pages\DestroyPage;
use Fb\Jobs\Cms\Pages\ActivatePage;
use Fb\Jobs\Cms\Pages\DeactivatePage;
use Fb\Models\Cms\Page;
use Fb\Models\Cms\PageType;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Http\Request;

use Fb\Http\Requests\Cms\Pages\CreatePageRequest;
use Fb\Http\Controllers\Controller;
use Redirect;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.pages.index', ['pages' => Page::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cms.pages.create', ['types' => PageType::getPossibleTypes()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreatePageRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePageRequest $request)
    {
        $this->dispatchFromArray(StorePage::class, ['data' =>[
            'name' => $request->get('name'),
            'title' => $request->get('title'),
            'type' => $request->get('type'),
            'description' => $request->get('description'),
            'body' => $request->get('body'),
            'logo' => $request->file('logo'),
            'active' => $request->get('active')
        ]]);

        return Redirect::route('admin.cms.pages.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('admin.cms.pages.edit', [
            'page' => $page,
            'types' => PageType::getPossibleTypes($page),
            'categories' => GalleryCategory::getNestedList('name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EditPageRequest  $request
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(EditPageRequest $request, Page $page)
    {
        $this->dispatchFromArray(
            UpdatePage::class,
            [
                'page' => $page,
                'data' => [
                    'name' => $request->get('name'),
                    'title' => $request->get('title'),
                    'type' => $request->get('type'),
                    'description' => $request->get('description'),
                    'body' => $request->get('body'),
                    'logo' => $request->file('logo'),
                    'logo_exists' => $request->get('logo_existing'),
                    'active' => $request->get('active')
                ]
            ]
        );

        return Redirect::route('admin.cms.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        $this->dispatchFromArray(DestroyPage::class,['page' => $page]);

        return Redirect::route('admin.cms.pages.index');
    }

    public function activate(Page $page)
    {
        $this->dispatchFromArray(ActivatePage::class, ['page' => $page]);
        return Redirect::route('admin.cms.pages.index');
    }

    public function deactivate(Page $page)
    {
        $this->dispatchFromArray(DeactivatePage::class, ['page' => $page]);
        return Redirect::route('admin.cms.pages.index');
    }
}
