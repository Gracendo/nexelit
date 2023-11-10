@extends('backend.admin-master')
@section('site-title')
    {{__('New Order')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/nice-select.css')}}">
    <style>
        .product-add-to-cart-wrap {
            display: flex;
            align-items: center;
        }

        .product-add-to-cart-wrap .btn {
            position: relative;
            top: 5px;
        }

        .product-add-to-cart-wrap .form-group {
            min-width: 300px;
        }
        .product-title {
            font-size: 16px;
            line-height: 20px;
            margin-bottom: 20px;
        }
        input.quantity {
            border: 1px solid #e2e2e2;
            height: 40px;
            padding: 10px;
            max-width: 80px;
        }
        .cart-table .product-variant-list-wrapper,
        .order-view-table .product-variant-list-wrapper
        {
            display: flex;
            align-items: center;
        }

        .cart-table .product-variant-list-wrapper .title ,
        .order-view-table .product-variant-list-wrapper .title
        {
            margin-right: 10px;
            font-size: 14px;
            line-height: 16px;
            position: relative;
            top: 5px;
            margin-bottom: 15px;
        }

        .order-view-table .product-variant-list-wrapper ul li.selected{
            background-color: #b8c5cd;
            color: #333;
        }
        .cart-table .product-variant-list-wrapper ul li,
        .order-view-table .product-variant-list-wrapper ul li
        {
            font-size: 12px;
            line-height: 16px;
            padding: 3px 5px;
            border: 1px solid #e2e2e2;
            display: inline-block;
            cursor: pointer;
        }

        .order-view-table .product-variant-list-wrapper + .product-variant-list-wrapper {
            margin-top: 10px;
        }
        .order-view-table .product-variant-list-wrapper .title {
            margin-bottom: 5px;
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrapper d-flex justify-content-between">
                           <h4 class="header-title">{{__('New Order')}}</h4>
                           <a href="{{route('admin.products.order.logs')}}" class="btn btn-primary">{{__('All Orders')}}</a>
                       </div>
                        <form action="{{route('admin.product.order.new')}}" method="post" enctype="multipart/form-data" id="new_product_order_form">
                            @csrf
                            <div class="form-group">
                                <label for="user_id">{{__('User')}}</label>
                                <select name="user_id" class="form-control nice-select wide" >
                                    <option value="">{{__('Select User')}}</option>
                                    @foreach($all_users as $user)
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <br>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <h6 class="group-title">{{__('Billing Details Details')}}</h6>
                                    <div class="form-group">
                                        <label for="billing_name">{{__('Billing Name')}}</label>
                                        <input type="text" class="form-control"  name="billing_name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_email">{{__('Billing Email')}}</label>
                                        <input type="text" class="form-control"  name="billing_email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_phone">{{__('Billing Phone')}}</label>
                                        <input type="text" class="form-control"  name="billing_phone" >
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_country">{{__('Billing Country')}}</label>
                                        {!! get_country_field('billing_country','billing_country','form-control') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_street_address">{{__('Billing Street Address')}}</label>
                                        <input type="text" class="form-control" name="billing_street_address">
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_town">{{__('Billing Town/City')}}</label>
                                        <input type="text" class="form-control" name="billing_town" >
                                    </div>
                                    <div class="form-group">
                                        <label for="billing_district">{{__('Billing State')}}</label>
                                        <input type="text" class="form-control" name="billing_district">
                                    </div>

                                    <div class="form-group">
                                        <label for="different_shipping_address"><strong>{{__('Use Different Shipping Address Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="different_shipping_address" checked>
                                            <span class="slider"></span>
                                        </label>
                                    </div>

                                    <div class="shipping-wrap">
                                    <h6 class="group-title">{{__('Shipping Details')}}</h6>
                                    <div class="form-group">
                                        <label for="shipping_name">{{__('Shipping Name')}}</label>
                                        <input type="text" class="form-control"  name="shipping_name" >
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_email">{{__('Shipping Email')}}</label>
                                        <input type="text" class="form-control"  name="shipping_email" >
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_phone">{{__('Shipping Phone')}}</label>
                                        <input type="text" class="form-control"  name="shipping_phone" >
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_country">{{__('Shipping Country')}}</label>
                                        {!! get_country_field('shipping_country','shipping_country','form-control') !!}
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_street_address">{{__('Shipping Street Address')}}</label>
                                        <input type="text" class="form-control" name="shipping_street_address">
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_town">{{__('Shipping Town/City')}}</label>
                                        <input type="text" class="form-control" name="shipping_town" >
                                    </div>
                                    <div class="form-group">
                                        <label for="shipping_district">{{__('Shipping State')}}</label>
                                        <input type="text" class="form-control" name="shipping_district">
                                    </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                        <label for="stock_status">{{__('Shipping Method')}}</label>
                                        <select name="product_shippings_id" class="form-control" >
                                            <option value="">{{__('Select Shipping Method')}}</option>
                                            @foreach($all_shipping as $shipping)
                                            <option value="{{$shipping->id}}" @if($shipping->is_default == 1) selected @endif>{{$shipping->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="payment_gateway">{{__('Payment Gateway')}}</label>
                                        <select name="payment_gateway" class="form-control" >
                                            <option value="">{{__('Select Shipping Method')}}</option>
                                            @php
                                                $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack'];
                                            @endphp
                                            @foreach($all_gateways as $gateway)
                                                @if(!empty(get_static_option($gateway.'_gateway')))
                                                    <option value="{{$gateway}}" @if(get_static_option('site_default_payment_gateway') == $gateway) selected @endif>{{ucwords(str_replace('_',' ',$gateway))}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                   <div class="product-add-to-cart-wrap">
                                       <div class="form-group">
                                           <label for="cart_items">{{__('Products')}}</label>
                                           <select id="product_items" class="form-control nice-select wide">
                                               <option value="">{{__('Select Products')}}</option>
                                               @foreach($all_products as $product)
                                                   <option value="{{$product->id}}">{{$product->title}}</option>
                                               @endforeach
                                           </select>
                                       </div>
                                       <button type="button" class="btn btn-primary" id="add_to_cart_btn">{{__('Add In Cart')}}</button>
                                   </div>
                                    <div id="cart-item-wrapper">
                                        <table class="table table-bordered order-view-table">
                                            <thead>
                                                <tr>
                                                    <th>{{__('Thumbnail')}}</th>
                                                    <th>{{__('Product Name')}}</th>
                                                    <th>{{__('Quantity')}}</th>
                                                    <th>{{__('Unit Price')}}</th>
                                                    <th>{{__('Tax')}}</th>
                                                    <th>{{__('Subtotal')}}</th>
                                                    <th>{{__('Action')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart-table-body"></tbody>
                                        </table>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">{{__('Status')}}</label>
                                        <select name="status" id="status"  class="form-control">
                                            <option value="pending">{{__('Pending')}}</option>
                                            <option value="in_progress">{{__('In Progress')}}</option>
                                            <option value="shipped">{{__('Shipped')}}</option>
                                            <option value="cancel">{{__('Cancel')}}</option>
                                            <option value="complete">{{__('Complete')}}</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4" id="new_order_submit_btn">{{__('Submit')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/backend/js/jquery.nice-select.min.js')}}"></script>
    <script>
        $(document).ready(function () {
            /*---------------------------------------
            *  QUANTITY CHANGE CALCULATION
            * -------------------------------------*/
            $('body').on('click','.ajax_remove_cart_item',function (e){
                e.preventDefault();
                $(this).parent().parent().parent().remove();
            });

            $('body').on('click','.product-variant-list li',function (){

                $(this).addClass('selected').siblings().removeClass('selected');
                var trContainer = $(this).parent().parent().parent().parent();
                var allSelectedValue  = trContainer.find('.product-variant-list li.selected');;
                var variantVal = [];
                $.each(allSelectedValue,function (index,value){
                    var elData = $(this).data();
                    variantVal.push({
                        'variantID' : elData.variantid,
                        'variantName' : elData.variantname,
                        'term' : elData.term,
                        'price' :  elData.price =! 'undefined' ? elData.price : '',
                    })
                });
                trContainer.find('.product_variant_input').val(JSON.stringify(variantVal));
            });

            $('body').on('change','.quantity',function (){
                var qty = $(this).val();
                var productId = $(this).data('productid');
                var container = $(this).parent().parent();
                if(qty > 0){
                    $.ajax({
                        url: "{{route('admin.product.order.qty.calculate.ajax')}}",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: productId,
                            qty: qty,
                        },
                        success: function (data){
                            if(data != ''){
                                container.find('.unit_price').text(data.unit_price);
                                container.find('.tax_amount').text(data.tax_markup);
                                container.find('.subtotal').text(data.subtotal_markup);
                            }
                        },
                        error: function (response){

                        }
                    });
                }

            })
            /*---------------------------------------
            *  ADD TO CART ICON
            * -------------------------------------*/
            $(document).on('click','#add_to_cart_btn',function (){
                var productId = $('#product_items').val();
                var btn = $('#add_to_cart_btn');
                var cartTableBody = $('#cart-table-body');
                btn.find('i').remove();
                if (productId != ''){
                    btn.append('<i class="fas fa-spinner fa-spin"></i>');

                    $.ajax({
                        url: "{{route('admin.product.order.cart.markup.by.ajax')}}",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: productId
                        },
                        success: function (data){
                            cartTableBody.append(data);
                            btn.find('i').remove();
                        },
                        error: function (response){

                        }
                    });
                }
            });

            /*---------------------------------------
            *  FETCH USER DETAILS
            * -------------------------------------*/
            //add_to_cart_btn
            $(document).on('change','select[name="user_id"]',function (){
                var userId = $(this).val();
                if (userId != ''){
                    $.ajax({
                        url: "{{route('admin.product.order.user.details.ajax')}}",
                        type: 'POST',
                        data: {
                            _token: "{{csrf_token()}}",
                            id: userId
                        },
                        success: function (data){
                            $('input[name="billing_name"]').val(data.name);
                            $('input[name="billing_email"]').val(data.email);
                            $('input[name="billing_phone"]').val(data.phone);
                            $('input[name="billing_street_address"]').val(data.address);
                            $('input[name="billing_town"]').val(data.city);
                            $('input[name="billing_district"]').val(data.state);
                            $('select[name="billing_country"] option[value="'+data.country+'"]').attr('selected',true);
                        }
                    });
                }
            });


           /*--------------------------------------
           *  DIFFERENT SHIPPING METHOD CHECK
           * -------------------------------------*/

            $(document).on('change','input[name="different_shipping_address"]',function(){
                var shippingWrap = $('.shipping-wrap');
                if($(this).is(':checked')){
                    shippingWrap.addClass('d-block').removeClass('d-none');
                }else{
                    shippingWrap.removeClass('d-block').addClass('d-none');
                }
            });

            /*---------------------------------
            *   NICE SELECT INITIALIZE
            * -------------------------------*/
            var niceSelect = $('.nice-select');
            if(niceSelect.length > 0){
                niceSelect.niceSelect();
            }


            /*---------------------------------
            *      CHECK PRODUCT VARIANT INPUT
            * -------------------------------*/

            $(document).on('click','#new_order_submit_btn',function (e){
               e.preventDefault();
               var preventSubmit = true;
               var allVariants = $('.product-variant-list');
               $.each(allVariants,function (index,value){
                   preventSubmit = true;
                   if($(this).children('.selected').length > 0){
                       preventSubmit = false;
                   }
               });
                if(!preventSubmit){
                    $('#new_product_order_form').trigger('submit');
                }else{
                    alert("{{__('select product variant')}}");
                }
            });
        });
    </script>
@endsection
