<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\DonationLogs;
use App\Events;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use Illuminate\Support\Facades\Mail;


class AppointmentBookingSuccessMailSend
{

    public function __construct()
    {
        //
    }


    public function handle(Events\AppointmentBooking $event)
    {
        $data = $event->data;

        if (empty($data) && !isset($data['transaction_id']) && !isset($data['donation_log_id'])){
            return;
        }

        $new_appointment_booking = AppointmentBooking::findOrFail($data['appointment_id']);
        $all_custom_fields = $new_appointment_booking->custom_fields;
        unset($all_custom_fields['appointment_id']);
        $all_custom_fields['booking_id'] = '#'.$new_appointment_booking->id;
        //mail to admin
        $admin_email = get_static_option('appointment_notify_mail') ?? get_static_option('site_global_email');
        try {
            Mail::to($admin_email)->send(new BasicMail(EmailTemplate::appointmentBookingMailAdmin($new_appointment_booking)));
            //mail to user
            Mail::to($new_appointment_booking->email)->send(new BasicMail(EmailTemplate::appointmentBookingMailUser($new_appointment_booking)));
        }catch (\Exception $e){
            //show error message
        }


    }
}
