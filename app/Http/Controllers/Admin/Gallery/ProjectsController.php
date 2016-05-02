<?php namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Jobs\Gallery\Project\DestroyProject;
use Fb\Models\Gallery\GalleryProject;
use Illuminate\Http\Request;
use Fb\Jobs\Gallery\Project\ActivateProject;
use Fb\Jobs\Gallery\Project\DeactivateProject;
use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Support\Facades\Redirect;
use Fb\Jobs\Gallery\Project\StoreProject;
use Fb\Jobs\Gallery\Project\UpdateProject;
use Fb\Http\Requests\Galleries\Projects\CreateProjectRequest;
use Fb\Http\Requests\Galleries\Projects\EditProjectRequest;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallery.projects.index', ['projects' => GalleryProject::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('admin.gallery.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProjectRequest $request)
    {
        $this->dispatchFromArray(StoreProject::class, ['request' => $request]);
        return Redirect::route('admin.gallery.projects.index');
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
    public function edit(GalleryProject $projects)
    {
        return view('admin.gallery.projects.edit', [
            'project' => $projects
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditProjectRequest $request, GalleryProject $project)
    {
        $this->dispatchFromArray(UpdateProject::class,
            ['project' => $project, 'request' => $request]);
        return Redirect::route('admin.gallery.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryProject $project)
    {
        $this->dispatchFromArray(DestroyProject::class, ['project' => $project]);
        return Redirect::route('admin.gallery.projects.index');
    }

    public function activate(GalleryProject $project)
    {
        $this->dispatchFromArray(ActivateProject::class, ['project' => $project]);
        return Redirect::route('admin.gallery.projects.index');
    }

    public function deactivate(GalleryProject $project)
    {
        $this->dispatchFromArray(DeactivateProject::class, ['project' => $project]);
        return Redirect::route('admin.gallery.projects.index');
    }
}
