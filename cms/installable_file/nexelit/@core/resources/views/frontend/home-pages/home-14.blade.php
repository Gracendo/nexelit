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

<div class="header-slider-wrapper cdesign-home"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_14_header_background_image',$static_field_data)) !!}
>
    <div class="header-area cdesign-agency-home">
        <div class="right-image-wrap">
            {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_14_header_right_image',$static_field_data)) !!}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="header-inner">
                        <h1 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_title',$static_field_data)}}</h1>
                        <p class="description">{!! filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_description',$static_field_data) !!}</p>
                        <div class="btn-wrapper margin-top-30">
                            @if(!empty(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_text',$static_field_data)))
                                <a href="{{ filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_url',$static_field_data) }}"
                                   class="btn-dagency">{{ filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_text',$static_field_data) }}
                                    <i class="{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_header_area_button_one_icon',$static_field_data)}}"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(!empty(filter_static_option_value('home_page_brand_logo_section_status',$static_field_data)))
    <div class="client-section padding-bottom-70 padding-top-60">
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

@if(!empty(filter_static_option_value('home_page_service_section_status',$static_field_data)))
    <div class="latest-cause-area padding-top-60 padding-bottom-20">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-100 dagency-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_service_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_service_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @php $a=1;@endphp
                @foreach($all_service as $data)
                    <div class="col-lg-4 col-md-6">
                        <div class="single-dagency-service-item">
                            @if($data->icon_type == 'icon' || $data->icon_type == '')
                                <div class="icon style-{{$a }}">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                            @else
                                <div class="img-icon style-{{$a}}">
                                    {!! render_image_markup_by_attachment_id($data->img_icon) !!}
                                </div>
                            @endif
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

@if(!empty(filter_static_option_value('home_page_case_study_section_status',$static_field_data)))
    <div class="dagency-project-area padding-top-60 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center  dagency-home margin-bottom-60">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_project_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_project_area_title',$static_field_data)}}</h2>
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

@if(!empty(filter_static_option_value('home_page_call_to_action_section_status',$static_field_data)))
    <div class="dagency-cta-area padding-120" >
        <div class="right-image-area">
            {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_14_cta_area_right_image',$static_field_data)) !!}
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="cta-area-inner">
                        <div class="left-content-area">
                            <h3 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_title',$static_field_data)}}</h3>
                            <p class="description">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_description',$static_field_data)}}</p>
                        </div>
                        <div class="right-content-area">
                            @if(!empty(filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_button_status',$static_field_data)))
                                <div class="btn-wrapper margin-top-40">
                                    <a href="{{filter_static_option_value('home_page_14_cta_area_button_url',$static_field_data)}}"
                                       class="btn-dagency">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_cta_area_button_title',$static_field_data)}}
                                        <i class="{{filter_static_option_value('home_page_14_cta_section_button_icon',$static_field_data)}}"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif

@if(!empty(filter_static_option_value('home_page_work_process_section_status',$static_field_data)))
    <div class="creative-agency-work-process-area padding-top-115 padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_work_process_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_work_process_section_'.$user_select_lang_slug.'_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="cagency-work-process-list">
                        @php
                            $all_icon_fields =  filter_static_option_value('home_page_14_work_process_section_item_number',$static_field_data);
                            $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields) : [];
                            $all_title_fields = filter_static_option_value('home_page_14_work_process_section_item_'.$user_select_lang_slug.'_title',$static_field_data);
                            $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [];
                        @endphp
                        @foreach($all_icon_fields as $number)
                            <li class="single-work-process-item">
                                <div class="num-wrap style-{{$loop->index + 1}}">
                                    <span class="number">{{$number}}</span>
                                </div>
                                <h4 class="title">{{$all_title_fields[$loop->index] ?? ''}}</h4>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_counterup_section_status',$static_field_data)))
    <div class="dcagency-counterup-area padding-top-115 padding-bottom-120"
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_14_counterup_section_background_image',$static_field_data)) !!}
    >
        <div class="container">
            <div class="row">
                @foreach($all_counterup as $data)
                    <div class="col-lg-3 col-md-6">
                        <div class="cagency-counterup-item dagency-home">
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

@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="logistic-testimonial-area padding-top-120 padding-bottom-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_testimonial_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_testimonial_section_title',$static_field_data)}}</h2>
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
                                <div class="cagency-single-testimonial-item dagency-home">
                                    <div class="content">
                                        <i class="fas fa-quote-left"></i>
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

@if(!empty(filter_static_option_value('home_page_latest_news_section_status',$static_field_data)))
    <div class="const-news-area padding-bottom-90 padding-top-115 dagency-bg-color">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_news_area_section_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_news_area_section_title',$static_field_data)}}</h2>
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
                                <div class="single-portfolio-blog-grid dagency-home">
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

@if(!empty(filter_static_option_value('home_page_contact_section_status',$static_field_data)))
    <div class="dagency-news-area padding-bottom-120 padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 dagency-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="contact-form-wrap">
                        <form action="{{route('frontend.get.touch')}}" id="get_in_touch_form" method="post" enctype="multipart/form-data"
                              class="contact-page-form">
                            <div class="error-message"></div>
                            @csrf
                            <input type="hidden" name="captcha_token" id="gcaptcha_token">
                                {!! render_form_field_for_frontend(filter_static_option_value('get_in_touch_form_fields',$static_field_data)) !!}
                                <div class="btn-wrapper">
                                    <button type="submit" id="get_in_touch_submit_btn"
                                            class="boxed-btn">{{filter_static_option_value('home_page_14_'.$user_select_lang_slug.'_contact_area_button_text',$static_field_data)}}</button>
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
                <div class="col-lg-4">
                    <ul class="dagency-info-list">
                        @foreach($all_contact_info as $data)
                            <li class="single-info-list">
                                <div class="icon">
                                    <i class="{{$data->icon}}"></i>
                                </div>
                                <div class="content">
                                    <h5 class="title">{{$data->title}}</h5>
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
