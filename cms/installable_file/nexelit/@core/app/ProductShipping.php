<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductShipping extends Model
{
    protected $table = 'product_shippings';
    protected $fillable = ['title','status','lang','description','cost','order','is_default'];
}
