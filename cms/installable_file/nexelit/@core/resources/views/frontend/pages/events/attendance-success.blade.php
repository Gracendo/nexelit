@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:'.' '.$attendance_details->event_name)}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-50">
                        <h1 class="title">{{get_static_option('event_success_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p>{{get_static_option('event_success_page_' . $user_select_lang_slug . '_description')}}</p>

                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title">{{__('Billing Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Attendance ID')}}:</strong> #{{$payment_log->id}}</li>
                        <li><strong>{{__('Name')}}:</strong> {{$payment_log->name}}</li>
                        <li><strong>{{__('Email')}}:</strong> {{$payment_log->email}}</li>
                        <li><strong>{{__('Payment Method')}}:</strong> {{str_replace('_',' ',$payment_log->package_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}:</strong> {{$payment_log->status}}</li>
                        <li><strong>{{__('Transaction id')}}:</strong> {{$payment_log->transaction_id}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        @if(auth()->guard('web')->check())
                            <a href="{{route('user.home')}}" class="boxed-btn">{{__('Go To Dashboard')}}</a>
                        @else
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="event-single-wrap">
                        <div class="single-events-list-item event-order-success-page">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($event_details->image) !!}
                            </div>
                            <div class="content-area">
                                <div class="top-part">
                                    <div class="time-wrap">
                                        <span class="date">{{date('d',strtotime($event_details->date))}}</span>
                                        <span class="month">{{date('M',strtotime($event_details->date))}}</span>
                                    </div>
                                    <div class="title-wrap">
                                        <a href="{{route('frontend.events.single',$event_details->slug)}}"><h4 class="title">{{$event_details->title}}</h4></a>
                                        <span class="location"><i class="fas fa-map-marker-alt"></i> {{$event_details->venue_location}}</span>
                                    </div>
                                </div>
                                <p>{{strip_tags(Str::words(str_replace('&nbsp;',' ',$event_details->content),20))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
