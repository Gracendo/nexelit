@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Order Payment Not Success')}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <h1 class="title">{{get_static_option('product_cancel_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p>{{get_static_option('product_cancel_page_' . $user_select_lang_slug . '_description')}}</p>
                        <div class="product-orders-summery-warp">
                            <div class="extra-data">
                                <ul>
                                    <li><strong>{{__('Order ID: ')}}</strong> {{'#'.$order_details->id}}</li>
                                    <li><strong>{{__('Shipping Method:')}}</strong> {{get_shipping_name_by_id($order_details->product_shippings_id)}}</li>
                                    <li><strong>{{__('Payment Method:')}}</strong> {{str_replace('_',' ', ucfirst($order_details->payment_gateway))}}</li>
                                    <li><strong>{{__('Payment Status:')}}</strong> {{__($order_details->payment_status)}}</li>
                                    <li><strong>{{__('Order Status:')}}</strong> {{__($order_details->status)}}</li>
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
                                            <td>{{amount_with_currency_symbol($order_details->subtotal)}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{__('Coupon Discount')}}</strong></td>
                                            <td>- {{amount_with_currency_symbol($order_details->coupon_discount)}}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>{{__('Shipping Cost')}}</strong></td>
                                            <td>+ {{amount_with_currency_symbol($order_details->shipping_cost)}}</td>
                                        </tr>
                                        @if(is_tax_enable())
                                            @php $tax_percentage = get_static_option('product_tax_type') == 'total' ? '('.get_static_option('product_tax_percentage').')' : '';  @endphp
                                            <tr>
                                                <td><strong>{{__('Tax')}} {{$tax_percentage}}</strong></td>
                                                <td>+ {{amount_with_currency_symbol(cart_tax_for_mail_template($cart_items))}}</td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td><strong>{{__('Total')}}</strong></td>
                                            <td>{{amount_with_currency_symbol($order_details->total)}}</td>
                                        </tr>
                                    </table>
                                    @if(get_static_option('product_tax') && get_static_option('product_tax_system') == 'inclusive')
                                        <p class="tax-info">{{__('Inclusive of custom duties and taxes where applicable')}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="btn-wrapper">
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
