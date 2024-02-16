<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory,
         SoftDeletes;
    protected $table = 'categories';


    protected $fillable = ['name', 'brand_id', 'parent_id'];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public static function isNameUniqueForBrand($name, $brandId, $ignoreId = null)
    {
        $query = self::where('name', $name)
            ->where('brand_id', $brandId);

        if ($ignoreId !== null) {
            $query->where('id', '!=', $ignoreId);
        }

        return !$query->exists();
    }
    public static function isNameUniqueForBrandAndParent($name, $brandId, $parentCategoryId, $ignoreId = null)
    {
        return static::where('name', $name)
            ->where('brand_id', $brandId)
            ->where('parent_id', $parentCategoryId)
            ->when($ignoreId, function ($query) use ($ignoreId) {
                return $query->where('id', '!=', $ignoreId);
            })
            ->doesntExist();
    }
}
