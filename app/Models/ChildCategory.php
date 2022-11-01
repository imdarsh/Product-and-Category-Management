<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildCategory extends Model
{
    use HasFactory;
    
    public function product() {
        return $this->hasOne(Product::class);
    }

    public function subcategory() {
        return $this->belongsTo(SubCategory::class,'subcat_id');
    }
    public function category() {
        return $this->belongsTo(Category::class,'cat_id');
    }
}
