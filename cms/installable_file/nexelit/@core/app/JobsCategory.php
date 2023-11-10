<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsCategory extends Model
{
    protected $table = 'jobs_categories';
    protected $fillable = ['title','status','lang'];
}
