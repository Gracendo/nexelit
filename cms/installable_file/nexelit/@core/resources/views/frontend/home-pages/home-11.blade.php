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
                        @if(!empty(filter_static_option_value('site_white_logo',$global_static_field_data)))
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('site_white_logo',$global_static_field_data)) !!}
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
        <div class="header-area political-home"
                {!! render_background_image_markup_by_attachment_id(filter_static_option_value('political_home_page_header_background_image',$static_field_data)) !!}
        >
            <div class="left-image-wrap">
                {!! render_image_markup_by_attachment_id(filter_static_option_value('political_home_page_header_left_image',$static_field_data)) !!}
            </div>
            <div class="container">
                <div class="row justify-content-end">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <h1 class="title">{{filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_title',$static_field_data)}}</h1>
                            <p class="description">{{filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_description',$static_field_data)}}</p>
                            @if(!empty(filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data)))
                            <div class="btn-wrapper margint-top-30">
                                <a href="{{filter_static_option_value('political_home_page_header_button_url',$static_field_data)}}" class="boxed-btn political">{{ filter_static_option_value('political_home_page_header_'.$user_select_lang_slug.'_button_text',$static_field_data) }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data)))
<div class="header-bottom-area margin-minus-100">
    <div class="container">
        <div class="row">
            @php
                $all_button_one_icon_fields =  filter_static_option_value('home_page_11_key_features_section_icon',$static_field_data);
                $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields) : [];
                $all_title_fields = filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_key_features_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
            @endphp
            <div class="col-lg-12">
                <ul class="political-feature-list">
                    @foreach($all_button_one_icon_fields as $index => $icon)
                    <li class="single-political-list-item style-{{$index}}">
                        <div class="icon">
                            <i class="{{$icon}}"></i>
                        </div>
                        <h3 class="title">{{$all_title_fields[$index] ?? ''}}</h3>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
    <div class="lawyer-about-area political-home padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <span class="subtitle">{{filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                        <div class="description">{!! filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper">
                            @if(!empty(filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)))
                                <a href="{{filter_static_option_value('political_about_section_button_url',$static_field_data)}}"
                                   class="boxed-btn lawyer-home">
                                    {{filter_static_option_value('political_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('political_about_section_right_image',$static_field_data)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<section class="video-and-cta-area">
    @if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data)))
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="political-video-wrap">
                    <div class="img-wrap">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_11_video_area_background_image',$static_field_data)) !!}
                        <a href="{{filter_static_option_value('home_page_11_video_area_video_url',$static_field_data)}}" class="mfp-iframe video-play-btn"><i class="fas fa-play"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)))
    <div class="political-cta-area-wrapper" 
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_11_cta_area_background_image',$static_field_data)) !!}
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="cta-area-inner">
                        <span class="subtitle">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_subtitle',$static_field_data)}}</span>
                        <h3 class="title">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)}}</h3>
                        <p>{{ filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_description',$static_field_data) }} </p>
                        @if(!empty(filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data)))
                        <div class="btn-wrapper">
                            <a href="{{filter_static_option_value('home_page_11_cta_area_button_url',$static_field_data)}}" class="boxed-btn political-home">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)}}</a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="political-what-we-offer-area padding-top-120 industry-section-bg padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 political-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="political-single-what-we-cover-item  margin-bottom-30">
                            <div class="hover">
                                <h4 class="title"><a
                                    href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                </h4>
                                <p>{{$data->excerpt}}</p>
                            </div>
                            {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                            <div class="content">
                                <h4 class="title">
                                    <a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                </h4>
                                <a href="{{route('frontend.services.single', $data->slug)}}"
                                   class="readmore">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_service_area_readmore_text',$static_field_data)}}
                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="lawyer-counterup-area padding-top-115 padding-bottom-115"
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_11_counterup_section_background_image',$static_field_data)) !!}
    >
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="lawyer-home-counterup-item">
                            <div class="icon">
                                <i class="{{$data->icon}}"></i>
                            </div>
                            <div class="count-wrap"><span
                                        class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                            <h4 class="title">{{$data->title}}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_event_section_status',$static_field_data)))
<section class="event-area padding-top-120 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_event_area_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_event_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                @php $a = 0; @endphp 
                @foreach ( $all_events as $data)
                <div class="political-single-event-item-wrap">
                    <div class="thumb">
                        {!! render_image_markup_by_attachment_id($data->image,'grid') !!}
                        <div class="time-wrap style-{{$a}}">
                            <span class="date">{{date('d',strtotime($data->date))}}</span>
                            <span class="month">{{date('M',strtotime($data->date))}}</span>
                        </div>
                    </div>
                    <div class="content">
                        <h4 class="title"> <a href="{{route('frontend.events.single',$data->slug)}}">{{$data->title}}</a></h4>
                        <div class="description">{{strip_tags(Str::words(strip_tags($data->content),20))}}</div>
                        <ul>
                            <li><i class="fas fa-map-marker-alt"></i> {{$data->venue_location}}</li>
                            <li><i class="far fa-clock"></i> {{$data->time}}</li>
                        </ul>
                    </div>
                </div>
                @php ($a == 2) ? $a = 0 : $a++; @endphp 
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
<div class="logistic-testimonial-area padding-top-115 padding-bottom-120"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_11_testimonial_area_background_image',$static_field_data)) !!}
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
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
                            <div class="logistic-single-testimonial-item political-home">
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

@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data,$static_field_data)))
    <div class="const-news-area padding-bottom-120 industry-section-bg padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 political-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data,$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_title',$static_field_data)}}</h2>
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
                                <div class="single-portfolio-blog-grid political-home">
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
                                        <p class="excerpt">{{strip_tags($data->excerpt)}}</p>
                                        <a class="readmore" href="{{route('frontend.blog.single',$data->slug)}}">{{filter_static_option_value('home_page_11_'.$user_select_lang_slug.'_new_area_button_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
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


