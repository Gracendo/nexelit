@include('frontend.partials.homesupportbar')
@php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$static_field_data);
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
<div class="header-slider-one global-carousel-init"
     data-loop="true"
     data-desktopitem="1"
     data-mobileitem="1"
     data-tabletitem="1"
     data-nav="true"
     data-dots="true"
     data-autoplay="true"
     data-margin="0"
>
    @php
        $all_bg_image_fields =  filter_static_option_value('home_page_06_header_section_bg_image',$static_field_data);
        $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields) : [];
        $all_button_one_url_fields =  filter_static_option_value('home_page_06_header_section_button_one_url',$static_field_data);
        $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields) : [];
        $all_button_two_url_fields =  filter_static_option_value('home_page_06_header_section_button_two_url',$static_field_data);
        $all_button_two_url_fields = !empty($all_button_two_url_fields) ? unserialize($all_button_two_url_fields) : [];
        $all_description_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
        $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
        $all_btn_one_text_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
        $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields) : [];
        $all_btn_two_text_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_header_section_button_two_text',$static_field_data);
        $all_btn_two_text_fields = !empty($all_btn_two_text_fields) ? unserialize($all_btn_two_text_fields) : [];
        $all_title_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
    @endphp
    @foreach($all_bg_image_fields as $index => $image_field)
        <div class="header-area style-04 header-bg-04 logistics-home"
                {!! render_background_image_markup_by_attachment_id($image_field) !!}
        >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-inner logistics-home">
                            @if(isset($all_title_fields[$index]))
                                <h1 class="title">{{$all_title_fields[$index]}}</h1>
                            @endif
                            @if(isset($all_description_fields[$index]))
                                <p class="description">{{$all_description_fields[$index]}}</p>
                            @endif
                            @if(isset($all_btn_one_text_fields[$index]) || isset($all_btn_two_text_fields[$index]))
                                <div class="btn-wrapper  desktop-center">
                                    @if(isset($all_btn_one_text_fields[$index]))
                                    <a href="{{isset($all_button_one_url_fields[$index]) ? $all_button_one_url_fields[$index] : ''}}" class="logistics-btn">{{$all_btn_one_text_fields[$index]}}</a>
                                    @endif
                                    @if(isset($all_btn_two_text_fields[$index]))
                                    <a href="{{isset($all_button_two_url_fields[$index]) ? $all_button_two_url_fields[$index] : ''}}" class="logistics-btn blank">{{$all_btn_two_text_fields[$index]}}</a>
                                    @endif
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
<div class="logistics-key-feature-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="lkey-feature-outer-warpp">
                    <ul class="lkey-features-list">
                        @foreach($all_key_features as $key => $data)
                            <li class="single-logistic-key-feature-one">
                                <div class="icon">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">{{$data->title}}</h4>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
<div class="logistics-what-we-offer-area padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('logistic_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('logistic_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($all_service as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="logistics-single-what-we-cover-item margin-bottom-30">
                        <div class="thumb">
                            <a href="{{route('frontend.services.single', $data->slug)}}">
                            {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                            </a>
                        </div>
                        <div class="content">
                            <h4 class="title"><a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a></h4>
                            <p>{{$data->excerpt}}</p>
                            <a href="{{route('frontend.services.single', $data->slug)}}" class="readmore">{{filter_static_option_value('logistic_what_we_offer_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_video_section_status',$static_field_data)))
<div class="logistic-video-area-wrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="logistic-video-wrap">
                    {!! render_image_markup_by_attachment_id(filter_static_option_value('portfolio_video_section_background_image',$static_field_data),'','full') !!}
                    <a href="{{filter_static_option_value('portfolio_video_section_video_url',$static_field_data)}}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
<div class="logistic-counterup-area bg-overlay padding-bottom-120"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('portfolio_counterup_section_background_image',$static_field_data)) !!}
>
    <div class="container">
        <div class="row">
            @foreach($all_counterup as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="logistic-counterup-item">
                        <div class="icon">
                            <i class="{{$data->icon}}" aria-hidden="true"></i>
                        </div>
                        <div class="content">
                            <h4 class="title">{{$data->title}}</h4>
                            <div class="count-wrap"><span class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
<div class="logistic-project-area padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('logistic_project_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('logistic_project_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
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
@if(!empty(filter_static_option_value('home_page_quote_faq_section_status',$static_field_data)))
<div class="quote-and-faq section-white-bg-one padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="logistic-get-quote">
                    <span class="subtitle">{{filter_static_option_value('logistic_quote_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h4 class="title">{{filter_static_option_value('logistic_quote_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h4>
                    <form action="" class="logistic-quote-form">
                        @csrf
                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        {!! render_form_field_for_frontend(filter_static_option_value('quote_page_form_fields',$static_field_data)) !!}
                        <div class="form-group">
                            <button type="submit" class="logistics-btn">{{filter_static_option_value('logistic_quote_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="logistic-faq-wrapper">
                    <span class="subtitle">{{filter_static_option_value('logistic_faq_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h4 class="title">{{filter_static_option_value('logistic_faq_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h4>
                    <div class="accordion-wrapper logistics-style">
                        @php
                            $all_title_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_faq_item_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_description_fields = filter_static_option_value('home_page_06_'.$user_select_lang_slug.'_faq_item_description',$static_field_data);
                            $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
                        @endphp
                        @php $rand_number = rand(9999,99999999); @endphp
                        <div id="accordion_{{$rand_number}}">
                            @foreach($all_title_fields as $index => $title)
                                <div class="card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                    <div class="card-header" id="headingOne_{{$index}}" itemprop="name">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" data-target="#collapseOne_{{$index}}" role="button"
                                               aria-expanded="false" aria-controls="collapseOne_{{$index}}">
                                                {{$title}}
                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_{{$index}}" class="collapse"
                                         aria-labelledby="headingOne_{{$index}}" data-parent="#accordion_{{$rand_number}}" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="card-body" itemprop="text">
                                            {{isset($all_description_fields[$index]) ? $all_description_fields[$index] : ''}}
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
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
<div class="logistic-testimonial-area padding-top-115 padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('logistic_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('logistic_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
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
                            <div class="logistic-single-testimonial-item">
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
<div class="logistic-news-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('logistic_news_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('logistic_news_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
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
                            <div class="single-portfolio-blog-grid logistics-page">
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
                                    <a class="readmore" href="{{route('frontend.blog.single',$data->slug)}}">{{filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}</a>
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