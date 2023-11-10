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

class PakcagesOrderSuccessMailSendUser
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
        $payment_details = PaymentLogs::where('order_id', $orders['order_id'])->first();
        try{
            Mail::to($payment_details->email)->send(new BasicMail(EmailTemplate::packageOrderUserMail($order_details)));
        }catch (\Exception $e){
            //show error message
        }
    }
}
