<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseLang extends Model
{
    protected $table = 'course_langs';
    protected $fillable = ['lang','title','description','meta_tag','meta_title','meta_description','og_meta_title','course_id','slug'];


}
