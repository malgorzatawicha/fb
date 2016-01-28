<?php

namespace Fb\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'page_friends';

    protected $fillable = [
        'active', 'name', 'description', 'filename', 'path', 'url', 'position'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
