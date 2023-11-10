<?php

namespace App\Listeners;

use App\Events\ProductOrders;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use App\ProductOrder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class ProductOrderSuccessMailSend
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
        if (!$order_details['order_id']){return;}

        $order_details = ProductOrder::find($order_details['order_id']);

        try {
            Mail::to(get_static_option('site_global_email'))->send(new BasicMail(EmailTemplate::productOrderAdminMail($order_details)));
            Mail::to($order_details->billing_email)->send(new BasicMail(EmailTemplate::productOrderUserMail($order_details)));
        }catch (\Exception $e){
            //show error message
        }
    }
}
