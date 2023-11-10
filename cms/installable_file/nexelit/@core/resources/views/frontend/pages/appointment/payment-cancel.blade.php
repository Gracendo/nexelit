@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Cancelled For:')}} {{$booking->appointment ? $booking->appointment->title : __('Untitled') }}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area">
                        <h1 class="title">{{get_static_option('appointment_booking_'.$user_select_lang_slug.'_cancel_page_title' )}}</h1>
                        <p>{{get_static_option('appointment_booking_' . $user_select_lang_slug . '_cancel_page_description')}}</p>
                        <div class="btn-wrapper">
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
