<?php namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Jobs\Cms\Banners\UpdateBanner;
use Fb\Jobs\Gallery\Category\DestroyCategory;
use Fb\Jobs\Gallery\Category\UpdateCategory;
use Illuminate\Http\Request;

use Fb\Http\Requests;
use Fb\Http\Controllers\Controller;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Support\Facades\Redirect;
use Fb\Jobs\Gallery\Category\StoreCategory;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.gallery.categories.index', [ 'categories' => GalleryCategory::getTree()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $parent = null;
        if ($request->has('node')) {
            $parent = GalleryCategory::findOrFail($request->node);
        }
        return view('admin.gallery.categories.create', [
            'categories' => GalleryCategory::getTree(),
            'parent' => $parent
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->dispatchFromArray(StoreCategory::class, ['data' => $request->all()]);
        return Redirect::route('admin.gallery.categories.index');
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
    public function edit($id)
    {
        $category = GalleryCategory::findOrFail($id);
        $parent = null;
        if (!$category->isRoot()) {
            $parent = $category->parent()->get();
        }
        return view(
            'admin.gallery.categories.edit',
            [
                'category' => $category,
                'parent' => $parent,
                'categories' => GalleryCategory::getTree()
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = GalleryCategory::findOrFail($id);
        $this->dispatchFromArray(UpdateCategory::class, ['data' => $request->all(), 'galleryCategory' => $category]);
        return Redirect::route('admin.gallery.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(GalleryCategory $category)
    {
        $this->dispatchFromArray(DestroyCategory::class, ['category' => $category]);
        return Redirect::route('admin.gallery.categories.index');
    }
}
