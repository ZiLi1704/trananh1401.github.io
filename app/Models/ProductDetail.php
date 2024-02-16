<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id', 'color', 'import_quantity', 'quantity', 'import_price', 'sale_price',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
