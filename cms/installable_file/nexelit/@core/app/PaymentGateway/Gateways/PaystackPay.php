<?php


namespace App\PaymentGateway\Gateways;


use App\PaymentGateway\PaymentGatewayBase;
use Unicodeveloper\Paystack\Facades\Paystack;

class PaystackPay extends PaymentGatewayBase
{
    /**
     * this payment gateway will not work without this package
     * @ https://github.com/unicodeveloper/laravel-paystack
     * @param $amount
     * @return string
     */
    public function charge_amount($amount): string
    {
        // TODO: Implement charge_amount() method.
        if (in_array(self::global_currency(), $this->supported_currency_list())){
            return $amount;
        }
        return self::get_amount_in_ngn($amount);
    }
    /**
     * return params
     * transaction_id
     * type
     * track
     * */
    public function ipn_response(array $args =[])
    {
        // TODO: Implement ipn_response() method.
        $paymentDetails = Paystack::getPaymentData();
        if ($paymentDetails['status']) {
            $meta_data = $paymentDetails['data']['metadata'];
            return $this->verified_data([
                'transaction_id' =>  $paymentDetails['data']['reference'],
                'type' => $meta_data['type'],
                'track' => $meta_data['track'],
            ]);
        }
        return ['status' => 'failed'];
    }
    /**
     * @required param list
     * 'amount'
     * 'package_name'
     * name
     * email
     * order_id
     * track
     * */
    public function charge_customer(array $args)
    {
        // TODO: Implement charge_customer() method.
        $paystack_data['currency'] = $this->charge_currency();
        $paystack_data['price'] = $this->charge_amount($args['amount']);
        $paystack_data['package_name'] =  $args['package_name'];
        $paystack_data['name'] = $args['name'];
        $paystack_data['email'] = $args['email'];
        $paystack_data['order_id'] = $args['order_id'];
        $paystack_data['track'] = $args['track'];
        $paystack_data['route'] = $args['route'];
        $paystack_data['type'] = $args['type'];

        return view('payment.paystack')->with(['paystack_data' => $paystack_data]);

    }

    public function supported_currency_list()
    {
        // TODO: Implement supported_currency_list() method.
        return ['GHS','NGN'];
    }

    public function charge_currency()
    {
        // TODO: Implement charge_currency() method.
        if (in_array(self::global_currency(), $this->supported_currency_list())){
            return self::global_currency();
        }
        return  "NGN";
    }

    public function gateway_name()
    {
        // TODO: Implement geteway_name() method.
        return 'paystack';
    }
}