<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePlanCategory extends Model
{
    protected $table = 'price_plan_categories';
    protected $fillable = ['name','status','lang'];
}
