<?php

namespace Fb\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'is_active',
        'is_featured',
        'image_name',
        'image_path',
        'image_extension',
        'image_filename',
        'mobile_name',
        'mobile_path',
        'mobile_extension',
        'mobile_filename',
        'image_thumbnail_filename',
        'image_thumbnail_path',
        'image_thumbnail_extension',
        'mobile_thumbnail_filename',
        'mobile_thumbnail_path',
        'mobile_thumbnail_extension',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
