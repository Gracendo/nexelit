<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'services';

    protected $fillable = ['title','meta_tag','icon_type','img_icon','sr_order','meta_description','status','slug','lang','icon','image','description','categories_id','excerpt','price_plan'];

    public function category(){
        return $this->belongsTo('App\ServiceCategory','categories_id');
    }
}
