<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'carts';

    protected $fillable = [
        'id_user',
        'id_product',
        'quantity',
    ];

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'id_product_detail');
    }
    // Các quan hệ có thể được định nghĩa ở đây
}
