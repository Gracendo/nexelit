@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Cancelled Of:'.' '.$donation_logs->donation->title)}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area">
                        <h1 class="title">{{get_static_option('donation_cancel_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <h3 class="sub-title">
                            @php
                                $subtitle = get_static_option('donation_cancel_page_' . $user_select_lang_slug . '_subtitle');
                                $subtitle = str_replace('{dnname}',$donation_logs->donation->title,$subtitle);
                            @endphp
                            {{$subtitle}}
                        </h3>
                        <p>
                            {{get_static_option('donation_cancel_page_' . $user_select_lang_slug . '_description')}}
                        </p>
                        <div class="btn-wrapper">
                            <a href="{{url('/')}}" class="boxed-btn">{{__('Back To Home')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
