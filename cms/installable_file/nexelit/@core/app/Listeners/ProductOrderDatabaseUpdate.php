<?php

namespace App\Listeners;

use App\Events\ProductOrders;
use App\ProductOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ProductOrderDatabaseUpdate
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
     * @param  ProductOrders  $event
     * @return void
     */
    public function handle(ProductOrders $event)
    {
        $order_details = $event->order_details;
        if (!isset($order_details['transaction_id'])){return;}
        //implement database update process
        ProductOrder::find($order_details['order_id'])->update(['payment_status' => 'complete', 'transaction_id' => $order_details['transaction_id'] ]);
        rest_cart_session();

    }
}
