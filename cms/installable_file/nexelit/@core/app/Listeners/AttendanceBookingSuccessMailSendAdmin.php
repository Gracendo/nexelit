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

class AttendanceBookingSuccessMailSendAdmin
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
        $admin_mail =  get_static_option('event_attendance_receiver_mail') ?? get_static_option('site_global_email');
        try {
            Mail::to($admin_mail)->send(new BasicMail(EmailTemplate::eventBookingAdminMail($event_attendance)));
        }catch (\Exception $e){
            //show error message
        }

    }
}
