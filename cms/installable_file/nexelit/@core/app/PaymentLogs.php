<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentLogs extends Model
{
    protected $table = 'payment_logs';
    protected $fillable = ['email','name','package_name','package_price','package_gateway','order_id','status','track','transaction_id'];
}
