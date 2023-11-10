<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoursesCategoryLang extends Model
{
    protected $table = 'courses_category_langs';
    protected $fillable = ['cat_id','title','lang'];
}
