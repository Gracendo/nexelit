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
    <div class="header-slider-one global-carousel-init"
         data-loop="true"
         data-desktopitem="1"
         data-mobileitem="1"
         data-tabletitem="1"
         data-nav="true"
         data-autoplay="true"
         data-margin="0"
    >
        @php
            $all_bg_image_fields =  filter_static_option_value('home_page_10_header_section_bg_image',$static_field_data);
            $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields,['class' => false]) : [];
            $all_button_one_url_fields =  filter_static_option_value('home_page_10_header_section_button_one_url',$static_field_data);
            $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields,['class' => false]) : [];
            $all_button_two_url_fields =  filter_static_option_value('home_page_10_header_section_button_two_url',$static_field_data);
            $all_button_two_url_fields = !empty($all_button_two_url_fields) ? unserialize($all_button_two_url_fields,['class' => false]) : [];
            $all_description_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
            $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
            $all_btn_one_text_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
            $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : [];
            $all_btn_two_text_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_button_two_text',$static_field_data);
            $all_btn_two_text_fields = !empty($all_btn_two_text_fields) ? unserialize($all_btn_two_text_fields,['class' => false]) : [];
            $all_title_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
            $all_subtitle_fields = filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_header_section_subtitle',$static_field_data);
            $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
        @endphp
        @foreach($all_bg_image_fields as $index => $image)
        <div class="header-area lawyer-home"
                {!! render_background_image_markup_by_attachment_id($image) !!}
        >
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="header-inner">
                            <span class="subtitle">{{$all_subtitle_fields[$index] ?? ''}}</span>
                            <h1 class="title">{{$all_title_fields[$index] ?? ''}}</h1>
                            <p class="description">{{$all_description_fields[$index] ?? ''}}</p>
                            <div class="btn-wrapper margint-top-30">
                                @if(!empty($all_button_one_url_fields[$index]))
                                    <a href="{{$all_button_one_url_fields[$index] ?? ''}}" class="boxed-btn laywer">{{$all_btn_one_text_fields[$index] ?? ''}}</a>
                                @endif
                                    @if(!empty($all_button_two_url_fields[$index]))
                                        <a href="{{$all_button_two_url_fields[$index] ?? ''}}" class="boxed-btn laywer blank">{{$all_btn_two_text_fields[$index] ?? ''}}</a>
                                    @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       @endforeach
    </div>
</div>
@if(!empty(filter_static_option_value('home_page_key_feature_section_status',$static_field_data)))
<div class="header-button-area">
    <div class="container">
        <div class="row">
            @php
                $all_button_one_icon_fields =  filter_static_option_value('home_page_10_key_features_section_icon',$static_field_data);
                $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields,['class' => false]) : [];
                $all_description_fields = get_static_option('home_page_10_'.$user_select_lang_slug.'_key_feeatures_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $all_title_fields = get_static_option('home_page_10_'.$user_select_lang_slug.'_key_features_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
            @endphp
            @foreach($all_button_one_icon_fields as $index => $icon)
            <div class="col-lg-4 col-md-6">
                <div class="header-bottom-item-lawyer">
                    <div class="icon">
                        <i class="{{$icon}}"></i>
                    </div>
                    <h3 class="title">{{$all_title_fields[$index] ?? ''}}</h3>
                    <p>{{$all_description_fields[$index] ?? ''}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_about_us_section_status',$static_field_data)))
    <div class="lawyer-about-area lawyer-home padding-top-115 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area">
                        {!! render_image_markup_by_attachment_id(filter_static_option_value('lawyer_about_section_left_top_image',$static_field_data)) !!}
                        <div class="shape">
                            {!! render_image_markup_by_attachment_id(filter_static_option_value('lawyer_about_section_left_bottom_image',$static_field_data)) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area">
                        <span class="subtitle">{{filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                        <div class="description">{!! filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper">
                            @if(!empty(filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)))
                                <a href="{{filter_static_option_value('lawyer_about_section_button_url',$static_field_data)}}"
                                   class="boxed-btn lawyer-home">
                                    {{filter_static_option_value('lawyer_about_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="lawyer-what-we-offer-area padding-top-120 industry-section-bg padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="construction-single-what-we-cover-item lawyer-home margin-bottom-30">
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
                                   class="readmore">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_service_area_readmore_text',$static_field_data)}}
                                    <i class="fas fa-long-arrow-alt-right"></i></a>
                            </div>
                        </div>
                    </div>
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
                        <span class="subtitle">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_appointment_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_appointment_section_title',$static_field_data)}}</h2>
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
                                <div class="appointment-single-item lawyyer-home">
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
                                            <span class="location"><i class="fas fa-map-marker-alt"></i>{{$data->lang_front->location}}</span>
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


@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="logistic-project-area">
        <div class="case-studies-masonry-wrapper global-carousel-init"
             data-loop="true"
             data-desktopitem="4"
             data-mobileitem="1"
             data-tabletitem="2"
             data-nav="false"
             data-dots="true"
             data-autoplay="true"
             data-margin="0"
        >
            @foreach($all_work as $data)
                <div class="const-single-case-study-style-02 lawyer-home">
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

@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="lawyer-counterup-area padding-top-115 padding-bottom-115"
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_10_counterup_section_background_image',$static_field_data)) !!}
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



@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="const-testimonial-area padding-top-115 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="testimonial-carousel-area margin-top-10 logistic-dots lawyer-home">
                        <div class="global-carousel-init"
                             data-loop="true"
                             data-desktopitem="1"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="0"
                        >
                            @foreach($all_testimonial as $data)
                                <div class="lawyer-single-testimonial-item">
                                    <div class="thumb ">
                                        {!! render_image_markup_by_attachment_id($data->image) !!}
                                    </div>
                                    <div class="content">
                                        <p class="description ">{{$data->description}}</p>
                                    </div>
                                    <div class="author-details ">
                                        <i class="fas fa-quote-left"></i>
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
                    <div class="section-title desktop-center margin-bottom-60 lawyer-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_new_area_subtitle',$static_field_data,$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_new_area_title',$static_field_data)}}</h2>
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
                                <div class="single-portfolio-blog-grid lawyer-home">
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

@if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)))
<section class="lawyer-call-to-action padding-top-120 padding-bottom-120"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_10_cta_area_background_image',$static_field_data)) !!}
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="inner-wrap">
                    <h3 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)}}</h3>
                    <p>{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_description',$static_field_data)}}</p>
                    @if (!empty(filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data)))
                    <div class="btn-wrapper">
                        <a href="{{filter_static_option_value('home_page_10_cta_area_button_url',$static_field_data)}}" class="boxed-btn lawyer-home">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)}}</a>
                    </div>
                    @endif 
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@if(!empty(filter_static_option_value('home_page_contact_section_status',$static_field_data)))
<div class="lawyer-contact-area padding-top-120 padding-bottom-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="left-contnet-wrap">
                    <ul class="lawyer-contact-list">
                        @foreach($all_contact_info as $data)
                        <li class="lawyer-contact-item">
                            <div class="icon">
                                <i class="{{$data->icon}}"></i>
                            </div>
                            <div class="content">
                                <span class="title">{{$data->title}}</span>
                                @php
                                    $info_details = !empty($data->description) ? explode("\n",$data->description) : [];
                                @endphp
                                @foreach($info_details as $item)
                                <span class="details">{{$item}}</span>
                                @endforeach
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="right-content-wrap">
                <h3 class="title">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_contact_area_title',$static_field_data)}}</h3>
                <form action="{{route('frontend.get.touch')}}" id="get_in_touch_form" method="post" enctype="multipart/form-data"
                            class="contact-page-form">
                        <div class="error-message"></div>
                        @csrf
                        <input type="hidden" name="captcha_token" id="gcaptcha_token"/>
                                {!! render_form_field_for_frontend(filter_static_option_value('get_in_touch_form_fields',$static_field_data)) !!}
                        
                        <div class="btn-wrapper">
                            <button type="submit" id="get_in_touch_submit_btn"
                                    class="boxed-btn lawyer-page">{{filter_static_option_value('home_page_10_'.$user_select_lang_slug.'_contact_area_button_title',$static_field_data)}}</button>
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
                    url: "{{route('frontend.get.touch')}}",
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
                        console.log(data);
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
