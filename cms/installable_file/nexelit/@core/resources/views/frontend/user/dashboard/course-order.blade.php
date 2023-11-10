@extends('frontend.user.dashboard.user-master')
@section('section')
    @if(!empty(get_static_option('course_module_status')))
        @if(count($all_enrolls) > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"> {{__('Enroll Info')}}</th>
                        <th scope="col">{{__('Enroll & Payment Status')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($all_enrolls as $data)
                        <tr>
                            <td scope="row">
                                <div class="user-dahsboard-order-info-wrap">
                                    <h5 class="title">
                                        @if(!empty($data->course))
                                            <a href="{{route('frontend.course.single',[optional(optional($data->course)->lang_front)->slug,optional($data->course)->id])}}">{{optional(optional($data->course)->lang_front)->title}}</a>
                                        @else
                                            <div class="text-warning">{{__('This item is not available or removed')}}</div>
                                        @endif
                                    </h5>
                                    <small class="d-block"><strong> {{__('Enroll ID:')}}</strong> #{{$data->id}}</small>
                                    <small class="d-block"><strong>{{__('Amount:')}}</strong>
                                        {{amount_with_currency_symbol(course_discounted_amount($data->total,$data->coupon))}}
                                        @if(!empty($data->coupon))
                                            <del> {{amount_with_currency_symbol($data->total)}}</del>
                                        @endif
                                    </small>
                                    <small class="d-block"><strong>{{__('Payment Gateway:')}}</strong> {{str_replace('_',' ',__($data->payment_gateway))}}</small>
                                    <small class="d-block"><strong>{{__('Enroll Status:')}}</strong> {{$data->status}}</small>

                                    @if(!empty($data->coupon))
                                        <small class="d-block"><strong>{{__('Coupon:')}}</strong> {{$data->coupon}}</small>
                                    @endif
                                    @if(!empty($data->coupon))
                                        <small class="d-block"><strong>{{__('Discount:')}}</strong> {{amount_with_currency_symbol($data->coupon_discounted)}}</small>
                                    @endif
                                    @if($data->payment_status === 'complete')
                                    <small class="d-block"><strong>{{__('Transaction Id:')}}</strong> {{$data->transaction_id}}</small>
                                    @endif
                                    <small class="d-block"><strong>{{__('Date:')}}</strong> {{date_format($data->created_at,'d M Y')}}</small>
                                </div>
                            </td>
                            <td>
                                @if($data->status == 'pending')
                                    <span class="alert alert-warning text-capitalize alert-sm alert-small">{{__($data->status)}}</span>
                                    @if( $data->payment_gateway != 'manual_payment')
                                        <form action="{{route('frontend.course.enroll.submit')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="enroll_id" value="{{$data->id}}" >
                                            <input type="hidden" name="name" value="{{$data->name}}" >
                                            <input type="hidden" name="email" value="{{$data->email}}" >
                                            <input type="hidden" name="course_id" value="{{$data->course_id}}">
                                            <input type="hidden" name="selected_payment_gateway" value="{{$data->payment_gateway}}">
                                            <button type="submit" class="small-btn btn-boxed margin-top-20">{{__('Pay Now')}}</button>
                                        </form>
                                    @endif
                                    <form action="{{route('user.dashboard.course.order.cancel')}}" method="post">
                                        @csrf
                                        <input type="hidden" name="order_id" value="{{$data->id}}">
                                        <button type="submit" class="small-btn btn-danger margin-top-10 ">{{__('Cancel')}}</button>
                                    </form>
                                @elseif($data->status == 'cancel')
                                    <span class="alert alert-danger text-capitalize alert-sm alert-small d-inline-block">{{__($data->status)}}</span>
                                @else
                                    <span class="alert alert-success text-capitalize alert-sm alert-small d-inline-block">{{__($data->status)}}</span>
                                    <br>
                                    <a href="{{route('frontend.course.lesson.start',[$data->course_id,$data->id])}}" class="btn-success btn">{{__('Start Learning')}}</a>

                                    @if(!is_null($data->certificate))
                                        @if(optional($data->certificate)->status === 0)
                                        <a class="btn btn-warning margin-top-10">{{__('Waiting For Approval')}}</a>
                                        @else
                                        <a href="{{route('user.dashboard.course.certificate.download',optional($data->certificate)->id)}}" class="btn btn-info  margin-top-10">{{__('Download Certificate')}}</a>
                                        @endif
                                    @else
                                        <form action="{{route('user.dashboard.course.certificate')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="course_id" value="{{$data->course_id}}">
                                            <button type="submit" class="small-btn btn-info margin-top-10 ">{{__('Request For Certificate')}}</button>
                                        </form>
                                    @endif

                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="blog-pagination">
                {{ $all_enrolls->links() }}
            </div>
        @else
            <div class="alert alert-warning">{{__('Nothing Found')}}</div>
        @endif
    @endif
@endsection