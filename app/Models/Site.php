<?php

namespace Fb\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';

    protected $fillable = [
        'title',
        'description',
        'breadcrumb',
        'keywords',
        'footer'
    ];

    public function faviconFile()
    {
        return $this->belongsTo(File::class, 'favicon_id', 'id');
    }

    public function bannerFile()
    {
        return $this->belongsTo(File::class, 'banner_id', 'id');
    }
}
