<?php

namespace Fb\Models\Gallery;

use Illuminate\Database\Eloquent\Model;
use Rutorika\Sortable\SortableTrait;

class GalleryProjectImage extends Model
{
    use SortableTrait;

    protected $fillable = [
        'name', 'active', 'description',
        'base_filename', 'base_path',
        'big_filename', 'big_path',
        'mobile_filename', 'mobile_path',
        'thumb_filename', 'thumb_path',
        'mobile_thumb_filename', 'mobile_thumb_path', 'position'
    ];

    public function project()
    {
        return $this->belongsTo(GalleryProject::class);
    }

}
