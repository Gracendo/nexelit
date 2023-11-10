<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PopupBuilder extends Model
{
    protected $table = 'popup_builders';
    protected $fillable = ['name','type','title','only_image','background_image','offer_time_end','button_text','button_link','btn_status','description','lang'];
}
