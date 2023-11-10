@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('appointment_module_status')))
        @if(count($appointments) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('Booking Info')}}</th>
                        <th scope="col">{{__('Booking & Payment Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($appointments as $data)
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        @if(!empty($data->appointment->lang_front->title))
                                            <a href="{{route('frontend.appointment.single',[$data->appointment->lang_front->slug ?? __('untitled'),$data->appointment->id])}}">{{$data->appointment->lang_front->title}}</a>
                                        @else
                                            <div class="text-warning">{{__('This item is not available or removed')}}</div>
                                        @endif
                                    </h5>
                                    <small class="d-block"><strong>{{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Amount:')}}</strong> {{amount_with_currency_symbol($data->total)}}</small>
                                    <small class="d-block"><strong>{{__('Payment Gateway:')}}</strong> {{str_replace('_',' ',__($data->payment_gateway))}}</small>
                                    <small class="d-block"><strong>{{__('Booking Date:')}}</strong> {{date('D,d F Y',strtotime($data->booking_date))}}</small>
                                    <small class="d-block"><strong>{{__('Booking Time:')}}</strong> {{$data->booking_time->time ?? __('Not Set')}}</small>
                                    <small class="d-block"><strong>{{__('Booking Status:')}}</strong> {{$data->status}}</small>
                                    <small class="d-block"><strong>{{__('Date:')}}</strong> {{date_format($data->created_at,'d M Y')}}</small>
                                </div>
                            </td>
                            <td>
                                @if($data->status == 'pending')
                                    <span class="alert alert-warning text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                    @if( $data->payment_gateway != 'manual_payment')
                                        <form action="{{route('frontend.appointment.booking')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="booking_id" value="{{$data->id}}" >
                                            <input type="hidden" name="name" value="{{$data->name}}" >
                                            <input type="hidden" name="email" value="{{$data->email}}" >
                                            <input type="hidden" name="booking_date" value="{{$data->booking_date}}" >
                                            <input type="hidden" name="appointment_id" value="{{$data->appointment_id}}">
                                            <input type="hidden" name="booking_time_id" value="{{$data->booking_time_id}}">
                                            <input type="hidden" name="selected_payment_gateway" value="{{$data->payment_gateway}}">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20">{{__('Pay Now')}}</button>
                                        </form>
                                    @endif
                                    <form action="{{route('user.dashboard.appointment.order.cancel')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                        <button type="submit" class="small-btn btn-danger margin-top-10 ">{{__('Cancel')}}</button>
                                    </form>

                                    @elseif($data->status == 'cancel')
                                        <span class="alert alert-danger text-capitalize alert-sm alert-small d-inline-block">{{__($data->status)}}</span>
                                    @else
                                        <span class="alert alert-success text-capitalize alert-sm alert-small d-inline-block">{{__($data->status)}}</span>
                                    @endif

                                    @if(!empty($data->manual_payment_attachment))
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="{{url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''}}" target="_blank">
                                            {{__('View Bank Attachment')}}
                                        </a>
                                    @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                {{ $appointments->links() }}
            </div>
        @else
            <div class="alert alert-warning">{{__('Nothing Found')}}</div>
        @endif
    @endif
@endsection