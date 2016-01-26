<?php

namespace Fb\Models\Cms;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use \Rutorika\Sortable\SortableTrait;

class Page extends Model implements SluggableInterface
{
    use SluggableTrait, SortableTrait;

    protected $sluggable = [
        'build_from' => 'name',
        'save_to'    => 'slug',
        'on_update'  => true
    ];

    protected $fillable = [
        'name',
        'title',
        'description',
        'body',
        'logo_filename',
        'logo_path',
        'position'
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }
}
