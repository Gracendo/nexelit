@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(count($package_orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">{{__('Package Order Info')}}</th>
                    <th scope="col">{{__('Payment Status')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package_orders as $data)
                    <tr>
                        <td>
                            <div class="user-dahsboard-order-info-wrap">
                                <h5 class="title">{{$data->package_name}}</h5>
                                <div class="div">
                                    <small class="d-block"><strong>{{__('Order ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Package Price:')}}</strong> {{amount_with_currency_symbol($data->package_price)}}</small>
                                    <small class="d-block"><strong>{{__('Order Status:')}}</strong>
                                        @if($data->status == 'pending')
                                            <span class="alert alert-warning text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                        @elseif($data->status == 'cancel')
                                            <span class="alert alert-danger text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                        @elseif($data->status == 'in_progress')
                                            <span class="alert alert-info text-capitalize alert-sm alert-small">{{str_replace('_',' ',__($data->status))}}</span>
                                        @else
                                            <span class="alert alert-success text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                        @endif
                                    </small>

                                    <small class="d-block"><strong>{{__('Date:')}}</strong> {{date_format($data->created_at,'D m Y')}}</small>
                                    @if($data->payment_status == 'complete')
                                        <form action="{{route('frontend.package.invoice.generate')}}"  method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="{{$data->id}}">
                                            <button class="btn btn-secondary btn-xs btn-small margin-top-10" type="submit">{{__('Invoice')}}</button>
                                        </form>
                                    @endif

                                    @if(!empty(optional($data->paymentLog)->manual_payment_attachment))
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="{{url('assets/uploads/attachment/'.optional($data->paymentLog)->manual_payment_attachment) ?? ''}}" target="_blank">
                                            {{__('View Bank Attachment')}}
                                        </a>
                                    @endif

                                </div>
                            </div>
                        </td>
                        <td>
                            @if($data->payment_status == 'pending' && $data->status != 'cancel')
                                <span class="alert alert-warning text-capitalize alert-sm">{{$data->payment_status}}</span>
                                <a href="{{route('frontend.order.confirm',$data->id)}}" class="small-btn btn-boxed">{{__('Pay Now')}}</a>
                                <form action="{{route('user.dashboard.package.order.cancel')}}" method="post">
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
            {{ $package_orders->links() }}
        </div>
    @else
        <div class="alert alert-warning">{{__('No Order Found')}}</div>
    @endif
@endsection