<?php

namespace App\Traits\EmailTemplate;

use App\Helpers\LanguageHelper;

trait ProductEmailTemplate
{
    /**
     * send productOrderStatusChangeMail
     * */
    public function productOrderStatusChangeMail($order_details)
    {
        $message = get_static_option('product_order_status_change_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseProductOrderInfo($message, $order_details);
        return [
            'subject' => get_static_option('product_order_status_change_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }


    /**
     * send productOrderPaymentAccpetMail
     * */
    public function productOrderReminderMail($order_details)
    {
        $message = get_static_option('product_order_reminder_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseProductOrderInfo($message, $order_details);
        return [
            'subject' => get_static_option('product_order_reminder_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send productOrderPaymentAccpetMail
     * */
    public function productOrderPaymentAccpetMail($order_details)
    {
        $message = get_static_option('product_order_payment_accept_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseProductOrderInfo($message, $order_details);
        return [
            'subject' => get_static_option('product_order_payment_accept_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }
    /**
     * send productOrderUserMail
     * */
    public function productOrderUserMail($order_details)
    {
        $message = get_static_option('product_order_user_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseProductOrderInfo($message, $order_details);
        return [
            'subject' => get_static_option('product_order_user_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    /**
     * send productOrderAdminMail
     * */
    public function productOrderAdminMail($order_details)
    {
        $message = get_static_option('product_order_admin_mail_' . LanguageHelper::user_lang_slug() . '_message');
        $message = $this->parseProductOrderInfo($message, $order_details);
        return [
            'subject' => get_static_option('product_order_admin_mail_' . LanguageHelper::user_lang_slug() . '_subject'),
            'message' => $message,
        ];
    }

    private function parseProductOrderInfo($message, $order_details)
    {
        $message = str_replace(
            [
                '@billing_name',
                '@billing_email',
                '@order_id',
                '@payment_gateway',
                '@billing_info',
                '@shipping_info',
                '@cart_info',
                '@order_summery',
                '@payment_status',
                '@order_date',
                '@user_dashboard',
                '@order_status',
                '@site_title',
            ],
            [
                $order_details->billing_name,
                $order_details->billing_email,
                $order_details->id,
                str_replace('-',' ',$order_details->payment_gateway),
                $this->productBillingInfo($order_details),
                $this->productShippingInfo($order_details),
                $this->productCartInfo($order_details),
                $this->productOrderSummery($order_details),
                $order_details->payment_status,
                $order_details->created_at->format('D, d-m-y h:i:s'),
                '<a href="' . route('user.home') . '">' . __('your dashboard') . '</a>',
                str_replace(['-','_'],[' ',' '],$order_details->status),
                get_static_option('site_' . LanguageHelper::user_lang_slug() . '_title')
            ], $message);
        return $message;
    }
    /**
     * productBillingInfo
     * */
    private function productBillingInfo($order_details)
    {
        $output = ' <div class="billing-wrap">';
        $output .= '<h2 class="subtitle">'.__('Billing Details').'</h2>';
        $output .= '<ul>';
        $output .= '<li><strong>'.__('Name').'</strong> '.$order_details->billing_name.'</li>';
        $output .= '<li><strong>'.__('Email').'</strong> '.$order_details->billing_email.'</li>';
        $output .= '<li><strong>'.__('Phone').'</strong> '.$order_details->billing_phone.'</li>';
        $output .= '<li><strong>'.__('Country').'</strong> '.$order_details->billing_country.'</li>';
        $output .= '<li><strong>'.__('Address').'</strong> '.$order_details->billing_street_address.'</li>';
        $output .= '<li><strong>'.__('Town').'</strong> '.$order_details->billing_town.'</li>';
        $output .= '<li><strong>'.__('District').'</strong>  '.$order_details->billing_district.'</li>';
        $output .= '</ul>';

        $output .= '</div>';
        return $output;
    }

    private function productShippingInfo($order_details)
    {
        if($order_details->different_shipping_address === 'no'){
            return '';
        }
        $output = '<div class="shipping-wrap">';
        $output .=  '<h2 class="subtitle">'.__('Shipping Details').'</h2>';
        $output .=  '<ul>';
        $output .= '<li><strong>'.__('Name').'</strong> '.$order_details->shipping_name.'</li>';
        $output .= '<li><strong>'.__('Email').'</strong> '.$order_details->shipping_email.'</li>';
        $output .= '<li><strong>'.__('Phone').'</strong> '.$order_details->shipping_phone.'</li>';
        $output .= '<li><strong>'.__('Country').'</strong> '.$order_details->shipping_country.'</li>';
        $output .= '<li><strong>'.__('Address').'</strong> '.$order_details->shipping_street_address.'</li>';
        $output .= '<li><strong>'.__('Town').'</strong> '.$order_details->shipping_town.'</li>';
        $output .= '<li><strong>'.__('District').'</strong> '.$order_details->shipping_district.'</li>';
        $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    private function productOrderSummery($order_details)
    {
        $output = '<div class="order-summery"> <h2 class="title">'.__('Order Summery').'</h2>';
        $output .= '<div class="extra-data"><ul>';
        $output .= '<li><strong>'.__('Shipping Method:').'</strong> '.ucwords(get_shipping_name_by_id($order_details->product_shippings_id)).'</li>';
        $output .= '<li><strong>'.__('Payment Method:').'</strong> '.str_replace('_',' ', ucfirst($order_details->payment_gateway)).'</li>';
        $output .= '<li><strong>'.__('Payment Status:').'</strong> '.ucfirst($order_details->payment_status).'</li>';
        $output .= '</ul></div>';
        $output .= '</div>';
        $output .= '<table>';

        $output .= '<tr><td><strong>'.__('Subtotal').'</strong></td><td>'.amount_with_currency_symbol($order_details->subtotal).'</td></tr>';
        $output .= '<tr><td><strong>'.__('Coupon Discount').'</strong></td><td>- '.amount_with_currency_symbol($order_details->coupon_discount).'</td></tr>';
        $output .= '<tr><td><strong>'.__('Shipping Cost').'</strong></td><td>+ '.amount_with_currency_symbol($order_details->shipping_cost).'</td></tr>';

        if(\App\Facades\Cart::is_tax_enable() && get_static_option('product_tax_type') === 'individual'){
            $tax_percentage = get_static_option('product_tax_type') === 'total' ? '('.get_static_option('product_tax_percentage').')' : '';
            $output .= '<tr><td><strong>'.__('Tax').' '.$tax_percentage.'</strong></td><td>+ '.amount_with_currency_symbol(\App\Facades\Cart::cart_tax_for_mail_template(unserialize($order_details->cart_items,['class' => false]),$order_details)).'</td></tr>';
        }

        $output .= '<tr><td><strong>'.__('Total').'</strong></td> <td>'.amount_with_currency_symbol($order_details->total).'</td></tr>';
        $output .= '</table>';

        if(get_static_option('product_tax') && get_static_option('product_tax_system') === 'inclusive'){
            $output .= '<p>'.__('Inclusive of custom duties and taxes where applicable').'</p>';
        }

        return $output;
    }

    private function productCartInfo($order_details)
    {
        $output = '<div class="ordered-product-summery margin-top-30"><h4 class="title">'.__('Ordered Products').'</h4>';
        $output .= '<table class="table table-bordered order-view-table"><thead><th>'.__('Thumbnail').'</th><th>'.__('Product Info').'</th> </thead> <tbody>';
        $cart_items = unserialize($order_details->cart_items,['class' => false]);
        foreach($cart_items as $item){
            $product_info = \App\Products::find($item['id']);
            $output .= '<tr>';
            $output .= '<td><div class="product-thumbnail">'.render_image_markup_by_attachment_id($product_info->image,'','thumb').' </div> </td>';
            $output .= '<td><div class="product-info-wrap"><h4 class="product-title">';
            $output .= ' <a href="'.route('frontend.products.single',$product_info->slug).'">'.$product_info->title.'</a>';
            $item_variants = isset($item['variant']) && !empty($item['variant']) ? json_decode($item['variant'],true) : [];
            foreach($item_variants as $variants){
                $variant = get_product_variant_list_by_id($variants->variantID);
                if(!empty($variant)){
                    $index = array_search($variants->term, json_decode($variant->terms,true));
                    $prices = json_decode($variant->price) ?? [];
                    $terms = json_decode($variant->terms) ?? [];
                    $output .= '<ul class="product-variant-list"><li>'.isset($terms[$index]) ? $terms[$index] : '';

                    if (isset($prices[$index]) && !empty($prices[$index])){
                        $output .= '<small> +'.amount_with_currency_symbol($prices[$index]).'</small>';
                    }
                    $output .= '</li></ul>';
                }
            }
            $output .= '</h4>';
            $output .= '<span class="pdetails"><strong>'.__('Price :').'</strong> '.amount_with_currency_symbol($product_info->sale_price).'</span>';
            $output .= '<span class="pdetails"><strong>'.__('Quantity :').'</strong> '.$item['quantity'].'</span>';
            $tax_amount = 0;
            if(get_static_option('product_tax_type') === 'individual' && is_tax_enable()){
                $percentage = !empty($product_info->tax_percentage) ? $product_info->tax_percentage : 0;
                $tax_amount = ($product_info->sale_price * $item['quantity']) / 100 * $product_info->tax_percentage;
                $output .= ' <span class="pdetails" style="color: red"><strong>'.__('Tax').' '.'('.$percentage.'%) :'.'</strong> +'.amount_with_currency_symbol($tax_amount).'</span>';
            }
            $output .= ' <span class="pdetails"><strong>'.__('Subtotal :').'</strong> '.amount_with_currency_symbol($product_info->sale_price * $item['quantity'] + $tax_amount ).'</span> </div></td>';

            $output .= '</tr>';
        }
        $output .= '</tbody></table></div>';

        return $output;
    }

}