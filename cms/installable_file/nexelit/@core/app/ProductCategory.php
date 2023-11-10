<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = ['title','status','lang','image'];

    public function subcategory(){
        return $this->hasMany(ProductSubCategory::class,'product_category_id');
    }

    public function products(){
        return $this->hasMany(Products::class,'category_id','id');
    }
}
