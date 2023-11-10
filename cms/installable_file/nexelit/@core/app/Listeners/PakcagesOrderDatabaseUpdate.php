<?php

namespace App\Listeners;

use App\Events\PackagesOrderSuccess;
use App\Order;
use App\PaymentLogs;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PakcagesOrderDatabaseUpdate
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

    public function handle(PackagesOrderSuccess $event)
    {
        $orders = $event->orders;
        if (!isset($orders['order_id']) && !isset($orders['transaction_id'])){return;}
        Order::find($orders['order_id'])->update(['payment_status' => 'complete']);
        PaymentLogs::where('order_id', $orders['order_id'])->update(['transaction_id' => $orders['transaction_id'], 'status' => 'complete']);
    }
}
