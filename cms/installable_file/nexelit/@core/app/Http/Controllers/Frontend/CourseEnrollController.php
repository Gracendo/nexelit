<?php

namespace App\Http\Controllers\Frontend;

use App\Course;
use App\CourseCoupon;
use App\CourseEnroll;
use App\Events\CourseEnrollSuccess;
use App\Facades\EmailTemplate;
use App\Helpers\NexelitHelpers;
use App\Helpers\PaymentGatewayCredential;
use App\Http\Controllers\Controller;
use App\Mail\BasicMail;
use App\PaymentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CourseEnrollController extends Controller
{
    private const SUCCESS_ROUTE = 'frontend.course.payment.success';
    private const CANCEL_ROUTE = 'frontend.course.payment.cancel';
    private const STATIC_CANCEL_ROUTE = 'frontend.static.order.cancel';

    public function enroll_now(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:191',
            'email' => 'required|string|max:191',
            'course_id' => 'required|string',
        ], [
            'name.required' => __('name is required'),
            'email.required' => __('email is required'),
        ]);

        $course = Course::findOrFail($request->course_id);
        $max_enroll = CourseEnroll::where(['course_id' => $course->id])->count();


        if ($max_enroll >= $course->max_student) {
            $data['type'] = 'danger';
            $data['msg'] = __('max student limit reached');
            return back()->with($data);
        }

        if (empty($request->enroll_id)) {
            //save content to database
            $new_enroll = CourseEnroll::where(['course_id' => $request->course_id,'user_id' => auth()->guard('web')->id()])->first();
            if (is_null($new_enroll)){
                $new_enroll = CourseEnroll::create([
                    'email' => $request->email,
                    'name' => $request->name,
                    'code' => \Cookie::get('nexelit_cookie'),
                    'total' => $course->price,
                    'user_id' => auth()->guard('web')->check() ? auth()->guard('web')->user()->id : null,
                    'payment_gateway' => $request->selected_payment_gateway ?? '',
                    'payment_track' => Str::random(10) . Str::random(10),
                    'transaction_id' => null,
                    'payment_status' => !empty($course->price) && $course->price != 0 ? 'pending' : '',
                    'status' => 'pending',
                    'course_id' => $course->id,
                    'coupon' => $request->coupon,
                    'coupon_discounted' => $request->coupon ? $this->discounted_price($course->price, $request->coupon) : 0 // dicounted price
                ]); 
            }else{
                $new_enroll = CourseEnroll::findOrFail($new_enroll->id);
                $new_enroll->payment_gateway = $request->selected_payment_gateway ?? '';
                $new_enroll->coupon = $request->coupon;
                $new_enroll->coupon_discounted = $request->coupon ? $this->discounted_price($course->price, $request->coupon) : 0; // dicounted price
                $new_enroll->save();
                
                $new_enroll = CourseEnroll::findOrFail($new_enroll->id);
            }
        } else {
            $new_enroll = CourseEnroll::findOrFail($new_enroll->id);
            $new_enroll->payment_gateway = $request->selected_payment_gateway ?? '';
            $new_enroll->coupon = $request->coupon;
            $new_enroll->coupon_discounted = $request->coupon ? $this->discounted_price($course->price, $request->coupon) : 0; // dicounted price
            $new_enroll->save();
        }


        if ($request->selected_payment_gateway === 'paypal') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.paypal.ipn'));
            $paypal = PaymentGatewayCredential::get_paypal_credential();
            $response = $paypal->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paytm') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.paytm.ipn'));
            $paytm = PaymentGatewayCredential::get_paytm_credential();
            $response = $paytm->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'manual_payment') {

            $this->validate($request, [
                'manual_payment_attachment' => 'required|file'
            ], ['manual_payment_attachment.required' => __('Bank Attachment Required')]);

            $fileName = time().'.'.$request->manual_payment_attachment->extension();
            $request->manual_payment_attachment->move('assets/uploads/attachment/',$fileName);

            event(new CourseEnrollSuccess([
                'enroll_id' => $new_enroll->id,
                'transaction_id' => Str::random(20)
            ]));

            CourseEnroll::findOrFail($new_enroll->id)->update(['manual_payment_attachment' => $fileName]);
            $order_id = Str::random(6) . $new_enroll->id . Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE,$order_id);


        } elseif ($request->selected_payment_gateway === 'stripe') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.stripe.ipn'));
            $stripe = PaymentGatewayCredential::get_stripe_credential();
            $response = $stripe->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'razorpay') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.razorpay.ipn'));
            $razorpay = PaymentGatewayCredential::get_razorpay_credential();
            $response = $razorpay->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'paystack') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.price.plan.paystack.ipn'));
            $paystack = PaymentGatewayCredential::get_paystack_credential();
            $response = $paystack->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'payfast') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.payfast.ipn'));
            $payfast = PaymentGatewayCredential::get_payfast_credential();
            $response = $payfast->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'mollie') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.mollie.ipn'));
            $mollie = PaymentGatewayCredential::get_mollie_credential();
            $response = $mollie->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway == 'flutterwave') {

            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.flutterwave.ipn'));
            $flutterwave = PaymentGatewayCredential::get_flutterwave_credential();
            $response = $flutterwave->charge_customer($params);
            return $response;

        } elseif ($request->selected_payment_gateway === 'midtrans') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.midtrans.ipn'));
            $midtrans = PaymentGatewayCredential::get_midtrans_credential();
            $response = $midtrans->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cashfree') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.cashfree.ipn'));
            $cashfree = PaymentGatewayCredential::get_cashfree_credential();
            $response = $cashfree->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'instamojo') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.instamojo.ipn'));
            $instamojo = PaymentGatewayCredential::get_instamojo_credential();
            $response = $instamojo->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'marcadopago') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.marcadopago.ipn'));
            $marcadopago = PaymentGatewayCredential::get_marcadopago_credential();
            $response = $marcadopago->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'squareup') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.squreup.ipn'));
            $squareup = PaymentGatewayCredential::get_squareup_credential();
            $response = $squareup->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'cinetpay') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.cinetpay.ipn'));
            $cinetpay = PaymentGatewayCredential::get_cinetpay_credential();
            $response = $cinetpay->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'paytabs') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.paytabs.ipn'));
            $paytabs = PaymentGatewayCredential::get_paytabs_credential();
            $response = $paytabs->charge_customer($params);
            return $response;
        }

        elseif ($request->selected_payment_gateway === 'billplz') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.billplz.ipn'));
            $billplz = PaymentGatewayCredential::get_billplz_credential();
            $response = $billplz->charge_customer($params);
            return $response;
        }
        elseif ($request->selected_payment_gateway === 'zitopay') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.zitopay.ipn'));
            $zitopay = PaymentGatewayCredential::get_zitopay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'toyyibpay') {

            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.toyyibpay.ipn'));
            $zitopay = PaymentGatewayCredential::get_toyyibpay_credential();
            $params['title'] = str::limit($params['title'],25);
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'pagalipay') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.pagalipay.ipn'));
            $zitopay = PaymentGatewayCredential::get_pagalipay_credential();
            $response = $zitopay->charge_customer($params);

            return $response;
        }

        elseif ($request->selected_payment_gateway === 'authorizenet') {
            $params = $this->common_charge_customer_data($new_enroll,route('frontend.course.authorizenet.ipn'));
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

    private function discounted_price($price, $coupon)
    {
        //have to write code for get discounted price
        $return_val = 0;
        if (!empty($coupon)) {
            $coupon_details = CourseCoupon::where('code', $coupon)->first();
            if (!empty($coupon_details)) {
                if ($coupon_details->discount_type === 'percentage') {
                    $discount_bal = ($price / 100) * (int)$coupon_details->discount;
                    $return_val = $discount_bal;
                } elseif ($coupon_details->discount_type === 'amount') {
                    $return_val = $coupon_details->discount;
                }
            }
        }

        return $return_val;
    }
    private function discounted_amount($price, $coupon)
    {
        //have to write code for get discounted price
        $return_val = $price;
        if (!empty($coupon)) {
            $coupon_details = CourseCoupon::where('code', $coupon)->first();
            if (!empty($coupon_details)) {
                if ($coupon_details->discount_type === 'percentage') {
                    $discount_bal = ($price / 100) * (int)$coupon_details->discount;
                    $return_val = $price - $discount_bal;
                } elseif ($coupon_details->discount_type === 'amount') {
                    $return_val = $price - (int)$coupon_details->discount;
                }
            }
        }

        return $return_val;
    }

    private function common_charge_customer_data($enroll_details, $ipn_route, $payment_type = 'course') : array
    {
        $data = [
            'amount' => $this->discounted_amount($enroll_details->total, $enroll_details->coupon),
            'title' => __('Payment For Course Enroll Id:'). ' #'.$enroll_details->id,
            'description' => __('Payment For Course Enroll Id:'). ' #'.$enroll_details->id.' '.__('Payer Name: ').' '.$enroll_details->name.' '.__('Payer Email:').' '.$enroll_details->email,
            'order_id' =>  $enroll_details->id,
            'track' =>  $enroll_details->payment_track,
            'cancel_url' => route(self::CANCEL_ROUTE, $enroll_details->id),
            'success_url' => route(self::SUCCESS_ROUTE, random_int(333333, 999999) . $enroll_details->id . random_int(333333, 999999)),
            'name' => $enroll_details->name,
            'email' => $enroll_details->email,
            'payment_type' => $payment_type,
            'ipn_url' => $ipn_route
        ];

        return $data;
    }
    private function common_ipn_data($payment_data)
    {
        if (isset($payment_data['status']) && $payment_data['status'] === 'complete'){
            event(new CourseEnrollSuccess([
                'enroll_id' => $payment_data['order_id'],
                'transaction_id' => $payment_data['transaction_id'],
            ]));
            $order_id = Str::random(6) . $payment_data['order_id']. Str::random(6);
            return redirect()->route(self::SUCCESS_ROUTE, $order_id);
        }
        return redirect()->route(self::STATIC_CANCEL_ROUTE);
    }

}
