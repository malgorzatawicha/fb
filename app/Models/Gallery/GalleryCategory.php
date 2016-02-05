<?php namespace Fb\Models\Gallery;

use Baum\Node;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

/**
* GalleryCategory
*/
class GalleryCategory extends Node implements SluggableInterface {

    use SluggableTrait;
    /**
    * Table name.
    *
    * @var string
    */
    protected $table = 'gallery_categories';

    protected $fillable = [
        'name', 'title', 'active', 'description', 'logo_filename', 'logo_path'
    ];

    public static function tree()
    {
      return self::all()->toHierarchy();
    }

    public function page()
    {
        return $this->hasOne(PageGallery::class);
    }

    public function projects()
    {
        return $this->hasMany(GalleryProject::class);
    }
}
