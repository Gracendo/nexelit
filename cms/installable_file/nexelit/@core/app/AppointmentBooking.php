<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentBooking extends Model
{
    protected $table = 'appointment_bookings';
    protected $fillable = ['all_attachment','custom_fields','email','name','total','appointment_id','user_id','payment_gateway','payment_track','transaction_id','payment_status','status','booking_time_id','booking_date','manual_payment_attachment'];

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function booking_time(){
        return $this->belongsTo(AppointmentBookingTime::class,'booking_time_id');
    }
    public function appointment(){
        return $this->belongsTo(Appointment::class,'appointment_id');
    }

    public function setCustomFieldsAttribute($value){
        $final_value = $value ?? [];
        $test = $final_value;
        unset($test["manual_payment_attachment"]);
        $this->attributes['custom_fields'] = serialize($test) ;
        unset($test);
    }

    public function getCustomFieldsAttribute($value){
        return unserialize($value,['class' => false]);
    }
    public function setAllAttachmentAttribute($value){
        $final_value = $value ?? [];
        $this->attributes['all_attachment'] = serialize($final_value);
    }
    public function getAllAttachmentAttribute($value){
        return unserialize($value,['class' => false]);
    }
}
