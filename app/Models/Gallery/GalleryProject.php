<?php

namespace Fb\Models\Gallery;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

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
        'name', 'title', 'active', 'description', 'logo_filename', 'logo_path', 'position'
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    public function images()
    {
        return $this->hasMany(GalleryProjectImage::class, 'gallery_project_id', 'id');
    }
}
