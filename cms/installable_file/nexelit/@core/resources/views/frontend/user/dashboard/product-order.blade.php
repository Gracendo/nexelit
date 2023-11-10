@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('product_module_status')))
        @if(count($product_orders) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}}  {{__('Order Info')}}</th>
                        <th scope="col">{{__('Payment Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product_orders as $data)
                        <tr>
                            <th scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <small class="d-block"><strong>{{__('Order ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Total Amount:')}}</strong>{{amount_with_currency_symbol($data->total)}}</small>
                                    <small class="d-block"><strong>{{__('Payment Gateway:')}}</strong>{{ucwords(str_replace('_',' ',$data->payment_gateway))}}</small>
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
                                    <small class="d-block"><strong>{{__('Order Date:')}}</strong> {{date_format($data->created_at,'d M Y')}}</small>
                                    @if($data->payment_status == 'complete')
                                        <form action="{{route('frontend.product.invoice.generate')}}"  method="post">
                                            @csrf
                                            <input type="hidden" name="order_id" id="invoice_generate_order_field" value="{{$data->id}}">
                                            <button class="btn btn-secondary btn-small" type="submit">{{__('Invoice')}}</button>
                                        </form>
                                    @endif

                                    @if(!empty($data->manual_payment_attachment))
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="{{url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''}}" target="_blank">
                                            {{__('View Bank Attachment')}}
                                        </a>
                                    @endif
                                </div>
                            </th>
                            <td>
                                @if($data->payment_status == 'pending' && $data->status != 'cancel')
                                    <span class="alert alert-warning text-capitalize alert-sm margin-bottom-20">{{$data->payment_status}}</span>
                                    @if( $data->payment_gateway != 'cash_on_delivery' &&  $data->payment_gateway != 'manual_payment')
                                        <form action="{{route('frontend.products.checkout')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$data->id}}">
                                            <input type="hidden" name="selected_payment_gateway" value="{{$data->payment_gateway}}">
                                            <input type="hidden" name="subtotal" value="{{$data->subtotal}}">
                                            <input type="hidden" name="total" value="{{$data->total}}">
                                            <input type="hidden" name="billing_name" value="{{$data->billing_name}}">
                                            <input type="hidden" name="billing_email" value="{{$data->billing_email}}">
                                            <input type="hidden" name="billing_phone" value="{{$data->billing_phone}}">
                                            <input type="hidden" name="billing_country" value="{{$data->billing_country}}">
                                            <input type="hidden" name="billing_street_address" value="{{$data->billing_street_address}}">
                                            <input type="hidden" name="billing_town" value="{{$data->billing_town}}">
                                            <input type="hidden" name="billing_district" value="{{$data->billing_district}}">
                                            <input type="hidden" name="billing_district" value="{{$data->billing_district}}">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20">{{__('Pay Now')}}</button>
                                        </form>
                                    @endif
                                    <form action="{{route('user.dashboard.product.order.cancel')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                        <button type="submit" class="small-btn btn-danger margin-top-10">{{__('Cancel')}}</button>
                                    </form>
                                @else
                                    <span class="alert alert-success text-capitalize alert-sm" style="display: inline-block">{{$data->payment_status}}</span>
                                @endif
                                <a href="{{route('user.dashboard.product.order.view',$data->id)}}" target="_blank" class="small-btn btn-boxed margin-top-20">{{__('View Order')}}</a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                {{ $product_orders->links() }}
            </div>
        @else
            <div class="alert alert-warning">{{__('No Product Order Found')}}</div>
        @endif
    @endif

@endsection