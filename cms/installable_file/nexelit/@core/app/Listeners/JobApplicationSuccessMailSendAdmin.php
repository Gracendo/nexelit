<?php

namespace App\Listeners;

use App\Events\JobApplication;
use App\Facades\EmailTemplate;
use App\JobApplicant;
use App\Jobs;
use App\Mail\BasicMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class JobApplicationSuccessMailSendAdmin
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
     * @param  JobApplication  $event
     * @return void
     */
    public function handle(JobApplication $event)
    {

        $data = $event->data;
        if (!isset($data['transaction_id']) && !isset($data['job_application_id'])){return;}

        $job_applicant_details = JobApplicant::where('id',$data['job_application_id'])->first();
        $receiver_mail_address = get_static_option('job_single_page_applicant_mail') ?? get_static_option('site_global_email');


       try{
           Mail::to($receiver_mail_address)->send(new BasicMail(EmailTemplate::jobAdminMail($job_applicant_details)));
       }catch (\Exception $e){
           //show error message
       }

    }
}
