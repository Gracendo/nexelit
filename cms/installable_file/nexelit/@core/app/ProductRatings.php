<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductRatings extends Model
{
    protected $table ='product_ratings';
    protected $fillable = ['ratings','message','product_id','user_id'];

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }
    public function product(){
        return $this->belongsTo('App\Products','product_id');
    }
}
