<?php

namespace App\Listeners;

use App\AppointmentBooking;
use App\EventPaymentLogs;


class AppointmentBookingDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(\App\Events\AppointmentBooking $event)
    {
        $data = $event->data;

        if (empty($data) && !isset($data['transaction_id'])) {
            return;
        }

        AppointmentBooking::findOrFail($data['appointment_id'])->update([
            'transaction_id' =>  $data['transaction_id'],
            'payment_status' => 'complete',
            'status' => 'confirm'
        ]);

    }
}
