@php
    $home_page_variant =$home_page ?? get_static_option('home_page_variant');
@endphp
<div class="construction-support-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="support-inner">
                    <div class="left-content-wrap">
                        @php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        @endphp
                        <ul class="construction-info-list">
                            @foreach($all_icon_fields as $icon)
                                <li class="construction-single-info-list-item">
                                    <div class="icon">
                                        <i class="{{$icon}}"></i>
                                    </div>
                                    <div class="content">
                                        <span class="subtitle">{{$all_title_fields[$loop->index] ?? ''}}</span>
                                        <h5 class="title">{{$all_details_fields[$loop->index] ?? ''}}</h5>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-content-wrap">
                        <ul>
                            @if(auth()->check())
                                @php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                @endphp
                                <li><a href="{{$route}}">{{__('Dashboard')}}</a> <span>/</span>
                                    <a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a
                                            href="{{route('user.register')}}">{{__('Register')}}</a></li>
                            @endif
                            @if(!empty(filter_static_option_value('language_select_option',$static_field_data)))
                                <li>
                                    <select id="langchange">
                                        @foreach($all_language as $lang)
                                            <option @if($user_select_lang_slug == $lang->slug) selected
                                                    @endif value="{{$lang->slug}}"
                                                    class="lang-option">{{explode('(',$lang->name)[0] ?? $lang->name}}</option>
                                        @endforeach
                                    </select>
                                </li>
                            @endif
                            @if(!empty(filter_static_option_value('navbar_button',$static_field_data)))
                                <li>
                                    @php
                                        $custom_url = filter_static_option_value('navbar_button_custom_url_status',$static_field_data) ?? route('frontend.request.quote');
                                    @endphp
                                    <div class="btn-wrapper">
                                        <a href="{{$custom_url}}" rel="canonical"
                                           @if(!empty(filter_static_option_value('navbar_button_custom_url_status',$static_field_data))) target="_blank"
                                           @endif class="boxed-btn reverse-color">{{filter_static_option_value('navbar_'.$user_select_lang_slug.'_button_text',$static_field_data)}}</a>
                                    </div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
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
    <div class="header-area style-04 header-bg-04 construction-home"
            {!! render_background_image_markup_by_attachment_id(filter_static_option_value('construction_header_section_bg_image',$static_field_data)) !!}
    >
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner construction-home">
                        <h1 class="title">{{filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h1>
                        <p class="description">{{filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_description',$static_field_data)}}</p>
                        <div class="btn-wrapper">
                            @if(!empty(filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)))
                                <a href="{{filter_static_option_value('construction_header_section_button_one_url',$static_field_data)}}"
                                   class="industry-btn construciton-home">{{filter_static_option_value('construction_header_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)}}
                                    <i class="{{filter_static_option_value('construction_header_section_button_one_icon',$static_field_data)}}"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
    <div class="construction-about-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        <div class="shape">
                            <img src="{{asset('assets/frontend/img/shape/12.png')}}" alt="">
                        </div>
                        <div class="construction-video-wrap">
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('construction_about_section_left_image',$static_field_data)) !!}
                            <a class="video-play mfp-iframe"
                               href="{{filter_static_option_value('construction_about_section_video_url',$static_field_data)}}"><i
                                        class="fas fa-play"></i></a>
                            <div class="experience-wrap">
                                <span class="year">{{filter_static_option_value('construction_about_section_experience_year',$static_field_data)}}</span>
                                <h5 class="title">{{filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_experience_year_title',$static_field_data)}}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle">{{filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                        <div class="description">{!! filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper">
                            @if(!empty(filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)))
                                <a href="{{filter_static_option_value('construction_about_section_button_one_url',$static_field_data)}}"
                                   class="industry-btn const-home-color">{{filter_static_option_value('construction_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)}}
                                    <i class="{{filter_static_option_value('construction_about_section_button_one_icon',$static_field_data)}}"></i></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="construction-counterup-area padding-top-115 padding-bottom-115">
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="construction-counterup-item">
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
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="construction-what-we-offer-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle">{{filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="construction-single-what-we-cover-item margin-bottom-30">
                            @if($data->icon_type == 'icon' || $data->icon_type == '')
                                <div class="icon">
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
                                <a href="{{route('frontend.services.single', $data->slug)}}"
                                   class="readmore">{{filter_static_option_value('construction_what_we_offer_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_quote_faq_section_status',$static_field_data)))
<div class="construction-quote-area padding-100"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('construction_quote_section_bg_image',$static_field_data)) !!}
>
    <div class="right-image">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('construction_quote_section_right_image',$static_field_data)) !!}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="section-title margin-bottom-60 white const-home-color">
                    <span class="subtitle">{{filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
                <div class="construction-home-quote-form">
                    @include('backend.partials.message')
                    @include('backend.partials.error')
                    <form action="{{route('frontend.quote.message')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="captcha_token" id="gcaptcha_token">
                        {!! render_form_field_for_frontend(filter_static_option_value('quote_page_form_fields',$static_field_data)) !!}
                        <div class="btn-wrapper margin-top-40">
                            <button class="industry-btn const-home-color" type="submit"> {{filter_static_option_value('construction_quote_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}} <i class="{{filter_static_option_value('construction_quote_section__button_icon',$static_field_data)}}"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="logistic-project-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-title margin-bottom-60 const-home-color">
                        <span class="subtitle">{{filter_static_option_value('construction_project_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_project_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="construction-project-nav"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="case-studies-masonry-wrapper construction-case-study-carousel global-carousel-init"
                    data-loop="true"
                    data-desktopitem="1"
                    data-mobileitem="1"
                    data-tabletitem="1"
                    data-nav="true"
                    data-dots="false"
                    data-autoplay="true"
                    data-navcontainer=".construction-project-nav"
                    data-stagepadding="200"
                    data-margin="30"
                    >
                        @foreach($all_work as $data)
                            <div class="const-single-case-study-style-02">
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
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_team_member_section_status',$static_field_data)))
    <div class="const-team-member-area padding-top-115 padding-bottom-120 industry-section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle">{{filter_static_option_value('construction_team_member_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_team_member_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="team-member-carousel-area margin-top-10 ">
                        <div class="industry-member-carousel global-carousel-init logistic-dots const-page"
                             data-loop="true"
                             data-desktopitem="4"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-stagepadding="0"
                             data-margin="30"
                             >
                            @foreach($all_team_members as $data)
                                <div class="const-team-single-item">
                                    <div class="thumb">
                                        {!! render_image_markup_by_attachment_id($data->image) !!}
                                    </div>
                                    <div class="content">
                                        <h4 class="title">{{$data->name}}</h4>
                                        <span>{{$data->designation}}</span>
                                        @php
                                            $social_fields = array(
                                                'icon_one' => 'icon_one_url',
                                                'icon_two' => 'icon_two_url',
                                                'icon_three' => 'icon_three_url',
                                            );
                                        @endphp
                                        <ul class="social-icons">
                                            @foreach($social_fields as $key => $value)
                                                <li><a rel="canonical" href="{{$data->$value}}"><i class="{{$data->$key}}"></i></a></li>
                                            @endforeach
                                        </ul>
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
    <div class="const-testimonial-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle">{{filter_static_option_value('construction_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 logistic-dots const-page">
                        <div class="global-carousel-init"
                             data-loop="true"
                             data-desktopitem="3"
                             data-mobileitem="1"
                             data-tabletitem="2"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            @foreach($all_testimonial as $data)
                                <div class="const-single-testimonial-item">
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
@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data,$static_field_data)))
    <div class="const-news-area padding-bottom-120 industry-section-bg padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 const-home-color">
                        <span class="subtitle">{{filter_static_option_value('construction_news_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data,$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('construction_news_area_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-grid-carosel-wrapper">
                            <div class="global-carousel-init logistic-dots const-page"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-dots="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            @foreach($all_blog as $data )
                                <div class="single-portfolio-blog-grid const-page">
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
                                        <a class="readmore"
                                           href="{{route('frontend.blog.single',$data->slug)}}">{{filter_static_option_value('portfolio_news_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}</a>
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
    <div class="client-section padding-bottom-70 padding-top-70">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                            <div class="client-active-area global-carousel-init logistic-dots const-page"
                                 data-loop="true"
                                 data-desktopitem="5"
                                 data-mobileitem="1"
                                 data-tabletitem="3"
                                 data-dots="true"
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
