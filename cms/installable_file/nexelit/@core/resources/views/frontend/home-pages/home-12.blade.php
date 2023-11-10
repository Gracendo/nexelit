@include('frontend.partials.homesupportbar')
@php
    $home_page_variant =$home_page ?? get_static_option('home_page_variant');
@endphp
<div class="header-style-03  header-variant-{{$home_page_variant}}">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="{{url('/')}}" class="logo">
                        @if(!empty(filter_static_option_value('site_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_logo',$global_static_field_data)) !!}
                        @else
                            <h2 class="site-title">{{filter_static_option_value('site_'.$user_select_lang_slug.'_title',$global_static_field_data)}}</h2>
                        @endif
                    </a>
                </div>
                <x-product-cart-mobile/>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <div class="nav-right-content">
                <div class="icon-part">
                    <ul>
                        <x-navbar-search/>
                        <x-product-cart/>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="header-slider-wrapper">
        <div class="header-area medical-home"
                {!! render_background_image_markup_by_attachment_id(filter_static_option_value('medical_home_page_header_background_image',$static_field_data)) !!}
        >
            <div class="right-image-wrap">
                {!! render_image_markup_by_attachment_id(filter_static_option_value('medical_home_page_header_right_image',$static_field_data)) !!}
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title">{{filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_title',$static_field_data)}}</h1>
                            <p class="description">{{filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_description',$static_field_data)}}</p>
                        
                            <div class="btn-wrapper margin-top-30">
                                @if(!empty(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data)))
                                <a href="{{filter_static_option_value('medical_home_page_header_button_url',$static_field_data)}}" class="boxed-btn medical">{{ filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data) }}</a>
                                @endif
                                @if(!empty(filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_two_text',$static_field_data)))
                                <a href="{{filter_static_option_value('medical_home_page_header_button_two_url',$static_field_data)}}" class="boxed-btn medical blank">{{ filter_static_option_value('medical_home_page_header_'.$user_select_lang_slug.'_button_two_text',$static_field_data) }}</a>
                                @endif
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-image-shape">
                <img src="{{asset('assets/frontend/img/shape/header-bottom-shape.svg')}}" alt="header bottom image shape">
            </div>
            <div class="shape image-1">
                <img src="{{asset('assets/frontend/img/shape/medical-left-top-shape.png')}}" alt="">
            </div>
            <div class="shape image-2">
                 <img src="{{asset('assets/frontend/img/shape/medical-shape-two.png')}}" alt="">
            </div>
            <div class="shape image-3">
                 <img src="{{asset('assets/frontend/img/shape/medical-shape.png')}}" alt="">
            </div>
        </div>
       
</div>
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
    <div class="medical-about-area padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <span class="subtitle">{{filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                        <div class="description">{!! filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper">
                            @if(!empty(filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)))
                                <a href="{{filter_static_option_value('medical_about_section_button_url',$static_field_data)}}"
                                   class="boxed-btn medical-home">
                                    {{filter_static_option_value('medical_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('medical_about_section_right_image',$static_field_data)) !!}
                        <div class="image-wapper">
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('medical_about_section_right_bottom_image',$static_field_data)) !!}
                            @if(!empty(filter_static_option_value('home_page_13_about_section_video_url',$static_field_data)))
                            <div class="vdo-btn">
                                <a href="{{filter_static_option_value('home_page_13_about_section_video_url',$static_field_data)}}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i> </a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="political-what-we-offer-area padding-top-60 padding-bottom-30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a=0; @endphp
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="political-single-what-we-cover-item  margin-bottom-30">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                                <div class="icon style-{{$a}}">
                                    <i class="{{$data->icon}}"></i>  
                                </div>
                            </div>
                            <div class="content">
                                <h4 class="title">
                                    <a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                </h4>
                                <p>{{$data->excerpt}}</p>
                            </div>
                        </div>
                    </div>
                    @php ($a == 6) ? $a= 1 : $a++; @endphp
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_appointment_section_status',$static_field_data)))
    <div class="const-team-member-area padding-top-60 padding-bottom-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_appointment_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_appointment_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="team-member-carousel-area margin-top-10 ">
                        <div class="industry-member-carousel global-carousel-init logistic-dots lawyer-home"
                             data-loop="true"
                             data-desktopitem="4"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-stagepadding="0"
                             data-margin="30"
                        >
                            @foreach($appointments as $data)
                                <div class="appointment-single-item medical-home">
                                    <div class="thumb"
                                            {!! render_background_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    >
                                        <div class="cat">
                                            <a href="{{route('frontend.appointment.category',['id' => $data->category->id,'any' => Str::slug($data->category->lang_front->title ?? __("Uncategorized"))])}}">{{$data->category->lang_front->title ?? __("Uncategorized")}}</a>
                                        </div>
                                    </div>
                                    <div class="content">
                                        @if(!empty($data->lang_front->designation))
                                            <span class="designation">{{$data->lang_front->designation}}</span>
                                        @endif
                                        @if(count($data->reviews) > 0)
                                            <div class="rating-wrap">
                                                <div class="ratings">
                                                    <span class="hide-rating"></span>
                                                    <span class="show-rating" style="width: {{{get_appointment_ratings_avg_by_id($data->id) / 5 * 100}}}%"></span>
                                                </div>
                                                <p><span class="total-ratings">({{count($data->reviews)}})</span></p>
                                            </div>
                                        @endif
                                        <a href="{{route('frontend.appointment.single',[$data->lang_front->slug ?? __('untitled'),$data->id])}}"><h4 class="title">{{$data->lang_front->title ?? ''}}</h4></a>
                                        @if(!empty($data->lang_front->location))
                                            <span class="location"><i class="fas fa-map-marker-alt"></i>{{$data->lang_front->location ?? ''}}</span>
                                        @endif

                                        <p>{{Str::words(strip_tags($data->lang_front->short_description ?? ''),10)}}</p>
                                        <div class="btn-wrapper">
                                            <a href="{{route('frontend.appointment.single',[$data->lang_front->slug ?? __('untitled'),$data->id])}}" class="boxed-btn">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_booking_button_text')}}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)))
<section class="appointment-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="appointment-inner-area">
                    <div class="left-content-area">
                        <span class="subtitle">{{filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h3 class="title">{{filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h3>
                        <div class="description">{!! filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                        <h5 class="helpline">{{filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_hotline',$static_field_data)}}</h5>
                    </div>
                    <div class="right-content-area">
                        <form action="{{route('frontend.appointment.message')}}" method="post" class="contact-page-form" id="appointment_form" enctype="multipart/form-data">
                            <div class="error-message"></div>
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                            {!! render_form_field_for_frontend(get_static_option('appointment_form_fields')) !!}
                            <div class="btn-wrapper">
                                <button type="submit" class="boxed-btn medical-home" id="submit_appointment_btn">{{filter_static_option_value('medical_cta_area_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="medical-counterup-area medical-section-bg-color padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="medical-home-counterup-item">
                            <div class="icon style-{{$loop->index}}">
                                <i class="{{$data->icon}}"></i>
                            </div>
                           <div class="content">
                               <div class="count-wrap">
                                   <span class="count-num">{{$data->number}}</span>{{$data->extra_text}}
                               </div>
                               <h4 class="title">{{$data->title}}</h4>
                           </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="medical-project-area padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_case_study_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_case_study_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="case-studies-masonry-wrapper global-carousel-init"
             data-loop="true"
             data-desktopitem="4"
             data-mobileitem="1"
             data-tabletitem="2"
             data-nav="false"
             data-dots="true"
             data-autoplay="true"
             data-margin="30"
        >
            @foreach($all_work as $data)
                <div class="const-single-case-study-style-02 medical-home">
                    <div class="thumb">
                        {!! render_image_markup_by_attachment_id($data->image) !!}
                    </div>
                    <div class="cart-icon">
                        <h4 class="title">
                            <a href="{{route('frontend.work.single',$data->slug)}}"> {{$data->title}}</a>
                        </h4>
                        <div class="cat-wrapper">
                            @php
                                $all_cat =  get_work_category_by_id($data->id)
                            @endphp
                            @foreach($all_cat as $catid => $can_name)
                                <a href="{{route('frontend.works.category',['id' => $catid, 'any' => $can_name ? Str::slug($can_name) : ''])}}">{{$can_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
<div class="logistic-testimonial-area padding-top-60 padding-bottom-120" >
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 medical-home">
                    <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        @foreach($all_testimonial as $data)
                            <div class="logistic-single-testimonial-item medical-home">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">{{$data->description}}</p>
                                    <div class="author-details ">
                                        <h4 class="title ">{{$data->name}}</h4>
                                        <span class="designation ">{{$data->designation}}</span>
                                    </div>
                                </div>
                                <div class="thumb ">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data)))
    <div class="const-news-area padding-bottom-120 industry-section-bg padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 medical-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                            <div class="global-carousel-init logistic-dots lawyer-home"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-dots="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            @foreach($all_blog as $data )
                                <div class="single-portfolio-blog-grid medical-home">
                                    <div class="thumb">
                                        {!! render_image_markup_by_attachment_id($data->image,'thumb') !!}
                                        <div class="time-wrap">
                                            <span class="date">{{date_format($data->created_at,'d')}}</span>
                                            <span class="month">{{date_format($data->created_at,'M')}}</span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a>
                                        </h4>
                                        <a class="readmore" href="{{route('frontend.blog.single',$data->slug)}}">{{filter_static_option_value('home_page_12_'.$user_select_lang_slug.'_news_section_readmore_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data)))
    <div class="client-section padding-bottom-70 padding-top-85">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            @foreach($all_brand_logo as $data)
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        @if(!empty($data->url) )<a rel="canonical" href="{{$data->url}}">@endif
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                            @if(!empty($data->url) )  </a>@endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@section('scripts')
    <script>
        $(document).ready(function () {
            $(document).on('click', '#submit_appointment_btn', function (e) {
                e.preventDefault();
                var buttonText = $(this).text();
                var myForm = document.getElementById('appointment_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.appointment.message')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                       $('#submit_appointment_btn').text('{{__('Please Wait..')}}')
                    },
                    success: function (data) {
                        var errMsgContainer = $('#appointment_form').find('.error-message');
                        $('#submit_appointment_btn').text('{{filter_static_option_value('medical_appointment_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}')
                        errMsgContainer.html('');
                        if(data.status == '400'){
                            errMsgContainer.append('<span class="text-danger">'+data.msg+'</span>');
                        }else{
                            errMsgContainer.append('<span class="text-success">'+data.msg+'</span>');
                        }
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#appointment_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#submit_appointment_btn').text('{{filter_static_option_value('medical_appointment_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}');
                    }
                });
            });
        });
    </script>
@endsection
