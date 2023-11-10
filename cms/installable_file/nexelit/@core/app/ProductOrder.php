<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    protected $table = 'product_orders';
    protected $fillable = [
        'payment_gateway',
        'payment_status',
        'transaction_id',
        'payment_track',
        'user_id',
        'status',
        'subtotal',
        'coupon_discount',
        'shipping_cost',
        'product_shippings_id',
        'total',
        'billing_name',
        'billing_email',
        'billing_phone',
        'billing_country',
        'billing_street_address',
        'billing_town',
        'billing_district',
        'different_shipping_address',
        'shipping_name',
        'shipping_email',
        'shipping_phone',
        'shipping_country',
        'shipping_street_address',
        'shipping_town',
        'shipping_district',
        'coupon_code',
        'cart_items',
    ];

    public function shipping_details(){
        return $this->belongsTo('App\ProductShipping','product_shippings_id');
    }
}
