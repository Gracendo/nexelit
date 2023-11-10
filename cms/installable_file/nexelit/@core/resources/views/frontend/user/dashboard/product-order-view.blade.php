@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Product Order View')}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
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
                                        @if(\App\Facades\Cart::is_tax_enable() && get_static_option('product_tax_type') === 'individual')
                                            @php $tax_percentage = get_static_option('product_tax_type') === 'total' ? '('.get_static_option('product_tax_percentage').')' : '';  @endphp
                                            <tr>
                                                <td><strong>{{__('Tax')}} {{$tax_percentage}}</strong></td>
                                                <td>+ {{amount_with_currency_symbol(\App\Facades\Cart::cart_tax_for_mail_template($cart_items,$order_details))}}</td>
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
                        <div class="ordered-product-summery margin-top-30">
                            <h4 class="title">{{__('Ordered Products')}}</h4>
                            <table class="table table-bordered order-view-table">
                                <thead>
                                <th>{{__('Thumbnail')}}</th>
                                <th>{{__('Product Info')}}</th>
                                </thead>
                                <tbody>
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
                                                <h4 class="product-title">
                                                    <a href="{{route('frontend.products.single',$product_info->slug)}}">{{$product_info->title}}</a>
                                                @if (!empty($item['variant']))
                                                    @foreach(json_decode($item['variant']) as $variants)
                                                       @php
                                                            $variant = get_product_variant_list_by_id($variants->variantID);
                                                       @endphp
                                                        @if(!empty($variant))
                                                        @php
                                                          $index = array_search($variants->term, json_decode($variant->terms,true));
                                                           $prices = json_decode($variant->price) ?? [];
                                                           $terms = json_decode($variant->terms) ?? [];
                                                       @endphp
                                                        <ul class="product-variant-list">
                                                            <li>
                                                                {{$terms[$index] ?? ''}}
                                                                @if (isset($prices[$index]) && !empty($prices[$index]))
                                                                <small> +{{amount_with_currency_symbol($prices[$index])}}</small>
                                                                @endif
                                                               </li>
                                                            </ul>
                                                        @endif
                                                    @endforeach
                                                @endif
                                            </h4>


                                                <span class="pdetails"><strong>{{__('Price :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price)}}</span>
                                                <span class="pdetails"><strong>{{__('Quantity :')}}</strong> {{$item['quantity']}}</span>
                                                @php $tax_amount = 0; @endphp
                                                @if(get_static_option('product_tax_type') === 'individual' && is_tax_enable())
                                                    @php
                                                        $percentage = !empty($product_info->tax_percentage) ? $product_info->tax_percentage : 0;
                                                        $tax_amount = ($product_info->sale_price * $item['quantity']) / 100 * $product_info->tax_percentage;
                                                    @endphp
                                                    <span class="pdetails" style="color: red"><strong>{{__('Tax')}} {{'('.$percentage.'%) :'}}</strong> +{{amount_with_currency_symbol($tax_amount)}}</span>
                                                @endif
                                                <span class="pdetails"><strong>{{__('Subtotal :')}}</strong> {{amount_with_currency_symbol($product_info->sale_price * $item['quantity'] + $tax_amount )}}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="btn-wrapper">
                            @if(auth()->guard('web')->check())
                                <a href="{{route('user.home')}}" class="boxed-btn">{{__('Go To Dashboard')}}</a>
                            @else
                                <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
