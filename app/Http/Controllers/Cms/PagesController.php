<?php

namespace Fb\Http\Controllers\Cms;

use Fb\Jobs\Cms\Pages\StorePage;
use Fb\Jobs\Cms\Pages\UpdatePage;
use Fb\Jobs\Cms\Pages\DestroyPage;
use Fb\Models\Cms\Page;
use Illuminate\Http\Request;

use Fb\Http\Requests;
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
        return view('cms.pages.index', ['pages' => Page::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('cms.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        $this->dispatchFromArray(StorePage::class, ['data' => $request->all()]);

        return Redirect::route('admin.pages.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show(Page $page)
    {
        return view('cms.pages.show', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Page $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        return view('cms.pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Page $page)
    {
        $this->validate($request, [
            'title' => 'required|max:255'
        ]);

        $this->dispatchFromArray(
            UpdatePage::class,
            [
                'page' => $page,
                'data' => $request->all()
            ]
        );

        return Redirect::route('admin.pages.index');
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

        return Redirect::route('admin.pages.index');
    }
}
