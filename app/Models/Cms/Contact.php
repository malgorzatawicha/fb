<?php

namespace Fb\Models\Cms;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'page_contacts';

    protected $fillable = [
        'active', 'name', 'body', 'position'
    ];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
