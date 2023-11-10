@extends('frontend.frontend-page-master')
@section('page-title')
    {{__('Payment Success For:'.' '.$donation_logs->donation->title)}}
@endsection
@section('content')
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <h1 class="title">{{get_static_option('donation_success_page_' . $user_select_lang_slug . '_title')}}</h1>
                        <p>{{get_static_option('donation_success_page_' . $user_select_lang_slug . '_description')}}</p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title">{{__('Donor Details')}}</h2>
                    <ul class="billing-details">
                        <li><strong>{{__('Donation Log ID')}}:</strong> #{{$donation_logs->id}}</li>
                        <li><strong>{{__('Name')}}:</strong> {{$donation_logs->name}}</li>
                        <li><strong>{{__('Email')}}:</strong> {{$donation_logs->email}}</li>
                        <li><strong>{{__('Payment Method')}}:</strong>  {{str_replace('_',' ',$donation_logs->payment_gateway)}}</li>
                        <li><strong>{{__('Payment Status')}}:</strong> {{$donation_logs->status}}</li>
                        <li><strong>{{__('Transaction id')}}:</strong> {{$donation_logs->transaction_id}}</li>
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
                    <div class="donation-wrap donation-success-page">
                        <div class="contribute-single-item">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($donation->image,'','grid') !!}
                                <div class="thumb-content">
                                    <div class="progress-item">
                                        <div class="single-progressbar">
                                            <div class="donation-progress" data-percent="{{get_percentage($donation->amount,$donation->raised)}}"></div>
                                        </div>
                                    </div>
                                    <div class="goal">
                                        <h4 class="raised">{{get_static_option('donation_raised_'.$user_select_lang_slug.'_text')}} @if(!empty($donation->raised)){{amount_with_currency_symbol($donation->raised)}}@else {{amount_with_currency_symbol(0)}} @endif</h4>
                                        <h4 class="raised">{{get_static_option('donation_goal_'.$user_select_lang_slug.'_text')}} {{amount_with_currency_symbol($donation->amount)}}</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <a href="{{route('frontend.donations.single',$donation->slug)}}"><h4 class="title">{{$donation->title}}</h4></a>
                                <p>{{strip_tags(Str::words(strip_tags($donation->donation_content),20))}}</p>
                                <div class="btn-wrapper">
                                    <a href="{{route('frontend.donations.single',$donation->slug)}}" class="boxed-btn">{{get_static_option('donation_button_'.$user_select_lang_slug.'_text')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{asset('assets/frontend/js/jQuery.rProgressbar.min.js')}}"></script>
    <script>
        (function($) {
            'use strict';
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "{{get_static_option('site_color')}}"
                });
            })
        })(jQuery);
    </script>
@endsection
