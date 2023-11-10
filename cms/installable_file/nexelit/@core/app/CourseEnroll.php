<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CourseEnroll extends Model
{
    protected $table = 'course_enrolls';
    protected $fillable = ['total','name','email','user_id','payment_gateway','payment_track','transaction_id','payment_status','status','course_id','coupon','coupon_discounted','manual_payment_attachment'];

    public function course(){
        return $this->belongsTo(Course::class,'course_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function certificate(){
        return $this->belongsTo(CourseCertificate::class,'course_id','course_id')
            ->where('user_id',Auth::guard('web')->id());
    }
}
