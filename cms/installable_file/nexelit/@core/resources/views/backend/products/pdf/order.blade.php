<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Tamma+2:wght@400;600;700&display=swap" rel="stylesheet">
    <title>{{__('Product Order Invoice')}}</title>
    <style>

        body * {
            font-family: 'Baloo Tamma 2', cursive;
        }

        table, td, th {
            border: 1px solid #ddd;
            text-align: left;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            padding: 15px;
        }

        /* cart page */
        .cart-wrapper table .thumbnail {
            max-width: 50px;
        }

        .cart-wrapper table .product-title {
            font-size: 16px;
            line-height: 1;
            font-weight: 600;
            transition: 300ms all;
        }

        .cart-wrapper table .quantity {
            max-width: 80px;
            border: 1px solid #e2e2e2;
            height: 40px;
            padding-left: 10px;
        }

        .cart-wrapper table {
            color: #656565;
        }

        .cart-wrapper table th {
            color: #333;
        }

        .cart-total-wrap .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .cart-total-table table td {
            color: #333;
        }

        .billing-details-wrapper .login-form {
            max-width: 450px;
        }

        .billing-details-wrapper {
            margin-bottom: 80px;
        }

        .billing-details-fields-wrapper .title {
            font-size: 30px;
            line-height: 40px;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        #pdf_content_wrapper {
            max-width: 1000px;
        }

        .cart-wrapper table .thumbnail img {
            width: 80px;
        }

        .cart-total-table-wrap .title {
            font-size: 25px;
            line-height: 34px;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .billing-and-shipping-details div:first-child {
            margin-bottom: 30px;
        }

        .billing-and-shipping-details div ul {
            margin: 0;
            padding: 0;
        }

        .billing-and-shipping-details div ul li {
            font-size: 16px;
            line-height: 30px;
        }

        .billing-and-shipping-details div .title {
            font-size: 22px;
            line-height: 26px;
            font-weight: 600;
        }

        .billing-and-shipping-details {
            margin-top: 40px;
        }

        .billing-wrap ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .product-orders-summery-warp .title {
            font-size: 24px;
            text-align: left;
            margin-bottom: 7px;
        }

        .billing-and-shipping-details {
            display: flex;
            justify-content: space-between;
            text-align: left;
        }

        .billing-and-shipping-details ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .billing-and-shipping-details ul li {
            margin: 8px 0;
        }

        .billing-and-shipping-details ul li strong {
            color: var(--heading-color);
            margin-right: 30px;
        }

        .cart-table-footer-wrap .boxed-btn {
            border: none;
            padding: 7px 20px;
        }

        .cart-table-footer-wrap .coupon-wrap .boxed-btn {
            margin-left: 20px;
        }
        .ordered-product-summery .title {
            font-size: 20px;
            margin: 0;
        }

        .ordered-product-summery .product-info-wrap {
            text-align: left;
        }

        .ordered-product-summery .product-info-wrap .pdetails {
            display: block;
            font-size: 14px;
            font-weight: 400;
            margin-bottom: 5px;
        }

        .ordered-product-summery .product-info-wrap .pdetails strong {
            font-weight: 500;
        }

        .product-orders-summery-warp .extra-data {
            text-align: left;
        }

    </style>
</head>
<body>
<div id="pdf_content_wrapper">
    <div class="logo-wrapper">
        {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
    </div>
    <div class="order-success-area">
        <div class="product-orders-summery-warp">
            <div class="extra-data">
                <ul>
                    <li><strong>{{__('Order ID: ')}}</strong> {{'#'.$order_details->id}}</li>
                    <li><strong>{{__('Shipping Method:')}}</strong> {{ucwords(get_shipping_name_by_id($order_details->product_shippings_id))}}</li>
                    <li><strong>{{__('Payment Method:')}}</strong> {{str_replace('_',' ', ucfirst($order_details->payment_gateway))}}</li>
                    <li><strong>{{__('Payment Status:')}}</strong> {{ucfirst($order_details->payment_status)}}</li>
                </ul>
            </div>
            <div class="billing-and-shipping-details">
                <div class="billing-wrap">
                    <h4 class="title">{{__('Billing Details')}}</h4>
                    <ul>
                        <li><strong>{{__('Name')}}</strong> {{$order_details->billing_name}}</li>
                        <li><strong>{{__('Email')}}</strong> {{$order_details->billing_email}}</li>
                        <li><strong>{{__('Phone')}}</strong> {{$order_details->billing_phone}}</li>
                        <li><strong>{{__('Country')}}</strong> {{$order_details->billing_country}}</li>
                        <li><strong>{{__('Street Address')}}</strong> {{$order_details->billing_street_address}}</li>
                        <li><strong>{{__('District')}}</strong> {{$order_details->billing_district}}</li>
                        <li><strong>{{__('Town')}}</strong> {{$order_details->billing_town}}</li>
                    </ul>
                </div>
                @if($order_details->different_shipping_address == 'yes')
                    <div class="billing-wrap">
                        <h4 class="title">{{__('Shipping Details')}}</h4>
                        <ul>
                            <li><strong>{{__('Name')}}</strong> {{$order_details->shipping_name}}</li>
                            <li><strong>{{__('Email')}}</strong> {{$order_details->shipping_email}}</li>
                            <li><strong>{{__('Phone')}}</strong> {{$order_details->shipping_phone}}</li>
                            <li><strong>{{__('Country')}}</strong> {{$order_details->shipping_country}}</li>
                            <li><strong>{{__('Street Address')}}</strong> {{$order_details->shipping_street_address}}</li>
                            <li><strong>{{__('District')}}</strong> {{$order_details->shipping_district}}</li>
                            <li><strong>{{__('Town')}}</strong> {{$order_details->shipping_town}}</li>
                        </ul>
                    </div>
                @endif
            </div>
            @php $cart_items = unserialize($order_details->cart_items); @endphp
            <h4 class="title">{{__('Order Summery')}}</h4>
            <div class="cart-total-table-wrap">
                <div class="cart-total-table table-responsive text-left">
                    <table class="table table-bordered">
                        <tr>
                            <td><strong>{{__('Subtotal')}}</strong></td>
                            <td>{{amount_with_currency_symbol($order_details->subtotal,true)}}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('Coupon Discount')}}</strong></td>
                            <td>- {{amount_with_currency_symbol($order_details->coupon_discount,true)}}</td>
                        </tr>
                        <tr>
                            <td><strong>{{__('Shipping Cost')}}</strong></td>
                            <td>+ {{amount_with_currency_symbol($order_details->shipping_cost,true)}}</td>
                        </tr>
                        @if(is_tax_enable())
                            @php $tax_percentage = get_static_option('product_tax_type') == 'total' ? '('.get_static_option('product_tax_percentage').')' : '';  @endphp
                            <tr>
                                <td><strong>{{__('Tax '.$tax_percentage)}}</strong></td>
                                <td>+ {{amount_with_currency_symbol(cart_tax_for_mail_template($cart_items),true)}}</td>
                            </tr>
                        @endif
                        <tr>
                            <td><strong>{{__('Total')}}</strong></td>
                            <td>{{amount_with_currency_symbol($order_details->total,true)}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="ordered-product-summery">
            <h4 class="title">{{__('Ordered Products')}}</h4>
            <table class="table table-bordered">
                <tbody>
                <tr>
                    <td>{{__('thumbnail')}}</td>
                    <td>{{__('Product Info')}}</td>
                </tr>
                @foreach($cart_items as $item)
                    @php $product_info = \App\Products::find($item['id']);@endphp
                    <tr>
                        <td>
                            <div class="product-thumbnail">
                                {!! render_image_markup_by_attachment_id($product_info->image,'','thumb') !!}
                            </div>
                        </td>
                        <td>
                            <div class="product-info-wrap">
                                <h4 class="product-title"><a href="{{route('frontend.products.single',$product_info->slug)}}">{{$product_info->title}}</a></h4>
                                <span class="pdetails"><strong>{{__('Price :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price,true)}}</span>
                                <span class="pdetails"><strong>{{__('Quantity :')}}</strong> {{$item['quantity']}}</span>
                                @php $tax_amount = 0; @endphp
                                @if(get_static_option('product_tax_type') == 'individual' && is_tax_enable())
                                    @php
                                        $percentage = !empty($product_info->tax_percentage) ? $product_info->tax_percentage : 0;
                                        $tax_amount = ($product_info->sale_price * $item['quantity']) / 100 * $product_info->tax_percentage;
                                    @endphp
                                    <span class="pdetails" style="color: red"><strong>{{__('Tax ('.$percentage.'%) :')}}</strong> +{{amount_with_currency_symbol($tax_amount,true)}}</span>
                                @endif
                                <span class="pdetails"><strong>{{__('Subtotal :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price * $item['quantity'] + $tax_amount ,true)}}</span>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
