@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:')}} {{ $enroll_details->course->lang_front->title ?? __('Untitled') }}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80">
                        <h1 class="title">{{get_static_option('course_success_'.$user_select_lang_slug.'_title' )}}</h1>
                        <p>{{get_static_option('course_success_' . $user_select_lang_slug . '_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h2 class="billing-title">{{__('Payment Details')}}</h2>
                    <ul class="booking_details_list">
                        <li><strong>{{__('Enroll Id')}}</strong> : #{{$enroll_details->id}}</li>
                        <li><strong>{{__('Name')}}</strong> : {{$enroll_details->name}}</li>
                        <li><strong>{{__('Email')}}</strong> : {{$enroll_details->email}}</li>
                        <li><strong> {{get_static_option('courses_page_'.$user_select_lang_slug.'_name')}} {{__('Name')}}</strong> : {{ $enroll_details->course->lang_front->title ?? __('Untitled') }}</li>
                        <li><strong>{{__('Price')}}</strong> :
                            {{amount_with_currency_symbol(course_discounted_amount($enroll_details->total,$enroll_details->coupon))}}
                            @if(!empty($enroll_details->coupon))
                             <del> {{amount_with_currency_symbol($enroll_details->total)}}</del>
                             @endif
                        </li>
                        @if(!empty($enroll_details->coupon))
                        <li><strong>{{__('Coupon')}}</strong> : {{$enroll_details->coupon}}</li>
                        @endif
                        @if(!empty($enroll_details->coupon))
                        <li><strong>{{__('Discount')}}</strong> : {{amount_with_currency_symbol($enroll_details->coupon_discounted)}}</li>
                        @endif
                        <li><strong>{{__('Payment Gateway')}}</strong> : {{$enroll_details->payment_gateway}}</li>
                        <li><strong>{{__('Payment Status')}}</strong> : {{$enroll_details->payment_status}}</li>
                        <li><strong>{{__('Transaction Id')}}</strong> : {{$enroll_details->transaction_id}}</li>
                        <li><strong>{{__('Enrollment Status')}}</strong> : {{$enroll_details->status}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        <a href="{{route('user.home')}}" class="boxed-btn">{{__('Go To Dashboard')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
