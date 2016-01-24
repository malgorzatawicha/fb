<?php

namespace Fb\Models\Cms;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Page extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $sluggable = [
        'build_from' => 'title',
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
}
