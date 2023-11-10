<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseCertificate extends Model
{
    protected $fillable = ['course_id','user_id','status'];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
