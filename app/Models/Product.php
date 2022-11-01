<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function images() {
        return $this->hasMany(Images::class,'product_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class,'product_category');
    }
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class,'product_subcategory');
    }
    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class,'product_childcategory');
    }
}
