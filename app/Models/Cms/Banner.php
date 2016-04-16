<?php

namespace Fb\Models\Cms;

use Fb\Models\File;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'active', 'name', 'description', 'position'
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
