<?php namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Models\Gallery\GalleryProject;
use Illuminate\Http\Request;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Support\Facades\Redirect;
use Fb\Jobs\Gallery\Project\StoreProject;
use Fb\Jobs\Gallery\Project\UpdateProject;


class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(GalleryCategory $categories)
    {
        return view('admin.gallery.projects.index', ['category' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, GalleryCategory $categories)
    {
        return view('admin.gallery.projects.create', [
            'category' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, GalleryCategory $categories)
    {
        $this->dispatchFromArray(StoreProject::class, ['category' => $categories, 'request' => $request]);
        return Redirect::route('admin.gallery.categories.projects.index', ['categories' => $categories->getKey()]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GalleryCategory $categories, GalleryProject $projects)
    {
        return view('admin.gallery.projects.edit', [
            'project' => $projects,
            'category' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GalleryCategory $categories, $id)
    {
        $project = GalleryProject::findOrFail($id);
        $this->dispatchFromArray(UpdateProject::class,
            ['project' => $project, 'request' => $request]);
        return Redirect::route('admin.gallery.categories.projects.index', ['categories' => $categories->getKey()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
