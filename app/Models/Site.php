<?php

namespace Fb\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'site';

    protected $fillable = [
        'title',
        'description',
        'banner_name',
        'banner_filename',
        'banner_path',
        'banner_extension'
    ];
}
