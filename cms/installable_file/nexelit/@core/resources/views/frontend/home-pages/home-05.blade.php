@include('frontend.partials.homesupportbar')
@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
@endphp
<div class="header-style-02  header-variant-{{$home_page_variant}}">
    <nav class="navbar navbar-area nav-absolute navbar-expand-lg nav-style-01">
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

<div class="portfolio-home-header-area">
    <div class="shape-01 shape">
        <img src="{{asset('assets/frontend/img/shape/01.png')}}" alt="">
    </div>
    <div class="shape-02 shape">
        <img src="{{asset('assets/frontend/img/shape/02.png')}}" alt="">
    </div>
    <div class="shape-03 shape">
        <img src="{{asset('assets/frontend/img/shape/03.png')}}" alt="">
    </div>
    <div class="shape-04 shape">
        <img src="{{asset('assets/frontend/img/shape/04.png')}}" alt="">
    </div>
    <div class="shape-05 shape">
        <img src="{{asset('assets/frontend/img/shape/05.png')}}" alt="">
    </div>
    <div class="right-image">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('portfolio_home_page_right_image',$static_field_data)) !!}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="header-inner">
                    <span class="subtitle">{{filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h1 class="title">{{filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_title',$static_field_data)}}</h1>
                    <h6 class="profession">{{filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_profession',$static_field_data)}}</h6>
                    <div class="description">{!! filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                    <div class="btn-wrapper margin-top-40">
                        <a href="{{filter_static_option_value('portfolio_home_page_button_url',$static_field_data)}}"
                           class="portfolio-btn">{{filter_static_option_value('portfolio_home_page_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                            <i class="fas fa-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="about-and-coutnerup-area dark-section-bg-two">
    @if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="counterup-area padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="single-counterup-03">
                            <div class="number">{{$data->number}}{{$data->extra_text}}</div>
                            <h4 class="title">{{$data->title}}</h4>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    @if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
    <div class="portfolio-about-us-section padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="img-wrapper">
                            <div class="shape-06">
                                <img src="{{asset('assets/frontend/img/shape/06.png')}}" alt="">
                            </div>
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('portfolio_about_section_left_image',$static_field_data)) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle">{{filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h3 class="title">{{filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h3>
                        <div class="description">
                            {!! filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}
                        </div>
                        <ul class="about-info-list">
                            @php
                                $all_icon_fields =  filter_static_option_value('home_page_05_about_section_icon_box_icon',$static_field_data);
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                                $all_title_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_about_section_icon_box_title',$static_field_data);
                                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            @endphp
                            @if(!empty($all_icon_fields))
                                @foreach($all_icon_fields as $index => $icon)
                                    <li>
                                        <i class="{{$icon}}"></i> {{isset($all_title_fields[$index]) ? $all_title_fields[$index] : ''}}
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                        <div class="button-wrap margin-top-40">
                            <a href="{{filter_static_option_value('portfolio_about_section_button_one_url',$static_field_data)}}"
                               class="portfolio-btn">{{filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)}}
                                <i class="{{filter_static_option_value('portfolio_about_section_button_one_icon',$static_field_data)}}"></i></a>
                            <a href="{{filter_static_option_value('portfolio_about_section_button_two_url',$static_field_data)}}"
                               class="portfolio-btn blank">{{filter_static_option_value('portfolio_about_section_'.$user_select_lang_slug.'_button_two_text',$static_field_data)}}
                                <i class="{{filter_static_option_value('portfolio_about_section_button_two_icon',$static_field_data)}}"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@if(!empty(filter_static_option_value('home_page_expertice_section_status',$static_field_data)))
<div class="expertice-area dark-section-bg-three padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('portfolio_expertice_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('portfolio_expertice_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @php
                $all_icon_fields =  filter_static_option_value('home_page_05_experties_section_skill_box_number',$static_field_data);
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                $all_title_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_experties_section_skill_box_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                $all_subtitle_fields = filter_static_option_value('home_page_05_'.$user_select_lang_slug.'_experties_section_skill_box_subtitle',$static_field_data);
                $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields) : [];
            @endphp
            @if(!empty($all_icon_fields))
                @foreach($all_icon_fields as $index => $icon)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-expertice-area">
                            <span class="number">{{$icon}}%</span>
                            <h4 class="title">{{isset($all_title_fields[$index]) ? $all_title_fields[$index] : ''}}</h4>
                            <span class="category">{{isset($all_subtitle_fields[$index]) ? $all_subtitle_fields[$index] : ''}}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
<div class="what-we-offer-area dark-section-bg-two padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('portfolio_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('portfolio_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($all_service as $data)
            <div class="col-lg-6">
                <div class="single-we-offer-item">
                    @if($data->icon_type == 'icon' || $data->icon_type == '')
                        <div class="icon">
                            <i class="{{$data->icon}}"></i>
                        </div>
                    @else
                        <div class="img-icon">
                            {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                        </div>
                    @endif
                    <div class="content-wrap">
                        <h4 class="title"><a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a></h4>
                        <p>{{$data->excerpt}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
<div class="what-we-offer-area dark-section-bg-three padding-top-115 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="case-studies-masonry-wrapper">
                    <ul class="case-studies-menu white">
                        <li class="active" data-filter="*">{{__('All')}}</li>
                        @foreach($all_work_category as $data)
                            <li data-filter=".{{Str::slug($data->name)}}">{{$data->name}}</li>
                        @endforeach
                    </ul>
                    <div class="case-studies-masonry">
                        @foreach($all_work as $data)
                            <div class="col-lg-4 col-md-4 col-sm-6 masonry-item {{get_work_category_by_id($data->id,'slug')}}">
                                <div class="single-case-studies-item portfolio-home margin-bottom-30">
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
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="{{route('frontend.work')}}" class="portfolio-btn">{{filter_static_option_value('portfolio_recent_work_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)))
<div class="portfolio-cta-area dark-section-bg-two">
    <div class="shape-01 shape">
        <img src="{{asset('assets/frontend/img/shape/01.png')}}" alt="">
    </div>
    <div class="shape-02 shape">
        <img src="{{asset('assets/frontend/img/shape/02.png')}}" alt="">
    </div>
    <div class="shape-03 shape">
        <img src="{{asset('assets/frontend/img/shape/03.png')}}" alt="">
    </div>
    <div class="shape-04 shape">
        <img src="{{asset('assets/frontend/img/shape/04.png')}}" alt="">
    </div>
    <div class="shape-05 shape">
        <img src="{{asset('assets/frontend/img/shape/05.png')}}" alt="">
    </div>
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-lg-8">
                <div class="left-content-wrap">
                    <h4 class="title">{{{filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_title',$static_field_data)}}}</h4>
                    <p class="description">{{{filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_description',$static_field_data)}}}</p>
                    <div class="btn-wrapper">
                        <a href="{{filter_static_option_value('portfolio_cta_section_button_url',$static_field_data)}}" class="portfolio-btn">{{filter_static_option_value('portfolio_cta_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}} <i class="{{filter_static_option_value('portfolio_cta_section_button_icon',$static_field_data)}}"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="right-content-wrap">
                    <div class="img-wrap">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('portfolio_cta_section_right_image',$static_field_data)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
<div class="portfolio-testimonial-area dark-section-bg-three padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('portfolio_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('portfolio_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-12 ">
                <div class="testimonial-carousel-area margin-top-10 ">
                        <div class=" pcarousel-dots global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        @foreach($all_testimonial as $data)
                            <div class="single-portfolio-testimonial-item ">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">{{$data->description}}</p>
                                </div>
                                <div class="author-details ">
                                    <div class="thumb ">
                                        {!! render_image_markup_by_attachment_id($data->image,'','thumb') !!}
                                    </div>
                                    <div class="author-meta ">
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
@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data)))
<div class="portfolio-news-area dark-section-bg-two padding-top-115 padding-bottom-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title white text-center margin-bottom-60">
                    <span class="subtitle">{{filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="blog-grid-carosel-wrapper">
                        <div class=" pcarousel-dots global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                        @foreach($all_blog as $data )
                            <div class="single-portfolio-blog-grid">
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