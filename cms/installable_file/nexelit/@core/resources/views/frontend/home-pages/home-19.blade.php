@php
    $rtl_condition = get_user_lang_direction() == 'rtl' ? 'true' : 'false';
@endphp

<header class="header-style-01">
    <!-- Topbar area Starts -->
    <div class="topbar-area home-19 home-variant-19">
        <div class="container container-one">
            <div class="row justify-content-between align-items-center">
                <div class="col-lg-4 col-sm-6">
                    <div class="topbar-social-list">
                        <ul class="topbar-social">
                            @foreach($all_social_item as $data)
                                <li><a href="{{$data->url}}" rel="canonical"><i class="{{$data->icon}}"></i></a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 d-none d-lg-block">
                    <div class="topbar-logo center-text">
                        <a href="{{url('/')}}" class="logo">
                            {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <div class="lang-contents-wrapper">
                        <ul>
                            @if(auth()->check())
                                @php
                                    $route = auth()->guest() == 'admin' ? route('admin.home') : route('user.home');
                                @endphp
                                <li class="login-register"><a href="{{$route}}">{{__('Dashboard')}}</a>  <span>/</span>
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
                                <li class="login-register"><a href="{{route('user.login')}}">{{__('Login')}}</a> <span>/</span> <a href="{{route('user.register')}}">{{__('Register')}}</a></li>
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
    <!-- Top bar area Ends -->

    <!-- Header area Starts -->
    <div class="header-style-03 home-19 header-variant-19 searchbar-area">
        <nav class="navbar navbar-area navbar-expand-lg">
            <div class="container container-one nav-container">
                <div class="top-menu-category">
                    <div class="top-menu-toggle">
                        <a href="javascript:void(0)" class="single-category-flex bg-color-three radius-5">
                            <h6 class="category-title text-white"> {{__('All Category')}} </h6>
                            <span class="icon-bar text-white fs-18"> <i class="fas fa-bars"></i> </span>
                        </a>
                    </div>
                    <div class="navbar-area-side active">
                        <ul class="navbar-nav-side">

                            @foreach($product_categories_for_sidebar as $category)
                                @php
                                    $category_condition = !empty($category->products) && count($category->products)  > 0 ? 'menu-item-has-children current-menu-item' : '';
                                @endphp
                            <li class="cate-list {{$category_condition}}">
                                <a href="{{route('frontend.products.category',['id' => $category->id,'any' => Str::slug($category->title) ])}}">
                                    <div class="category-menu-inner">
                                        <div class="category-menu-image radius-5">
                                            {!! render_image_markup_by_attachment_id($category->image) !!}
                                        </div>
                                        <div class="category-list">
                                            <h6 class="title"> {{$category->title}}</h6>
                                        </div>
                                    </div>
                                </a>
                                @if(!empty($category->products) && count($category->products) > 0 )
                                <div class="category-megamenu">
                                    @foreach($category->products as $pro)

                                              <div class="single-megamenu">
                                                  <h5 class="submenu-title"> {{optional($pro->subcategory)->title}}</h5>
                                                  <div class="megamenu-product">
                                                      <div class="megamenu-thumbs">
                                                          <a href="{{route('frontend.products.single',$pro->slug)}}">
                                                              {!! render_image_markup_by_attachment_id($pro->image,'','thumb') !!}
                                                          </a>
                                                      </div>
                                                      <div class="megamenu-contents">
                                                          <h4 class="megamenu-title hover-color-three">
                                                              <a href="{{route('frontend.products.single',$pro->slug)}}"> {{$pro->title}} </a>
                                                          </h4>
                                                          <div class="price-updates mt-2">
                                                              <h5 class="price-title"> {{amount_with_currency_symbol($pro->sale_price)}} </h5>
                                                              <span class="old-price"> {{amount_with_currency_symbol($pro->regular_price)}}</span>
                                                          </div>
                                                      </div>
                                                  </div>
                                              </div>
                                     @endforeach
                                </div>
                                @endif
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="navbar-nav-right">
                    <div class="responsive-mobile-menu">
                        <div class="logo-wrapper d-block d-lg-none">
                            <a href="{{url('/')}}" class="logo">
                               {!! render_image_markup_by_attachment_id(get_static_option('site_logo')) !!}
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
                        <div class="right-content-wrapper">
                            <div class="right-icon-list">
                                @if(!empty(get_static_option('navbar_search_icon_status')))
                                    <div class="single-icon search-open" id="search">
                                        <span class="icon"> <i class="fas fa-search"></i> </span>
                                    </div>
                                @endif

                                    @if(!empty(get_static_option('product_module_status')))
                                <div class="single-icon cart">
                                    <a href="{{route('frontend.products.wishlist')}}" class="icon">
                                        <i class="fas fa-heart"></i>
                                        <span class="pcount home-page-21-wishlist-icon-top">
                                               {{\App\Facades\Wishlist::count()}}
                                          </span>
                                    </a>
                                </div>

                                    <div class="single-icon cart">
                                        <a href="{{route('frontend.products.cart')}}" class="icon">
                                            <i class="fas fa-shopping-cart"></i>
                                            <span class="pcount home-page-21-cart-icon-top">
                                                {{\App\Facades\Cart::count()}}
                                            </span>
                                        </a>
                                    </div>
                                @endif
                            </div>

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
            </div>
        </nav>
    </div>
    <!-- Header area ends -->

</header>
<div class="body-overlay"></div>
<div class="body-overlay-desktop"></div>
<!-- Header area end -->
<!-- Banner area Starts -->
<div class="banner-area home-19">
    <div class="container container-one">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="banner-middle-content bg-item-one radius-10">
                    <div class="global-slick-init dot-style-one banner-dots dot-color-three dot-absolute" data-rtl="{{$rtl_condition}}" data-infinite="true" data-arrows="true" data-dots="true" data-autoplaySpeed="3000" data-autoplay="true">
                        @php
                              $all_icon_fields =  get_static_option('home19_header_section_button_url');
                               $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : [];
                               $all_image_fields =  get_static_option('home19_header_section_image');
                               $all_image_fields = !empty($all_image_fields) ? unserialize($all_image_fields,['class' => false]) : [];
                              $all_subtitle_fields = get_static_option('home_19_header_section_'.$user_select_lang_slug.'_subtitle');
                              $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
                              $all_title_fields = get_static_option('home_19_header_section_'.$user_select_lang_slug.'_title');
                              $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                              $all_button_text_fields = get_static_option('home_19_header_section_'.$user_select_lang_slug.'_button_text');
                              $all_button_text_fields = !empty($all_button_text_fields) ? unserialize($all_button_text_fields,['class' => false]) : [];
                        @endphp
                        @foreach($all_icon_fields as $icon_field)
                        <div class="banner-middle-image">
                            <div class="banner-single-thumb">
                                {!! render_image_markup_by_attachment_id($all_image_fields[$loop->index] ?? '') !!}
                            </div>
                            <div class="middle-content">
                                <span class="middle-span fw-500 color-light"> {{$all_subtitle_fields[$loop->index] ?? ''}} </span>
                                <h2 class="banner-middle-title fw-500 mt-3">
                                    @php
                                        $title_text = $all_title_fields[$loop->index] ?? '';
                                        $title_text = str_replace(['{color}','{/color}'],['<span class="color-three">','</span>'],$title_text);
                                    @endphp
                                    {!! $title_text !!}
                                </h2>
                                <div class="btn-wrapper mt-4 mt-lg-5">
                                    <a href="{{$icon_field ?? ''}}" class="cmn-btn btn-bg-3"> {{$all_button_text_fields[$loop->index] ?? ''}}</a>
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
<!-- Banner area end -->
<!-- Deal area Starts -->
<section class="deal-area home-19 padding-top-100 padding-bottom-50">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> {{get_static_option('home_page_19_'.get_user_lang().'_todays_deal_area_title')}} </h2>
                        <span class="hot-deal bg-color-three radius-5"> {{get_static_option('home_page_19_'.get_user_lang().'_todays_deal_area_right_text')}}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="global-slick-init deal-slider nav-style-one nav-color-three dot-style-one dot-color-three slider-inner-margin" data-rtl="{{$rtl_condition}}" data-infinite="false" data-arrows="true" data-dots="false" data-slidesToShow="4" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
                     data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 3}},{"breakpoint": 1200,"settings": {"slidesToShow": 2}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"arrows":false, "dots": true, "slidesToShow": 1}}]'>
                  @php
                      $colors = ['bg-color-stock','bg-color-three'];
                  @endphp
                    @foreach($all_hot_deal_products as $key => $pro)

                    <div class="slick-slider-items wow fadeInDown" data-wow-delay=".2s">
                        <div class="global-card-item center-text border-1 no-shadow radius-10">
                            <div class="global-card-thumb radius-10">
                                <a href="javascript:void(0)">
                                   {!! render_image_markup_by_attachment_id($pro->image,'radius-10') !!}
                                </a>
                                <div class="thumb-top-contents">
                                    @if(!empty($pro->badge))
                                       <span class="percent-box {{$colors[$key % count($colors)]}} radius-5"> {{$pro->badge}} </span>
                                     @endif
                                </div>
                                <ul class="global-thumb-icons">
                                    @if($pro->stock_status === 'out_stock')
                                        <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                                     @else
                                     <li class="lists" data-bs-toggle="tooltip" data-bs-placement="left" title="add to cart">
                                            @if(!empty($pro->variant) && count(json_decode($pro->variant,true)) > 0)
                                                 <a class="icon"
                                                   title="{{__('View Details')}}"
                                                   href="{{route('frontend.products.single',$pro->slug)}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                             @else
                                                <a class="icon cart-loading ajax_add_to_cart_with_icon"
                                                   data-product_id="{{$pro->id}}"
                                                   data-product_title="{{$pro->title}}"
                                                   data-product_quantity="1"
                                                   href="javascript:void(0)">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                    <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="add to wishlist">
                                        <a class="icon cart-loading ajax_add_to_wishlist_with_icon"
                                           data-product_id="{{$pro->id}}"
                                           href="javascript:void(0)"> <i class="fas fa-heart"></i> </a>
                                    </li>
                                    <li class="lists" data-bs-toggle="tooltip" data-bs-placement="top" title="Product Details">
                                        @php
                                            $product_img = get_attachment_image_by_id($pro->image,null,true);
                                            $img_url = $product_img['img_url'];
                                            $product = $pro;
                                            $view = view('frontend.pages.products.product-attribute-passing',compact('product'))->render();
                                        @endphp
                                        <a class="icon today_deal_quick_view"
                                           data-toggle="modal"
                                           data-target="#quick_view"
                                           data-id="{{$pro->id}}"
                                           data-title="{{$pro->title}}"
                                           data-short_description="{{$pro->short_description}}"
                                           data-regular_price="{{amount_with_currency_symbol($pro->regular_price)}}"
                                           data-sale_price="{{amount_with_currency_symbol($pro->sale_price)}}"
                                           data-in_stock="{{str_replace('_',' ', ucfirst($pro->stock_status))}}"
                                           data-category="{{optional($pro->category)->title}}"
                                           data-subcategory="{{optional($pro->subcategory)->title}}"
                                           data-image="{{$img_url}}"
                                           data-attribute="{{$view}}"
                                           href="javascript:void(0)">
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="global-card-contents">
                                <h4 class="common-title hover-color-three"> <a href="{{route('frontend.products.single',$pro->slug)}}"> {{$pro->title}}</a> </h4>
                                <div class="global-card-flex-contents">
                                    <div class="single-global-card">
                                        <div class="global-card-right">
                                            @if(count($pro->ratings) > 0)
                                                {!! ratingMarkup($pro->ratings->avg("ratings"),$pro->ratings_count) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="single-global-card mt-2">
                                        <div class="global-card-left">
                                            <div class="price-update-through">
                                                @if(!get_static_option('display_price_only_for_logged_user'))
                                                    <span class="fs-24 fw-500 ff-rubik flash-prices color-three"> {{$pro->sale_price == 0 ? __('Free') : amount_with_currency_symbol($pro->sale_price)}} </span>
                                                    @if(!empty($pro->regular_price))
                                                      <span class="fs-18 flash-old-prices ff-rubik">{{ amount_with_currency_symbol($pro->regular_price) }}  </span>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Deal area end -->


<!-- Updated area Starts -->
<section class="updated-area home-19 padding-bottom-50">
    <div class="container container-one">
        <div class="row mt-4 pt-1">

            @php
                $all_updated_area_icon_fields =  get_static_option('home19_updated_section_button_url');
                $all_updated_area_icon_fields = !empty($all_updated_area_icon_fields) ? unserialize($all_updated_area_icon_fields,['class' => false]) : [];
                $all_updated_area_image_fields =  get_static_option('home19_updated_section_image');
                $all_updated_area_image_fields = !empty($all_updated_area_image_fields) ? unserialize($all_updated_area_image_fields,['class' => false]) : [];
                $all_updated_area_subtitle_fields = get_static_option('home_19_updated_section_'.$user_select_lang_slug.'_subtitle');
                $all_updated_area_subtitle_fields = !empty($all_updated_area_subtitle_fields) ? unserialize($all_updated_area_subtitle_fields,['class' => false]) : [];
                $all_updated_area_title_fields = get_static_option('home_19_updated_section_'.$user_select_lang_slug.'_title');
                $all_updated_area_title_fields = !empty($all_updated_area_title_fields) ? unserialize($all_updated_area_title_fields,['class' => false]) : [];
                $all_updated_area_button_text_fields = get_static_option('home_19_updated_section_'.$user_select_lang_slug.'_button_text');
                $all_updated_area_button_text_fields = !empty($all_updated_area_button_text_fields) ? unserialize($all_updated_area_button_text_fields,['class' => false]) : [];
            @endphp

            @foreach($all_updated_area_icon_fields as $icon_updated_field)
                <div class="col-xl-4 col-lg-6 col-md-6 mt-4">
                <div class="single-updated radius-10">
                    <div class="updated-image-contents">
                        <div class="updated-flex-contents">
                            <div class="updated-img">
                               {!! render_image_markup_by_attachment_id($all_updated_area_image_fields[$loop->index ?? '']) !!}
                            </div>
                            <div class="updated-contents">
                                <span class="updated-top color-three fw-500"> {{$all_updated_area_title_fields[$loop->index ?? '']}}  </span>
                                <h2 class="updated-title"> <a href="javascript:void(0)"> {{$all_updated_area_subtitle_fields[$loop->index ?? '']}}</a> </h2>
                                <a href="{{$icon_updated_field ?? ''}}" class="btn-buy icon btn-color-three"> {{$all_updated_area_button_text_fields[$loop->index ?? '']}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Updated area end -->

<!-- Store area Starts -->
<section class="store-area home-19 padding-top-50 padding-bottom-50">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> Our Store </h2>
                    </div>
                    <div class="product-list isootope-list mt-3">
                        <ul class="product-button isootope-button hover-color-three" id="store_area_category_item_section_by_ajax">
                            @foreach($all_store_area_categories as $cat)
                                <li data-catid="{{$cat->id}}" class="@if($loop->first) active @endif list" >{{$cat->title}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="imageloaded">
            <div class="row grid mt-4" id="store-area-append-container">
                <div class="col-lg-12 popular-category-preloader-wrap d-none">
                    <div class="preloader-wrap">
                        <i class="fas fa-spinner fa-spin fa-5x"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="see_all_product_btn center-text mt-4 mt-lg-5">
                    <div class="btn-wrapper">
                        <a href="{{get_static_option('home19_store_button_'.$user_select_lang_slug.'_url')}}" class="cmn-btn btn-outline-three color-three"> {{get_static_option('home19_store_button_'.$user_select_lang_slug.'_text')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Store area end -->

<!-- Clothing area Starts -->
<section class="clothing-area home-19 padding-top-50 padding-bottom-50">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="clothing-wrapper bg-item-two">
                    <div class="clothing-thumb">
                     {!! render_image_markup_by_attachment_id(get_static_option('home19_clothing_area_section_left_image')) !!}
                     {!! render_image_markup_by_attachment_id(get_static_option('home19_clothing_area_section_right_image')) !!}

                    </div>
                    <div class="clothing-contents center-text">
                        <span class="percent-discount color-three fs-22 fw-500">{{filter_static_option_value('home19_clothing_area_section_'.$user_select_lang_slug.'_title',$static_field_data)}} </span>
                        <h2 class="clothing-title"> {{filter_static_option_value('home19_clothing_area_section_'.$user_select_lang_slug.'_subtitle',$static_field_data)}} </h2>
                        <div class="btn-wrapper mt-4 mt-lg-5">
                            <a href="{{filter_static_option_value('home19_clothing_area_section_'.$user_select_lang_slug.'_button_url',$static_field_data)}}" class="cmn-btn btn-bg-3">
                                {{filter_static_option_value('home19_clothing_area_section_'.$user_select_lang_slug.'_button_text',$static_field_data)}}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Clothing area end -->
<section class="sale-area home-19 padding-top-50 padding-bottom-50">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> {!! filter_static_option_value('home_page_19_'.$user_select_lang_slug.'_popular_area_title',$static_field_data) !!}</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="global-slick-init deal-slider nav-style-one nav-color-three dot-style-one dot-color-three slider-inner-margin" data-infinite="true" data-arrows="true" data-dots="false" data-slidesToShow="4" data-swipeToSlide="true" data-autoplay="true" data-autoplaySpeed="2500"
                     data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-rtl="{{$rtl_condition}}" data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 3}},{"breakpoint": 992,"settings": {"slidesToShow": 2}},{"breakpoint": 768, "settings": {"slidesToShow": 1}},{"breakpoint": 576, "settings": {"arrows": false,"dots": true,"slidesToShow": 1}}]'>

                    @foreach($all_popular_products as $key => $pro)
                      <div class="slick-slider-items wow fadeInUp" data-wow-delay=".1s">
                        <div class="global-card-item center-text border-1 no-shadow radius-10">
                            <div class="global-card-thumb radius-10">
                                <a href="javascript:void(0)">
                                    {!! render_image_markup_by_attachment_id($pro->image,'radius-10','grid') !!}
                                </a>
                                <div class="thumb-top-contents">
                                    @if(!empty($pro->badge))
                                       <span class="percent-box {{$colors[$key % count($colors)]}} radius-5"> {{$pro->badge}} </span>
                                    @endif
                                </div>
                                <ul class="global-thumb-icons">
                                    @if($pro->stock_status === 'out_stock')
                                        <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                                    @else
                                    
                                        <li class="lists" data-bs-toggle="tooltip" data-bs-placement="left" title="add to cart">
                                            @if(!empty($pro->variant) && count(json_decode($pro->variant,true)) > 0)
                                                 <a class="icon"
                                                   title="{{__('View Details')}}"
                                                   href="{{route('frontend.products.single',$pro->slug)}}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                             @else
                                                <a class="icon cart-loading ajax_add_to_cart_with_icon"
                                                   data-product_id="{{$pro->id}}"
                                                   data-product_title="{{$pro->title}}"
                                                   data-product_quantity="1"
                                                   href="javascript:void(0)">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </a>
                                            @endif
                                        </li>
                                    @endif
                                    <li class="lists" data-bs-toggle="tooltip" data-bs-placement="left" title="add to wishloast">
                                        <a class="icon cart-loading ajax_add_to_wishlist_with_icon"
                                           data-product_id="{{$pro->id}}"
                                           href="javascript:void(0)"> <i class="fas fa-heart"></i> </a>
                                    </li>
                                    <li class="lists" data-bs-toggle="tooltip" data-bs-placement="left" title="Product Details">
                                        @php
                                            $product_img = get_attachment_image_by_id($pro->image,null,true);
                                            $img_url = $product_img['img_url'];
                                            $product = $pro;
                                            $view = view('frontend.pages.products.product-attribute-passing',compact('product'))->render();
                                        @endphp
                                        <a class="icon popular_product_quick_view"
                                           data-toggle="modal"
                                           data-target="#quick_view"
                                           data-id="{{$pro->id}}"
                                           data-title="{{$pro->title}}"
                                           data-short_description="{{$pro->short_description}}"
                                           data-regular_price="{{amount_with_currency_symbol($pro->regular_price)}}"
                                           data-sale_price="{{amount_with_currency_symbol($pro->sale_price)}}"
                                           data-in_stock="{{str_replace('_',' ', ucfirst($pro->stock_status))}}"
                                           data-category="{{optional($pro->category)->title}}"
                                           data-subcategory="{{optional($pro->subcategory)->title}}"
                                           data-image="{{$img_url}}"
                                           data-attribute="{{$view}}"
                                           href="javascript:void(0)"
                                        >
                                            <i class="fas fa-search-plus"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="global-card-contents">
                                <h4 class="common-title hover-color-three"> <a href="{{route('frontend.products.single',$pro->slug)}}"> {{$pro->title}}</a> </h4>
                                <div class="global-card-flex-contents">
                                    <div class="single-global-card">
                                        <div class="global-card-right">
                                            @if(count($pro->ratings) > 0)
                                              {!! ratingMarkup($pro->ratings->avg("ratings"),$pro->ratings_count) !!}
                                            @endif
                                        </div>
                                    </div>
                                    <div class="single-global-card mt-2">
                                        <div class="global-card-left">
                                            <div class="price-update-through">
                                                @if(!get_static_option('display_price_only_for_logged_user'))
                                                    <span class="fs-24 fw-500 ff-rubik flash-prices color-three"> {{$pro->sale_price == 0 ? __('Free') : amount_with_currency_symbol($pro->sale_price)}} </span>
                                                    @if(!empty($product->regular_price))
                                                         <span class="fs-18 flash-old-prices ff-rubik">{{ amount_with_currency_symbol($pro->regular_price) }}</span>
                                                     @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>



<!-- Instagram area Starts -->
<div class="instagram-area home-19 padding-top-50 padding-bottom-50">
    <div class="container container-one">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-19 section-border-bottom">
                    <div class="title-left">
                        <h2 class="title"> {{ filter_static_option_value('home_page_19_'.$user_select_lang_slug.'_instagram_area_title',$static_field_data) }} </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="instagram-wrapper">
                    <div class="global-slick-init instagram-slider nav-style-one nav-color-three dot-style-one dot-color-three slider-inner-margin" data-infinite="true" data-arrows="true" data-dots="false" data-swipeToSlide="true" data-autoplaySpeed="3000" data-autoplay="true"
                         data-slidesToShow="6" data-rtl="{{$rtl_condition}}"  data-prevArrow='<div class="prev-icon"><i class="fas fa-angle-left"></i></div>' data-nextArrow='<div class="next-icon"><i class="fas fa-angle-right"></i></div>' data-responsive='[{"breakpoint": 1600,"settings": {"slidesToShow": 5}},{"breakpoint": 1400,"settings": {"slidesToShow": 4}},{"breakpoint": 1200,"settings": {"slidesToShow": 4}},{"breakpoint": 992,"settings": {"slidesToShow": 3}},{"breakpoint": 768, "settings": {"slidesToShow": 2}},{"breakpoint": 576, "settings": {"arrows":false, "dots": true, "slidesToShow": 2}} ]'>
                         @foreach($all_instagram_data->data ?? [] as $insta)
                            <div class="single-instagram">
                                <div class="instagram-image radius-10">
                                    <a href="{{$insta->permalink}}" target="_blank">
                                        <img src="{{$insta->media_url}}" alt="">
                                    </a>
                                    <a href="{{$insta->permalink}}" class="icon color-three radius-5" target="_blank"> <i class="fab fa-instagram"></i> </a>
                                </div>
                            </div>
                         @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Instagram area end -->

<!-- Promo area Starts -->
<section class="promo-area home-19 padding-bottom-100 padding-top-25">
    <div class="container container-one">
        <div class="row">
            @php
                $all_title_fields = get_static_option('home_19_promo_section_'.$user_select_lang_slug.'_title');
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];

                $all_subtitle_fields = get_static_option('home_19_promo_section_'.$user_select_lang_slug.'_subtitle');
                $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];

                $all_title_fields_url = get_static_option('home_19_promo_section_'.$user_select_lang_slug.'_title_url');
                $all_title_fields_url = !empty($all_title_fields_url) ? unserialize($all_title_fields_url,['class' => false]) : [];

                $all_icon_fields =  get_static_option('home19_promo_section_icon');
                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : ['#'];
            @endphp

            @foreach($all_icon_fields as $icon)
            <div class="col-xxl-3 col-xl-3 col-md-6 promo-child mt-4">
                <div class="single-promo no-shadow border-1">
                    <div class="promo-inner">
                        <div class="icon color-three">
                            <i class="{{$icon ?? ''}}"></i>
                        </div>
                        <div class="contents">
                            <h4 class="common-title hover-color-three"> <a href="{{$all_title_fields_url[$loop->index] ?? ''}}"> {{$all_title_fields[$loop->index] ?? ''}}</a> </h4>
                            <p class="common-para"> {{$all_subtitle_fields[$loop->index] ?? ''}} </p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- Promo area end -->


<!-- quick view Modal-->
<div class="modal fade home-variant-19 quick_view_modal" id="quick_view" tabindex="-1" role="dialog" aria-labelledby="productModal" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content p-5">
            <div class="quick-view-close-btn-wrapper">
                <button class="quick-view-close-btn close" data-dismiss="modal"><i class="fas fa-times"></i></button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="product_details">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="product-view-wrap product-img">
                                    <ul class="other-content">
                                        <li>
                                            <span class="badge-tag image_category"></span>
                                        </li>
                                    </ul>
                                    <img src="" alt="" class="img_con">
                                </div>
                            </div>
                            <div class="col-lg-6">

                                <div class="product-summery">
                                    <span class="product-meta pricing">
                                         <span id="unit">1</span> <span id="uom">Piece</span>
                                    </span>
                                    <h3 class="product-title title"></h3>
                                    <div>
                                        <span class="availability is_available text-success"></span>
                                    </div>
                                    <div class="price-wrap">
                                        <span class="price sale_price quick_view_sale_price font-weight-bold"></span>
                                        <del class="del-price del_price regular_price"></del>
                                    </div>

                                    <div class="product_attributes my-3">

                                    </div>

                                    <div class="rating-wrap ratings" style="display: none">
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                        <i class="fa fa-star icon"></i>
                                    </div>

                                    <div class="short-description">
                                        <p class="info short_description"></p>
                                    </div>
                                    <div class="cart-option"><div class="user-select-option">
                                        </div>
                                        <div class="d-flex">
                                            <div class="input-group">
                                                <input class="quantity form-control" type="number" min="1" max="10000000" value="1" id="quantity_single_quick_view_btn">
                                            </div>
                                            <div class="btn-wrapper">
                                                <a href="#" data-attributes="[]"
                                                   class="btn-default rounded-btn add-cart-style-02 add_cart_from_quick_view"
                                                   data-product_id=""
                                                   data-product_title=""
                                                   data-product_quantity="1"
                                                >
                                                   {{__('Add to cart')}}
                                                </a>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="category">
                                        <p class="name">Category: </p>
                                        <a href="" class="product_category"></a>
                                    </div>
                                    <div class="product-details-tag-and-social-link">
                                        <div class="tag d-flex">
                                            <p class="name">{{__('Subcategory : ')}} </p>
                                            <div class="subcategory_container">
                                                <a href="" class="tag-btn product_subcategory" rel="tag"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@section('scripts')
{{--@include('frontend.partials.product-wishlist-ajax-js-with-icon')--}}
    <script>
        $(document).ready(function (){

            $(document).on('click','#store_area_category_item_section_by_ajax li',function (e) {
                e.preventDefault();
                $(this).addClass('active').siblings().removeClass('active');
                fetchPopularCategoryItemById($(this).data('catid'));
            });

            fetchPopularCategoryItemById($('#store_area_category_item_section_by_ajax li.active').data('catid'));
            function fetchPopularCategoryItemById(catid){
                let preloaderContainer = $('#store-area-append-container').find('.popular-category-preloader-wrap');
                $.ajax({
                    url: "{{route('frontend.story.product.item.by.category')}}",
                    type: 'POST',
                    beforeSend:function(){
                        let markup = ` <div class="col-lg-12 popular-category-preloader-wrap">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                        $('#store-area-append-container').html(markup);
                    },
                    data: {
                        _token: "{{csrf_token()}}",
                        catid: catid
                    },
                    success: function (data){
                        //append data
                        let markup = ` <div class="col-lg-12 popular-category-preloader-wrap d-none">
                                <div class="preloader-wrap">
                                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                                </div>
                            </div>`;
                        markup += data;
                        //
                        $('#store-area-append-container').html(markup);
                        preloaderContainer.addClass('d-none');
                    }
                });
            }

            //Popular area quick view
            $(document).on('click','.popular_product_quick_view ',function(){
            
                let el = $(this);
                quick_view_data(el);
            });

            //Today deal area quick view
            $(document).on('click','.today_deal_quick_view',function(){
      
                let el = $(this);
                quick_view_data(el);
            });

            //Store area quick view
            $(document).on('click','.store_quick_view',function(){
              
                let el = $(this);
                quick_view_data(el);
            });

      function quick_view_data(el)
         {
             let modal = $('.quick_view_modal');
               $('p.text-danger').remove();

                modal.find('.add_cart_from_quick_view').attr('data-product_id',el.data('id'));
                modal.find('.add_cart_from_quick_view').attr('data-product_title',el.data('title'));

             let subcat_con = el.data('subcategory') == '' ? 'Unsubcategorized' : el.data('subcategory');

             modal.find('.product-title').text(el.data('title'));
                modal.find('.title').text(el.data('title'));
                modal.find('.availability').text(el.data('in_stock'));
                modal.find('.image_category').text(el.data('category'));
                modal.find('.sale_price').text(el.data('sale_price'));
                modal.find('.regular_price').text(el.data('regular_price'));
                modal.find('.short_description').text(el.data('short_description'));
                modal.find('.product_category').text(el.data('category'));
                modal.find('.product_subcategory').text(subcat_con);
                modal.find('.img_con').attr('src',el.data('image'));
                modal.find('.ajax_add_to_cart_with_icon').data('src',el.data('image'));
                modal.find('.product_attributes').html(el.data('attribute'));
            }
        });


        $(document).on('keyup change','#quantity_single_quick_view_btn',function(){
            let modal = $('.quick_view_modal');
            let el = $(this).val();
            modal.find('.add_cart_from_quick_view').attr('data-product_quantity',el);
        });

    </script>
@endsection