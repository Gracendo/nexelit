<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Collection;

class WishlistHelper
{

    public function add(array $item_info): array
    {
        $old_items = $this->items();
        if ($this->has($item_info)) {
            $this->update($item_info);
        } else {
            $old_items[] = $item_info;
            Session::put('wishlist_items',$old_items);
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

    public function updateWishlist(array $item_index,array $quantity)
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
        return Session::get('wishlist_items');
    }

    private function session_update($items)
    {
        Session::put('wishlist_items',$items );
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

    public function wishlistTable(): string
    {

        $output = '';
        $all_cart_item = $this->items();
        if (!is_null($all_cart_item)) {
            $output = '<div class="table-responsive cart-table"><form id="cart_update_form" method="post"><table class="table table-bordered">';
            $output .= "\t" . '<thead><tr>';
            $colspan = 7;
            $output .= "\n\t" . '<th>' . __('Sl#') . '</th>';
            $output .= "\n\t" . '<th>' . __('Thumbnail') . '</th>';
            $output .= "\n\t" . '<th>' . __('Product Name') . '</th>';
            $output .= "\n\t" . '<th>' . __('Price') . '</th>';
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
                $output .= $this->cartTitle($single_product,$item)['markup']; // need to get

                $output .= $this->price($single_product->sale_price);
                $output .= $this->cartAction($key,$item);
                $output .= '</tr>';
                $a++;
            }

            $output .= "\n\t" . '</tbody>';
//            $output .= $this->cartFooter($colspan);

            $output .= '</table></form></div>';
            return $output;
        }

        return '<div class="alert alert-warning">' . __('No Item In Wishlist..!') . '</div>';
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
        $update_cart = __('Clear Wishlist');
        return <<<HTML
<tfoot>
    <tr>
        <td colspan="{$colspan}">
            <div class="cart-table-footer-wrap">
                <div class="coupon-wrap">
 
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

    private function price($final_price)
    {
        return '<td>'. amount_with_currency_symbol($final_price) .'</td>';
    }

    private function cartAction($wishlist_index,$value) : string
    {
        return'<td>
                   <div class="cart-action-wrap">
                     '.$this->ajaxPreloader().'
                     <a href="#" class="btn btn-sm btn-success ajax_add_to_cart_with_icon mr-2"
                                 data-product_id="'.$value["id"].'"
                                 data-product_title="'.$value["title"].'"
                                 data-product_quantity="1"
                                 >
                                <i class="fas fa-shopping-cart"></i>
                         </a>'.

                       '<a href="#" class="btn btn-sm btn-danger ajax_remove_wishlist_item" data-wishlistindex="'.$wishlist_index.'">
                                <i class="fas fa-trash-alt"></i>
                         </a>'.$this->ajaxPreloader().

                    '</div>
                </td>';
    }

}