@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('donations_module_status')))
        @if(count($donation) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">{{get_static_option('donation_page_'.$user_select_lang_slug.'_name')}} {{__('Info')}}</th>
                        <th scope="col">{{__('Payment Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($donation as $data)
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        @if(!empty($data->donation))
                                            <a href="{{route('frontend.donations.single',$data->donation->slug)}}">{{$data->donation->title}}</a>
                                        @else
                                            <div class="text-warning">{{__('This item is not available or removed')}}</div>
                                        @endif
                                    </h5>
                                    <small class="d-block"><strong>{{get_static_option('donation_page_'.$user_select_lang_slug.'_name')}} {{__('ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Amount:')}}</strong> {{amount_with_currency_symbol($data->amount)}}</small>
                                    <small class="d-block"><strong>{{__('Payment Gateway:')}}</strong> {{str_replace('_',' ',__($data->payment_gateway))}}</small>
                                    <small class="d-block"><strong>{{__('Date:')}}</strong> {{date_format($data->created_at,'d M Y')}}</small>
                                    @if(!empty($data->donation) && $data->status == 'complete')
                                        <form action="{{route('frontend.donation.invoice.generate')}}"  method="post">
                                            @csrf
                                            <input type="hidden" name="id" id="invoice_generate_order_field" value="{{$data->id}}">
                                            <button class="btn btn-secondary btn-small" type="submit">{{__('Invoice')}}</button>
                                        </form>
                                    @endif

                                    @if(!empty($data->manual_payment_attachment))
                                        <a class="btn btn-warning mt-2 btn-xs mb-3" href="{{url('assets/uploads/attachment/'.$data->manual_payment_attachment) ?? ''}}" target="_blank">
                                            {{__('View Bank Attachment')}}
                                        </a>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($data->status == 'pending')
                                    <span class="alert alert-warning text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                    @if( $data->payment_gateway != 'manual_payment')
                                        <form action="{{route('frontend.donations.log.store')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="order_id" value="{{$data->id}}" >
                                            <input type="hidden" name="donation_id" value="{{$data->donation_id}}" >
                                            <input type="hidden" name="amount" value="{{$data->amount}}">
                                            <input type="hidden" name="name" value="{{$data->name}}" >
                                            <input type="hidden" name="email" value="{{$data->email}}" >
                                            <input type="hidden" name="selected_payment_gateway" value="{{$data->payment_gateway}}">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20">{{__('Pay Now')}}</button>
                                        </form>
                                    @endif
                                    <form action="{{route('user.dashboard.donation.order.cancel')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                        <button type="submit" class="small-btn btn-danger margin-top-10">{{__('Cancel')}}</button>
                                    </form>
                                @elseif($data->status == 'cancel')
                                    <span class="alert alert-danger text-capitalize alert-sm alert-small" style="display: inline-block">{{__($data->status)}}</span>
                                @else
                                    <span class="alert alert-success text-capitalize alert-sm alert-small" style="display: inline-block">{{__($data->status)}}</span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        <div class="blog-pagination">
            {{ $donation->links() }}
        </div>
        @else
            <div class="alert alert-warning">{{__('No Donation Found')}}</div>
        @endif
    @endif
@endsection