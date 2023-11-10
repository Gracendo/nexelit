@extends('frontend.frontend-page-master')
@php
  $post_img = null;
  $blog_image = get_attachment_image_by_id($item->image,"full",false);
  $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
 @endphp

@section('og-meta')
    <meta property="og:url"  content="{{route('frontend.appointment.single',[optional($item->lang_front)->slug ?? __('untitled'),$item->id])}}" />
    <meta property="og:type"  content="article" />
    <meta property="og:title"  content="{{optional($item->lang_front)->title}}" />
    <meta property="og:image" content="{{$post_img}}" />
@endsection
@section('page-meta-data')
    <meta name="description" content="{{optional($item->lang_front)->meta_description}}">
    <meta name="tags" content="{{optional($item->lang_front)->meta_tag}}">
@endsection
@section('site-title')
    {{optional($item->lang_front)->title}}
@endsection
@section('page-title')
    {{optional($item->lang_front)->title}}
@endsection
@section('content')
    <section class="blog-details-content-area padding-top-100 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="appointment-details-item">
                       <div class="top-part">
                           <div class="thumb">
                               {!! render_image_markup_by_attachment_id($item->image,'full') !!}
                           </div>
                           <div class="content">
                               @if(optional($item->lang_front)->designation)
                               <span class="designation">{{optional($item->lang_front)->designation}}</span>
                               @endif
                               <h2 class="title">{{optional($item->lang_front)->title}}</h2>
                               <div class="short-description">{!! optional($item->lang_front)->short_description	 !!}</div>
                               @if(optional($item->lang_front)->location)
                               <div class="location"><i class="fas fa-map-marked-alt"></i>  {{optional($item->lang_front)->location}}</div>
                               @endif
                               <div class="price-wrap">
                                   <h4 class="price">{{__('Fee')}}: <span>{{amount_with_currency_symbol($item->price)}}</span></h4>
                               </div>
                               <div class="social-share-wrap">
                                   <ul class="social-share">
                                       {!! single_post_share(route('frontend.appointment.single',[optional($item->lang_front)->slug ?? __('untitled'),$item->id]),optional($item->lang_front)->title,get_attachment_url_by_id($item->image,'full')) !!}
                                   </ul>
                               </div>
                           </div>
                       </div>
                        <div class="bottom-part">
                            <x-error-msg/>
                            <x-flash-msg/>
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    <a class="nav-link "  data-toggle="tab" href="#nav-information" role="tab"  aria-selected="false">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_information_tab_title')}}</a>
                                    <a class="nav-link active"  data-toggle="tab" href="#nav-booking" role="tab"  aria-selected="true">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_booking_tab_title')}}</a>
                                    <a class="nav-link"  data-toggle="tab" href="#nav-feedback" role="tab"  aria-selected="false">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_feedback_tab_title')}}</a>
                                </div>
                            </nav>
                            <div class="tab-content" >
                                <div class="tab-pane fade" id="nav-information" role="tabpanel" >
                                    <div class="information-area-wrap">
                                        <div class="description-wrap">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_about_me_title')}}</h3>
                                            {!! optional($item->lang_front)->description !!}
                                        </div>
                                        @if(!empty(current(optional($item->lang_front)->experience_info)))
                                        <div class="education-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_educational_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach(optional($item->lang_front)->experience_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if(!empty(current(optional($item->lang_front)->additional_info)))
                                        <div class="additional-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_additional_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach(optional($item->lang_front)->additional_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                        @if(!empty(current(optional($item->lang_front)->specialized_info)))
                                        <div class="specialised-info">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_specialize_info_title')}}</h3>
                                            <ul class="circle-list">
                                                @foreach(optional($item->lang_front)->specialized_info as $info)
                                                    <li>{{$info}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade show active" id="nav-booking" role="tabpanel" >
                                    @if($item->appointment_status === 'yes')
                                    <div class="booking-wrap">
                                        <div class="left-part">
                                            <div class="date-time-block">
                                                <h4 class="title">{{__('Available On')}} <time>{{date('F Y')}}</time></h4>
                                                <ul class="time-slot date">
                                                    <li data-date="{{date('d-m-Y')}}">{{date('d/m/Y')}}</li>
                                                    @for($i=1; $i <10; $i++)
                                                        <li data-date="{{date('d-m-Y',strtotime("+".$i." day"))}}">{{date('d/m/Y',strtotime("+".$i." day"))}}</li>
                                                    @endfor
                                                </ul>
                                            </div>
                                            <div class="date-time-block">
                                                <h4 class="title">{{__('Availability On')}} <time class="time_slog_date">{{date('D, d F, Y')}}</time></h4>
                                                <p class="alert alert-warning " id="time_slot_warning">{{__('select date first')}}</p>
                                                <ul class="time-slot time" id="time_slot_wrapper">
                                                    {{-- @foreach($item->booking_time_ids as $time)
                                                        <li data-id="{{$time['id']}}">{{$time['time']}}</li>
                                                    @endforeach  --}}
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="right-part">
                                            <div class="form-wrapper">

                                                <div class="billing-details-wrapper">
                                                    <div class="order-tab-wrap">
                                                        <nav>
                                                            <div class="nav nav-tabs" role="tablist">
                                                                @if(!auth()->guard('web')->check())
                                                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"  aria-selected="true"><i class="fas fa-user"></i></a>
                                                                @endif
                                                                <a class="nav-item nav-link  @if(auth()->check()) active @else disabled @endif" disabled id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><i class="fas fa-address-book"></i></a>
                                                            </div>
                                                        </nav>
                                                        <div class="tab-content" >
                                                            @if(!auth()->guard('web')->check())
                                                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel">
                                                                    @if(get_static_option('disable_guest_mode_for_appointment_module'))
                                                                    <div class="checkout-type margin-bottom-30  @if(auth()->guard('web')->check()) d-none @endif ">
                                                                        <div class="custom-control custom-switch">
                                                                            <input type="checkbox" class="custom-control-input" id="guest_logout" name="checkout_type">
                                                                            <label class="custom-control-label" for="guest_logout">{{__('Guest Order')}}</label>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    @if(!auth()->guard('web')->check())
                                                                        @include('frontend.partials.ajax-login-form')
                                                                    @else
                                                                        <div class="alert alert-success">
                                                                            {{__('Your Are Logged In As')}} {{auth()->guard('web')->user()->name}}
                                                                        </div>
                                                                    @endif
                                                                    @if(!auth()->guard('web')->check())
                                                                        <div class="next-step">
                                                                            <button class="next-step-btn btn-boxed" style="display: none" type="button">{{__('Next Step')}}</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                            <div class="tab-pane fade @if(auth()->guard('web')->check()) show active @endif" id="nav-profile" role="tabpanel">

                                                                <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_information_text')}}</h3>
                                                                <form action="{{route('frontend.appointment.booking')}}" method="post" class="appointment-booking-form" id="appointment-booking-form" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <div class="error-message"></div>
                                                                    <input type="hidden" name="booking_date">
                                                                    <input type="hidden" name="booking_time_id">
                                                                    <input type="hidden" name="appointment_id" value="{{$item->id}}">
                                                                    <div class="form-group">
                                                                        <input type="text" name="name" class="form-control" placeholder="{{__('Name')}}" value="{{auth()->guard('web')->check() ? auth()->guard('web')->user()->name : ''}}">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type="email" name="email" class="form-control" placeholder="{{__('Email')}}" value="{{auth()->guard('web')->check() ? auth()->guard('web')->user()->email : ''}}">
                                                                    </div>
                                                                    {!! render_form_field_for_frontend(get_static_option('appointment_booking_page_form_fields')) !!}

                                                                    @if(!empty($item->price))
                                                                        {!! render_payment_gateway_for_form(false) !!}
                                                                        @if(!empty(get_static_option('manual_payment_gateway')))
                                                                            <div class="form-group manual_payment_transaction_field" @if( get_static_option('site_default_payment_gateway') === 'manual_payment') style="display: block;"@endif >
                                                                                <div class="label mb-2">{{__('Attach your bank Document')}}</div>
                                                                                <input class="form-control btn btn-primary btn-sm pb-2 pt-2" type="file" name="manual_payment_attachment">
                                                                                <span class="help-info mt-2">{!! get_manual_payment_description() !!}</span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                    <div class="button-wrap">
                                                                        <button type="submit" class="btn-boxed appointment appo_booking_btn">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_button_text')}} <i class="fas fa-spinner fa-spin d-none"></i></button>
                                                                    </div>
                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                    @else
                                       <div class="alert alert-warning"> {{__('Not Available')}}</div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="nav-feedback" role="tabpanel" >
                                    <div class="feedback-wrapper">
                                        @if(auth()->guard('web')->check())
                                        <div class="feedback-form-wrapper">
                                            <h3 class="title">{{__('Leave your feedback')}}</h3>
                                            <form action="{{route('frontend.appointment.review')}}" method="post" class="appointment-booking-form" id="appointment_rating_form">
                                                @csrf
                                                <div class="error-message"></div>
                                                <input type="hidden" name="appointment_id" value="{{$item->id}}">
                                                <div class="form-group">
                                                    <label for="rating-empty-clearable2">{{__('Ratings')}}</label>
                                                    <input type="number" name="ratings"
                                                           id="rating-empty-clearable2"
                                                           class="rating text-warning"/>
                                                </div>
                                                <div class="form-group">
                                                    <label for="">{{__('Message')}}</label>
                                                    <textarea name="message" cols="30" class="form-control" rows="5"></textarea>
                                                </div>
                                                <button type="submit" class="btn-boxed appointment" id="appointment_ratings">{{__('Submit')}}  <i class="fas fa-spinner fa-spin d-none"></i></button>
                                            </form>
                                        </div>
                                        @else
                                            @include('frontend.partials.ajax-login-form')
                                        @endif
                                        @if(count($item->reviews) > 0)
                                        <div class="feedback-comment-list-wrap margin-top-40">
                                            <h3 class="title">{{get_static_option('appointment_single_'.$user_select_lang_slug.'_appointment_booking_client_feedback_title')}}</h3>
                                            <ul class="feedback-list">
                                                @foreach($item->reviews as $data)
                                                <li class="single-feedback-item">
                                                    <div class="content">
                                                        <h4 class="title">{{$data->user ? optional($data->user)->username : __("Anonymous")}}</h4>
                                                        <div class="rating-wrap single">
                                                           @for( $i =1; $i <= $data->ratings; $i++ )
                                                               <i class="fas fa-star"></i>
                                                           @endfor
                                                        </div>
                                                        <div class="description">{{$data->message}}</div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap4-rating-input.js')}}"></script>
    @include('frontend.partials.ajax-login-form-js')
    <script>
        (function ($){
            "use strict";

            $(document).on('change','#guest_logout',function (e) {
                e.preventDefault();
                var infoTab = $('#nav-profile-tab');
                var nextBtn = $('.next-step-btn');
                if($(this).is(':checked')){
                    $('.booking-wrap .login-form').hide();
                    infoTab.attr('disabled',false).removeClass('disabled');
                    nextBtn.show();

                }else{
                    $('.login-form').show();
                    infoTab.attr('disabled',true).addClass('disabled');
                    nextBtn.hide();
                }
            });
            $(document).on('click','.next-step-btn',function(e){
                var infoTab = $('#nav-profile-tab');
                infoTab.attr('disabled',false).removeClass('disabled').addClass('active').siblings().removeClass('active');
                $('#nav-profile').addClass('show active').siblings().removeClass('show active');
            });

            $(document).on('click','.payment-gateway-wrapper > ul > li',function (e) {
                e.preventDefault();
                var gateway = $(this).data('gateway');
                var manual_gateway_tr = $('.manual_payment_transaction_field');
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="selected_payment_gateway"]').val(gateway);
                if(gateway === 'manual_payment'){
                    manual_gateway_tr.show();
                }else{
                    manual_gateway_tr.hide();
                }
            });

            $(document).on('click','.time-slot.date li',function (e){
                e.preventDefault();

                var date = $(this).data('date');
                date = date.split('-');
                var showDate = new Date(date[2]+'-'+ date[1]+'-'+date[0]);
                $('.time_slog_date').text(showDate.toDateString());
                $(this).toggleClass('selected').siblings().removeClass('selected');
                $('input[name="booking_date"]').val($(this).data('date'));
                //frontend.appointment.booking.time.check
                $('#time_slot_warning').show();
                $('#time_slot_warning').text('Loading Available Times..');
                $('#time_slot_wrapper').html('');

                $.ajax({
                    url: "{{route('frontend.appointment.booking.time.check')}}",
                    type: 'post',
                    data: {
                        _token: '{{csrf_token()}}',
                        date : $(this).data('date'),
                        appointment_id : '{{$item->id}}'
                    },
                    success: function(data){
                        console.log(data);
                       
                        $.each(data.available_booking_time,function(index,value){
                            if(value != false){
                                $('#time_slot_wrapper').append('<li data-id="'+value.id+'">'+value.time+'</li>');
                                $('#time_slot_warning').hide();
                            }else {
                                $('#time_slot_warning').text('no booking time available this date');
                                $('#time_slot_warning').show();
                            }
                        });
                        //append time slot for the current selected item
                    }
                });
            });

            $(document).on('click','.time-slot.time li',function (e){
                e.preventDefault();
                $(this).addClass('selected').siblings().removeClass('selected');
                $('input[name="booking_time_id"]').val($(this).data('id'));
            });


            $(document).on('click', '#appointment_ratings', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('appointment_rating_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.appointment.review')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#appointment_ratings').children('i').removeClass('d-none');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        $('#appointment_ratings').children('i').addClass('d-none');
                        errMsgContainer.html('');
                        errMsgContainer.append('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');

                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_rating_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#appointment_ratings').children('i').addClass('d-none');
                    }
                });
            });

            //appo_booking_btn
        })(jQuery);
    </script>
@endsection
