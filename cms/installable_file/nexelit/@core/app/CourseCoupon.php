<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCoupon extends Model
{
    protected $table = 'course_coupons';
    protected $fillable = ['code','discount','discount_type','expire_date','status'];
}
