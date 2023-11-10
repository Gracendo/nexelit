
@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
@endphp
<div class="navbar-variant-03">
<div class="industry-support-wrap">
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-lg-9">
                <div class="industry-support-inner-wrap">
                    <div class="left-content">
                        @php
                            $all_icon_fields =  filter_static_option_value('home_page_07_topbar_section_info_item_icon',$static_field_data);
                            $all_icon_fields =  !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                            $all_details_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_topbar_section_info_item_details',$static_field_data);
                            $all_details_fields = !empty($all_details_fields) ? unserialize($all_details_fields) : [];
                        @endphp
                        <ul class="industry-info-items">
                            @foreach($all_icon_fields as $icon)
                            <li class="industry-single-info-item">
                                <div class="icon">
                                    <i class="{{$icon}}"></i>
                                </div>
                                <div class="content">
                                    <h4 class="title">{{$all_title_fields[$loop->index] ?? ''}}</h4>
                                    <span class="details">{{$all_details_fields[$loop->index] ?? ''}}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="right-content">
                        <ul class="industry-top-right-list">
                            @if(auth()->check())
                                @php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                @endphp
                                <li><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>
                                    <a href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('userlogout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="userlogout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a href="{{route('user.register')}}">{{__('Register')}}</a></li>
                            @endif
                            @if(!empty(get_static_option('language_select_option')))
                                <li>
                                    <select id="langchange">
                                        @foreach($all_language as $lang)
                                            <option @if($user_select_lang_slug == $lang->slug) selected @endif value="{{$lang->slug}}" class="lang-option">{{explode('(',$lang->name)[0] ?? $lang->name}}</option>
                                        @endforeach
                                    </select>
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
</div>
    <div class="header-slider-one global-carousel-init logistic-dots"
         data-loop="true"
         data-desktopitem="1"
         data-mobileitem="1"
         data-tabletitem="1"
         data-nav="true"
         data-autoplay="true"
    >
    @php
        $all_bg_image_fields =  filter_static_option_value('home_page_07_header_section_bg_image',$static_field_data);
        $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields) : [];
        $all_button_one_url_fields =  filter_static_option_value('home_page_07_header_section_button_one_url',$static_field_data);
        $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields) : [];

        $all_button_one_icon_fields =  filter_static_option_value('home_page_07_header_section_button_one_icon',$static_field_data);
        $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields) : [];

        $all_description_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
        $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields) : [];
        $all_btn_one_text_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
        $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields) : [];
        $all_title_fields = filter_static_option_value('home_page_07_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
    @endphp
    @foreach($all_bg_image_fields as $index => $image_field)
        <div class="header-area style-04 header-bg-04 industry-home"
                {!! render_background_image_markup_by_attachment_id($image_field) !!}
        >
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="header-inner industry-home">
                            @if(isset($all_title_fields[$index]))
                                <h1 class="title">{{$all_title_fields[$index]}}</h1>
                            @endif
                            @if(isset($all_description_fields[$index]))
                                <p class="description">{{$all_description_fields[$index]}}</p>
                            @endif
                            @if(isset($all_btn_one_text_fields[$index]) || isset($all_btn_two_text_fields[$index]))
                                <div class="btn-wrapper">
                                    @if(isset($all_btn_one_text_fields[$index]))
                                    <a href="{{$all_button_one_url_fields[$index] ?? ''}}" class="industry-btn">{{$all_btn_one_text_fields[$index]}} <i class="{{$all_button_one_icon_fields[$index] ?? ''}}"></i></a>
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
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
<div class="industry-about-area padding-top-115 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-content-wrap">
                    <img src="{{asset('assets/frontend/img/shape/07.png')}}" class="shape" alt="about">
                    <div class="vertical-image">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('industry_about_section_left_image',$static_field_data),'','full') !!}
                    </div>
                    <div class="industry-video-wrap">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('industry_about_section_video_background_image',$static_field_data),'','full') !!}
                        <div class="hover">
                            <a href="{{filter_static_option_value('industry_about_section_video_url',$static_field_data)}}" class="mfp-iframe  vdo-btn"><i class="fas fa-play"></i></a>
                        </div>
                        <div class="experience">
                            <span class="year">{{filter_static_option_value('industry_about_section_experience_year',$static_field_data)}}</span>
                            <h4 class="title">{{filter_static_option_value('industry_about_section_'.$user_select_lang_slug.'_experience_year_title',$static_field_data)}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-area margin-top-40">
                    <span class="subtitle">{{filter_static_option_value('industry_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h4 class="title">{{filter_static_option_value('industry_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h4>
                    <div class="description">{!! filter_static_option_value('industry_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                    <div class="btn-wrapper">
                        <a href="{{filter_static_option_value('industry_about_section_button_one_url',$static_field_data)}}" class="industry-btn black">{{filter_static_option_value('industry_about_section_'.$user_select_lang_slug.'_button_one_text',$static_field_data)}} <i class="{{filter_static_option_value('industry_about_section_button_one_icon',$static_field_data)}}"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
<div class="industry-what-we-offer-area padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 industry-home">
                    <span class="subtitle">{{filter_static_option_value('industry_what_we_offer_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('industry_what_we_offer_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($all_service as $data)
                <div class="col-lg-4 col-md-6">
                    <div class="industry-single-what-we-cover-item margin-bottom-30">
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
                            <h4 class="title"><a href="{{route('frontend.services.single', $data->slug)}}">{{$data->title}}</a></h4>
                            <p>{{$data->excerpt}}</p>
                            <a href="{{route('frontend.services.single', $data->slug)}}" class="readmore">{{filter_static_option_value('industry_what_we_offer_section_'.$user_select_lang_slug.'_readmore_text',$static_field_data)}} <i class="fas fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
<div class="industry-counterup-area bg-overlay padding-top-115 padding-bottom-115"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('industry_counterup_section_background_image',$static_field_data)) !!}
>
    <div class="container">
        <div class="row">
            @foreach($all_counterup as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="industry-counterup-item">
                        <div class="count-wrap"><span class="count-num">{{$data->number}}</span>{{$data->extra_text}}</div>
                        <h4 class="title">{{$data->title}}</h4>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
<div class="industry-project-area padding-top-115 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="section-title margin-bottom-60 industry-home">
                    <span class="subtitle">{{filter_static_option_value('industry_project_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('industry_project_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="project-carousel-nav"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <div class="global-carousel-init logistic-dots"
                         data-loop="true"
                         data-desktopitem="2"
                         data-mobileitem="1"
                         data-tabletitem="1"
                         data-dots="true"
                         data-nav="true"
                         data-autoplay="true"
                         data-margin="30"
                         data-navcontainer=".project-carousel-nav"
                    >
                    @foreach($all_work as $data)
                        <div class="industry-single-case-studies-item">
                            <div class="thumb">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                <div class="content">
                                    <div class="cat">
                                        @php
                                           $category_list = get_work_category_by_id($data->id);
                                        @endphp
                                        @foreach($category_list as $cat_id => $cat_name)
                                        <a href="{{route('frontend.works.category',['id' => $cat_id ,'any' => Str::slug($cat_name)])}}">{{$cat_name}}</a>
                                        @endforeach
                                    </div>
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
@endif

@if(!empty(filter_static_option_value('home_page_team_member_section_status',$static_field_data)))
    <div class="industry-team-member-area padding-top-115 padding-bottom-120 industry-section-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 industry-home">
                        <span class="subtitle">{{filter_static_option_value('industry_team_member_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('industry_team_member_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="team-member-carousel-area margin-top-10 logistic-dots">
                            <div class="global-carousel-init logistic-dots"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-dots="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            @foreach($all_team_members as $data)
                                <div class="industry-team-single-item">
                                    <div class="tumb">
                                        {!! render_image_markup_by_attachment_id($data->image) !!}
                                    </div>
                                    <div class="content">
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
                                        <h4 class="title">{{$data->name}}</h4>
                                        <span>{{$data->designation}}</span>
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
<div class="industry-testimonial-area padding-top-115 padding-bottom-120 ">
    <div class="container">
        <div class="row justify-content-center">
               <div class="col-lg-10">
                   <div class="row">
                       <div class="col-xl-8 col-lg-12">
                           <div class="section-title margin-bottom-60 industry-home">
                               <span class="subtitle">{{filter_static_option_value('industry_testimonial_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                               <h2 class="title">{{filter_static_option_value('industry_testimonial_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                           </div>
                       </div>
                       <div class="col-lg-4">
                           <div class="industry-testimonial-carousel-nav"></div>
                       </div>
                   </div>
               </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="testimonial-carousel-area margin-top-10">
                    <div class="global-carousel-init logistic-dots"
                         data-loop="true"
                         data-desktopitem="1"
                         data-mobileitem="1"
                         data-tabletitem="1"
                         data-dots="true"
                         data-nav="true"
                         data-autoplay="true"
                         data-margin="30"
                         data-navcontainer=".industry-testimonial-carousel-nav"
                    >
                        @foreach($all_testimonial as $data)
                            <div class="industry-single-testimonial-item">
                                <div class="content">
                                    <i class="fas fa-quote-left"></i>
                                    <p class="description ">{{$data->description}}</p>
                                </div>
                                <div class="thumb ">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                    <div class="author-details ">
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
<div class="industry-news-area padding-top-115 padding-bottom-120 industry-section-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 industry-home">
                    <span class="subtitle">{{filter_static_option_value('industry_news_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('industry_news_area_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
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
                            <div class="single-portfolio-blog-grid industry-page">
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
@if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data)))
    <div class="client-section padding-bottom-70 padding-top-85">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init logistic-dots"
                                 data-loop="true"
                                 data-desktopitem="5"
                                 data-mobileitem="1"
                                 data-tabletitem="3"
                                 data-dots="true"
                                 data-autoplay="true"
                                 data-margin="60"
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