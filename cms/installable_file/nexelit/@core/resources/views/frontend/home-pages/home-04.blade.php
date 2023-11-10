@include('frontend.partials.homesupportbar')
@include('frontend.partials.navbar')
    <div class="header-slider-one global-carousel-init"
         data-loop="true"
         data-desktopitem="1"
         data-mobileitem="1"
         data-tabletitem="1"
         data-nav="true"
         data-autoplay="true"
         data-margin="0"
    >
    @foreach($all_header_slider as $data)
        <div class="header-area style-04 header-bg-04"
            {!! render_background_image_markup_by_attachment_id($data->image) !!}
        >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-inner style-01">
                            @if(!empty($data->title))
                                <h1 class="title">{{$data->title}}</h1>
                            @endif
                            @if(!empty($data->description))
                                <p class="description">{{$data->description}}</p>
                            @endif
                            <div class="header-bottom">
                                @if(!empty($data->btn_01_status))
                                    <div class="btn-wrapper desktop-left">
                                        <a href="{{$data->btn_01_url}}" class="boxed-btn">{{$data->btn_01_text}}</a>
                                    </div>
                                @endif
                                @if(!empty($data->video_btn_status))
                                    <div class="vdo-btn-wrap">
                                        <a class="video-play mfp-iframe" href="{{$data->video_btn_url}}">
                                            <i class="fas fa-play"></i>{{$data->video_btn_text}}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
<div class="our-mission-area">
    <div class="container-fulid p-0">
        <div class="row no-gutters">
            <div class="col-lg-6">
                <div class="our-service-wrappper bg-main padding-top-100 padding-bottom-15">
                    <div class="section-title white padding-bottom-15 desktop-left">
                        <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_title',$static_field_data)}}</h2>
                        <p class="m-inherit">{!! filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_description',$static_field_data) !!}</p>
                        <div class="service-area-work">
                            @foreach($all_key_features as $key => $data)
                                <div class="single-header-bottom-item-04">
                                    <div class="icon">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{$data->title}}</h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="service-item-wrapper">
                    <div class="single-service-item">
                        <div class="service-img">
                            <div class="bg-image" {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_04_about_us_our_mission_image',$static_field_data)) !!}></div>
                        </div>
                        <div class="service-text">
                            <div class="service-text-inner">
                                <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_our_mission_title',$static_field_data)}}</h2>
                                <p>{!! filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_our_mission_description',$static_field_data) !!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="single-service-item">
                        <div class="service-text">
                            <div class="service-text-inner">
                                <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_our_vision_title',$static_field_data)}}</h2>
                                <p>{!! filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_our_vision_description',$static_field_data) !!}</p>
                            </div>
                        </div>
                        <div class="service-img style-01">
                            <div class="bg-image"  {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_04_about_us_our_vision_image',$static_field_data)) !!}></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_quality_section_status',$static_field_data)))
<section class="top-experience-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="experience-author bg-image"
                   {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_04_quality_area_image',$static_field_data)) !!}
                >
                </div>
            </div>
            <div class="col-lg-5 offset-lg-1 p-0">
                <div class="experience-content-03 section-padding">
                    <div class="content">
                        <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_title',$static_field_data)}}</h2>
                        <p>{!! filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_description',$static_field_data) !!}</p>
                        <div class="servicee-area">
                            <ul>
                                @php
                                $bullet_list = explode("\n",filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_list',$static_field_data));
                                @endphp
                                @foreach($bullet_list as $item)
                                    @if($item)
                                    <li>
                                        <i class="fas fa-check-circle"></i> {{$item}}
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <section class="what-we-cover bg-image padding-top-110 padding-bottom-90"
        {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_01_service_area_background_image',$static_field_data)) !!}
    >
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title white desktop-center margin-bottom-55">
                        <h3 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h3>
                        <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_description',$static_field_data)}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a = 1; @endphp
                @if(filter_static_option_value('home_page_01_service_area_item_type',$static_field_data) === 'category')
                @foreach($all_service_category as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="single-what-we-cover-item style-01 margin-bottom-30">
                        @if($data->icon_type == 'icon' || $data->icon_type == '')
                            <div class="icon style-0{{$a }}">
                                <i class="{{$data->icon}}"></i>
                            </div>
                        @else
                            <div class="img-icon style-0{{$a}}">
                                {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                            </div>
                        @endif
                        <div class="content">
                            <h4 class="title">
                                <a href="{{route('frontend.services.category',[ 'id' => $data->id , 'any' => Str::slug($data->name)])}}">{{$data->name}}</a>
                            </h4>
                        </div>
                    </div>
                </div>
                    @php  if($a == 4){ $a = 1;}else{$a++;}; @endphp
                @endforeach
                @else
                    @foreach($all_service as $data)
                        <div class="col-lg-4 col-md-6">
                            <div class="single-what-we-cover-item style-01 margin-bottom-30">
                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                    <div class="icon style-0{{$a }}">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                @else
                                    <div class="img-icon style-0{{$a}}">
                                        {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                    </div>
                                @endif
                                <div class="content">
                                    <h4 class="title"><a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a></h4>
                                    <p>{{$data->excerpt}}</p>
                                </div>
                            </div>
                        </div>
                        @php  if($a == 4){ $a = 1;}else{$a++;}; @endphp
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endif
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="case-studies-area-03  padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title desktop-center padding-top-110 padding-bottom-50">
                        <h3 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_title',$static_field_data)}}</h3>
                        <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_description',$static_field_data)}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper">
                        <ul class="case-studies-menu style-01">
                            <li class="active" data-filter="*">{{__('All')}}</li>
                            @foreach($all_work_category as $data)
                                <li data-filter=".{{Str::slug($data->name)}}">{{$data->name}}</li>
                            @endforeach
                        </ul>
                        <div class="case-studies-masonry">
                            @foreach($all_work as $data)
                                <div class="col-lg-4 col-md-4 col-sm-6 masonry-item {{get_work_category_by_id($data->id,'slug')}}">
                                    <div class="single-case-studies-item">
                                        <div class="thumb">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <div class="cart-icon">
                                            <h4 class="title"><a href="{{route('frontend.work.single',$data->slug)}}"> {{$data->title}}</a></h4>
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
    <section class="testimonial-area bg-image-01 padding-top-110 padding-bottom-115"
             {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_03_testimonial_bg',$static_field_data)) !!}
    >
        <div class=" container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8 ">
                    <div class="section-title white desktop-center padding-bottom-20 ">
                        <h2 class="title ">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row ">
                <div class="col-lg-12 ">
                    <div class="testimonial-carousel-area margin-top-10 ">
                            <div class="testimonial-carousel global-carousel-init"
                                 data-loop="true"
                                 data-desktopitem="1"
                                 data-mobileitem="1"
                                 data-tabletitem="1"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            @foreach($all_testimonial as $data)
                            <div class="single-testimonial-item ">
                                <div class="content style-01">
                                    <div class="thumb ">
                                        {!! render_image_markup_by_attachment_id($data->image) !!}
                                    </div>
                                    <p class="description ">{{$data->description}}</p>
                                    <div class="author-details ">
                                        <div class="author-meta ">
                                            <h4 class="title ">{{$data->name}}</h4>
                                            <span class="designation ">{{$data->designation}}</span>
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
    </section>
@endif
@if(!empty(filter_static_option_value('home_page_price_plan_section_status',$static_field_data)))
    <section class="pricing-plan-area bg-liteblue price-inner padding-bottom-120 padding-top-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center padding-bottom-55">
                        <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_price_plan_section_title',$static_field_data)}}</h2>
                        <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_price_plan_section_description',$static_field_data)}} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                        <div class="price-plan-slider global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-nav="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        @foreach($all_price_plan as $data)
                            <div class="single-price-plan-01  @if(!empty($data->highlight)) style-02 active @endif">
                                <div class="price-header">
                                    <div class="name-box">
                                        <h4 class="name">{{$data->title}}</h4>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price">{{amount_with_currency_symbol($data->price)}}</span><span class="month">{{$data->type}}</span>
                                    </div>
                                </div>
                                <div class="price-body">
                                    <ul>
                                        @php
                                            $features = explode("\n",$data->features);
                                        @endphp
                                        @foreach($features as $item)
                                            <li>{{$item}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="btn-wrapper">
                                    @php
                                        $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                    @endphp
                                    <a href="{{$url}}" rel="canonical" class="boxed-btn">{{$data->btn_text}}</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="counterup-area counterup-bg padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="singler-counterup-item-01">
                            <div class="icon">
                                <i class="{{$data->icon}}" aria-hidden="true"></i>
                            </div>
                            <div class="content">
                                <div class="count-wrap"><span class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                                <h4 class="title">{{$data->title}}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data)))
    <section class="blog-area padding-top-110 padding-bottom-120 bg-liteblue">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h3 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_latest_news_title',$static_field_data)}}</h3>
                        <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_latest_news_description',$static_field_data)}} </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                        <div class="blog-grid-carousel global-carousel-init"
                             data-loop="true"
                             data-desktopitem="2"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-nav="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            @foreach($all_blog as $data )
                                <div class="single-blog-grid-01"
                                    {!! render_background_image_markup_by_attachment_id($data->image,'large') !!}
                                >
                                    <div class="content">
                                        <ul class="post-meta">
                                            <li>
                                                <a href="{{route('frontend.blog.single', $data->slug)}}"><i
                                                        class="far fa-clock"></i> {{date_format($data->created_at,'d M Y')}}
                                                </a></li>
                                            <li>
                                                <div class="cats"><i class="fas fa-tags"></i>{!! get_blog_category_by_id($data->blog_categories_id,'link') !!}</div>
                                            </li>
                                        </ul>
                                        <h4 class="title"><a
                                                href="{{route('frontend.blog.single',$data->slug)}}">{{$data->title}}</a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

@include('frontend.partials.contact-section')
