<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentCategory extends Model
{
    protected $fillable = ['status'];
    public function lang(){
        return $this->hasOne(AppointmentCategoryLang::class,'cat_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(AppointmentCategoryLang::class,'cat_id')->where(['lang' => get_user_lang()]);
    }
    public function lang_all(){
        return $this->hasMany(AppointmentCategoryLang::class,'cat_id');
    }
}
