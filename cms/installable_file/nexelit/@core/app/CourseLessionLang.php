<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLessionLang extends Model
{
    protected $table = 'course_lession_langs';
    protected $fillable = ['lession_id','lang','title','description'];
}
