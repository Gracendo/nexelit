<?php
namespace App\Helpers;

use App\ProductCoupon;
use App\Products;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Static_;

class ProductModuleHelper{
    private $cart_items = [];
    private $coupon_code;

    public  function add_to_cart($id,$qty,$variant = null): array
    {
        $product_details = Products::find($id);
        $new_cart_item = [
            'id' => $product_details->id,
            'title' => $product_details->title,
            'variant' => $variant,
            'quantity' => $qty,
            'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
            'price' => $product_details->sale_price * $qty
        ];
        $this->add_new_item_to_cart($new_cart_item);
        return $this->cart_items;
    }

    private  function add_new_item_to_cart($new_item) : void
    {
        if (!empty( $this->cart_items)) {
            if (array_key_exists($new_item['id'],  $this->cart_items)) {
                //existing item of cart
                $existing_item = $this->cart_items[$new_item['id']];
                $old_cart_item[$new_item['id']]['quantity'] = $new_item['quantity'] + $existing_item['quantity'];
                $old_cart_item[$new_item['id']]['price'] = $existing_item['price'] + $new_item['price'];
                $old_cart_item[$new_item['id']]['variant'] = $new_item['variant'] ;
            } else {


                $product_details = Products::find($new_item['id']);
                //add new item in existing cart
                $this->cart_items[$new_item['id']] = [
                    'id' => $new_item['id'],
                    'title' => $new_item['title'],
                    'variant' => $new_item['variant'],
                    'quantity' => $new_item['quantity'],
                    'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
                    'price' => $new_item['price']
                ];
            }

        } else {
            $product_details = Products::find($new_item['id']);
            //new item in cart
            $this->cart_items[$new_item['id']] = [
                'id' => $new_item['id'],
                'title' => $new_item['title'],
                'quantity' => $new_item['quantity'],
                'variant' => $new_item['variant'],
                'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
                'price' => $new_item['price']
            ];
        }
    }

    public function subtotal(){
        $return_val = 0;
        if (!empty($this->cart_items)) {
            $return_val = 0;
            foreach ($this->cart_items as $product_id => $cat_data) {
                $return_val += (int) $cat_data['price'];
            }
            return $return_val;
        }

        return $return_val;
    }

    public function total($shipping_id,$coupon_code = null){
        $cart_sub_total = $this->subtotal();
        $get_coupon_discount = $this->coupon_discount($coupon_code);
        $get_shipping_charge = $this->shipping_cost($shipping_id);

        $return_val =  $cart_sub_total + $get_shipping_charge + $this->get_tax($get_coupon_discount);

        if (!empty($get_coupon_discount)) {
            $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
            if ($coupon_details->discount_type === 'percentage') {
                $discount_bal = ($cart_sub_total / 100) * (int) $coupon_details->discount;
                $return_val = $cart_sub_total - $discount_bal;
            } elseif ($coupon_details->discount_type === 'amount') {
                $return_val = $cart_sub_total - (int) $coupon_details->discount;
            }

            return $return_val + $get_shipping_charge + $this->get_tax();
        }

        return $return_val;
    }

    public function shipping_cost($shipping_id){
        if (!empty($shipping_id)) {
            $shipping_details = \App\ProductShipping::where('id', $shipping_id)->first();
            $shipping_details =  $shipping_details ?? 0;
            $return_val =  (int) $shipping_details->cost;
        }
        return $return_val ?? 0;
    }

    private function coupon_discount($coupon_code)
    {
        if ($coupon_code){
            $coupon_details = ProductCoupon::where('code',$coupon_code)->first();
            if ($coupon_details->discount_type === 'percentage') {
                $discount_bal = ($this->subtotal() / 100) * (int)$coupon_details->discount;
                $return_val = $this->subtotal()- $discount_bal;
            } elseif ($coupon_details->discount_type === 'amount') {
                $return_val = $this->subtotal() - (int)$coupon_details->discount;
            }
        }

        return $return_val ?? 0;
    }

    private function get_tax($coupon_discount_amount = null)
    {
        $tax_percentage = get_static_option('product_tax_percentage') ?? 0;
        $cart_sub_total = $this->subtotal();

        $return_val = $cart_sub_total - (int)$coupon_discount_amount;

        $tax_amount = ($return_val / 100) * (int)$tax_percentage; // get tax by percentage

        if (get_static_option('product_tax_type') === 'individual') {
            //write code for all individual tax amount and sum all of them
            $all_cart_items = $this->cart_items;
            $all_individual_tax = [];
            foreach ($all_cart_items as $item) {
                $product_details = \App\Products::find($item['id']);
                if (empty($product_details)) {
                    continue;
                }
                $price = $product_details->sale_price * $item['quantity'];
                $tax_percentage = ($price / 100) * $product_details->tax_percentage;
                $all_individual_tax[] = $tax_percentage;
            }
            $tax_amount = array_sum($all_individual_tax);
        }

        return $tax_amount;
    }

}