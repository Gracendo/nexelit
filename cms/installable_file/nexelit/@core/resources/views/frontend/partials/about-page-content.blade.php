@if(!empty(get_static_option('about_page_about_us_section_status')))
    <section class="top-experience-area padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="experience-author padding-bottom-100">
                        <div class="thumb-1">
                            {!! render_image_markup_by_attachment_id(get_static_option('about_page_image_one')) !!}
                        </div>
                        <div class="thumb-2">
                            {!! render_image_markup_by_attachment_id(get_static_option('about_page_image_two')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 offset-lg-1 p-0">
                    <div class="experience-content-03">
                        <div class="content">
                            <h2 class="title">{{get_static_option('about_page_'.$user_select_lang_slug.'_about_section_title')}}</h2>
                            <p>{!! get_static_option('about_page_'.$user_select_lang_slug.'_about_section_description') !!}</p>
                            @if(!empty(get_static_option('about_page_'.$user_select_lang_slug.'_about_section_quote_text')))
                                <div class="icon-area">
                                    <div class="icon">
                                        <i class="flaticon-right-quote-1"></i>
                                    </div>
                                    <p>{{get_static_option('about_page_'.$user_select_lang_slug.'_about_section_quote_text')}}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty(get_static_option('about_page_key_feature_section_status')))
    <div class="header-bottom-area padding-bottom-80 padding-top-80">
        <div class="container">
            <div class="row no-gutters">
                @php $a = 1;@endphp
                @foreach($all_key_features as $data)
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="single-header-bottom-item-02">
                            <div class="icon style-0{{$a}}">
                                <i class="{{$data->icon}}"></i>
                            </div>
                            <div class="content">
                                <h4 class="title">{{$data->title}}</h4>
                            </div>
                        </div>
                    </div>
                    @php if($a == 4){$a=1;}else{$a++;} @endphp
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(get_static_option('about_page_global_network_section_status')))
    <div class="global-network-area bg-liteblue padding-bottom-120 padding-top-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="global-content">
                        <h2 class="title">
                            {{get_static_option('about_page_'.$user_select_lang_slug.'_global_network_title')}}
                        </h2>
                        <p>
                            {!! get_static_option('about_page_'.$user_select_lang_slug.'_global_network_description') !!}
                        </p>
                        @if(!empty(get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_status')))
                            <div class="btn-wrapper padding-top-25">
                                <a href="{{get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_url')}}" class="boxed-btn reverse-color">{{get_static_option('about_page_'.$user_select_lang_slug.'_global_network_button_title')}}</a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="map-img">
                        {!! render_image_markup_by_attachment_id(get_static_option('about_page_global_network_image')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@if(!empty(get_static_option('about_page_experience_section_status')))
    <section class="top-experience-area bg-blue">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-6">
                    <div class="experience-right style-01"
                         {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_experience_video_background_image')) !!} 
                    >
                        <div class="vdo-btn">
                            <a class="video-play-btn mfp-iframe" href="{{get_static_option('about_page_'.$user_select_lang_slug.'_experience_video_url')}}"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="experience-content-02">
                        <h2 class="title">{{get_static_option('about_page_'.$user_select_lang_slug.'_experience_title')}}</h2>
                        <p>{!! get_static_option('about_page_'.$user_select_lang_slug.'_experience_description') !!}</p>
                        <div class="sign-area">
                            <p>{!! get_static_option('about_page_'.$user_select_lang_slug.'_quote_text') !!}</p>
                            <div class="sing-img padding-top-10">
                                {!! render_image_markup_by_attachment_id(get_static_option('about_page_experience_signature_image')) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty(get_static_option('about_page_team_member_section_status')))
    <section class="creative-team-two padding-top-110 padding-bottom-110">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="section-title desktop-center padding-bottom-55">
                        <h3 class="title">{{get_static_option('about_page_'.$user_select_lang_slug.'_team_member_section_title')}}</h3>
                        <p>{{get_static_option('about_page_'.$user_select_lang_slug.'_team_member_section_description')}}</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="team-carousel global-carousel-init"
                         data-loop="true"
                         data-desktopitem="4"
                         data-mobileitem="1"
                         data-tabletitem="2"
                         data-autoplay="true"
                         data-margin="30"
                    >
                        @foreach($all_team_members as $data)
                            <div class="team-section team-member-style-01">
                                <div class="team-img-cont">
                                    {!! render_image_markup_by_attachment_id($data->image) !!}
                                    <div class="social-link">
                                        @php
                                            $social_fields = array(
                                                'icon_one' => 'icon_one_url',
                                                'icon_two' => 'icon_two_url',
                                                'icon_three' => 'icon_three_url',
                                            );
                                        @endphp
                                        <ul>
                                            @foreach($social_fields as $key => $value)
                                                <li><a href="{{$data->$value}}"><i class="{{$data->$key}}"></i></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="team-text">
                                    <h4 class="title">{{$data->name}}</h4>
                                    <span>{{$data->designation}}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif
@if(!empty(get_static_option('about_page_testimonial_section_status')))
    <section class="testimonial-area bg-image-01 padding-top-110 padding-bottom-115"
            {!! render_background_image_markup_by_attachment_id(get_static_option('about_page_testimonial_background_image')) !!}
    >
        <div class=" container ">
            <div class="row justify-content-center ">
                <div class="col-lg-8 ">
                    <div class="section-title white desktop-center padding-bottom-20 ">
                        <h2 class="title ">{{get_static_option('about_page_'.$user_select_lang_slug.'_testimonial_title')}}</h2>
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
                             data-margin="0"
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
@if(!empty(get_static_option('about_page_brand_logo_section_status')))
    <div class="client-section padding-bottom-70 padding-top-85">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="client-area">
                        <div class="client-active-area global-carousel-init"
                             data-loop="true"
                             data-desktopitem="5"
                             data-mobileitem="2"
                             data-tabletitem="3"
                             data-autoplay="true"
                             data-margin="80"
                        >
                            @foreach($all_brand_logo as $data)
                                <div class="single-brand">
                                    <div class="img-wrapper">
                                        @if(!empty($data->url) )<a href="{{$data->url}}">@endif
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