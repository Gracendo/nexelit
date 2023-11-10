<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPaymentLogs extends Model
{
    protected $table = 'event_payment_logs';
    protected $fillable = ['email','name','event_name','event_cost','event_gateway','attendance_id','package_gateway','status','transaction_id','track'];
    public function attendance_logs(){
        return $this->belongsTo('App\EventAttendance','attendance_id');
    }
}
