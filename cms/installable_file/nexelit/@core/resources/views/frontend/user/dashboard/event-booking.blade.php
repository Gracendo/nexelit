@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('events_module_status')))
        @if(count($event_attendances) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{get_static_option('events_page_'.$user_select_lang_slug.'_name')}} {{__('Booking Info')}}</th>
                        <th scope="col">{{__('Payment Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($event_attendances as $data)
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        @if(!empty($data->event))
                                            <a href="{{route('frontend.events.single',$data->event->slug)}}">{{$data->event_name}}</a>
                                        @else
                                            <div class="alert alert-warning">{{__('This item is not available or removed')}}</div>
                                        @endif
                                    </h5>
                                    <small class="d-block"><strong>{{__('Attendance ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Ticket Price:')}}</strong> {{amount_with_currency_symbol($data->event_cost)}}</small>
                                    <small class="d-block"><strong>{{__('Quantity:')}}</strong> {{$data->quantity}}</small>
                                    <small class="d-block"><strong>{{__('Payment Gateway:')}}</strong>
                                        @php
                                            $custom_fields = unserialize($data->custom_fields);
                                            $selected_payment_gateway = isset($custom_fields['selected_payment_gateway']) ? str_replace('_',' ',__($custom_fields['selected_payment_gateway'])) : '';
                                        @endphp
                                        {{$selected_payment_gateway}}
                                    </small>
                                    <small class="d-block"><strong>{{__('Booking Status:')}}</strong>
                                        @if($data->status == 'pending')
                                            <span class="alert alert-warning text-capitalize alert-sm alert-small" style="display: inline-block">{{__($data->status)}}</span>
                                        @elseif($data->status == 'cancel')
                                            <span class="alert alert-danger text-capitalize alert-sm alert-small" style="display: inline-block">{{__($data->status)}}</span>
                                        @else
                                            <span class="alert alert-success text-capitalize alert-sm alert-small" style="display: inline-block">{{__($data->status)}}</span>
                                        @endif
                                    </small>
                                    <small class="d-block"><strong>{{__('Date:')}}</strong> {{date_format($data->created_at,'d M Y')}}</small>
                                    @if(!empty($data->event) && $data->payment_status == 'complete')
                                        <form action="{{route('frontend.event.invoice.generate')}}"  method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="{{$data->id}}">
                                            <button class="btn btn-secondary" type="submit">{{__('Invoice')}}</button>
                                        </form>
                                        <form action="{{route('user.dashboard.event.ticket.generate')}}"  method="post">
                                            @csrf
                                            <input type="hidden" name="id" value="{{$data->id}}">
                                            <button class="btn btn-primary margin-top-20" type="submit">{{__('Ticket')}}</button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($data->payment_status == 'pending' && $data->status != 'cancel')
                                    <span class="alert alert-warning text-capitalize alert-sm" style="display: inline-block">{{$data->payment_status}}</span>
                                    <a href="{{route('frontend.event.booking.confirm',$data->id)}}" class="btn-boxed btn-small">{{__('Pay Now')}}</a>
                                    <form action="{{route('user.dashboard.event.order.cancel')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                        <button type="submit" class="small-btn btn-danger margin-top-10">{{__('Cancel')}}</button>
                                    </form>
                                @else
                                    <span class="alert alert-success text-capitalize alert-sm" style="display: inline-block">{{$data->payment_status}}</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                {{ $event_attendances->links() }}
            </div>
        @else
            <div class="alert alert-warning">{{__('No Event Found')}}</div>
        @endif
    @endif
@endsection