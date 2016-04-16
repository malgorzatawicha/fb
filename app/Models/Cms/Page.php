<?php

namespace Fb\Models\Cms;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Fb\Models\File;
use Illuminate\Database\Eloquent\Model;
use \Rutorika\Sortable\SortableTrait;
use Fb\Models\Gallery\PageGallery;

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
        'position',
        'active',
        'type',
    ];

    public function banners()
    {
        return $this->hasMany(Banner::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function friends()
    {
        return $this->hasMany(Friend::class);
    }

    public function gallery()
    {
        return $this->hasOne(PageGallery::class);
    }

    public function logoFile()
    {
        return $this->belongsTo(File::class, 'logo_id', 'id');
    }
}
