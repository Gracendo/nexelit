<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInstructor extends Model
{
    protected $table = 'course_instructors';
    protected $fillable = ['image','social_icons','name','designation','social_icon_url'];

    public function setSocialIconsAttribute($value){
        $final_value = $value ?? [];
         $this->attributes['social_icons'] = serialize($final_value);
    }
    public function getSocialIconsAttribute($value){
         return unserialize($value,['class'=>false]);
    }
    public function getSocialIconUrlAttribute($value){
          return unserialize($value,['class'=>false]);
    }
    public function setSocialIconUrlAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['social_icon_url'] = serialize($final_value);
    }

    public function lang(){
        return $this->hasOne(CourseInstructorLang::class,'instructor_id')->where('lang',get_default_language());
    }
    public function lang_query(){
        return $this->hasOne(CourseInstructorLang::class,'instructor_id');
    }
    public function lang_front(){
        return $this->hasOne(CourseInstructorLang::class,'instructor_id')->where('lang',get_user_lang());
    }
    public function lang_all(){
        return $this->hasMany(CourseInstructorLang::class,'instructor_id');
    }
}
