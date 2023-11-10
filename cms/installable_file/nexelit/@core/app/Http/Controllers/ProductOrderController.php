<?php

namespace App\Http\Controllers;

use App\Events;
use App\Facades\Cart;
use App\Helpers\PaymentGatewayCredential;
use App\PaymentLogs;
use App\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductOrderController extends Controller
{
    private const SUCCESS_ROUTE = 'frontend.product.payment.success';
    private const CANCEL_ROUTE = 'frontend.product.payment.cancel';
    private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function product_checkout(Request $request){

        $this->validate($request,[
            'payment_gateway' => 'nullable|string',
            'subtotal' => 'required|string',
            'coupon_discount' => 'nullable|string',
            'shipping_cost' => 'nullable|string',
            'product_shippings_id' => 'nullable|string',
            'total' => 'required|string',
            'billing_name' => 'required|string',
            'billing_email' => 'required|string',
            'billing_phone' => 'required|string',
            'billing_country' => 'required|string',
            'billing_street_address' => 'required|string',
            'billing_town' => 'required|string',
            'billing_district' => 'required|string',
            'different_shipping_address' => 'nullable|string',
            'shipping_name' => 'nullable|string',
            'shipping_email' => 'nullable|string',
            'shipping_phone' => 'nullable|string',
            'shipping_country' => 'nullable|string',
            'shipping_street_address' => 'nullable|string',
            'shipping_town' => 'nullable|string',
            'shipping_district' => 'nullable|string'
        ],
        [
            'billing_name.required' => __('The billing name field is required.'),
            'billing_email.required' => __('The billing email field is required.'),
            'billing_phone.required' => __('The billing phone field is required.'),
            'billing_country.required' => __('The billing country field is required.'),
            'billing_street_address.required' => __('The billing street address field is required.'),
            'billing_town.required' => __('The billing town field is required.'),
            'billing_district.required' => __('The billing district field is required.')
        ]);

        if (!get_static_option('disable_guest_mode_for_product_module') && !auth()->guard('web')->check()){
            return back()->with(['type' => 'warning','msg' => __('login to place an order')]);
        }

        $order_details = ProductOrder::find($request->order_id);
        if (empty($order_details)){
            $order_details = ProductOrder::create([
                'payment_gateway' => $request->selected_payment_gateway,
                'payment_status' => 'pending',
                'payment_track' => Str::random(10). Str::random(10),
                'user_id' => auth('web')->check() ? auth('web')->id() : null,
                'subtotal' => $request->subtotal,
                'coupon_discount' => $request->coupon_discount,
                'coupon_code' => session()->get('coupon_discount'),
                'shipping_cost' => $request->shipping_cost,
                'product_shippings_id' => $request->product_shippings_id,
                'total' => $request->total,
                'billing_name'  => $request->billing_name,
                'billing_email'  => $request->billing_email,
                'billing_phone'  => $request->billing_phone,
                'billing_country' => $request->billing_country,
                'billing_street_address' => $request->billing_street_address,
                'billing_town' => $request->billing_town,
                'billing_district' => $request->billing_district,
                'different_shipping_address' => $request->different_shipping_address ? 'yes' : 'no',
                'shipping_name' => $request->shipping_name,
                'shipping_email' => $request->shipping_email,
                'shipping_phone' => $request->shipping_phone,
                'shipping_country' => $request->shipping_country,
                'shipping_street_address' => $request->shipping_street_address,
                'shipping_town' => $request->shipping_town,
                'shipping_district' => $request->shipping_district,
                'cart_items' => Cart::count() > 0 ? serialize(Cart::items()) : '',
                'status' =>  'pending',
            ]);
        }

        if (empty(get_static_option('site_payment_gateway'))){
            rest_cart_session();
            $order_id = Str::random(6).$order_details->id.Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }
         // check it price is equal to 0 
         if($order_details->total == 0){
            event(new Events\ProductOrders([
                'order_id' => $order_details->id,
                'transaction_id' => 'free-products'
            ]));
            $order_id = Str::random(6).$order_details->id.Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);
        }

        //have to work on below code
        if ($request->selected_payment_gateway === 'paypal') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.paypal.ipn'));
            $paypal = PaymentGatewayCredential::get_paypal_credential();
            $response = $paypal->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paytm') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.paytm.ipn'));
            $paytm = PaymentGatewayCredential::get_paytm_credential();
            $response = $paytm->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'manual_payment') {

            $this->validate($request, [
                'manual_payment_attachment' => 'required|file'
            ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

            $fileName = time().'.'.$request->manual_payment_attachment->extension();
            $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

            event(new Events\ProductOrders([
                'order_id' => $order_details->id,
                'transaction_id' => Str::random(20)
            ]));

            ProductOrder::where('id', $order_details->id)->update(['manual_payment_attachment' => $fileName]);
            $order_id = Str::random(6) . $order_details->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);


        } elseif ($request->selected_payment_gateway === 'stripe') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.stripe.ipn'));
            $stripe = PaymentGatewayCredential::get_stripe_credential();
            $response = $stripe->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'razorpay') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.razorpay.ipn'));
            $razorpay = PaymentGatewayCredential::get_razorpay_credential();
            $response = $razorpay->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paystack') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.price.plan.paystack.ipn'));
            $paystack = PaymentGatewayCredential::get_paystack_credential();
            $response = $paystack->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'payfast') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.payfast.ipn'));
            $payfast = PaymentGatewayCredential::get_payfast_credential();
            $response = $payfast->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'mollie') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.mollie.ipn'));
            $mollie = PaymentGatewayCredential::get_mollie_credential();
            $response = $mollie->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway == 'flutterwave') {

            $params = $this->common_charge_customer_data($order_details,route('frontend.product.flutterwave.ipn'));
            $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
            $response = $flutterwave->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'midtrans') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.midtrans.ipn'));
            $midtrans = PaymentGatewayCredential::get_midtrans_credential();
            $response = $midtrans->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cashfree') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.cashfree.ipn'));
            $cashfree = PaymentGatewayCredential::get_cashfree_credential();
            $response = $cashfree->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'instamojo') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.instamojo.ipn'));
            $instamojo = PaymentGatewayCredential::get_instamojo_credential();
            $response = $instamojo->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'marcadopago') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.marcadopago.ipn'));
            $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
            $response = $marcadopago->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'squareup') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.squreup.ipn'));
            $squareup = PaymentGatewayCredential::get_squareup_credential();
            $response = $squareup->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cinetpay') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.cinetpay.ipn'));
            $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
            $response = $cinetpay->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'paytabs') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.paytabs.ipn'));
            $paytabs = PaymentGatewayCredential::get_paytabs_credential();
            $response = $paytabs->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'billplz') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.billplz.ipn'));
            $billplz = PaymentGatewayCredential::get_billplz_credential();
            $response = $billplz->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'zitopay') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.zitopay.ipn'));
            $zitopay = PaymentGatewayCredential::get_zitopay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'toyyibpay') {

            $params = $this->common_charge_customer_data($order_details,route('frontend.product.toyyibpay.ipn'));
            $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
            $params['title'] = str::limit($params['title'],25);
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'pagalipay') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.pagalipay.ipn'));
            $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'authorizenet') {
            $params = $this->common_charge_customer_data($order_details,route('frontend.product.authorizenet.ipn'));
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


    private function common_charge_customer_data($order_details,$ipn_route,$payment_type = 'product') : array
    {
        $data = [
            'amount' => $order_details->total,
            'title' => 'Payment For Product Order Id: #'.$order_details->id,
            'description' =>'Payment For Product Order Id: #'.$order_details->id.' Payer Name: '.$order_details->billing_name.' Payer Email:'.$order_details->billing_email,
            'order_id' => $order_details->id,
            'track' => $order_details->payment_track,
            'cancel_url' => route(self::CANCEL_ROUTE, $order_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $order_details->id . random_int(333333, 999999)),
            'name' => $order_details->billing_name,
            'email' => $order_details->billing_email,
            'payment_type' => $payment_type,
            'ipn_url' => $ipn_route
        ];

        return $data;
    }

    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){

            event(new Events\ProductOrders([
                'order_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id']
            ]));

            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }

}
