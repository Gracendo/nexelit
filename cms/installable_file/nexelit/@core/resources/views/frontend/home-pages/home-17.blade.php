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

<div class="header-slider-wrapper course-home p"
        {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_17_header_area_background_image',$static_field_data)) !!}
>
    <div class="right-image-wrap">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_17_header_area_right_image',$static_field_data)) !!}
    </div>
    <div class="header-area course-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner">
                        <h1 class="title">{{filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_title',$static_field_data)}}</h1>
                        <div class="description">{!! filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper margin-top-30">
                            @if(!empty(filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data)))
                                <a href="{{ filter_static_option_value('home_page_17_header_area_button_url',$static_field_data) }}"
                                   class="btn-dagency">{{ filter_static_option_value('home_page_17_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data) }}
                                    <i class="{{filter_static_option_value('home_page_17_header_area_button_icon',$static_field_data)}}"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty(filter_static_option_value('home_page_course_category_section_status',$static_field_data)))
<div class="category-slider-wrap padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class=" global-carousel-init course-category-carousel"
                     data-loop="true"
                     data-desktopitem="5"
                     data-mobileitem="2"
                     data-tabletitem="3"
                     data-autoplay="true"
                     data-margin="40",
                     data-dots="true",
                     data-nav="true"
                >
                    @php $a=1; @endphp
                    @foreach($all_courses_category as $data)
                        <div class="single-course-category-item">
                            <a href="{{route('frontend.course.category',[Str::slug($data->lang_front->title ?? '','-',$data->lang_front->lang ?? ''),$data->id])}}">
                            <div class="icon bg-{{$a}}"
                            style="background-image: url({{asset('assets/frontend/img/icon/course-'.$a.'.svg')}})"
                            >
                                <i class="{{$data->icon}}"></i>
                            </div>
                            </a>
                            <div class="content">
                                <a href="{{route('frontend.course.category',[Str::slug($data->lang_front->title ?? '','-',$data->lang_front->lang ?? ''),$data->id])}}">
                                <h4 class="title">{{$data->lang_front->title ?? __('Untitled')}}</h4>
                                </a>
                                <span class="count">{{$data->course->count() ?? 0}} {{__('Courses')}}</span>
                            </div>
                        </div>
                        @php if($a == 6){ $a=1;}else{$a++;} @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_our_speciality_section_status',$static_field_data)))
<div class="our-specialities-area padding-top-60 padding-bottom-60">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title course-home margin-bottom-80">
                    <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $all_icon_fields =  filter_static_option_value('course_home_page_specialities_item_icon',$static_field_data);
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : [];
                $all_title_fields = filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                $all_description_fields = filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_specialities_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $all_url_fields = filter_static_option_value('course_home_page_specialities_item_url',$static_field_data);
                $all_url_fields = !empty($all_url_fields) ? unserialize($all_url_fields,['class' => false]) : [];
           $a = 1;
            @endphp
            @foreach($all_icon_fields as $index => $icon)
                <div class="col-lg-3">
                    <div class="single-specialities-item bg-color-{{$a}}">
                        <div class="icon"><i class="{{$icon}}"></i></div>
                        <div class="content">
                            <h4 class="title"><a href="{{$all_url_fields[$index] ?? ''}}">{{$all_title_fields[$index] ?? ''}}</a></h4>
                            <div class="description">{{$all_description_fields[$index] ?? ''}}</div>
                        </div>
                    </div>
                </div>
                @php $a < 5 ? $a++ : $a=1;  @endphp
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_featured_courses_section_status',$static_field_data)))
<div class="latest-courses-area course-section-bg padding-bottom-80 padding-top-110">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title course-home margin-bottom-80">
                    <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_featured_course_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="recent-course-area global-carousel-init"
                     data-loop="true"
                     data-desktopitem="3"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-autoplay="true"
                     data-nav="true"
                     data-margin="30"
                     data-stagePadding="10"
                >
                    @php $a=1; @endphp
                    @foreach($featured_courses as $data)
                        <div class="course-single-grid-item">
                            <div class="thumb">
                                <a href="{{route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])}}">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                </a>
                                <div class="price-wrap">
                                    {{amount_with_currency_symbol($data->price)}}
                                    <del>{{amount_with_currency_symbol($data->sale_price)}}</del>
                                </div>
                                <div class="cat">
                                    <a class="bg-{{$a}}" href="{{route('frontend.course.category',[Str::slug(optional(optional($data->category)->lang_front)->title ?? '','-',optional(optional($data->category)->lang_front)->lang),optional($data->category)->id])}}">{{optional(optional($data->category)->lang_front)->title}}</a>
                                </div>
                            </div>
                            <div class="content">
                                @if(count($data->reviews) > 0)
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating" style="width: {{{get_course_ratings_avg_by_id($data->id) / 5 * 100}}}%"></span>
                                        </div>
                                        <p><span class="total-ratings">({{count($data->reviews)}})</span></p>
                                    </div>
                                @endif
                                <h3 class="title"><a href="{{route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])}}">{{Str::words($data->lang_front->title ?? '',6,'..')}}</a></h3>
                                <div class="instructor-wrap"><span>{{__('By')}}</span> <a href="{{route('frontend.course.instructor',[Str::slug($data->instructor->name ?? ''),$data->instructor->id])}}">{{$data->instructor->name}}</a></div>
                                <div class="description">
                                    {!! Str::words(strip_tags($data->lang_front->description ?? ''),15) !!}
                                </div>
                                <div class="footer-part">
                                    <span><i class="fas fa-users"></i> {{$data->enrolled_student}} {{__('Enrolled')}}</span>
                                    <span><i class="fas fa-clock"></i> {{$data->duration}} {{$data->duration_type}}</span>
                                </div>
                            </div>
                        </div>
                        @php if($a == 4){ $a=1;}else{$a++;} @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data)))
    <div class="logistic-video-area-wrap padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="logistic-video-wrap">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('course_home_page_video_section_background_image',$static_field_data),'','full') !!}
                        <a href="{{filter_static_option_value('course_home_page_video_section_video_url',$static_field_data)}}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                        <div class="shape">
                            <img src="{{asset('assets/frontend/img/shape/11.png')}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="cagency-counterup-area course-bg padding-bottom-120" style="background-image: url({{asset('assets/frontend/img/shape/course-cta-shape.png')}})">
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="cagency-counterup-item">
                            <div class="number style-{{$loop->index + 1}}">
                                <div class="count-wrap"><span class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                            </div>
                            <div class="content">
                                <h4 class="title">{{$data->title}}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_all_courses_section_status',$static_field_data)))
<div class="all-courses-area padding-top-110 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-between ">
           <div class="col-lg-8">
               <div class="section-title course-home margin-bottom-80">
                   <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_all_course_area_title',$static_field_data)}}</h2>
               </div>
           </div>
            <div class="col-lg-4">
                <div class="btn-wrapper desktop-right course-home">
                    <a href="{{route('frontend.course')}}" class="achor-btn">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_all_course_area_button_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
        <div class="row">
            @php $a=1; @endphp
            @foreach($latest_courses as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="course-single-grid-item">
                        <div class="thumb">
                            <a href="{{route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])}}">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                            </a>
                            <div class="price-wrap">
                                {{amount_with_currency_symbol($data->price)}}
                                <del>{{amount_with_currency_symbol($data->sale_price)}}</del>
                            </div>
                            <div class="cat">
                                <a class="bg-{{$a}}" href="{{route('frontend.course.category',[Str::slug(optional(optional($data->category)->lang_front)->title ,'-',optional(optional($data->category)->lang_front)->lang),optional($data->category)->id])}}">{{optional(optional($data->category)->lang_front)->title}}</a>
                            </div>
                        </div>
                        <div class="content">
                            @if(count($data->reviews) > 0)
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: {{{get_course_ratings_avg_by_id($data->id) / 5 * 100}}}%"></span>
                                    </div>
                                    <p><span class="total-ratings">({{count($data->reviews)}})</span></p>
                                </div>
                            @endif
                            <h3 class="title"><a href="{{route('frontend.course.single',[$data->lang_front->slug ?? '',$data->id])}}">{{Str::words($data->lang_front->title ?? '',6,'..')}}</a></h3>
                            <div class="instructor-wrap"><span>{{__('By')}}</span> <a href="{{route('frontend.course.instructor',[Str::slug($data->instructor->name),$data->instructor->id])}}">{{$data->instructor->name}}</a></div>
                            <div class="description">
                                {!! Str::words(strip_tags($data->lang_front->description ?? ''),15) !!}
                            </div>
                            <div class="footer-part">
                                <span><i class="fas fa-users"></i> {{$data->enrolled_student}} {{__('Enrolled')}}</span>
                                <span><i class="fas fa-clock"></i> {{$data->duration}} {{$data->duration_type}}</span>
                            </div>
                        </div>
                    </div>
                    @php if($a == 4){ $a=1;}else{$a++;} @endphp
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="cleaning-home-testimonial-area padding-top-120 padding-bottom-120 course-section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-80 course-home">
                        <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)}}</h2>
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
                                <div class="const-single-testimonial-item course-home">
                                    <div class="content">
                                        <i class="fas fa-quote-left"></i>
                                        <p class="description ">{{$data->description}}</p>
                                    </div>
                                    <div class="author-details ">
                                        <div class="thumb ">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <h4 class="title ">{{$data->name}}</h4>
                                        <span class="designation ">{{$data->designation}}</span>
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
@if(!empty(filter_static_option_value('home_page_event_section_status',$static_field_data)))
    <div class="course-event-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-80 course-home">
                        <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_event_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="event-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="0"
                        >
                            @foreach($all_events as $data)
                                <div class="single-events-list-item course-home">
                                    <div class="thumb">
                                        {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    </div>
                                    <div class="content-area">
                                        <div class="top-part">
                                            <div class="time-wrap">
                                                <span class="date">{{date('d',strtotime($data->date))}}</span>
                                                <span class="month">{{date('M',strtotime($data->date))}}</span>
                                            </div>
                                            <div class="title-wrap">
                                                <a href="{{route('frontend.events.single',$data->slug)}}"><h4 class="title">{{$data->title}}</h4></a>
                                            </div>
                                        </div>
                                        <span class="location d-block"><i class="fas fa-map-marker-alt"></i> {{$data->venue_location}}</span>
                                        <p>{{strip_tags(Str::words(str_replace('&nbsp;',' ',$data->content),20))}}</p>
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
    <div class="course-cta-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="course-inner-area-wrap">
                        <div class="left-content-wrap">
                            <h2 class="title">{{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)}}</h2>
                        </div>
                        @if(filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data))
                        <div class="right-content-wrap">
                            <div class="btn-wrapper">
                                <a href="{{filter_static_option_value('course_home_page_cta_area_button_url',$static_field_data)}}" class="btn-dagency"> {{filter_static_option_value('course_home_page_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)}} <i class="{{filter_static_option_value('course_home_page_cta_section_button_icon',$static_field_data)}}"></i></a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif