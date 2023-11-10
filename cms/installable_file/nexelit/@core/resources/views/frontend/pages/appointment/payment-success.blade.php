@extends('frontend.frontend-page-master')
@section('page-title')

    {{__('Payment Success For:')}} {{$booking->appointment ? optional(optional($booking->appointment)->lang)->title : __('Untitled') }}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80">
                        <h1 class="title">{{get_static_option('appointment_booking_'.$user_select_lang_slug.'_success_page_title' )}}</h1>
                        <p>{{get_static_option('appointment_booking_' . $user_select_lang_slug . '_success_page_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h2 class="billing-title">{{__('Appointment Details')}}</h2>
                    <ul class="booking_details_list">
                        <li><strong>{{__('Id')}}</strong> : #{{$booking->id}}</li>
                        <li><strong>{{__('Name')}}</strong> : {{$booking->name}}</li>
                        <li><strong>{{__('Email')}}</strong> : {{$booking->email}}</li>
                        <li><strong>{{__('Fee')}}</strong> : {{amount_with_currency_symbol($booking->total)}}</li>
                        <li><strong>{{__('Payment Gateway')}}</strong> : {{$booking->payment_gateway}}</li>
                        <li><strong>{{__('Payment Status')}}</strong> : {{$booking->payment_status}}</li>
                        <li><strong>{{__('Transaction Id')}}</strong> : {{$booking->transaction_id}}</li>
                        <li><strong>{{__('Appointment Status')}}</strong> : {{$booking->status}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
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

@endsection
