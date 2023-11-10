<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculm extends Model
{
    protected $table = 'course_curriculms';
    protected $fillable = ['course_id'];

    public function lang_all(){
        return $this->hasMany(CourseCurriculmLang::class,'curriculum_id');
    }
    public function lesson(){
        return $this->hasMany(CourseLession::class,'curriculum_id');
    }
    public function lang_front(){
        return $this->hasOne(CourseCurriculmLang::class,'curriculum_id')->where(['lang' => get_user_lang()]);
    }
    public function lang_query(){
        return $this->hasOne(CourseCurriculmLang::class,'curriculum_id');
    }
}
