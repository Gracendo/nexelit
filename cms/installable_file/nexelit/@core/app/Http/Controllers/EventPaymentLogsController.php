<?php

namespace App\Http\Controllers;

use App\EventAttendance;
use App\EventPaymentLogs;
use App\Events;
use App\Helpers\PaymentGatewayCredential;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventPaymentLogsController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.event.payment.cancel';
    private const SUCCESS_ROUTE = 'frontend.event.payment.success';
    private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function booking_payment_form(Request $request){
        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'attendance_id' => 'required|string'
        ],
        [
            'name.required' => __('Name field is required'),
            'email.required' => __('Email field is required')
        ]);

        if (!get_static_option('disable_guest_mode_for_event_module') && !auth()->guard('web')->check()){
            return back()->with(['type' => 'warning','msg' => __('login to place an order')]);
        }

        $event_details = EventAttendance::find($request->attendance_id);
        $event_info = Events::find($event_details->event_id);
        $event_payment_details = EventPaymentLogs::where('attendance_id',$request->attendance_id)->first();

        if (!empty($event_info->cost) && $event_info->cost > 0){
            $this->validate($request,[
                'payment_gateway' => 'required|string'
            ],[
                'payment_gateway.required' => __('Select A Payment Method')
            ]);
        }

        if (empty($event_payment_details)){
            $payment_log_id = EventPaymentLogs::create([
                'email' =>  $request->email,
                'name' =>  $request->name,
                'event_name' =>  $event_details->event_name,
                'event_cost' =>  ($event_details->event_cost * $event_details->quantity),
                'package_gateway' =>  $request->payment_gateway,
                'attendance_id' =>  $request->attendance_id,
                'status' =>  'pending',
                'track' =>  Str::random(10). Str::random(10),
            ])->id;
            $event_payment_details = EventPaymentLogs::find($payment_log_id);
        }


        if ($request->payment_gateway === 'paypal') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.paypal.ipn'));
            $paypal = PaymentGatewayCredential::get_paypal_credential();
            $response = $paypal->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'paytm') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.paytm.ipn'));
            $paytm = PaymentGatewayCredential::get_paytm_credential();
            $response = $paytm->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'manual_payment') {

            $this->validate($request, [
                'manual_payment_attachment' => 'required|file'
            ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

            $fileName = time().'.'.$request->manual_payment_attachment->extension();
            $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

            event(new Events\AttendanceBooking([
                'attendance_id' => $request->attendance_id,
                'transaction_id' => Str::random(16)
            ]));

            EventPaymentLogs::where('attendance_id', $request->attendance_id)->update(['manual_payment_attachment' => $fileName]);
            $order_id = Str::random(6) . $request->attendance_id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);


        } elseif ($request->payment_gateway === 'stripe') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.stripe.ipn'));
            $stripe = PaymentGatewayCredential::get_stripe_credential();
            $response = $stripe->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'razorpay') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.razorpay.ipn'));
            $razorpay = PaymentGatewayCredential::get_razorpay_credential();
            $response = $razorpay->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'paystack') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.price.plan.paystack.ipn'));
            $paystack = PaymentGatewayCredential::get_paystack_credential();
            $response = $paystack->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'payfast') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.payfast.ipn'));
            $payfast = PaymentGatewayCredential::get_payfast_credential();
            $response = $payfast->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'mollie') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.mollie.ipn'));
            $mollie = PaymentGatewayCredential::get_mollie_credential();
            $response = $mollie->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway == 'flutterwave') {

            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.flutterwave.ipn'));
            $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
            $response = $flutterwave->charge_customer($params);
            return $response;

        } elseif ($request->payment_gateway === 'midtrans') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.midtrans.ipn'));
            $midtrans = PaymentGatewayCredential::get_midtrans_credential();
            $response = $midtrans->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'cashfree') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.cashfree.ipn'));
            $cashfree = PaymentGatewayCredential::get_cashfree_credential();
            $response = $cashfree->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'instamojo') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.instamojo.ipn'));
            $instamojo = PaymentGatewayCredential::get_instamojo_credential();
            $response = $instamojo->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'marcadopago') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.marcadopago.ipn'));
            $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
            $response = $marcadopago->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'squareup') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.squreup.ipn'));
            $squareup = PaymentGatewayCredential::get_squareup_credential();
            $response = $squareup->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'cinetpay') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.cinetpay.ipn'));
            $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
            $response = $cinetpay->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'paytabs') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.paytabs.ipn'));
            $paytabs = PaymentGatewayCredential::get_paytabs_credential();
            $response = $paytabs->charge_customer($params);
            return $response;
        }

        elseif ($request->payment_gateway === 'billplz') {

            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.billplz.ipn'));
            $billplz = PaymentGatewayCredential::get_billplz_credential();
            $response = $billplz->charge_customer($params);

            return $response;

        }
        elseif ($request->payment_gateway === 'zitopay') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.zitopay.ipn'));
            $zitopay = PaymentGatewayCredential::get_zitopay_credential();

            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->payment_gateway === 'toyyibpay') {

            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.toyyibpay.ipn'));
            $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
            $params['title'] = str::limit($params['title'],25);
            $params['description'] = str::limit($params['description'],28);
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->payment_gateway === 'pagalipay') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.pagalipay.ipn'));
            $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->payment_gateway === 'authorizenet') {
            $params = $this->common_charge_customer_data($event_details,$event_payment_details,route('frontend.event.authorizenet.ipn'));
            $authorizenet = PaymentGatewayCredential::get_authorizenet_credential();
            $response = $authorizenet->charge_customer($params);

            return $response;
        }

        return redirect()->route('homepage');
    }


    public function paypal_ipn()
    {
        $paypal = PaymentGatewayCredential::get_paypal_credential();
        $payment_data = $paypal->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function paytm_ipn()
    {
        $paytm = PaymentGatewayCredential::get_paytm_credential();
        $payment_data = $paytm->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function flutterwave_ipn()
    {
        $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
        $payment_data = $flutterwave->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function stripe_ipn()
    {
        $stripe = PaymentGatewayCredential::get_stripe_credential();
        $payment_data = $stripe->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function razorpay_ipn()
    {
        $razorpay = PaymentGatewayCredential::get_razorpay_credential();
        $payment_data = $razorpay->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function paystack_ipn()
    {
        $paystack = PaymentGatewayCredential::get_paystack_credential();
        $payment_data = $paystack->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function payfast_ipn()
    {
        $payfast = PaymentGatewayCredential::get_payfast_credential();
        $payment_data = $payfast->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function mollie_ipn()
    {
        $mollie = PaymentGatewayCredential::get_mollie_credential();
        $payment_data = $mollie->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function midtrans_ipn()
    {
        $midtrans = PaymentGatewayCredential::get_midtrans_credential();
        $payment_data = $midtrans->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function cashfree_ipn()
    {
        $cashfree = PaymentGatewayCredential::get_cashfree_credential();
        $payment_data = $cashfree->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function instamojo_ipn()
    {
        $instamojo = PaymentGatewayCredential::get_instamojo_credential();
        $payment_data = $instamojo->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function marcadopago_ipn()
    {
        $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
        $payment_data = $marcadopago->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function squreup_ipn()
    {
        $squareup = PaymentGatewayCredential::get_squareup_credential();
        $payment_data = $squareup->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function cinetpay_ipn()
    {
        $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
        $payment_data = $cinetpay->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function paytabs_ipn()
    {
        $paytabs = PaymentGatewayCredential::get_paytabs_credential();
        $payment_data = $paytabs->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function billplz_ipn()
    {
        $billplz = PaymentGatewayCredential::get_billplz_credential();
        $payment_data = $billplz->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function zitopay_ipn()
    {
        $zitopay = PaymentGatewayCredential::get_zitopay_credential();
        $payment_data = $zitopay->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function toyyibpay_ipn()
    {
        $toyyibpay = PaymentGatewayCredential::get_toyyibpay_credential();
        $payment_data = $toyyibpay->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function pagalipay_ipn()
    {
        $pagalipay = PaymentGatewayCredential::get_pagalipay_credential();
        $payment_data = $pagalipay->ipn_response();
        return $this->common_ipn_data($payment_data);
    }

    public function authorizenet_ipn()
    {
        $authorizenet = PaymentGatewayCredential::get_authorizenet_credential();
        $payment_data = $authorizenet->ipn_response();
        return $this->common_ipn_data($payment_data);
    }



    private function common_charge_customer_data($event_details,$event_payment_details, $ipn_route, $payment_type = 'event') : array
    {
        $data = [
            'amount' =>$event_details->event_cost * $event_details->quantity,
            'title' => 'Payment For Event Order Id: #'.$event_details->id,
            'description' => 'Payment For Event Order Id: #'.$event_details->id.' Event Name: '.$event_details->event_name.' Payer Name: '.$event_details->name.' Payer Email:'.$event_details->email,
            'order_id' =>  $event_details->id,
            'track' => $event_details->track,
            'cancel_url' => route(self::CANCEL_ROUTE, $event_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $event_details->id . random_int(333333, 999999)),
            'email' => $event_payment_details->email,
            'name' => $event_payment_details->name,
            'payment_type' => $payment_type,
            'ipn_url' => $ipn_route
        ];

        return $data;
    }

    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new Events\AttendanceBooking([
                'attendance_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id'],
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }

}
