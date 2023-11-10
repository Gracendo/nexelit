@extends('frontend.frontend-page-master')
@section('site-title')
    {{__('Enroll')}} : {{$course->lang_front->title}}
@endsection
@section('page-title')
    {{__('Enroll')}} : {{$course->lang_front->title}}
@endsection
@section('content')
    <section class="course-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="enroll-area-wrapper">
                        @if(auth()->guard('web')->check())
                            <div class="enroll-form-wrapper">
                                <x-error-msg/>
                                <x-flash-msg/>
                                <h4 class="amount-title">{{__('Payable Amount')}} <span class="price">{{amount_with_currency_symbol($course->price)}}</span></h4>
                                <form action="{{route('frontend.course.enroll.submit')}}" method="post" class="appointment-booking-form" id="appointment_rating_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                    <div class="form-group">
                                        <label for="name">{{__('Name')}}</label>
                                        <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" value="{{auth()->guard('web')->user()->name}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">{{__('Email')}}</label>
                                        <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}" value="{{auth()->guard('web')->user()->email}}">
                                    </div>
                                    <div class="form-group coupon">
                                        <label for="coupon">{{__('Have Coupon?')}}</label>
                                        <input type="text" name="coupon" class="form-control" placeholder="{{__('Coupon')}}" >
                                        <span class="right spin-none" id="course_coupon_apply">{{__('Apply')}}<i class="fas fa-spinner fa-spin"></i></span>
                                    </div>
                                    <div class="coupon-msg-wrap"></div>
                                    @if(!empty($course->price) && $course->price != 0)
                                        {!! render_payment_gateway_for_form(false) !!}
                                        @if(!empty(get_static_option('manual_payment_gateway')))
                                            <div class="form-group manual_payment_transaction_field @if( get_static_option('site_default_payment_gateway') === 'manual_payment') d-block @endif ">
                                                <div class="label mb-2">{{__('Attach your bank Document')}}</div>
                                                <input class="form-control btn btn-primary btn-sm pb-2 pt-2" type="file" name="manual_payment_attachment">
                                                <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                                            </div>
                                        @endif
                                    @endif
                                   <div class="btn-wrapper">
                                       <button type="submit" class="btn-boxed enroll" >{{get_static_option('course_single_'.$user_select_lang_slug.'_enroll_button_text')}}</button>
                                   </div>
                                </form>
                            </div>
                        @else
                            @include('frontend.partials.ajax-login-form',['title' => __('Login to enroll')])
                        @endif
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('scripts')
    @include('frontend.partials.ajax-login-form-js')
    <script>
        (function (){
            "use strict";

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    manual_gateway_tr.removeClass('d-none').addClass('d-block');
                }else{
                    manual_gateway_tr.addClass('d-none').removeClass('d-block');
                }
            });

            $(document).on('click','#course_coupon_apply',function (){
               var course_id = $('input[name="course_id"]').val();
               var coupon = $('input[name="coupon"]').val();
                $(this).removeClass('spin-none')
               if(coupon == ''){
                    $('.coupon-msg-wrap').html('');
                    $('.coupon-msg-wrap').html('<span class="text-danger">'+'{{__("enter coupon")}}'+'</span>');
                    $(this).addClass('spin-none');
                   return
                }
               $.ajax({
                   'type' : 'post',
                   'url' : "{{route('frontend.course.apply.coupon')}}",
                   data: {
                        '_token': "{{csrf_token()}}",
                        'course_id' : course_id,
                        'coupon' : coupon
                   },
                   success: function (data){
                       $('#course_coupon_apply').addClass('spin-none');
                       $('.coupon-msg-wrap').html('');
                       $('.coupon-msg-wrap').html('<span class="text-'+data.status+'">'+data.msg+'</span>');
                       if(data.status == 'success'){
                           var oldPrice = $('.enroll-form-wrapper .amount-title .price').text();
                           $('.enroll-form-wrapper .amount-title .price').html(data.amount+'<del>'+oldPrice+'</del>');
                       }

                   }
               });
            });

        })(jQuery);
    </script>
@endsection
