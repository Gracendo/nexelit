@include('frontend.partials.homesupportbar')
@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
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

<div class="header-slider-wrapper cleaning-home"
        {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_16_header_area_background_image',$static_field_data)) !!}
>
    <div class="right-image-wrap">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_16_header_area_right_image',$static_field_data)) !!}
    </div>
    <div class="header-area cleaning-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner">
                        <h1 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_header_area_title',$static_field_data)}}</h1>
                        <div class="description">{!! filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_header_area_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper margin-top-30">
                            @if(!empty(filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data)))
                                <a href="{{ filter_static_option_value('home_page_16_header_area_button_url',$static_field_data) }}"
                                   class="btn-boxed cleaning-home">{{ filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data) }}
                                    <i class="{{filter_static_option_value('home_page_16_header_area_button_icon',$static_field_data)}}"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
<div class="cleaning-about-area-wrap padding-top-115 padding-bottom-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-wrap">
                    <div class="img-wrap">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_16_about_section_left_image',$static_field_data)) !!}
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-wrap">
                    <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_about_section_subtitle',$static_field_data)}}</span>
                    <h3 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_about_section_title',$static_field_data)}}</h3>
                    <div class="paragraph">
                        {!! filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_about_section_description',$static_field_data) !!}
                    </div>
                    @if(filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_about_section_button_text',$static_field_data))
                    <div class="btn-wrapper">
                        <a href="{{filter_static_option_value('home_page_16_about_section_button_url',$static_field_data)}}" class="btn-boxed cleaning-home">
                            {{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_about_section_button_text',$static_field_data)}}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="our-service-area padding-top-60 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 cleaning-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a=1;@endphp
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-cleaning-service-item">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                    <div class="icon style-{{$a }}">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                @else
                                    <div class="img-icon style-{{$a}}">
                                        {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                    </div>
                                @endif
                            </div>

                            <div class="content">
                                <h4 class="title"><a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a></h4>
                                <p>{{$data->excerpt}}</p>
                            </div>
                        </div>
                    </div>
                    @php ( $a == 6 ) ? $a = 1 : $a++; @endphp
                @endforeach
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_appointment_section_status',$static_field_data)))
    <div class="const-team-member-area padding-top-120 padding-bottom-120 ">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_appointment_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_appointment_section_title',$static_field_data)}}</h2>
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
                                <div class="appointment-single-item cleaning-home">
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

@if(!empty(filter_static_option_value('home_page_quote_faq_section_status',$static_field_data)))
<div class="estimate-area-wrap cleaning-home  padding-bottom-120">
   <div class="top-part padding-top-120">
       <div class="container">
           <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="left-content-wrap padding-top-60">
                        <h3 class="title">
                            {{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_estimate_area_title',$static_field_data)}}
                        </h3>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="estimate-form-wrapper">
                        <h4 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_estimate_area_form_title',$static_field_data)}}</h4>
                        <form action="{{route('frontend.estimate.message')}}" id="get_in_touch_form" enctype="multipart/form-data">
                            @csrf
                            <div class="error-message"></div>
                            {!! render_form_field_for_frontend(filter_static_option_value('estimate_form_fields',$static_field_data)) !!}
                            <div class="btn-wrapper">
                                <button type="submit" id="get_in_touch_submit_btn" class="submit-btn cleaning-home">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_estimate_area_form_button_text',$static_field_data)}}</button>
                                <div class="ajax-loading-wrap hide">
                                    <div class="sk-fading-circle">
                                        <div class="sk-circle1 sk-circle"></div>
                                        <div class="sk-circle2 sk-circle"></div>
                                        <div class="sk-circle3 sk-circle"></div>
                                        <div class="sk-circle4 sk-circle"></div>
                                        <div class="sk-circle5 sk-circle"></div>
                                        <div class="sk-circle6 sk-circle"></div>
                                        <div class="sk-circle7 sk-circle"></div>
                                        <div class="sk-circle8 sk-circle"></div>
                                        <div class="sk-circle9 sk-circle"></div>
                                        <div class="sk-circle10 sk-circle"></div>
                                        <div class="sk-circle11 sk-circle"></div>
                                        <div class="sk-circle12 sk-circle"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
           </div>
       </div>
   </div>
    <div class="bottom-part">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    @if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data)))
                        <div class="client-section padding-bottom-70 padding-top-60">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="client-area">
                                            <div class="client-active-area global-carousel-init"
                                                 data-loop="true"
                                                 data-desktopitem="3"
                                                 data-mobileitem="1"
                                                 data-tabletitem="2"
                                                 data-autoplay="true"
                                                 data-margin="40"
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
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="cleaning-project-area padding-top-60 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center  cleaning-home margin-bottom-60">
                        <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_work_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_work_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01 cleaning-home">
                            <li class="active" data-filter="*">{{__('All')}}</li>
                            @foreach($all_work_category as $data)
                                <li data-filter=".{{Str::slug($data->name)}}">{{$data->name}}</li>
                            @endforeach
                        </ul>
                        <div class="case-studies-masonry">
                            @foreach($all_work as $data)
                                <div class="col-lg-4 col-md-4 col-sm-6 masonry-item {{get_work_category_by_id($data->id,'slug')}}">
                                    <div class="single-case-studies-item cleaning-home">
                                        <div class="thumb">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <div class="content">
                                            <h4 class="title"><a href="{{route('frontend.work.single',$data->slug)}}"> {{$data->title}}</a></h4>
                                            <div class="cat-item">
                                                @php $all_cats = get_work_category_by_id($data->id); @endphp
                                                @foreach($all_cats as $cat_id => $name)
                                                    <a href="{{route('frontend.works.category',['id' => $cat_id,'any' =>  Str::slug($name)])}}">{{$name}}</a>
                                                @endforeach
                                            </div>
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

@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="cleaning-home-testimonial-area padding-top-120 padding-bottom-120 section-bg-1">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-40 cleaning-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_testimonial_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            @foreach($all_testimonial as $data)
                                <div class="cagency-single-testimonial-item cleaning-home">
                                    <div class="icon">
                                        <i class="fas fa-quote-left"></i>
                                    </div>
                                    <div class="content">
                                        <p class="description ">{{$data->description}}</p>
                                    </div>
                                    <div class="author-details">
                                        <div class="thumb ">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <div class="content">
                                            <h4 class="title ">{{$data->name}}</h4>
                                            <span class="designation ">{{$data->designation}}</span>
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

@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="counterup-area cleaning-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cleaning-counterup-area">
                        <div class="row">
                            @foreach($all_counterup as $data)
                                <div class="col-lg-3 col-md-6">
                                    <div class="cleaning-counterup-item">
                                            <div class="count-wrap"><span class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                                            <h4 class="title">{{$data->title}}</h4>
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
    <div class="cleaning-news-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center cleaning-home margin-bottom-60">
                        <span class="subtitle">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_new_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            @foreach($all_blog as $data )
                                <div class="single-portfolio-blog-grid cleaning-home">
                                    <div class="thumb">
                                        {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                                        <div class="time-wrap">
                                            <span class="date">{{date_format($data->created_at,'d')}}</span>
                                            <span class="month">{{date_format($data->created_at,'M')}}</span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">
                                            <a href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a>
                                        </h4>
                                        <p class="excerpt">{{strip_tags($data->excerpt)}}</p>
                                        <a class="readmore" href="{{route('frontend.blog.single',$data->slug)}}">{{filter_static_option_value('home_page_16_'.$user_select_lang_slug.'_new_area_button_text',$static_field_data)}}</a>
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
            $(document).on('click', '#get_in_touch_submit_btn', function (e) {
                e.preventDefault();
                var myForm = document.getElementById('get_in_touch_form');
                var formData = new FormData(myForm);

                $.ajax({
                    type: "POST",
                    url: "{{route('frontend.estimate.message')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('hide').addClass('show');
                    },
                    success: function (data) {
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                        errMsgContainer.html('');

                        if(data.status == '400'){
                            errMsgContainer.append('<span class="text-danger">'+data.msg+'</span>');
                        }else{
                            errMsgContainer.append('<span class="text-success">'+data.msg+'</span>');
                        }
                    },
                    error: function (data) {
                        var error = data.responseJSON;
                        var errMsgContainer = $('#get_in_touch_form').find('.error-message');
                        errMsgContainer.html('');
                        $.each(error.errors,function (index,value) {
                            errMsgContainer.append('<span class="text-danger">'+value+'</span>');
                        });
                        $('#get_in_touch_submit_btn').parent().find('.ajax-loading-wrap').removeClass('show').addClass('hide');
                    }
                });
            });
        });
    </script>
@endsection