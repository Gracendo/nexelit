@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Checkout')}}
@endsection
@section('page-title')
    {{__('Checkout')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
@endsection
@section('content')
    <section class="product-checkout-area order-service-page-content-area  padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <x-flash-msg/>
                    <x-error-msg/>
                    @if(\App\Facades\Cart::count() > 0)
                    <div class="checkout-wrapper">

                       <div class="billing-details-wrapper">
                           <div class="order-tab-wrap">
                               <nav>
                                   <div class="nav nav-tabs" role="tablist">
                                       @if(!auth()->check())
                                           <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                                       @endif
                                       <a class="nav-item nav-link  @if(auth()->check()) active @else disabled @endif" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                                   </div>
                               </nav>
                               <div class="tab-content" >
                                   @if(!auth()->check())
                                       <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                            @if(get_static_option('disable_guest_mode_for_product_module'))
                                           <div class="checkout-type margin-bottom-30  @if(auth()->check()) d-none  @endif">
                                               <div class="custom-control custom-switch">
                                                   <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                                   <label class="custom-control-label" for="guest_logout">{{__('Guest Order')}}</label>
                                               </div>
                                           </div>
                                           @endif

                                           @if(!auth()->check())
                                               <div class="login-form">
                                                   <form action="{{route('user.login')}}" method="post" enctype="multipart/form-data" class="account-form" id="login_form_order_page">
                                                       @csrf
                                                        <div class="error-wrap"></div>
                                                       <div class="form-group">
                                                           <input type="text" name="username" class="form-control" placeholder="{{__('Username')}}">
                                                       </div>
                                                       <div class="form-group">
                                                           <input type="password" name="password" class="form-control" placeholder="{{__('Password')}}">
                                                       </div>
                                                       <div class="form-group btn-wrapper">
                                                           <button type="submit" id="login_btn" class="submit-btn">{{__('Login')}}</button>
                                                       </div>
                                                       <div class="row mb-4 rmber-area">
                                                           <div class="col-6">
                                                               <div class="custom-control custom-checkbox mr-sm-2">
                                                                   <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                                                   <label class="custom-control-label" for="remember">{{__('Remember Me')}}</label>
                                                               </div>
                                                           </div>
                                                           <div class="col-6 text-right">
                                                               <a class="d-block" href="{{route('user.register')}}">{{__('Create New account?')}}</a>
                                                               <a href="{{route('user.forget.password')}}">{{__('Forgot Password?')}}</a>
                                                           </div>
                                                       </div>
                                                   </form>
                                               </div>
                                           @else
                                               <div class="alert alert-success">
                                                    {{__('Your Are Logged In As')}} {{auth()->user()->name}}
                                               </div>
                                           @endif
                                           @if(!auth()->check())
                                               <div class="next-step">
                                                   <button class="next-step-btn btn-boxed" style="display: none" type="button">{{__('Next Step')}}</button>
                                               </div>
                                           @endif
                                       </div>
                                   @endif
                                   <div class="tab-pane fade @if(auth()->check()) show active @endif" id="nav-profile" role="tabpanel">
                                       <form action="{{route('frontend.products.checkout')}}" method="post" enctype="multipart/form-data" class="contact-form order-form checkout-form" id="checkout_form">
                                           @csrf
                                           <input type="hidden" name="selected_payment_gateway" value="{{get_static_option('site_default_payment_gateway')}}">
                                           <input type="hidden" name="total" value="{{\App\Facades\Cart::total()}}">
                                           <input type="hidden" name="subtotal" value="{{\App\Facades\Cart::subtotal()}}">
                                           <input type="hidden" name="coupon_discount" value="{{\App\Facades\Cart::coupon()}}">
                                           <input type="hidden" name="shipping_cost" value="{{\App\Facades\Cart::cartShipping()}}">
                                           <input type="hidden" name="product_shippings_id" value="{{session()->get('shipping_charge')}}">
                                           <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                           <input type="hidden" name="transaction_id_val" id="transaction_id" placeholder="{{__('transaction')}}" class="form-control">
                                           <div class="row">
                                               <div class="col-lg-8">
                                                   <div class="billing-details-fields-wrapper">
                                                       <h4 class="title">{{__('Billing Information')}}</h4>
                                                       <div class="form-group">
                                                           <label for="billing_name">{{__('Name')}}</label>
                                                           <input type="text" class="form-control" name="billing_name" value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->name : ''}}" id="billing_name">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_email">{{__('Email')}}</label>
                                                           <input type="email" class="form-control" name="billing_email" value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->email : ''}}" id="billing_email">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_phone">{{__('Phone')}}</label>
                                                           <input type="text" class="form-control" value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->phone : ''}}" name="billing_phone" id="billing_phone">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_country">{{__('Country')}}</label>
                                                           {!! get_country_field('billing_country','billing_country','form-control') !!}
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_street_address">{{__('Street Address')}}</label>
                                                           <input type="text" class="form-control" name="billing_street_address" value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->address : ''}}" id="billing_street_address">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_town">{{__('Town/City')}}</label>
                                                           <input type="text" class="form-control" name="billing_town"  value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->city : ''}}" id="billing_own">
                                                       </div>
                                                       <div class="form-group">
                                                           <label for="billing_district">{{__('State')}}</label>
                                                           <input type="text" class="form-control" name="billing_district" value="{{auth()->guard('web')->user() ? auth()->guard('web')->user()->state : ''}}" id="billing_district">
                                                       </div>
                                                   </div>
                                                    <div class="shipping-details-wrapper">
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="different_shipping_method" name="different_shipping_address">
                                                            <label class="custom-control-label" for="different_shipping_method">{{__('Ship to a different location?')}}</label>
                                                        </div>
                                                        <div class="shipping-details-fields-wrapper">
                                                            <h4 class="title">{{__('Shipping Information')}}</h4>
                                                            <div class="form-group">
                                                                <label for="shipping_name">{{__('Name')}}</label>
                                                                <input type="text" class="form-control" name="shipping_name" id="shipping_name">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_email">{{__('Email')}}</label>
                                                                <input type="email" class="form-control" name="shipping_email" id="shipping_email">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_phone">{{__('Phone')}}</label>
                                                                <input type="text" class="form-control" name="shipping_phone" id="shipping_phone">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_country">{{__('Country')}}</label>
                                                                {!! get_country_field('shipping_country','shipping_country','form-control') !!}
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_street_address">{{__('Street Address')}}</label>
                                                                <input type="text" class="form-control" name="shipping_street_address" id="shipping_street_address">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_town">{{__('Town/City')}}</label>
                                                                <input type="text" class="form-control" name="shipping_town" id="shipping_town">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="shipping_district">{{__('District')}}</label>
                                                                <input type="text" class="form-control" name="shipping_district" id="shipping_district">
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>
                                           </div>

                                   </div>
                               </div>
                           </div>
                       </div>
                       <div class="cart-total-wrap">
                            {!! \App\Facades\Cart::cartSummery()!!}
                           {!! render_payment_gateway_for_form(true) !!}
                           @if(!empty(get_static_option('manual_payment_gateway')))
                               <div class="form-group manual_payment_transaction_field  @if( get_static_option('site_default_payment_gateway') === 'manual_payment') d-block @endif ">
                                   <div class="label mb-2">{{__('Attach your bank Document')}}</div>
                                   <input class="form-control btn btn-primary btn-sm pb-2" type="file" name="manual_payment_attachment"><br>
                                   <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                               </div>
                           @endif
                           <a href="{{route('frontend.products.checkout')}}" class="btn-boxed checkout_form_submit_btn">{{__('Confirm Order')}}</a>
                       </div>
                   </div>
                    @else
                        <div class="alert alert-warning">{{__('No Item In Cart!')}}</div>
                    @endif
                </div>
            </div>
        </div>
        </form>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
    <script>
        (function ($) {
            'use strict';
            @php
                $product_page_slug = !empty(get_static_option('product_page_slug')) ? get_static_option('product_page_slug') : 'products';
                $checkout_page_slug = $product_page_slug.'-checkout';
            @endphp
            @if(request()->path() == $checkout_page_slug)
            $('.cart-total-wrap .btn-boxed').hide();
            @endif

             $(document).on('click', '#login_btn', function (e) {
                e.preventDefault();
                var formContainer = $('#login_form_order_page');
                var el = $(this);
                var username = formContainer.find('input[name="username"]').val();
                var password = formContainer.find('input[name="password"]').val();
                var remember = formContainer.find('input[name="remember"]').val();

                el.text('{{__("Please Wait")}}');

                $.ajax({
                    type: 'post',
                    url: "{{route('user.ajax.login')}}",
                    data: {
                        _token: "{{csrf_token()}}",
                        username : username,
                        password : password,
                        remember : remember,
                    },
                    success: function (data){
                        if(data.status == 'invalid'){
                            el.text('{{__("Login")}}')
                            formContainer.find('.error-wrap').html('<div class="alert alert-danger">'+data.msg+'</div>');
                        }else{
                            formContainer.find('.error-wrap').html('');
                            el.text('{{__("Login Success.. Redirecting ..")}}');
                             location.reload();
                        }
                    },
                    error: function (data){
                        var response = data.responseJSON.errors
                        formContainer.find('.error-wrap').html('<ul class="alert alert-danger"></ul>');
                        $.each(response,function (value,index){
                            formContainer.find('.error-wrap ul').append('<li>'+index+'</li>');
                        });
                        el.text('{{__("Login")}}');
                    }
                });
            });
            
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "2000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
            shipping_info();
            $(document).on('change','#different_shipping_method',function (e) {
               e.preventDefault();
                shipping_info();
            });
            function shipping_info(){
                var shippingSwitcher = $('#different_shipping_method');
                var shippingFieldContainer = $('.shipping-details-fields-wrapper');
                if(shippingSwitcher.is(':checked')){
                    shippingFieldContainer.show();
                }else{
                    shippingFieldContainer.hide();
                }
            }
            $(document).on('click','.add_shipping',function (e) {
                e.preventDefault();
                var el = $(this);
                var shippingId = $('input[name="shipping_id"]:checked').val();
                $.ajax({
                    url: "{{route('frontend.products.shipping.apply')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        shipping_id : shippingId,
                    },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    error: function(response){
                        el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        var error = response.responseJSON.errors;
                        toastr.error(error.shipping_id[0]);
                    },
                    success:function (data) {
                        el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        if(data.status == 'ok'){
                            $('.cart-total-table-wrap').html(data.cart_total_markup);
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                });
            });

            $(document).on('click','.add_coupon_code_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var couponCode = $('input[name="coupon_code"]').val();
                $('.cart-table-footer-wrap .coupon-wrap').children('.error_wrap').remove();
                $.ajax({
                    url: "{{route('frontend.products.coupon.code')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        coupon_code : couponCode,
                    },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    error: function(response){
                        el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        var error = response.responseJSON.errors;
                        toastr.error(error.coupon_code[0]);
                    },
                    success:function (data) {
                        el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        if(data.status == 'ok'){
                            $('.cart-total-table-wrap').html(data.cart_total_markup);
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                });
            });

            $(document).on('click','.update_cart_items_btn',function (e) {
                e.preventDefault();
                var el = $(this);
                var productId =  $("input[name='product_id[]']").map(function(){return $(this).val();}).get();
                var quantity =  $("input[name='product_quantity[]']").map(function(){return $(this).val();}).get();
                $.ajax({
                    url: "{{route('frontend.products.ajax.cart.update')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        product_id : productId,
                        quantity : quantity
                    },
                    beforeSend: function(){
                        el.prev('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    success:function (data) {
                        el.prev('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount').text(data.total_cart_item);
                        $('.cart-total-table-wrap').html(data.cart_total_markup);
                        $('.cart-table-wrapper').html(data.cart_table_markup);
                        var msg = "{{__('Cart Updated')}}";
                        toastr.success(msg);
                    }
                });
            });

            $(document).on('click','.ajax_remove_cart_item',function (e) {
                e.preventDefault();
                var el = $(this);
                var productId = el.data('product_id');
                $.ajax({
                   url: "{{route('frontend.products.cart.ajax.remove')}}",
                   type: "POST",
                   data: {
                       _token : "{{csrf_token()}}",
                       product_id : productId
                   },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                   success:function (data) {
                       el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                       $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount').text(data.total_cart_item);
                       $('.cart-total-table-wrap').html(data.cart_total_markup);
                       $('.cart-table-wrapper').html(data.cart_table_markup);
                       var msg = "{{__('Cart Item Removed')}}";
                       toastr.error(msg);
                   }
                });
            });

            $(document).on('click','.checkout_form_submit_btn',function (e) {
                e.preventDefault();
                var manual_payment_gateway_transaction_id = $('input[name="transaction_id"]').val();
                $('#transaction_id').val(manual_payment_gateway_transaction_id);
                $('#checkout_form').submit();
            })

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway == 'manual_payment'){
                    manual_gateway_tr.addClass('d-block').removeClass('d-none');
                }else{
                    manual_gateway_tr.removeClass('d-block').addClass('d-none');
                }
            });

            $(document).on('change','#guest_logout',function (e) {
                e.preventDefault();
                var infoTab = $('#nav-profile-tab');
                var nextBtn = $('.next-step-btn');
                if($(this).is(':checked')){
                    $('.login-form').hide();
                    infoTab.attr('disabled',false).removeClass('disabled');
                    nextBtn.show();
                    
                }else{
                    $('.login-form').show();
                    infoTab.attr('disabled',true).addClass('disabled');
                    nextBtn.hide();
                }
            });
            $(document).on('click','.next-step-btn',function(e){
                var infoTab = $('#nav-profile-tab');
                infoTab.attr('disabled',false).removeClass('disabled').addClass('active').siblings().removeClass('active');
                $('#nav-profile').addClass('show active').siblings().removeClass('show active');
            });

            var selectdCountry = "{{auth()->guard('web')->user() ? auth()->guard('web')->user()->country : ''}}";
            $('#billing_country option[value="'+selectdCountry+'"]').attr('selected',true);
            
        })(jQuery);
    </script>
@endsection
