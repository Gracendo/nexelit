<?php

namespace App\Listeners;

use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Events\AttendanceBooking;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AttendanceBookingDatabaseUpdate
{

    public function __construct()
    {
        //
    }

    public function handle(AttendanceBooking $event)
    {
        $data = $event->data;
        if (!isset($data['attendance_id']) && !isset($data['transaction_id'])){return;}

        //update attendance status
        $order_details = EventAttendance::findOrFail($data['attendance_id']);
        $order_details->payment_status = 'complete';
        $order_details->status = 'complete';
        $order_details->save();

        //update event payment log
        EventPaymentLogs::where('attendance_id',$data['attendance_id'])->update([
            'transaction_id' => $data['transaction_id'],
            'status' => 'complete'
        ]);

        //update event available tickets
        $event_details = Events::findOrFail($order_details->event_id);
        $event_details->available_tickets = (int) $event_details->available_tickets - $order_details->quantity;
        $event_details->save();
    }
}
