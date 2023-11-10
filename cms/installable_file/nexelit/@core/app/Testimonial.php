<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $table ='testimonials';
    protected $fillable = ['name','image','lang','status','description','designation'];
}
