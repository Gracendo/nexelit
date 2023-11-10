@extends('frontend.frontend-page-master')

@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.donations.single',$donation->slug)}}" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{$donation->title}}" />
    {!! render_og_meta_image_by_attachment_id($donation->image) !!}
@endsection
@section('site-title')
    {{$donation->title}}
@endsection
@section('page-title')
    {{$donation->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$donation->meta_tags}}">
    <meta name="tags" content="{{$donation->meta_description}}">
@endsection
@section('content')
    <section class="blog-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="contribute-single-item">
                        <div class="thumb">
                            {!! render_image_markup_by_attachment_id($donation->image,'','large') !!}
                            <div class="thumb-content">
                                <div class="progress-item">
                                    <div class="single-progressbar">
                                        <div class="donation-progress" data-percent="{{get_percentage($donation->amount,$donation->raised)}}"></div>
                                    </div>
                                </div>
                                <div class="goal">
                                    <h4 class="raised">{{get_static_option('donation_raised_'.$user_select_lang_slug.'_text')}} {{amount_with_currency_symbol($donation->raised ? $donation->raised : 0 )}}</h4>
                                    <h4 class="raised">{{get_static_option('donation_goal_'.$user_select_lang_slug.'_text')}} {{amount_with_currency_symbol($donation->amount)}}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <div class="donation-goal">

                            </div>
                            <div class="details-content-area">
                                {!! $donation->donation_content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        <div class="donation_wrapper">
                            <h3 class="title">{{get_static_option('donation_single_'.$user_select_lang_slug.'_form_title')}}</h3>
                            <div class="single_amount_wrapper">
                                @php
                                    $custom_amounts  =  get_static_option('donation_custom_amount');
                                    $custom_amounts = !empty($custom_amounts) ? explode(',',$custom_amounts) : [50,100,150,200];
                                @endphp
                                @foreach($custom_amounts as $amount)
                                    <div class="single_amount" data-value="{{trim($amount)}}">{{amount_with_currency_symbol($amount)}}</div>
                                @endforeach
                            </div>
                            @if($errors->any())
                                <ul class="alert alert-danger">
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            @endif
                            <form action="{{route('frontend.donations.log.store')}}" method="post" enctype="multipart/form-data" class="donation-form-wrapper">
                                @csrf
                                 <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                <div class="amount_wrapper">
                                    <div class="suffix">{{site_currency_symbol()}}</div>
                                    <input type="hidden" name="donation_id" value="{{$donation->id}}" >
                                    <input type="number" name="amount" value="{{trim(get_static_option('donation_default_amount'))}}" step="1" min="1">
                                </div>
                                <div class="form-group">
                                    <div class="label">{{__('Name')}}</div>
                                    <input type="text" name="name" placeholder="{{__('Name')}}" @if(auth()->guard('web')->check()) value="{{auth()->guard('web')->user()->name}}"  @endif class="form-control">
                                </div>
                                <div class="form-group">
                                    <div class="label">{{__('Email')}}</div>
                                    <input type="email" name="email" placeholder="{{__('Email')}}" @if(auth()->guard('web')->check()) value="{{auth()->guard('web')->user()->email}}" @endif class="form-control">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" name="anonymous" class="form-check-input" id="anonymous">
                                    <label class="form-check-label" for="anonymous">{{__('Donate Anonymously')}}</label>
                                </div>
                                {!! render_payment_gateway_for_form() !!}
                                @if(!empty(get_static_option('manual_payment_gateway')))
                                    <div class="form-group manual_payment_transaction_field" @if( get_static_option('site_default_payment_gateway') === 'manual_payment') style="display: block;"@endif>
                                        <div class="label mb-2">{{__('Attach your bank Document')}}</div>
                                        <input class="form-control btn btn-primary btn-sm pb-5 mb-3" type="file" name="manual_payment_attachment"><br>
                                        <span class="help-info mt-3">{!! get_manual_payment_description() !!}</span>
                                    </div>
                                @endif

                                <button class="donation-btn btn-boxed style-01" type="submit">{{get_static_option('donation_single_'.$user_select_lang_slug.'_form_button_text')}}</button>
                            </form>
                        </div>
                        <div class="all-donor-list">
                            <h4 class="title">{{get_static_option('donation_single_'.$user_select_lang_slug.'_recent_donation_text')}}</h4>
                            @if(count($all_donations) > 0)
                            <ul>
                                @foreach($all_donations as $data)
                                <li class="single-donor">
                                    <div class="icon">
                                        <i class="fas fa-heart"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="dtitle">
                                            @if($data->anonymous == 1)
                                                {{__('anonymous')}}
                                             @else
                                            {{$data->name}}
                                            @endif
                                        </h4>
                                        <div class="bottom-part">
                                            <div class="amount">{{amount_with_currency_symbol($data->amount)}}</div>
                                            <div class="time">{{date_format($data->created_at,'d M y h:i:s')}}</div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @else
                                <span class="alert alert-warning">{{__('no donation found')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
            /*------------------------------
                donate activation
            -------------------------------*/

            $(document).on('click', '.donation_wrapper .single_amount', function(e) {
                e.preventDefault();
                $('input[name="amount"]').val($(this).data('value'));
            });

            var defaulGateway = $('#site_global_payment_gateway').val();
            $('.payment-gateway-wrapper ul li[data-gateway="'+defaulGateway+'"]').addClass('selected');

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                if(gateway == 'manual_payment'){
                    $('.manual_payment_transaction_field').show();
                }else{
                    $('.manual_payment_transaction_field').hide();
                }
                $(this).addClass('selected').siblings().removeClass('selected');
                $('.payment-gateway-wrapper').find(('input')).val(gateway);
            });

        })(jQuery);
    </script>
@endsection
