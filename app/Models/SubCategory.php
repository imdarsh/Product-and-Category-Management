<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;


    public function childcategories() {
        return $this->hasMany(ChildCategory::class,'subcat_id');
    }
    public function product() {
        return $this->hasOne(Product::class);
    }
    public function category() {
        return $this->belongsTo(Category::class,'cat_id');
    }
}
