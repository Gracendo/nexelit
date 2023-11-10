<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    protected $table = 'product_sub_categories';
    protected $fillable = ['title','status','lang','product_category_id'];

    public function category (){
        return $this->belongsTo(ProductCategory::class,'product_category_id');
    }

    public function products(){
        return $this->hasMany(Products::class,'subcategory_id','id');
    }
}
