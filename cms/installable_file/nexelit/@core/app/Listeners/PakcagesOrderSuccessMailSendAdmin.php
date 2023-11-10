<?php

namespace App\Listeners;

use App\Events\PackagesOrderSuccess;
use App\Facades\EmailTemplate;
use App\Mail\BasicMail;
use App\Mail\PlaceOrder;
use App\Order;
use App\PaymentLogs;
use App\PricePlan;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class PakcagesOrderSuccessMailSendAdmin
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
     * @param  PackagesOrderSuccess  $event
     * @return void
     */
    public function handle(PackagesOrderSuccess $event)
    {
        $orders = $event->orders;
        if (!isset($orders['order_id']) && !isset($orders['transaction_id'])){return;}

        $order_details = Order::find($orders['order_id']);
        $order_page_form_mail = get_static_option('order_page_form_mail');
        $order_mail = $order_page_form_mail ?: get_static_option('site_global_email');

        try {
            Mail::to($order_mail)->send(new BasicMail(EmailTemplate::packageOrderAdminMail($order_details)));
        }catch (\Exception $e){
            //show error message
            \Log::info($e->getMessage());
        }
    }
}
