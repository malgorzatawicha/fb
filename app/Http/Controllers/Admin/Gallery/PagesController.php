<?php namespace Fb\Http\Controllers\Admin\Gallery;

use Fb\Http\Controllers\Controller;
use Fb\Models\Cms\Page;
use Fb\Models\Gallery\GalleryCategory;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Fb\Jobs\Gallery\Pages\Attach;
use Illuminate\Support\Facades\Redirect;

class PagesController extends Controller
{
    use DispatchesJobs;
    public function attach(Request $request, Page $page)
    {
        $category = GalleryCategory::findOrFail($request->get('category'));
        $this->dispatchFromArray(Attach::class, ['page' => $page, 'category' => $category]);

        return Redirect::route('admin.cms.pages.edit', ['pages' => $page->slug]);
    }
}