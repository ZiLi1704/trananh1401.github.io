<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'category_id', 'product_code', 'key_type', 'material', 'keyboard_type', 'switch',
        'backlight', 'battery', 'size', 'weight', 'compatibility', 'warranty', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function details()
    {
        return $this->hasOne(ProductDetail::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
