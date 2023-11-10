<?php

namespace App\Http\Controllers\Frontend;

use App\Appointment;
use App\AppointmentBooking;
use App\AppointmentBookingTime;
use App\Facades\EmailTemplate;
use App\Helpers\PaymentGatewayCredential;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\Mail\ContactMessage;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class AppointmentBookingController extends Controller
{
    const SUCCESS_ROUTE = 'frontend.appointment.payment.success';
    const CANCEL_ROUTE = 'frontend.appointment.payment.cancel';
    const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function booking(Request $request){

        $this->validate($request,[
           'name' => 'required|string|max:191',
           'booking_date' => 'required|string|max:191',
           'appointment_id' => 'required|string|max:191',
           'booking_time_id' => 'required|string|max:191',
           'email' => 'required|email|max:191',
        ],[
            'name.required' => __('name is required'),
            'email.required' => __('email is required'),
            'booking_date.required' => __('select date'),
            'booking_time_id.required' => __('select time'),
        ]);
        if (!get_static_option('disable_guest_mode_for_appointment_module') && !auth()->guard('web')->check()){
            return back()->with(['type' => 'warning','msg' => __('login to place an order')]);
        }
        $appointment = Appointment::findOrFail($request->appointment_id);
        $max_appointment = AppointmentBooking::where(['appointment_id' => $appointment->id, 'booking_date' => date('d-m-y')])->count();

        if ( $max_appointment >= $appointment->max_appointment){
            $data['type'] = 'danger';
            $data['msg'] = __('no more appointment is not available for today');
            return back()->with($data);
        }

        if (empty($request->booking_id)){

            //check custom field validation
            $validated_data = $this->get_filtered_data_from_request(get_static_option('appointment_booking_page_form_fields'),$request);
            $all_attachment = $validated_data['all_attachment'];
            $all_field_serialize_data = $validated_data['field_data'];
            unset($all_field_serialize_data['captcha_token']);
            unset($all_field_serialize_data['transaction_id']);
            $booking_time = AppointmentBookingTime::find($all_field_serialize_data['booking_time_id']);
            $all_field_serialize_data['booking_time'] = $booking_time ? $booking_time->time : __('no time slot selected');
            unset($all_field_serialize_data['booking_time_id']);

            if (empty($request->selected_payment_gateway )){
                unset($all_field_serialize_data['payment_gateway']);
            }
            //save content to database
            $payment_status = 'pending';
            $booking_status = 'pending';
            if($appointment->price === 0 || empty($appointment->price)){

                $payment_status = 'complete';
                $booking_status = 'complete';
            }
            
            $new_appointment =  AppointmentBooking::create([
                'custom_fields' => $all_field_serialize_data,
                'all_attachment' => $all_attachment,
                'email' =>  $request->email,
                'name' => $request->name,
                'total' => $appointment->price,
                'appointment_id' => $appointment->id,
                'user_id' => auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null,
                'payment_gateway' => $request->selected_payment_gateway ?? '',
                'payment_track' => Str::random(10) . Str::random(10),
                'transaction_id' => null,
                'payment_status' => $payment_status,
                'booking_date' => $request->booking_date,
                'booking_time_id' => $request->booking_time_id,
                'status' => $booking_status,
            ]);
        }else{
            $new_appointment = AppointmentBooking::findOrFail($request->booking_id);
        }

        if ($request->selected_payment_gateway === 'paypal') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.paypal.ipn'));
            $paypal = PaymentGatewayCredential::get_paypal_credential();
            $response = $paypal->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paytm') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.paytm.ipn'));
            $paytm = PaymentGatewayCredential::get_paytm_credential();
            $response = $paytm->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'manual_payment') {

            $this->validate($request, [
                'manual_payment_attachment' => 'required|file'
            ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

            $fileName = time().'.'.$request->manual_payment_attachment->extension();
            $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

            event(new \App\Events\AppointmentBooking([
                'appointment_id' =>  $new_appointment->id,
                'transaction_id' => Str::random(20)
            ]));

            AppointmentBooking::where('id', $new_appointment->id)->update(['manual_payment_attachment' => $fileName]);
            $order_id = Str::random(6) . $new_appointment->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);


        } elseif ($request->selected_payment_gateway === 'stripe') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.stripe.ipn'));
            $stripe = PaymentGatewayCredential::get_stripe_credential();
            $response = $stripe->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'razorpay') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.razorpay.ipn'));
            $razorpay = PaymentGatewayCredential::get_razorpay_credential();
            $response = $razorpay->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paystack') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.price.plan.paystack.ipn'));
            $paystack = PaymentGatewayCredential::get_paystack_credential();
            $response = $paystack->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'payfast') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.payfast.ipn'));
            $payfast = PaymentGatewayCredential::get_payfast_credential();
            $response = $payfast->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'mollie') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.mollie.ipn'));
            $mollie = PaymentGatewayCredential::get_mollie_credential();
            $response = $mollie->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway == 'flutterwave') {

            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.flutterwave.ipn'));
            $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
            $response = $flutterwave->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'midtrans') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.midtrans.ipn'));
            $midtrans = PaymentGatewayCredential::get_midtrans_credential();
            $response = $midtrans->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cashfree') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.cashfree.ipn'));
            $cashfree = PaymentGatewayCredential::get_cashfree_credential();
            $response = $cashfree->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'instamojo') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.instamojo.ipn'));
            $instamojo = PaymentGatewayCredential::get_instamojo_credential();
            $response = $instamojo->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'marcadopago') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.marcadopago.ipn'));
            $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
            $response = $marcadopago->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'squareup') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.squreup.ipn'));
            $squareup = PaymentGatewayCredential::get_squareup_credential();
            $response = $squareup->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cinetpay') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.cinetpay.ipn'));
            $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
            $response = $cinetpay->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'paytabs') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.paytabs.ipn'));
            $paytabs = PaymentGatewayCredential::get_paytabs_credential();
            $response = $paytabs->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'billplz') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.billplz.ipn'));
            $billplz = PaymentGatewayCredential::get_billplz_credential();
            $response = $billplz->charge_customer($params);
            return $response;
        }
        elseif ($request->selected_payment_gateway === 'zitopay') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.zitopay.ipn'));
            $zitopay = PaymentGatewayCredential::get_zitopay_credential();

            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'toyyibpay') {

            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.toyyibpay.ipn'));
            $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
            $params['title'] = str::limit($params['title'],25);
            $params['description'] = str::limit($params['description'],28);
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'pagalipay') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.pagalipay.ipn'));
            $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'authorizenet') {
            $params = $this->common_charge_customer_data($new_appointment,route('frontend.appointment.authorizenet.ipn'));
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


    public function get_filtered_data_from_request($option_value,$request){

        $all_attachment = [];
        $all_quote_form_fields = (array) json_decode($option_value);
        $all_field_type = isset($all_quote_form_fields['field_type']) ? (array) $all_quote_form_fields['field_type'] : [];
        $all_field_name = isset($all_quote_form_fields['field_name']) ? $all_quote_form_fields['field_name'] : [];
        $all_field_required = isset($all_quote_form_fields['field_required'])  ? (object) $all_quote_form_fields['field_required'] : [];
        $all_field_mimes_type = isset($all_quote_form_fields['mimes_type']) ? (object) $all_quote_form_fields['mimes_type'] : [];

        //get field details from, form request
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token']);
        if (isset($all_field_serialize_data['captcha_token'])){
            unset($all_field_serialize_data['captcha_token']);
        }


        if (!empty($all_field_name)){
            foreach ($all_field_name as $index => $field){
                $is_required = !empty($all_field_required) && property_exists($all_field_required,$index) ? $all_field_required->$index : '';
                $mime_type = !empty($all_field_mimes_type) && property_exists($all_field_mimes_type,$index) ? $all_field_mimes_type->$index : '';
                $field_type = isset($all_field_type[$index]) ? $all_field_type[$index] : '';
                if (!empty($field_type) && $field_type == 'file'){
                    unset($all_field_serialize_data[$field]);
                }
                $validation_rules = !empty($is_required) ? 'required|': '';
                $validation_rules .= !empty($mime_type) ? $mime_type : '';

                //validate field
                $this->validate($request,[
                    $field => $validation_rules
                ]);

                if ($field_type == 'file' && $request->hasFile($field)) {
                    $filed_instance = $request->file($field);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-'.Str::random(32).'-'. $field .'.'. $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/applicant', $attachment_name);
                    $all_attachment[$field] = 'assets/uploads/attachment/applicant/' . $attachment_name;
                }
            }
        }
        return [
            'all_attachment' => $all_attachment,
            'field_data' => $all_field_serialize_data
        ];
    }

    private function common_charge_customer_data($booking_details,$ipn_route, $payment_type = 'appointment') : array
    {
        $data = [
            'amount' => $booking_details->total,
            'title' => __('Payment For Appointment Booking Id:'). ' #'.$booking_details->id,
            'description' => __('Payment For Appointment Booking Id:'). ' #'.$booking_details->id.' '.__('Payer Name: ').' '.$booking_details->name.' '.__('Payer Email:').' '.$booking_details->email,
            'order_id' => $booking_details->id,
            'track' => $booking_details->payment_track,
            'cancel_url' => route(self::CANCEL_ROUTE, $booking_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $booking_details->id . random_int(333333, 999999)),
            'email' => $booking_details->email,
            'name' => $booking_details->name,
            'payment_type' => $payment_type,
            'ipn_url' => $ipn_route
        ];
        return $data;
    }

    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new \App\Events\AppointmentBooking([
                'appointment_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id'],
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }


}
