<?php

namespace Fb\Models\Shop;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'active',
        'is_featured',
        'image_name',
        'image_path',
        'image_extension',
        'mobile_image_name',
        'mobile_image_path',
        'mobile_extension'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
