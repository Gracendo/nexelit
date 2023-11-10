@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:')}} {{$order_details->package_name}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80">
                        <h1 class="title">{{get_static_option('site_order_success_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p>{{get_static_option('site_order_success_page_' . $user_select_lang_slug . '_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title">{{__('Billing Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Order ID')}}</strong> #{{$order_details->id}}</li>
                        <li><strong>{{__('Name')}}</strong> {{$payment_details->name}}</li>
                        <li><strong>{{__('Email')}}</strong> {{$payment_details->email}}</li>
                        <li><strong>{{__('Payment Method')}}</strong> {{str_replace('_',' ',$payment_details->package_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}</strong> {{$payment_details->status}}</li>
                        <li><strong>{{__('Transaction id')}}</strong> {{$payment_details->transaction_id}}</li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        @if(auth()->guard('web')->check())
                            <a href="{{route('user.home')}}" class="boxed-btn">{{__('Go To Dashboard')}}</a>
                        @else
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="price-plan-wrap">
                        <div class="single-price-plan-01 style-02 active">
                            <div class="price-header">
                                <div class="name-box">
                                    <h4 class="name">{{$package_details->title}}</h4>
                                </div>
                                <div class="price-wrap">
                                    <span class="price">{{amount_with_currency_symbol($package_details->price)}}</span><span class="month">{{$package_details->type}}</span>
                                </div>
                            </div>
                            <div class="price-body">
                                <ul>
                                    @php
                                        $features = explode("\n",$package_details->features);
                                    @endphp
                                    @foreach($features as $item)
                                        <li>{{$item}}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="btn-wrapper text-center">
                                @if(!empty($package_details->url_status))
                                    <a class="order-btn boxed-btn" href="{{route('frontend.plan.order',$package_details->id)}}">{{$package_details->btn_text}}</a>
                                @else
                                    <a class="order-btn boxed-btn" href="{{$package_details->btn_url}}">{{$package_details->btn_text}}</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
