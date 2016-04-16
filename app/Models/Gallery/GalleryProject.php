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
        'name', 'title', 'active', 'description', 'position'
    ];

    public function category()
    {
        return $this->belongsTo(GalleryCategory::class);
    }

    public function images()
    {
        return $this->hasMany(GalleryProjectImage::class, 'gallery_project_id', 'id');
    }
    
    public function logo()
    {
        return $this->belongsTo(File::class, 'logo_id', 'id');
    }

    public function randomImages($limit)
    {
        return DB::table('gallery_project_images')
            ->select('gallery_project_images.name', 'gallery_project_images.thumb_id')
            ->join('gallery_projects', 'gallery_project_images.gallery_project_id', '=', 'gallery_projects.id')
            ->where('gallery_projects.id', '=', $this->getKey())
            ->orderByRaw("RAND()")
            ->limit($limit)->get();
    }
}
