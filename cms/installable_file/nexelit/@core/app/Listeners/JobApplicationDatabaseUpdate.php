<?php

namespace App\Listeners;

use App\Events\JobApplication;
use App\JobApplicant;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class JobApplicationDatabaseUpdate
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

        JobApplicant::where('id',$data['job_application_id'])->update([
            'transaction_id' => $data['transaction_id'],
            'payment_status' => 'complete',
        ]);
    }
}
