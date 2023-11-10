<?php

namespace App\Http\Controllers;

use App\Events\JobApplication;
use App\Helpers\PaymentGatewayCredential;
use App\JobApplicant;
use App\Jobs;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JobPaymentController extends Controller
{
    private const CANCEL_ROUTE = 'frontend.job.payment.cancel';
    private const SUCCESS_ROUTE = 'frontend.job.payment.success';
    private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function store_jobs_applicant_data(Request $request)
    {
        $jobs_details = Jobs::find($request->job_id);
        $this->validate($request,[
            'email' => 'required|email',
            'name' => 'required|string',
            'job_id' => 'required',
        ],[
            'email.required' => __('email is required'),
            'email.email' => __('enter valid email'),
            'name.required' => __('name is required'),
            'job_id.required' => __('must apply to any job'),
        ]);
        if (!empty($jobs_details->application_fee_status) && $jobs_details->application_fee > 0){
            $this->validate($request,[
                'selected_payment_gateway' => 'required|string'
            ],
                ['selected_payment_gateway.required' => __('You must have to select a payment gateway')]);
        }

//        if (!empty($jobs_details->application_fee_status) && $jobs_details->application_fee > 0 && $request->selected_payment_gateway == 'manual_payment'){
//            $this->validate($request,[
//                'transaction_id' => 'required|string'
//            ],
//           ['transaction_id.required' => __('You must have to provide your transaction id')]);
//        }

        $job_applicant_id = JobApplicant::create([
            'jobs_id' => $request->job_id,
            'payment_gateway' => $request->selected_payment_gateway,
            'email' => $request->email,
            'name' => $request->name,
            'application_fee' => $request->application_fee,
            'track' => Str::random(30),
            'payment_status' => 'pending',
        ])->id;

        $all_attachment = [];
        $all_quote_form_fields = (array) json_decode(get_static_option('apply_job_page_form_fields'));
        $all_field_type = isset($all_quote_form_fields['field_type']) ? $all_quote_form_fields['field_type'] : [];
        $all_field_name = isset($all_quote_form_fields['field_name']) ? $all_quote_form_fields['field_name'] : [];
        $all_field_required = isset($all_quote_form_fields['field_required']) ? $all_quote_form_fields['field_required'] : [];
        $all_field_required = (object) $all_field_required;
        $all_field_mimes_type = isset($all_quote_form_fields['mimes_type']) ? $all_quote_form_fields['mimes_type'] : [];
        $all_field_mimes_type = (object) $all_field_mimes_type;

        //get field details from, form request
        $all_field_serialize_data = $request->all();
        unset($all_field_serialize_data['_token'],$all_field_serialize_data['job_id'],$all_field_serialize_data['name'],$all_field_serialize_data['email'],$all_field_serialize_data['selected_payment_gateway']);

        if (!empty($all_field_name)){
            foreach ($all_field_name as $index => $field){
                $is_required = property_exists($all_field_required,$index) ? $all_field_required->$index : '';
                $mime_type = property_exists($all_field_mimes_type,$index) ? $all_field_mimes_type->$index : '';
                $field_type = isset($all_field_type[$index]) ? $all_field_type[$index] : '';
                $validation_rules = [];
                $validation_rules[] = !empty($is_required) ? 'required': 'nullable';
                if (!empty($field_type) && $field_type === 'file'){
                    unset($all_field_serialize_data[$field]);
                    if (!empty($mime_type)){
                        $validation_rules[]  = $mime_type;
                        $validation_rules[]  = 'max:200000';
                    }
                }
                if ($field_type === 'email'){
                    $validation_rules[]  = 'email';
                }

                //validate field

                $this->validate($request,[
                    $field => implode('|',$validation_rules)
                ]);

                if ($field_type == 'file' && $request->hasFile($field)) {
                    $filed_instance = $request->file($field);
                    $file_extenstion = $filed_instance->getClientOriginalExtension();
                    $attachment_name = 'attachment-'.$job_applicant_id.'-'. $field .Str::random(10).'.'. $file_extenstion;
                    $filed_instance->move('assets/uploads/attachment/applicant', $attachment_name);
                    $all_attachment[$field] = 'assets/uploads/attachment/applicant/' . $attachment_name;
                }
            }
        }

        $serialize_data = $all_field_serialize_data;
        unset($serialize_data['manual_payment_attachment']);

        //update database
         JobApplicant::where('id',$job_applicant_id)->update([
            'form_content' => serialize($serialize_data),
            'attachment' => serialize($all_attachment)
        ]);
        $job_applicant_details = JobApplicant::where('id',$job_applicant_id)->first();

        //check it application fee applicable or not
        if (!empty($jobs_details->application_fee_status) && $jobs_details->application_fee > 0){
            //have to redirect  to payment gateway route


            if ($request->selected_payment_gateway === 'paypal') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.paypal.ipn'));
                $paypal = PaymentGatewayCredential::get_paypal_credential();
                $response = $paypal->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'paytm') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.paytm.ipn'));
                $paytm = PaymentGatewayCredential::get_paytm_credential();
                $response = $paytm->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'manual_payment') {

                $this->validate($request, [
                    'manual_payment_attachment' => 'required|file'
                ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

                $fileName = time().'.'.$request->manual_payment_attachment->extension();
                $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

                event(new JobApplication([
                    'job_application_id' => $job_applicant_details->id,
                    'transaction_id' => Str::random(20)
                ]));

                JobApplicant::where('id', $job_applicant_details->id)->update(['manual_payment_attachment' => $fileName]);
                $order_id = Str::random(6) .$job_applicant_details->id . Str::random(6);
                return redirect()->route(self::SUCCESS_ROUTE,$order_id);


            } elseif ($request->selected_payment_gateway === 'stripe') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.stripe.ipn'));
                $stripe = PaymentGatewayCredential::get_stripe_credential();
                $response = $stripe->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'razorpay') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.razorpay.ipn'));
                $razorpay = PaymentGatewayCredential::get_razorpay_credential();
                $response = $razorpay->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'paystack') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.price.plan.paystack.ipn'));
                $paystack = PaymentGatewayCredential::get_paystack_credential();
                $response = $paystack->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'payfast') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.payfast.ipn'));
                $payfast = PaymentGatewayCredential::get_payfast_credential();
                $response = $payfast->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'mollie') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.mollie.ipn'));
                $mollie = PaymentGatewayCredential::get_mollie_credential();
                $response = $mollie->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway == 'flutterwave') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.flutterwave.ipn'));
                $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
                $response = $flutterwave->charge_customer($params);
                return $response;

            } elseif ($request->selected_payment_gateway === 'midtrans') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.midtrans.ipn'));
                $midtrans = PaymentGatewayCredential::get_midtrans_credential();
                $response = $midtrans->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'cashfree') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.cashfree.ipn'));
                $cashfree = PaymentGatewayCredential::get_cashfree_credential();
                $response = $cashfree->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'instamojo') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.instamojo.ipn'));
                $instamojo = PaymentGatewayCredential::get_instamojo_credential();
                $response = $instamojo->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'marcadopago') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.marcadopago.ipn'));
                $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
                $response = $marcadopago->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'squareup') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.squreup.ipn'));
                $squareup = PaymentGatewayCredential::get_squareup_credential();
                $response = $squareup->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'cinetpay') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.cinetpay.ipn'));
                $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
                $response = $cinetpay->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'paytabs') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.paytabs.ipn'));
                $paytabs = PaymentGatewayCredential::get_paytabs_credential();
                $response = $paytabs->charge_customer($params);
                return $response;
            }

            elseif ($request->selected_payment_gateway === 'billplz') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.billplz.ipn'));
                $billplz = PaymentGatewayCredential::get_billplz_credential();
                $response = $billplz->charge_customer($params);
                return $response;
            }
            elseif ($request->selected_payment_gateway === 'zitopay') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.zitopay.ipn'));
                $zitopay = PaymentGatewayCredential::get_zitopay_credential();

                $response = $zitopay->charge_customer($params);

                return $response;
            }

            elseif ($request->selected_payment_gateway === 'toyyibpay') {

                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.toyyibpay.ipn'));
                $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
                $params['title'] = str::limit($params['title'],25);
                $params['description'] = str::limit($params['description'],28);
                $response = $zitopay->charge_customer($params);

                return $response;
            }

            elseif ($request->selected_payment_gateway === 'pagalipay') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.pagalipay.ipn'));
                $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
                $response = $zitopay->charge_customer($params);

                return $response;
            }

            elseif ($request->selected_payment_gateway === 'authorizenet') {
                $params = $this->common_charge_customer_data($job_applicant_details,$jobs_details,route('frontend.job.authorizenet.ipn'));
                $authorizenet = PaymentGatewayCredential::get_authorizenet_credential();
                $response = $authorizenet->charge_customer($params);

                return $response;
            }

            return redirect()->route('homepage');

        }else{
            $succ_msg = get_static_option('apply_job_' . get_user_lang() . '_success_message');
            $success_message = !empty($succ_msg) ? $succ_msg : __('Your Application Is Submitted Successfully!!');
             event(new JobApplication([
                'transaction_id' => '',
                'job_application_id' => $job_applicant_details->id
            ]));
            return redirect()->back()->with(['msg' => $success_message, 'type' => 'success']);
        }
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


    private function common_charge_customer_data($job_applicant_details,$job_details, $ipn_route, $payment_type = 'job') : array
    {
        $data = [
            'amount' => $job_applicant_details->application_fee,
            'title' => __('Payment For Job Application Id:'). '#'.$job_applicant_details->id,
            'description' => __('Payment For Job Application Id:'). '#'.$job_applicant_details->id.' '.__('Job Title:').' '.$job_details->title.' '.__('Applicant Name:').' '.$job_applicant_details->name.' '.__('Applicant Email:').' '.$job_applicant_details->email,
            'order_id' => $job_applicant_details->id,
            'track' => $job_applicant_details->track,
            'cancel_url' => route(self::CANCEL_ROUTE, $job_applicant_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $job_applicant_details->id . random_int(333333, 999999)),
            'name' => $job_applicant_details->name,
            'email' => $job_applicant_details->email,
            'ipn_url' => $ipn_route,
            'payment_type' => $payment_type
        ];
        return $data;
    }

    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new JobApplication([
                'transaction_id' => $payment_data['transaction_id'],
                'job_application_id' => $payment_data['order_id'],
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }

}
