<?php

namespace App\Listeners;

use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Events\AttendanceBooking;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class AttendanceBookingSuccessMailSendUser
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AttendanceBooking  $event
     * @return void
     */
    public function handle(AttendanceBooking $event)
    {
        $data = $event->data;
        if (!isset($data['attendance_id']) && !isset($data['transaction_id'])){return;}

        $event_attendance = EventAttendance::find($data['attendance_id']);
        $event_payment_logs = EventPaymentLogs::where('attendance_id',$event_attendance->id)->first();

       try{
           Mail::to($event_payment_logs->email)->send(new BasicMail(EmailTemplate::eventBookingUserMail($event_attendance)));
       }catch (\Exception $e){

       }
    }
}
