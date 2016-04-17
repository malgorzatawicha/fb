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

    public function clearForJson($data)
    {
        if (!is_object($data) && !is_array($data)) {
            return preg_replace('#, "espots":.*?}\s]#', '', preg_replace('/\s+/', ' ',$data));
        }
        if (is_object($data)) {
            $data = $data->toArray();
        }
        $result = [];
        foreach ($data as $key => $value) {
            $result[$key] = $this->clearForJson($value);
        }
        return $result;
    }

    public function allProjects()
    {
        $categories = $this->getDescendantsAndSelf()->lists('id');
        return GalleryProject::whereIn('gallery_category_id', $categories)->get();
    }

    public function logoFile()
    {
        return $this->belongsTo(File::class, 'logo_id', 'id');
    }
}
