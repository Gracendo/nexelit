@extends('backend.admin-master')
@section('site-title')
    {{__('Appointments Booking Details')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title">{{__('Appointments Booking Details')}}</h4>
                           <a href="{{route('admin.appointment.booking.all')}}" class="btn btn-info">{{__('All Appointment Booking')}}</a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong>{{__('ID')}}</strong> : #{{$booking_details->id}}</li>
                                <li><strong>{{__('Name')}}</strong> : {{$booking_details->name}}</li>
                                <li><strong>{{__('Email')}}</strong> : {{$booking_details->email}}</li>
                                <li><strong>{{__('Appointment Title')}}</strong> : {{$booking_details->appointment->title ?? __('Untitled')}}</li>
                                <li><strong>{{__('Appointment Fee')}}</strong> : {{$booking_details->total}}</li>
                                <li><strong>{{__('Appointment Date')}}</strong> : {{date('D,d F Y',strtotime($booking_details->booking_date))}}</li>
                                <li><strong>{{__('Appointment Time')}}</strong> : {{$booking_details->booking_time->time ?? __('Not Set')}}</li>
                                <li><strong>{{__('Payment Gateway')}}</strong> : {{$booking_details->payment_gateway}}</li>
                                <li><strong>{{__('Payment Status')}}</strong> : {{$booking_details->payment_status}}</li>
                                @if($booking_details->payment_status === 'complete')
                                <li><strong>{{__('Transaction ID')}}</strong> : {{$booking_details->transaction_id}}</li>
                                @endif
                                <li><strong>{{__('Booking Status')}}</strong> : {{$booking_details->status}}</li>
                                @if(count($booking_details->custom_fields) > 0)
                                <li><strong>{{__('Custom Fields')}}</strong> :
                                    <ul>
                                        @foreach($booking_details->custom_fields as $key => $item)
                                            @if(in_array($key,['name','email','appointment_id','selected_payment_gateway','booking_time','booking_date']))
                                                @continue
                                            @endif
                                            <li><string>{{str_replace(['_','-'],[' ',' '],$key)}}</string> : {{$item}}</li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @if(count($booking_details->all_attachment) > 0)
                                    <li><strong>{{__('Attachments')}}</strong> :
                                        <ul>
                                            @foreach($booking_details->all_attachment as $key => $item)
                                                <li><string>{{str_replace(['_','-'],[' ',' '],$key)}}</string> :
                                                    <a href="{{asset($item)}}">{{$item}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
