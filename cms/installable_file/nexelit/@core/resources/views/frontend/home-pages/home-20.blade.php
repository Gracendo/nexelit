@php
   $rtl_condition = get_user_lang_direction() == 'rtl' ? 'true' : 'false';
@endphp

<div class="header-style-03 home-20 header-variant-20">
    <nav class="navbar navbar-area navbar-expand-lg">
        <div class="container container-two nav-container">
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
                <a href="javascript:void(0)" class="click-content-show">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                <ul class="navbar-nav">
                    {!! render_frontend_menu($primary_menu) !!}
                </ul>
            </div>
            <div class="nav-right-content right-contents-show">
                <div class="date-search-contents-wrapper">
                    <div class="date-content-area">
                        @if(!empty(get_static_option('navbar_search_icon_status')))
                            <div class="single-icon search-open" id="search">
                                <span class="icon"> <i class="fas fa-search"></i> </span>
                            </div>
                        @endif
{{--                        <div class="single-search">--}}
{{--                            <div class="single-icon search-open">--}}
{{--                                <span class="icon"> <i class="fas fa-search"></i> </span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="single-date">
                            <span id="current-date" class="update-date">{{\Carbon\Carbon::today()->format('D,d M Y')}}</span>
                        </div>
                    </div>
                    <!-- SearcBar -->

                    <div class="search-bar">
                        <form class="menu-search-form" action="#">
                            <div class="search-close"> <i class="fas fa-times"></i> </div>
                            <input class="item-search" type="text" placeholder="{{__('Search Here.....')}}">
                            <button type="submit"> <i class="fas fa-search"></i> </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</div>

<div class="header-bottom home-20 padding-top-30">
    <div class="container container-two">
        <div class="header-bottom-list">
            <div class="updated-news-top">
                <span class="update-news">{{filter_static_option_value('home_20_breaking_news_section_'.$user_select_lang_slug.'_title',$static_field_data)}} </span>
            </div>
            <div class="news-list-all">
                <ul class="news-lists">
                    @foreach($breaking_news as $news)
                        <li class="list">
                            <a href="{{route('frontend.blog.single', $news->slug)}}"> {{$news->title}} </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Banner area Starts -->

<!-- Left area starts -->
<div class="left-area-01 home-20">
    <div class="container container-two">
        <div class="row flex-xl-row-reverse justify-content-center">
            <div class="col-xl-8 col-lg-12">
                <div class="header-slider-outer padding-top-40 padding-bottom-50">
                    <div class="banner-slider global-slick-init nav-style-banner"
                         data-infinite="true" data-rtl="{{$rtl_condition}}" data-arrows="true" data-dots="false"
                         data-autoplaySpeed="3000" data-autoplay="true" data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>'
                         data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>'>

                        @foreach($header_slider_item as $slider_item)
                            <div class="single-slider">
                                <div class="banner-contents-wrapper">
                                    <div class="banner-thumbs">
                                        {!! render_image_markup_by_attachment_id($slider_item->image) !!}
                                    </div>
                                    <div class="banner-contents">
                                        <div class="tag-title-contents padding-bottom-20">
                                            {!! get_blog_category_by_id($slider_item->blog_categories_id,'link','tag-title') !!}
                                            <span class="banner-dates"> {{$slider_item->created_at->format('d M Y')}}</span>
                                        </div>
                                        <h2 class="banner-title"><a href="#">{{$slider_item->title}}</a></h2>
                                        <div class="btn-wrapper">
                                            <a href="{{route('frontend.blog.single',$slider_item->slug)}}" class="cmn-btn"> {{filter_static_option_value('home_20_header_section_'.$user_select_lang_slug.'_readmore_text',$static_field_data)}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Banner-ads starts -->
                <div class="banner-ads-area home-20 padding-top-50 padding-bottom-50 wow animated zoomIn" data-wow-delay=".3s">
                    <div class="single-banner-ads center-text home_advertisement">
                        <input type="hidden" id="add_id" value="{{$add_id}}">
                        {!! $advertisement_markup !!}
                    </div>
                </div>

                <!-- Banner-ads ends -->
                <!-- news area starts -->
                <section class="news-area home-20 padding-top-45 padding-bottom-45">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-12">
                            <div class="section-title-20">
                                <h4 class="title"> {{filter_static_option_value('home20_popular_news_section_'.$user_select_lang_slug.'_section_title',$static_field_data)}} </h4>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-12">
                            <div class="news-list">
                                <ul class="news-button-list" id="puplar_category_item_section_by_ajax">
                                    @foreach($popular_categories as $cat)
                                        <li data-catid="{{$cat->id}}" class="@if($loop->first) active @endif lists" >{{$cat->name}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="imageloaded">
                        <div class="row reverse-10" id="popular-category-item-append-container">
                            <div class="col-lg-12 popular-category-preloader-wrap d-none">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- news area ends -->
                <!-- Banner-ads starts -->
                <div class="banner-ads-area home-20 padding-top-50 padding-bottom-50 wow animated zoomIn" data-wow-delay=".3s">
                    <div class="single-banner-ads center-text">
                        {!! $advertisement_markup_bottom !!}
                    </div>
                </div>
                <!-- Banner-ads ends -->

                <!-- video area -->
                <section class="video-area home-20 padding-top-45 padding-bottom-45">
                    <div class="section-title-20">

                        <h4 class="title append-nav-one">{{filter_static_option_value('home20_video_news_section_'.$user_select_lang_slug.'_section_title',$static_field_data)}} </h4>
                    </div>
                    <div class="global-slick-init margin-top-40" data-rtl="{{$rtl_condition}}" data-appendArrows=".append-nav-one" data-infinite="true" data-arrows="true" data-dots="false" data-autoplaySpeed="3000" data-autoplay="true"  data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>'
                         data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>'>
                        @foreach($video_news_items as $vd_item)
                            <div class="video-wrapper">
                                <div class="single-videos">
                                    <div class="video-thumbs">
                                        {!! render_image_markup_by_attachment_id($vd_item->image,'large') !!}
                                        <div class="popup-videos">
                                            <a href="{{$vd_item->video_url}}" class="videos-play mfp-iframe"> <i class="fas fa-play"></i> </a>
                                        </div>
                                    </div>
                                    <div class="video-contents">
                                        <h2 class="video-title"> <a href="{{route('frontend.blog.single',$slider_item->slug)}}">{{$vd_item->title}}</a> </h2>
                                        <div class="tag-title-contents margin-top-20">
                                            {!! get_blog_category_by_id($slider_item->blog_categories_id,'link','tag-title') !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
                <!-- Video Area ends -->
            </div>
            <div class="col-xl-4 col-lg-6">
                <div class="right-side-area padding-top-50 padding-bottom-50">
                    {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('newspaper_homepage_sidebar',['column' => false]) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Left area end -->

<!-- sports area starts -->
<section class="sports-area home-20 padding-bottom-45 padding-top-50">
    <div class="container container-two">
        <div class="section-title-20">
            <h4 class="title append-nav-two"> {{filter_static_option_value('home20_sports_news_section_'.$user_select_lang_slug.'_section_title',$static_field_data)}} </h4>
        </div>
        <div class="margin-top-40 global-slick-init slider-inner-margin" data-rtl="{{$rtl_condition}}" data-appendArrows=".append-nav-two" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
             data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"slidesToShow": 1}}]'>

            @foreach($sports_news_item as $sport_news)
                <div class="slick-slide">
                    <div class="single-sports">
                        <div class="sports-thumbs">
                            {!! render_image_markup_by_attachment_id($sport_news->image,'grid') !!}
                        </div>
                        <div class="sports-contents">
                            <div class="tag-title-contents padding-bottom-10">
                                {!! get_blog_category_by_id($sport_news->blog_categories_id,'link','tag-title') !!}
                                <span class="banner-dates"> {{$sport_news->created_at->format('d M Y')}}</span>
                            </div>
                            <h4 class="sports-title"> <a href="{{route('frontend.blog.single',$sport_news->slug)}}">{{$sport_news->title}}</a> </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>


<!-- sports area end -->
<!-- Topic area starts -->
<section class="topic-area home-20 padding-bottom-90 padding-top-45">
    <div class="container container-two">
        <div class="section-title-20">
            <h4 class="title append-nav-three"> {{filter_static_option_value('home20_hot_news_section_'.$user_select_lang_slug.'_section_title',$static_field_data)}} </h4>
        </div>
        <div class="margin-top-40 global-slick-init slider-inner-margin" data-rtl="{{$rtl_condition}}" data-appendArrows=".append-nav-three" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="3" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
             data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"slidesToShow": 1}}]'>
            @foreach($hot_news_item as $hot_news)
            <div class="slick-slide">
                <div class="single-topics">
                    <div class="topics-thumbs">
                        {!! render_image_markup_by_attachment_id($hot_news->image,'grid') !!}
                    </div>
                    <div class="topics-contents">
                        <span class="global-dates mb-3">  {{$hot_news->created_at->format('d M Y')}}</span>
                        <div class="tag-title-contents padding-bottom-10">
                            {!! get_blog_category_by_id($hot_news->blog_categories_id,'link','tag-title') !!}
                        </div>
                        <h4 class="topics-title"> <a href="{{route('frontend.blog.single',$hot_news->slug)}}">{{$hot_news->title}}</a> </h4>
                        <p class="topic-para mt-3"> {{$hot_news->excerpt}} </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!-- Topic area end -->

@section('scripts')
    <script>
        $(document).ready(function (){

            $(document).on('click','#puplar_category_item_section_by_ajax li',function (e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                fetchPopularCategoryItemById($(this).data('catid'));
            });
            fetchPopularCategoryItemById($('#puplar_category_item_section_by_ajax li.active').data('catid'));
            function fetchPopularCategoryItemById(catid){
                let preloaderContainer = $('#popular-category-item-append-container').find('.popular-category-preloader-wrap');
                $.ajax({
                    url: "{{route('frontend.popular.item.by.category')}}",
                    type: 'POST',
                    beforeSend:function(){
                        let markup = ` <div class="col-lg-12 popular-category-preloader-wrap">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                        $('#popular-category-item-append-container').html(markup);
                    },
                    data: {
                        _token: "{{csrf_token()}}",
                        catid: catid
                    },
                    success: function (data){

                        console.log(data)
                        //append data
                        let markup = ` <div class="col-lg-12 popular-category-preloader-wrap d-none">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                        markup += data;
                        //
                        $('#popular-category-item-append-container').html(markup);
                        preloaderContainer.addClass('d-none');
                    }
                });
            }

        });

    </script>
@endsection