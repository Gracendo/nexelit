<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCurriculmLang extends Model
{
    protected $table = 'course_curriculm_langs';
    protected $fillable = ['curriculum_id','description','title','lang'];
}
