<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SupportDepartment extends Model
{
    protected $table = 'support_departments';
    protected $fillable = ['name','lang','status'];
}
