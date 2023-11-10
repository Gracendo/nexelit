<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';
    protected $fillable = ['image','categories_id','booking_time_ids','status','appointment_status','max_appointment','price'];

    public function setAppointmentStatusAttribute($value){
        $this->attributes['appointment_status'] = !empty($value) ? 'yes' : 'no';
    }
    public function category(){
        return $this->belongsTo(AppointmentCategory::class,'categories_id');
    }

    public function getBookingTimeIdsAttribute($value){
        $all_booking_time = AppointmentBookingTime::whereIn('id',explode(',',$value))->get();
        $all_times = $all_booking_time->map(function ($item){
            return ['id' => $item->id, 'time' => $item->time];
        })->toArray();
        return $all_times;
    }

    public function reviews(){
        return $this->hasMany(AppointmentLang::class,'appointment_id','appointment_id');
    }
    public function lang(){
        return $this->hasOne(AppointmentLang::class,'appointment_id')->where(['lang' => get_default_language()]);
    }
    public function lang_front(){
        return $this->hasOne(AppointmentLang::class,'appointment_id')->where(['lang' => get_user_lang()]);
    }
    public function lang_all(){
        return $this->hasMany(AppointmentLang::class,'appointment_id');
    }
    public function lang_query(){
        return $this->hasOne(AppointmentLang::class,'appointment_id');
    }
}
