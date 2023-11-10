@extends('backend.admin-master')
@section('site-title')
    {{__('Course Enroll Details')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title">{{__('Course Enroll Details')}}</h4>
                           <a href="{{route('admin.courses.enroll.all')}}" class="btn btn-info">{{__('All Course Enrollment')}}</a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong>{{__('Enroll Id')}}</strong> : #{{$enroll_details->id}}</li>
                                <li><strong>{{__('Name')}}</strong> : {{$enroll_details->name}}</li>
                                <li><strong>{{__('Email')}}</strong> : {{$enroll_details->email}}</li>
                                <li><strong> {{get_static_option('courses_page_'.get_default_language().'_name')}} {{__('Name')}}</strong> : {{ $enroll_details->course->lang_front->title ?? __('Untitled') }}</li>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
