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
        <div class="header-area header-bg"
            {!! render_background_image_markup_by_attachment_id($data->image) !!}
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-inner">
                            @if(!empty($data->subtitle))
                                <p class="subtitle">{{$data->subtitle}}</p>
                            @endif
                            @if(!empty($data->title))
                                <h1 class="title">{{$data->title}}</h1>
                            @endif
                            @if(!empty($data->description))
                                <p class="description">{{$data->description}}</p>
                            @endif
                            @if(!empty($data->btn_01_status))
                                <div class="btn-wrapper  desktop-left padding-top-30">
                                    <a href="{{$data->btn_01_url}}" class="boxed-btn ">{{$data->btn_01_text}}</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
@if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data)))
<div class="header-bottom-area bg-blue padding-bottom-120">
    <div class="header-bottom-inner">
        <div class="container">
            <div class="row">
                @foreach($all_key_features as $key => $data)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-header-bottom-item style-0{{$key+1}}">
                            <div class="icon">
                                <i class="{{$data->icon}}"></i>
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
</div>
@endif
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
<section class="top-experience-area bg-blue">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="experience-content">
                    <div class="content">
                        <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_title',$static_field_data)}}</h2>
                    </div>
                    <div class="col-lg-09 offset-lg-3">
                        <div class="experience-right">
                            <div class="experience-img">
                                {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_01_about_us_video_background_image',$static_field_data)) !!}
                            </div>
                            <div class="vdo-btn">
                                <a class="video-play-btn mfp-iframe"
                                   href="{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_about_us_video_url',$static_field_data)}}"><i
                                        class="fas fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
<section class="what-we-cover padding-bottom-85 padding-top-160">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-50">
                    <h3 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h3>
                    <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_service_area_description',$static_field_data)}}</p>
                </div>
            </div>
        </div>
        @if(filter_static_option_value('home_page_01_service_area_item_type',$static_field_data) === 'category')
        @foreach($all_service_category->chunk(3) as $row)
            <div class="row">
                @foreach($row as $key => $data)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="single-what-we-cover-item margin-bottom-50">
                            @if($data->icon_type == 'icon' || $data->icon_type == '')
                            <div class="icon style-0{{$key+1}}">
                                <i class="{{$data->icon}}"></i>
                            </div>
                            @else
                                <div class="img-icon">
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
                @endforeach
            </div>
        @endforeach
        @else
            @foreach($all_service->chunk(3) as $row)
                <div class="row">
                    @foreach($row as $key => $data)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="single-what-we-cover-item margin-bottom-50">
                                @if($data->icon_type == 'icon' || $data->icon_type == '')
                                    <div class="icon style-0{{$key+1}}">
                                        <i class="{{$data->icon}}"></i>
                                    </div>
                                @else
                                    <div class="img-icon">
                                        {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                    </div>
                                @endif
                                <div class="content">
                                    <h4 class="title"><a
                                                href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a>
                                    </h4>
                                    <p>{{$data->excerpt}}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_quality_section_status',$static_field_data)))
<div class="quality-area">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-6">
                {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_01_quality_area_background_image',$static_field_data),'only-mobile-version-show','full') !!}
                <div class="quality-img" {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_01_quality_area_background_image',$static_field_data)) !!}></div>
            </div>
            <div class="col-lg-6">
                <div class="quality-content">
                    <div class="quality-content-wrapper">
                        <h4 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_title',$static_field_data)}}</h4>
                        <p>{!! filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_description',$static_field_data) !!}</p>

                        @if(!empty(filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_status',$static_field_data)))
                            <div class="btn-wrapper margin-top-40">
                                <a href="{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_url',$static_field_data)}}"
                                   class="boxed-btn">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_quality_area_button_title',$static_field_data)}}</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
<div class="case-studies-area">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="section-title white bg-blue desktop-center padding-top-110 padding-bottom-55">
                    <h3 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_title',$static_field_data)}}</h3>
                    <p>{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_case_study_description',$static_field_data)}}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="case-studies-slider-active global-carousel-init"
                     data-loop="true"
                     data-desktopitem="3"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-nav="true"
                     data-center="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    @foreach($all_work as $data)
                        <div class="slider-img"
                            {!! render_background_image_markup_by_attachment_id($data->image) !!}
                        >
                            <div class="slider-inner-text">
                                <a href="{{route('frontend.work.single',$data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <p>{{$data->excerpt}}</p>
                                <div class="btn-wrapper padding-top-20">
                                    <a href="{{route('frontend.work.single',$data->slug)}}"
                                       class="boxed-btn">{{filter_static_option_value('case_study_'.$user_select_lang_slug.'_read_more_text',$static_field_data)}}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
<section class="testimonial-area bg-image padding-top-85 padding-bottom-40">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center padding-bottom-20">
                    <h2 class="title">{{filter_static_option_value('home_page_01_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="testimonial-carousel-area margin-top-10">
                    <div class="testimonial-carousel global-carousel-init"
                         data-loop="true"
                         data-desktopitem="1"
                         data-mobileitem="1"
                         data-tabletitem="1"
                         data-autoplay="true"
                         data-margin="0"
                    >
                        @foreach($all_testimonial as $data)
                            <div class="single-testimonial-item">
                                <div class="content">
                                    <div class="thumb">
                                        {!! render_image_markup_by_attachment_id($data->image) !!}
                                    </div>
                                    <p class="description">{{$data->description}}</p>
                                    <div class="icon">
                                        <i class="flaticon-right-quote-1"></i>
                                    </div>
                                    <div class="author-details">
                                        <div class="author-meta">
                                            <h4 class="title">{{$data->name}}</h4>
                                            <span class="designation">{{$data->designation}}</span>
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
<section class="pricing-plan-area bg-image price-inner padding-bottom-120 margin-top-70 padding-top-110"
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_01_price_plan_background_image',$static_field_data)) !!}
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white desktop-center padding-bottom-55">
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
                         data-autoplay="true"
                         data-margin="30"
                         data-nav="true"
                    >
                    @foreach($all_price_plan as $data)
                        <div class="single-price-plan-01 @if(!empty($data->highlight)) style-03 active @endif">
                            <div class="price-header">
                                <div class="name-box">
                                    <h4 class="name">{{$data->title}}</h4>
                                </div>
                                <div class="price-wrap">
                                    <span class="price">{{amount_with_currency_symbol($data->price)}}</span><span
                                        class="month">{{$data->type}}</span>
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
@if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data)))
<div class="client-section bg-liteblue padding-bottom-70 padding-top-70">
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
@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data)))
<section class="blog-area padding-top-110 padding-bottom-120">
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
                         data-tabletitem="2"
                         data-autoplay="true"
                         data-nav="true"
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
