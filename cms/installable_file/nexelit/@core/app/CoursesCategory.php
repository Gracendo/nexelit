<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesCategory extends Model
{
    protected $table = 'courses_categories';
    protected $fillable = ['status','icon'];

    public function lang(){
       return $this->hasOne(CoursesCategoryLang::class,'cat_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(CoursesCategoryLang::class,'cat_id')->where(['lang' => get_user_lang()]);
    }
    public function course(){
        return $this->hasMany(Course::class,'categories_id');
    }
    public function lang_all(){
        return $this->hasMany(CoursesCategoryLang::class,'cat_id');
    }

}
