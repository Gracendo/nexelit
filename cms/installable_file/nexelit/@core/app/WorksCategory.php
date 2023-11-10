<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorksCategory extends Model
{
    protected $table = 'works_categories';
    protected $fillable = ['name','status','lang'];
}
