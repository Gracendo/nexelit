<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLession extends Model
{
    protected $table = 'course_lessions';
    protected $fillable = ['course_id','curriculum_id','video_embed_code','status','duration','duration_type','preview','file'];

    public function setPreviewAttribute($value){
        $this->attributes['preview'] = $value ? 'yes' : 'no';
    }
    public function lang(){
        return $this->hasOne(CourseLessionLang::class,'lession_id')->where('lang',get_default_language());
    }

    public function lang_query(){
        return $this->hasOne(CourseLessionLang::class,'lession_id');
    }
    public function lang_all(){
        return $this->hasMany(CourseLessionLang::class,'lession_id');
    }
    public function lang_front(){
        return $this->hasOne(CourseLessionLang::class,'lession_id')->where('lang',get_user_lang());
    }
    public function course(){
        return $this->hasOne(CourseLang::class,'course_id','course_id')->where('lang',get_default_language());
    }
    public function curriculum(){
        return $this->hasOne(CourseCurriculmLang::class,'curriculum_id','curriculum_id')->where('lang',get_default_language());
    }
}
