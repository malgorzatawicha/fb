<?php

namespace Fb\Models\Gallery;

use Fb\Models\File;
use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class GalleryProjectImage extends Model
{
    use SortableTrait;

    protected $fillable = [
        'name', 'active', 'watermarked', 'description', 'position'
    ];

    protected static $sortableField = 'position';
    protected static $sortableGroupField = 'gallery_project_id';

    public function project()
    {
        return $this->belongsTo(GalleryProject::class, 'gallery_project_id', 'id');
    }

    public function imageFile()
    {
        return $this->belongsTo(File::class, 'image_id', 'id');
    }

    public function thumbFile()
    {
        return $this->belongsTo(File::class, 'thumb_id', 'id');
    }
}
