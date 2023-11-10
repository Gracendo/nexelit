<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'title',
        'slug',
        'regular_price',
        'sale_price',
        'sku',
        'lang',
        'stock_status',
        'category_id',
        'short_description',
        'description',
        'attributes_title',
        'attributes_description',
        'total_sold',
        'image',
        'gallery',
        'status',
        'is_downloadable',
        'downloadable_file',
        'meta_tags',
        'meta_description',
        'badge',
        'tax_percentage',
        'variant',
        'subcategory_id',
        'direct_download',
        'download_count',
    ];
    public function category(){
        return $this->hasOne('App\ProductCategory','id','category_id');
    }
    public function subcategory(){
        return $this->hasOne(ProductSubCategory::class,'id','subcategory_id');
    }
    public function ratings(){
        return $this->hasMany('App\ProductRatings','product_id','id');
    }
}
