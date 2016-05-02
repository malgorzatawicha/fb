<?php

namespace Fb\Models\Gallery;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Fb\Models\File;
use Illuminate\Database\Eloquent\Model;
use DB;

class GalleryProject extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'on_update'  => true
    ];

    protected $primaryKey = 'id';

    protected $fillable = [
        'name', 'title', 'short_title', 'active', 'description', 'position', 'gallery_category_id'
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    public function images()
    {
        return $this->hasMany(GalleryProjectImage::class, 'gallery_project_id', 'id');
    }
    
    public function logo()
    {
        return $this->belongsTo(File::class, 'logo_id', 'id');
    }

    public function hasMainImage()
    {
        return !empty($this->mainImage());
    }
    public function mainImage()
    {
        return GalleryProjectImage::where('gallery_project_id', $this->getKey())->first();
    }
}
