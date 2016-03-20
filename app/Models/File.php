<?php

namespace Fb\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'filename',
        'extension',
        'original_filename',
        'path'
    ];
}
