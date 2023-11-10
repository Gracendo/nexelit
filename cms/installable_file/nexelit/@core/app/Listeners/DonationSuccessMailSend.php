<?php

namespace App\Listeners;

use App\DonationLogs;
use App\Events\DonationSuccess;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use App\Mail\DonationMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class DonationSuccessMailSend
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
     * @param  DonationSuccess  $event
     * @return void
     */
    public function handle(DonationSuccess $event)
    {
        if (empty($event->data) && !isset($event->data['transaction_id']) && !isset($event->data['donation_log_id'])){
            return;
        }

        $donation_details = DonationLogs::findOrfail($event->data['donation_log_id']);
        $donation_notify_mail = get_static_option('donation_notify_mail');
        $admin_mail =  $donation_notify_mail ?? get_static_option('site_global_email');

        try {
            Mail::to($admin_mail)->send(new BasicMail(EmailTemplate::donationAdminMail($donation_details)));
            Mail::to($donation_details->email)->send(new BasicMail(EmailTemplate::donationUserMail($donation_details)));
        }catch (\Exception $e){
            //show error message
        }
    }
}
