<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PricePlan extends Model
{
    protected $table = 'price_plans';
    protected $fillable = ['title','url_status','price','type','status','highlight','lang','features','btn_text','btn_url','categories_id'];

    public function category(){
        return $this->belongsTo('App\PricePlanCategory','categories_id');
    }
}
