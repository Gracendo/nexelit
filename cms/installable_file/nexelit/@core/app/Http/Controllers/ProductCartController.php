<?php

namespace App\Http\Controllers;


use App\Facades\Cart;
use App\Facades\Wishlist;
use App\ProductCoupon;
use App\Products;
use App\ProductShipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductCartController extends Controller
{
    public function add_to_cart(Request $request)
    {
        $product_details = Products::find($request->product_id);

        Cart::add( [
            'id' => $product_details->id,
            'title' => $product_details->title,
            'quantity' => $request->quantity,
            'variant' => $request->product_variants ?? '',
            'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
            'price' => $product_details->sale_price * $request->quantity
        ]);

        return redirect()->back()->with(['msg' => __('Product added to cart') .' '. '<a class="btn-boxed" href="' . route('frontend.products.cart') . '">' . __('View Cart') . '</a>', 'type' => 'success']);
    }

    public static function remove_cart_item(Request $request)
    {
        Cart::remove($request->cart_index);
        return response()->json(
            [
                'cart_table_markup' => Cart::cartTable(),
                'total_cart_item' => Cart::count(),
                'cart_total_markup' => Cart::cartSummery(),
                'shipping_charge_status' => is_shipping_available()
            ]);
    }

    public static function remove_wishlist_item(Request $request)
    {
        Wishlist::remove($request->cart_index);
        return response()->json(
            [
                'cart_table_markup' => Wishlist::wishlistTable(),
                'total_cart_item' => Wishlist::count(),
            ]);
    }

    public function ajax_add_to_cart(Request $request)
    {

        $product_details = Products::find($request->product_id);
        Cart::add( [
            'id' => $product_details->id,
            'title' => $product_details->title,
            'quantity' => $request->quantity,
            'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
            'price' => $product_details->sale_price * $request->quantity
        ]);
        return response()->json(['msg' => __('Product Added In Cart'), 'total_cart_item' => Cart::count()]);
    }

    public function ajax_add_to_wishlist(Request $request)
    {
        $product_details = Products::find($request->product_id);
        Wishlist::add([
            'id' => $product_details->id,
            'title' => $product_details->title,
            'type' => !empty($product_details->is_downloadable) ? 'digital' : 'physical',
            'price' => $product_details->sale_price * $request->quantity
        ]);
        return response()->json(['msg' => __('Product Added In Wishlist'), 'total_wishlist_item' => Wishlist::count()]);
    }

    public function ajax_cart_update(Request $request){
        Cart::updateCart($request->cart_index,$request->quantity);

        return  response()->json([
            'cart_table_markup' => Cart::cartTable(),
            'total_cart_item' => Cart::count(),
            'cart_total_markup' => Cart::cartSummery()
        ]);
    }

    public function ajax_coupon_code(Request $request){
        $this->validate($request,[
           'coupon_code' => 'required|string'
        ],
        [
            'coupon_code.required' => __('Enter your coupon code')
        ]);

        $coupon_details = ProductCoupon::where('code',$request->coupon_code)->first();
        if (!empty($coupon_details)){
            if (time() > strtotime($coupon_details->expire_date) ){
                return  response()->json([
                    'status' => 'failed',
                    'msg' => __('Coupon is expired'),
                ]);
            }
            session()->put('coupon_discount',$request->coupon_code);
            return  response()->json([
                'cart_total_markup' => Cart::cartSummery(),
                'status' => 'ok',
                'msg' => __('Coupon Applied'),
            ]);
        }

        return  response()->json([
            'status' => 'failed',
            'msg' => __('Coupon Code Is Invalid'),
        ]);
    }

    public function ajax_shipping_apply(Request $request){
        $this->validate($request,[
            'shipping_id' => 'required|string'
            ],
            [
                'shipping_id.required' => __('Select Shipping Method')
            ]);

        $shipping_details = ProductShipping::find($request->shipping_id);
        if (!empty($shipping_details)){
            session()->put('shipping_charge',$shipping_details->id);
            return  response()->json([
                'cart_total_markup' => Cart::cartSummery(),
                'status' => 'ok',
                'msg' => __('Shipping Added'),
            ]);
        }

        return  response()->json([
            'status' => 'failed',
            'msg' => __('Shipping Invalid'),
        ]);
    }
}
