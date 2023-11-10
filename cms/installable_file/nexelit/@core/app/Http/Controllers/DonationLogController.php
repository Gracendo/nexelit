<?php

namespace App\Http\Controllers;
use App\DonationLogs;
use App\Events;
use App\Helpers\PaymentGatewayCredential;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class DonationLogController extends Controller
{
    const SUCCESS_ROUTE = 'frontend.donation.payment.success';
    const CANCEL_ROUTE = 'frontend.donation.payment.cancel';
    private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function store_donation_logs(Request $request){

        $this->validate($request,[
            'name' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'donation_id' => 'required|string',
            'amount' => 'required|string',
            'anonymous' => 'nullable|string',
            'selected_payment_gateway' => 'required|string',
        ],
            [
                'name.required' => __('Name field is required'),
                'email.required' => __('Email field is required'),
                'amount.required' => __('Amount field is required'),
            ]
        );

        if (!empty($request->order_id)){
            $payment_log_id =  $request->order_id;
        }else{
            $payment_log_id = DonationLogs::create([
                'email' =>  $request->email,
                'name' =>  $request->name,
                'donation_id' =>  $request->donation_id,
                'amount' =>  $request->amount,
                'anonymous' =>  !empty($request->anonymous) ? 1 : 0,
                'payment_gateway' =>  $request->selected_payment_gateway,
                'user_id' =>  auth()->check() ? auth()->user()->id : '',
                'status' =>  'pending',
                'track' =>  Str::random(10). Str::random(10),
            ])->id;
        }
        
        $donation_payment_details = DonationLogs::find($payment_log_id);

        if ($request->selected_payment_gateway === 'paypal') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.paypal.ipn'));
            $paypal = PaymentGatewayCredential::get_paypal_credential();
            $response = $paypal->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paytm') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.paytm.ipn'));
            $paytm = PaymentGatewayCredential::get_paytm_credential();
            $response = $paytm->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'manual_payment') {

            $this->validate($request, [
                'manual_payment_attachment' => 'required|file'
            ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

            $fileName = time().'.'.$request->manual_payment_attachment->extension();
            $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

            event(new Events\DonationSuccess([
                'donation_log_id' => $request->donation_id,
                'transaction_id' => Str::random(8)
            ]));

            DonationLogs::where('donation_id', $request->donation_id)->update(['manual_payment_attachment' => $fileName]);
            $order_id = Str::random(6) . $request->donation_id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);


        } elseif ($request->selected_payment_gateway === 'stripe') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.stripe.ipn'));
            $stripe = PaymentGatewayCredential::get_stripe_credential();
            $response = $stripe->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'razorpay') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.razorpay.ipn'));
            $razorpay = PaymentGatewayCredential::get_razorpay_credential();
            $response = $razorpay->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paystack') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.price.plan.paystack.ipn'));
            $paystack = PaymentGatewayCredential::get_paystack_credential();
            $response = $paystack->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'payfast') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.payfast.ipn'));
            $payfast = PaymentGatewayCredential::get_payfast_credential();
            $response = $payfast->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'mollie') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.mollie.ipn'));
            $mollie = PaymentGatewayCredential::get_mollie_credential();
            $response = $mollie->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway == 'flutterwave') {

            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.flutterwave.ipn'));
            $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
            $response = $flutterwave->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'midtrans') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.midtrans.ipn'));
            $midtrans = PaymentGatewayCredential::get_midtrans_credential();
            $response = $midtrans->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cashfree') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.cashfree.ipn'));
            $cashfree = PaymentGatewayCredential::get_cashfree_credential();
            $response = $cashfree->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'instamojo') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.instamojo.ipn'));
            $instamojo = PaymentGatewayCredential::get_instamojo_credential();
            $response = $instamojo->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'marcadopago') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.marcadopago.ipn'));
            $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
            $response = $marcadopago->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'squareup') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.squreup.ipn'));
            $squareup = PaymentGatewayCredential::get_squareup_credential();
            $response = $squareup->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cinetpay') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.cinetpay.ipn'));
            $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
            $response = $cinetpay->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'paytabs') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.paytabs.ipn'));
            $paytabs = PaymentGatewayCredential::get_paytabs_credential();
            $response = $paytabs->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'billplz') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.billplz.ipn'));
            $billplz = PaymentGatewayCredential::get_billplz_credential();
            $response = $billplz->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'zitopay') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.zitopay.ipn'));
            $zitopay = PaymentGatewayCredential::get_zitopay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'toyyibpay') {

            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.toyyibpay.ipn'));
            $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
            $params['title'] = str::limit($params['title'],25);
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'pagalipay') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.pagalipay.ipn'));
            $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'authorizenet') {
            $params = $this->common_charge_customer_data($donation_payment_details,route('frontend.donation.authorizenet.ipn'));
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


    private function common_charge_customer_data($donation_payment_details, $ipn_route, $payment_type = 'donation') : array
    {
        $data = [
            'amount' => $donation_payment_details->amount,
            'title' => __('Payment For Donation:').' '.optional($donation_payment_details->donation)->title ?? '',
            'description' => __('Payment For Donation:').' '.optional($donation_payment_details->donation)->title  ?? ''. ' #'.$donation_payment_details->id,
            'order_id' =>  $donation_payment_details->id,
            'track' => $donation_payment_details->track,
            'cancel_url' => route(self::CANCEL_ROUTE, $donation_payment_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $donation_payment_details->id . random_int(333333, 999999)),
            'email' => $donation_payment_details->email,
            'name' => $donation_payment_details->name,
            'payment_type' => $payment_type,
            'ipn_url' => $ipn_route
        ];

        return $data;
    }

    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new Events\DonationSuccess([
                'donation_log_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id'],
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }



}
