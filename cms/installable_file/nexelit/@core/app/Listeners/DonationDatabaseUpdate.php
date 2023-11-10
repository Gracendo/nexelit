<?php

namespace App\Listeners;

use App\Donation;
use App\DonationLogs;
use App\Events\DonationSuccess;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DonationDatabaseUpdate
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
        if (empty($event->data) && !isset($event->data['transaction_id'])){return;}

        //update donation log status/transaction id

        $payment_log_details = DonationLogs::findOrFail($event->data['donation_log_id']);
        $payment_log_details->status = 'complete';
        $payment_log_details->transaction_id = $event->data['transaction_id'];
        $payment_log_details->save();

        $event_details = Donation::find($payment_log_details->donation_id);
        //update donation raised amount
        $event_details->raised = (int) $event_details->raised + (int) $payment_log_details->amount;
        $event_details->save();
    }
}
