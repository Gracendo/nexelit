<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCoupon extends Model
{
    protected $table = 'product_coupons';
    protected $fillable = ['code','discount','discount_type','expire_date','status'];
}
