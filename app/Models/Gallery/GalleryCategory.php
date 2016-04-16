<?php namespace Fb\Models\Gallery;

use Baum\Node;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Fb\Models\Cms\Page;
use Fb\Models\File;
use Illuminate\Database\Eloquent\Builder;
use DB;

/**
* GalleryCategory
*/
class GalleryCategory extends Node implements SluggableInterface {

    use SluggableTrait;
    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'on_update'  => true
    ];
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'gallery_categories';

    protected $fillable = [
        'name', 'title', 'active', 'description',
    ];


    public static function getTree()
    {
        return self::all()->toHierarchy();
    }

    public function tree()
    {
        return $this->getDescendantsAndSelf()->toHierarchy();
    }

    public function page()
    {
        return $this->hasOne(PageGallery::class);
    }

    public function projects()
    {
        return $this->hasMany(GalleryProject::class);
    }

    public function pathIn(Page $page)
    {
        $rootCategory = $page->gallery->galleryCategory;

        $result = [];
        $category = $this;
        while (!$category->isRoot() && $category->getKey() != $rootCategory->getKey())
        {
            $result[] = $category;
            $category = $category->parent;
        }
        $result[] = $rootCategory;
        return array_reverse($result);
    }

    public function randomImages($limit)
    {
        $categories = $this->getDescendantsAndSelf()->lists('id');
        return DB::table('gallery_project_images')
            ->select('gallery_project_images.name', 'gallery_project_images.thumb_path', 'gallery_project_images.thumb_filename')
            ->join('gallery_projects', 'gallery_project_images.gallery_project_id', '=', 'gallery_projects.id')
            ->whereIn('gallery_projects.gallery_category_id', $categories)
            ->orderByRaw("RAND()")
            ->limit($limit)->get();
    }

    public function logoFile()
    {
        return $this->belongsTo(File::class, 'logo_id', 'id');
    }
}
