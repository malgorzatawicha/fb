<?php namespace Fb\Models\Gallery;

use Baum\Node;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Fb\Models\Cms\Page;
use Illuminate\Database\Eloquent\Builder;

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
        'name', 'title', 'active', 'description', 'logo_filename', 'logo_path'
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
            $result[] = $category->title;
            $category = $category->parent;
        }
        $result[] = $rootCategory->title;
        return array_reverse($result);
    }

}
