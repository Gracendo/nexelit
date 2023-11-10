<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\CourseEnroll;
use App\DonationLogs;
use App\Events;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use Illuminate\Support\Facades\Mail;


class CourseEnrollSuccessMailSend
{

    public function __construct()
    {
        //
    }

    public function handle(Events\CourseEnrollSuccess $event)
    {
        $data = $event->data;

        if (empty($data) && !isset($data['transaction_id']) && !isset($data['enroll_id'])){
            return;
        }

        $enroll_details = CourseEnroll::findOrFail($data['enroll_id']);
        $admin_email = get_static_option('course_notify_mail') ?? get_static_option('site_global_email');

        try {
            Mail::to($enroll_details->email)->send(new BasicMail(EmailTemplate::courseEnrollUserMail($enroll_details)));
            Mail::to($admin_email)->send(new BasicMail(EmailTemplate::courseEnrollAdminMail($enroll_details)));
        }catch (\Exception $e){}


    }
}
