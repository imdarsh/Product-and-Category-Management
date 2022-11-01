<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function getSubCat()  {
        return $this->hasMany(SubCategory::class,'cat_id');
    }

    public function product() {
        return $this->hasOne(Product::class);
    }
}
