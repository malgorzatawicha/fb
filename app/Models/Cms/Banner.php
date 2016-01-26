<?php

namespace Fb\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'active', 'name', 'description', 'filename', 'path', 'position'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
