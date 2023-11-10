<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentReview extends Model
{
    protected $table = 'appointment_reviews';
    protected $fillable = ['user_id','ratings','appointment_id','message'];

    public function appointment(){
        return $this->belongsTo(Appointment::class,'appointment_id');
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
