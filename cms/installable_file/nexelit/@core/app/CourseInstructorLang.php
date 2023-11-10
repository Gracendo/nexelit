<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseInstructorLang extends Model
{
    protected $table = 'course_instructor_langs';
    protected $fillable = ['instructor_id','description','lang'];
}
