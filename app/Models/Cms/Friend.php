<?php

namespace Fb\Models\Cms;

use Fb\Models\File;
use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    protected $table = 'page_friends';

    protected $fillable = [
        'active', 'name', 'description', 'url', 'position'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function logoFile()
    {
        return $this->belongsTo(File::class, 'file_id', 'id');
    }

}
