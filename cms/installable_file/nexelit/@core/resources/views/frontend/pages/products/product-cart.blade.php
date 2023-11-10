@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Cart')}}
@endsection
@section('page-title')
    {{__('Cart')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
@endsection
@section('content')
    <section class="product-content-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                   <div class="cart-wrapper">
                       <div class="cart-table-wrapper">
                           {!! \App\Facades\Cart::cartTable()!!}
                       </div>
                       @if(\App\Facades\Cart::count() > 0)
                       @if(is_shipping_available())
                       <div class="shipping-wrap">
                          <div class="cart-shipping-wrapper">
                              <div class="accordion" id="cart_shipping_accordion">
                                  <div class="card">
                                      <div class="card-header" id="headingOne">
                                          <a data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                              {{__('Apply Shipping')}}
                                          </a>
                                      </div>
                                      <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#cart_shipping_accordion">
                                          <div class="card-body">
                                             <div class="shipping-table-wrap table-responsive">
                                                 <table class="table table-bordered">
                                                     <tbody>
                                                        @foreach($all_shipping as $data)
                                                        <tr>
                                                            <td>
                                                                <input type="radio" @if($data->is_default == '1' || session()->get('shipping_charge') == $data->id) checked @endif value="{{$data->id}}" name="shipping_id">
                                                            </td>
                                                            <td>
                                                                <div class="shipping-details-wrap">
                                                                    <h5 class="title">{{$data->title}}</h5>
                                                                    <p>{{$data->description}}</p>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <span class="shipping-cost">
                                                                    {{amount_with_currency_symbol($data->cost)}}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                     </tbody>
                                                 </table>
                                                 <div class="btn-wrapper">
                                                     <a href="#" class="boxed-btn add_shipping">{{__('Apply Shipping')}}</a>
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
                                                 </div>
                                             </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                       </div>
                       @endif
                       <div class="cart-total-wrap margin-top-30">
                          {!! \App\Facades\Cart::cartSummery()!!}
                       </div>
                       @endif
                   </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
    <script>
        (function ($) {
            'use strict';
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

            @if(is_shipping_available())
            setDefaultShippingCost();
            
            function setDefaultShippingCost() {
                var defaultShippingValue = $('input[name="shipping_id"]:checked').val();
                var selectedShippingMethod = "{{session()->get('shipping_charge')}}";
                
                if(defaultShippingValue != '' && selectedShippingMethod == ''){
                    $.ajax({
                        url: "{{route('frontend.products.shipping.apply')}}",
                        type: "POST",
                        data: {
                            _token : "{{csrf_token()}}",
                            shipping_id : defaultShippingValue,
                        },
                        error: function(response){
                            var error = response.responseJSON.errors;
                            toastr.error(error.shipping_id[0]);
                        },
                        success:function (data) {
                            if(data.status == 'ok'){
                                $('.cart-total-wrap').html(data.cart_total_markup);
                                toastr.success(data.msg);
                            }else{
                                toastr.error(data.msg);
                            }
                        }
                    });
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
                            $('.cart-total-wrap').html(data.cart_total_markup);
                            toastr.success(data.msg);
                        }else{
                            toastr.error(data.msg);
                        }
                    }
                });
                
            });

            @endif
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
                            $('.cart-total-wrap').html(data.cart_total_markup);
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
                var cart_index =  $("input[name='cart_index[]']").map(function(){return $(this).val();}).get();
                var quantity =  $("input[name='product_quantity[]']").map(function(){return $(this).val();}).get();
                $.ajax({
                    url: "{{route('frontend.products.ajax.cart.update')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        cart_index : cart_index,
                        quantity : quantity
                    },
                    beforeSend: function(){
                        el.prev('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    success:function (data) {
                        el.prev('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount').text(data.total_cart_item);
                        $('.cart-total-wrap').html(data.cart_total_markup);
                        $('.cart-table-wrapper').html(data.cart_table_markup);
                        var msg = "{{__('Cart Updated')}}";
                        toastr.success(msg);
                    }
                });
            });

            $(document).on('click','.ajax_remove_cart_item',function (e) {
                e.preventDefault();
                var el = $(this);
                var cart_index = el.data('cartindex');
                $.ajax({
                   url: "{{route('frontend.products.cart.ajax.remove')}}",
                   type: "POST",
                   data: {
                       _token : "{{csrf_token()}}",
                       cart_index : cart_index
                   },
                    beforeSend: function(){
                        el.next('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                   success:function (data) {
                       el.next('.ajax-loading-wrap').removeClass('show').addClass('hide');
                       $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount').text(data.total_cart_item);
                       $('.cart-total-wrap').html(data.cart_total_markup);
                       $('.cart-table-wrapper').html(data.cart_table_markup);
                       var msg = "{{__('Cart Item Removed')}}";
                       toastr.error(msg);
                       if (!data.shipping_charge_status || $('.cart-table-wrapper table').length < 1){
                           $('.shipping-wrap').remove();
                       }
                   }
                });
            });

        })(jQuery);
    </script>
@endsection
