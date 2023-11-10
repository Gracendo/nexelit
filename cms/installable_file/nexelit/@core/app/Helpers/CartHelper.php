<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Collection;

class CartHelper
{

    public function add(array $item_info): array
    {
        $old_items = $this->items();
        if ($this->has($item_info)) {
            $this->update($item_info);
        } else {
            $old_items[] = $item_info;
            Session::put('cart_items',$old_items);
        }

        return $item_info;
    }

    private function update(array $item,$quantity =1)
    {
        $single = $this->existing_item_index($item);
        
        $existing_items = $this->items();
        $existing_item = $existing_items[$single];
        $existing_items[$single]['quantity'] = $existing_item['quantity'] + $quantity;

        $this->session_update($existing_items);
    }

    public function updateCart(array $item_index,array $quantity)
    {
        $existing_items = $this->items();
        foreach ($item_index as $index => $item){
            if (isset($existing_items[$item])){
                $existing_items[$item]['quantity'] = $quantity[$index];
            }
        }
        $this->session_update($existing_items);
    }

    public function remove($index)
    {
        $existing_items = $this->items();
        unset($existing_items[$index]);
        $this->session_update($existing_items);
    }

    public function subtotal()
    {
        $all_items = $this->items();
        $subtotal = 0;
        foreach ($all_items as $item) {
            $price_with_variant = 0;
            if (isset($item['variant']) && !empty($item['variant'])) {
                $variants = current(json_decode($item['variant']));
                $variant = get_product_variant_list_by_id($variants->variantID);
                if (!empty($variant)) {
                    $index = array_search($variants->term, json_decode($variant->terms, true));
                    $prices = json_decode($variant->price) ?? [];
                    if (isset($prices[$index]) && !empty($prices[$index])) {
                        $price_with_variant = $prices[$index];
                    }
                }
            }
            $subtotal += $price_with_variant;
            $subtotal += $item['price'] * $item['quantity'];
        }
        return $subtotal;
    }

    public function total()
    {
        $total_amount = $this->subtotal();
        $total_amount -= $this->coupon();
        if ($this->is_tax_enable()) {
            $total_amount += $this->cartTax();
        }
        if ($this->is_shipping_available()) {
            $total_amount += $this->cartShipping();
        }
        return $total_amount;
    }

    public function tax()
    {

    }

    public function shipping()
    {

    }

    public function coupon()
    {
        $get_coupon_discount = session()->get('coupon_discount');
        $return_val = 0;

        if (!empty($get_coupon_discount)) {
            $coupon_details = \App\ProductCoupon::where('code', $get_coupon_discount)->first();
            if ($coupon_details->discount_type === 'percentage') {
                $return_val = ($this->subtotal() / 100 ) * $coupon_details->discount;
            } elseif ($coupon_details->discount_type === 'amount') {
                $return_val = (float) $coupon_details->discount;
            }
        }

        return $return_val;
    }

    private function has($item)
    {
        if (is_null($this->items())){
            return false;
        }
        $result = array_filter($this->items(),function ($cart_item) use ($item){
            if (isset($item['variant']) && !empty($item['variant'])){
                return $item['id'] === $cart_item['id'] && $item['variant'] === $cart_item['variant'];
            }
            return $item['id'] === $cart_item['id'];
        });
        return $result;
    }

    public function count(): int
    {
        $items = is_null($this->items()) ? [] : $this->items();
        return array_sum(array_column($items, 'quantity'));
    }

    public function items()
    {
        return Session::get('cart_items');
    }

    private function session_update($items)
    {
        Session::put('cart_items',$items );
    }

    private function existing_item_index(array $item)
    {
        foreach ($this->items() as $index => $cart_item){
            if (isset($item['variant']) && !empty($item['variant']) && $item['id'] === $cart_item['id']){
                $old_terms = json_decode($cart_item['variant'],true);
                $new_terms = json_decode($item['variant'],true);
                if (current($old_terms)['term'] === current($new_terms)['term']){
                    return $index;
                }

            }elseif ($item['id'] === $cart_item['id'] && empty($item['variant'])){
                return $index;
            }
        }
    }

    public function cartTable(): string
    {

        $output = '';
        $all_cart_item = $this->items();
        if (!is_null($all_cart_item)) {
            $output = '<div class="table-responsive cart-table"><form id="cart_update_form" method="post"><table class="table table-bordered">';
            $output .= "\t" . '<thead><tr>';
            $colspan = 7;
            $output .= "\n\t" . '<th>' . __('Serial') . '</th>';
            $output .= "\n\t" . '<th>' . __('Thumbnail') . '</th>';
            $output .= "\n\t" . '<th>' . __('Product Name') . '</th>';
            $output .= "\n\t" . '<th>' . __('Quantity') . '</th>';
            $output .= "\n\t" . '<th>' . __('Unit Price') . '</th>';
            if ($this->is_tax_enable() && get_static_option('product_tax_type') === 'individual') {
                $output .= "\n\t" . '<th>' . __('Tax') . '</th>';
                $colspan = 8;
            }
            $output .= "\n\t" . '<th>' . __('Subtotal') . '</th>';
            $output .= "\n\t" . '<th>' . __('Action') . '</th>';
            $output .= "\n\t" . '</tr></thead>';

            $output .= "\n\t" . '<tbody>';
            $a = 1;

            foreach ($all_cart_item as $key => $item) {
                $single_product = \App\Products::find($item['id']);
                if (empty($single_product)) {
                    continue;
                }

                $output .= '<tr>';
                $output .= '<td>' . $a . '<input name="cart_index[]" type="hidden" value="' . $key . '">' . '</td>';
                $output .= $this->cartThumbnail($single_product);
                $price_with_variant = $this->cartTitle($single_product,$item)['price_with_variant']; // need to get
                $output .= $this->cartTitle($single_product,$item)['markup']; // need to get
                //add variant

                $output .= '<td><input type="number" name="product_quantity[]" class="quantity" min="1" value="' . $item['quantity'] . '"></td>';
                $output .= '<td class="unit_price">' . amount_with_currency_symbol($single_product->sale_price + $price_with_variant) . '</td>';

                $cartTaxInfo =  $this->cartTaxAmount($single_product,$price_with_variant);
                $tax_amount = $cartTaxInfo['tax_amount'];
                $colspan = $cartTaxInfo['colspan'];
                $final_price = $cartTaxInfo['final_price'];
                $output .=  $cartTaxInfo['markup'];
                $output .= $this->cartSubtotal($final_price,$item,$tax_amount);
               $output .= $this->cartAction($key);
                $output .= '</tr>';
                $a++;
            }

            $output .= "\n\t" . '</tbody>';
            $output .= $this->cartFooter($colspan);

            $output .= '</table></form></div>';
            return $output;
        }

        return '<div class="alert alert-warning">' . __('No Item In Cart!') . '</div>';
    }

    public function is_tax_enable() : bool
    {
        return get_static_option('product_tax') && get_static_option('product_tax_system') === 'exclusive';
    }

    private function ajaxPreloader() : string
    {
        return <<<HTML
<div class="ajax-loading-wrap hide">
    <div class="sk-fading-circle">
        <div class="sk-circle1 sk-circle"></div>
        <div class="sk-circle2 sk-circle"></div>
        <div class="sk-circle3 sk-circle"></div>
        <div class="sk-circle4 sk-circle"></div>
        <div class="sk-circle5 sk-circle"></div>
        <div class="sk-circle6 sk-circle"></div>
        <div class="sk-circle7 sk-circle"></div>
        <div class="sk-circle8 sk-circle"></div>
        <div class="sk-circle9 sk-circle"></div>
        <div class="sk-circle10 sk-circle"></div>
        <div class="sk-circle11 sk-circle"></div>
        <div class="sk-circle12 sk-circle"></div>
    </div>
</div>
HTML;

    }

    private function cartFooter($colspan = 0) : string
    {
        $ajax_preloader = $this->ajaxPreloader();
        $update_cart = __('Update Cart');
        $coupon_code =  __('Coupon Code');
        $submit = __('Submit');
        return <<<HTML
<tfoot>
    <tr>
        <td colspan="{$colspan}">
            <div class="cart-table-footer-wrap">
                <div class="coupon-wrap">
                    <input type="text" class="form-control" name="coupon_code" placeholder="{$coupon_code}">
                    <button class="btn-boxed add_coupon_code_btn">{$submit}</button>
                    {$ajax_preloader}
                </div>
                <div class="update-cart-wrap">{$ajax_preloader}
                    <button class="btn-boxed update_cart_items_btn">{$update_cart}</button>
                </div>
            </div>
        </td>
    </tr>
</tfoot>
HTML;

    }

    private function cartThumbnail($single_product)
    {
        $image_markup = render_image_markup_by_attachment_id($single_product->image, '', 'thumb');
        return <<<HTML
        <td>
            <div class="thumbnail">{$image_markup}</div>
        </td>
HTML;

    }

    private function cartTitle($single_product,$item)
    {
        $route = route('frontend.products.single', $single_product->slug);
        $title = $single_product->title;

        $variant_markup = '';
        $price_with_variant = 0;
        if (!empty($item['variant'])){
            foreach(json_decode($item['variant']) as $variants){
                $variant = get_product_variant_list_by_id($variants->variantID);
                if(!empty($variant)){
                    $index = array_search($variants->term, json_decode($variant->terms,true));
                    $prices = json_decode($variant->price) ?? [];
                    $terms = json_decode($variant->terms) ?? [];
                    $variant_markup .= '<div class="product-variant-list-wrapper"><h5 class="title">'.$variant->title.'</h5><ul class="product-variant-list">';
                    $variant_markup .= '<li>'.$terms[$index] ?? '' ;
                    if (isset($prices[$index]) && !empty($prices[$index])){
                        $variant_markup .= '<small> +'. amount_with_currency_symbol($prices[$index]) .'</small>';
                        $price_with_variant = $prices[$index];
                    }

                    $variant_markup .= '</li>';
                    $variant_markup .= '</ul></div>';
                }
            }
        }
        $markup = <<<HTML
<td>
    <h4 class="product-title">
        <a href="{$route}">{$title}</a>
    </h4>
    {$variant_markup}
</td>
HTML;
        return [
            'markup' => $markup,
            'price_with_variant' => $price_with_variant
        ];

    }

    private function cartTaxAmount($single_product,$price_with_variant)
    {
        $output = '';
        $tax_amount = 0;
        $colspan = 0;
        $final_price = !empty($price_with_variant) ? $price_with_variant + $single_product->sale_price : $single_product->sale_price ;
        if ($this->is_tax_enable() && get_static_option('product_tax_type') === 'individual') {
            $tax_amount = ($final_price / 100) * $single_product->tax_percentage;
            $output = '<td class="tax_amount">' . amount_with_currency_symbol($tax_amount) . '(' . $single_product->tax_percentage . '%)</td>';
            $colspan = 8;
        }
        return [
            'colspan' => $colspan,
            'tax_amount' => $tax_amount,
            'markup' => $output,
            'final_price' => $final_price
        ];
    }

    private function cartSubtotal($final_price,$item,$tax_amount)
    {
        $subtotal = (get_static_option('product_tax_type') === 'individual') ? $final_price * $item['quantity']  + $tax_amount : $final_price * $item['quantity'];
        return '<td>' . amount_with_currency_symbol($subtotal) . '</td>';
    }

    private function cartAction($cart_index) : string
    {
        return'<td><div class="cart-action-wrap"><a href="#" class="btn btn-sm btn-danger ajax_remove_cart_item"  data-cartindex="' . $cart_index. '"><i class="fas fa-trash-alt"></i></a>' . $this->ajaxPreloader() . '</div></td>';
    }

    public function cartSummery() : string
    {
        $output = '';

        $car_total = $this->items();
        if ($this->count() > 0) {
            $output .= '<h4 class="title">' . __('Order Summery') . '</h4><div class="cart-total-table-wrap">';
            $output .= ' <div class="cart-total-table table-responsive"><table class="table table-bordered"> <tbody>';
            $output .= ' <tr><th>' . __('Subtotal') . '</th><td>' . amount_with_currency_symbol($this->subtotal()) . '</td></tr>'; // subtotal done
            $output .= ' <tr><th>' . __('Coupon Discount') . '</th><td>-' . amount_with_currency_symbol($this->coupon()) . '</td></tr> ';
            if ($this->is_tax_enable()) {
                $tax_percentage = get_static_option('product_tax_type') === 'total' ? ' (' . get_static_option('product_tax_percentage') . '%)' : '';
                $output .= ' <tr><th>' . __('Tax') . $tax_percentage . '</th><td>+ ' . amount_with_currency_symbol($this->cartTax()) . '</td></tr>';
            }
            if ($this->is_shipping_available()) {
                $output .= ' <tr><th>' . __('Shipping Cost') . '</th><td>+ ' . amount_with_currency_symbol($this->cartShipping()) . '</td></tr>';
            }
            $output .= ' <tr><th>' . __('Total') . '</th><td><strong>' . amount_with_currency_symbol($this->total()) . '</strong></td></tr>';
            $output .= '</tbody></table></div>';
            $output .= '</div><a href="' . route('frontend.products.checkout') . '" class="btn-boxed">' . __('Process To Checkout') . '</a></div>';
        }

        return $output;
    }

    private function cartTax()
    {
        $tax_percentage = get_static_option('product_tax_percentage') ?: 0;
        $taxable_amount = $this->subtotal() - $this->coupon();
        $tax_amount = ($taxable_amount / 100) * (int)$tax_percentage;
        if (get_static_option('product_tax_type') === 'individual') {
            $all_cart_items = $this->items();
            $all_individual_tax = [];
            foreach ($all_cart_items as $item) {
                $product_details = \App\Products::find($item['id']);
                if (empty($product_details)) {
                    continue;
                }
                $price_with_variant = $this->cartTitle($product_details,$item)['price_with_variant'];
                $cart_tax_amount =  $this->cartTaxAmount($product_details,$price_with_variant)['tax_amount'];
                $price = $cart_tax_amount  * $item['quantity'];
                $all_individual_tax[] = $price;
            }
            $tax_amount = array_sum($all_individual_tax);
        }

        return $tax_amount;
    }

    private function is_shipping_available(): bool
    {
        $all_cart_item = $this->items();
        $return_val = true;
        $cart_item_type = !empty($all_cart_item) ? array_unique(array_column($all_cart_item,'type')) : [];
        if (count($cart_item_type)  === 1 && in_array('digital', $cart_item_type, true)){
            $return_val = false;
        }
        return $return_val;
    }

    public function cartShipping()
    {
        $get_shipping_charge = session()->get('shipping_charge');
        $return_val = 0;

        if (!empty($get_shipping_charge)) {
            $shipping_details = \App\ProductShipping::where('id', $get_shipping_charge)->first();
            if (!is_null($shipping_details)){
                $return_val = $shipping_details->cost;
            }
        }
        return $this->is_shipping_available() ? $return_val : 0;
    }

    public function cart_tax_for_mail_template($cart_items,$order_details){
        $tax_percentage = get_static_option('product_tax_percentage') ?: 0;
        $cart_sub_total = $order_details->subtotal;
        $get_coupon_discount = $order_details->coupon_code;

        $return_val = $cart_sub_total;

        if (!empty($get_coupon_discount)) {
            $return_val = $cart_sub_total - (int) $order_details->coupon_discount;
        }

        $tax_amount = ($return_val / 100) * (int) $tax_percentage;

        if (get_static_option('product_tax_type') === 'individual') {
            //write code for all individual tax amount and sum all of them
            $all_cart_items = $cart_items;
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