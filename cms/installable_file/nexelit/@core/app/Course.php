<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table = 'courses';
    protected $fillable = ['image','status','duration','duration_type','max_student','enrolled_student','featured','external_url','price','sale_price','enroll_required','og_meta_image','instructor_id','curriculum_id','categories_id'];


    public function setCurriculumIdAttribute($value)
    {
        $val = $value ?? [];
        $this->attributes['curriculum_id'] = serialize($val);
    }
    public function setFeaturedAttribute($value)
    {
        $this->attributes['featured'] = !empty($value) ? 'yes' : 'no';
    }
    public function setEnrollRequiredAttribute($value)
    {
        $this->attributes['enroll_required'] = !empty($value) ? 'yes' : 'no';
    }

    public function lang_query(){
        return $this->hasOne(CourseLang::class,'course_id');
    }
    public function lang(){
        return $this->hasOne(CourseLang::class,'course_id')->where('lang',get_default_language());
    }
    public function lang_front(){
        return $this->hasOne(CourseLang::class,'course_id')->where('lang',get_user_lang());
    }
    public function lang_all(){
        return $this->hasMany(CourseLang::class,'course_id');
    }
    public function category(){
        return $this->belongsTo(CoursesCategory::class,'categories_id');
    }
    public function instructor(){
        return $this->belongsTo(CourseInstructor::class,'instructor_id');
    }
    public function curriculum(){
        return $this->hasMany(CourseCurriculm::class,'course_id');
    }
    public function lesson_count(){
        return $this->hasMany(CourseLession::class,'course_id');
    }
    public function reviews(){
        return $this->hasMany(CourseReview::class,'course_id');
    }

}
