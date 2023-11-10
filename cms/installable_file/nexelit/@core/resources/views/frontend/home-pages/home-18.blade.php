@include('frontend.partials.homesupportbar')
@php
    $home_page_variant = $home_page ?? get_static_option('home_page_variant');
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

<div class="header-slider-wrapper global-carousel-init grocery-home"
     data-loop="true"
     data-desktopitem="1"
     data-mobileitem="1"
     data-tabletitem="1"
     data-dots="true"
     data-autoplay="true"
     data-stagepadding="0"
     data-margin="0"
>
    @php
        $all_bg_image_fields =  filter_static_option_value('grocery_home_page_header_section_bg_image',$static_field_data);
        $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields,['class' => false]) : [];
        $all_button_one_icon_fields =  filter_static_option_value('grocery_home_page_header_section_button_one_icon',$static_field_data);
        $all_button_one_icon_fields = !empty($all_button_one_icon_fields) ? unserialize($all_button_one_icon_fields,['class' => false]) : [];
        $all_button_one_url_fields =  filter_static_option_value('grocery_home_page_header_section_button_one_url',$static_field_data);
        $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields,['class' => false]) : [];
        $all_description_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_description',$static_field_data);
        $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
        $all_btn_one_text_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_button_one_text',$static_field_data);
        $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : [];
        $all_title_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_title',$static_field_data);
        $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
        $all_subtitle_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_header_section_subtitle',$static_field_data);
        $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];
    @endphp
    @foreach($all_bg_image_fields as $image)
        <div class="header-area grocery-home" {!! render_background_image_markup_by_attachment_id($image) !!}>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="header-inner">
                            <span class="subtitle">{{$all_subtitle_fields[$loop->index] ?? ''}}</span>
                            <h1 class="title">{{$all_title_fields[$loop->index] ?? ''}}</h1>
                            <p class="description">{{$all_description_fields[$loop->index] ?? ''}}</p>
                            <div class="btn-wrapper margin-top-30">
                                @if(isset($all_btn_one_text_fields[$loop->index]))
                                    <a href="{{ $all_button_one_url_fields[$loop->index] ?? '' }}"
                                       class="btn-dagency">{{ $all_btn_one_text_fields[$loop->index] ?? ''  }} <i
                                                class="{{$all_button_one_icon_fields[$loop->index] ?? ''}}"></i></a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

@if(!empty(filter_static_option_value('home_page_product_category_section_status',$static_field_data)))
<div class="categories-area-wrap padding-top-115 padding-bottom-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center grocery-home margin-bottom-50">
                    <h2 class="title">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_category_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-categories logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="4"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    @foreach($product_categories as $data)
                        <div class="single-product-cat-item">
                            <div class="thumb">
                                <a href="{{route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title) ])}}">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                </a>
                            </div>
                            <h3 class="title"><a href="{{route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title) ])}}">{{$data->title}}</a></h3>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_offer_section_status',$static_field_data)))
    @php
        $all_icon_fields =  get_static_option('grocery_home_page_offer_item_button_url');
        $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false] ) : ['#'];
        $offer_item_image =  get_static_option('grocery_home_page_offer_item_image');
        $offer_item_image = !empty($offer_item_image) ? unserialize($offer_item_image,['class' => false] ) : ['#'];
    @endphp
    <div class="offer-area-wrap padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row">
                @foreach($all_icon_fields as $icon_field)
                <div class="col-lg-6">
                    <div class="offer-item-wrap">
                        <a href="{{$icon_field}}">{!! render_image_markup_by_attachment_id($offer_item_image[$loop->index] ?? '') !!}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
@if(!empty(filter_static_option_value('home_page_featured_fruit_section_status',$static_field_data)))
<div class="feature-products-area padding-bottom-120 padding-top-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 grocery-home">
                    <span class="subtitle">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_featured_product_area_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_featured_product_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-slider logistic-dots grocery-home"
                     data-loop="true"
                     data-desktopitem="4"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    @foreach($featured_products as $data)
                        <div class="single-grocery-product-item">
                            <div class="thumb">
                                <a href="{{route('frontend.products.single',$data->slug)}}">
                                    <div class="img-wrapper">
                                        {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    </div>
                                </a>
                                @if(!empty($data->badge))
                                    <span class="tag">{{$data->badge}}</span>
                                @endif
                            </div>
                            <div class="content">
                                @if(count($data->ratings) > 0)
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($data->id) / 5 * 100}}%"></span>
                                        </div>
                                        <p><span class="total-ratings">({{count($data->ratings)}})</span></p>
                                    </div>
                                @endif
                                <a href="{{route('frontend.products.single',$data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <div class="price-wrap">
                                    <span class="price">{{amount_with_currency_symbol($data->sale_price)}}</span>
                                    @if(!empty($data->regular_price))<del class="del-price">{{amount_with_currency_symbol($data->regular_price)}}</del>@endif
                                </div>
                                @if($data->stock_status == 'out_stock')
                                    <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                                @else
                                    <a href="{{route('frontend.products.add.to.cart')}}" class="addtocart ajax_add_to_cart" data-product_id="{{$data->id}}" data-product_title="{{$data->title}}" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        {{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}</a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_process_section_status',$static_field_data)))
<div class="process-area-wrap padding-bottom-150 padding-top-120"
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_background_image',$static_field_data)) !!}
>
    <div class="right-image shape">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_right_image',$static_field_data)) !!}
    </div>
    <div class="left-image shape">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('grocery_home_page_process_area_left_image',$static_field_data)) !!}
    </div>
    <div class="container">
        <div class="row">
            @php
                $all_number_fields =  filter_static_option_value('grocery_home_page_process_area_item_number',$static_field_data);
                $all_number_fields = !empty($all_number_fields) ? unserialize($all_number_fields,['class' => false]) : [];
                $all_title_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_process_area_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                $all_description_fields = filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_process_area_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $process_area_item_icon = filter_static_option_value('grocery_home_page_process_area_item_icon',$static_field_data);
                $process_area_item_icon = !empty($process_area_item_icon) ? unserialize($process_area_item_icon,['class' => false]) : [];
            @endphp
            @foreach($all_number_fields as $number)
            <div class="col-lg-4 col-md-6">
                <div class="single-process-item-fruit-home">
                    <div class="icon">
                        <i class="{{$process_area_item_icon[$loop->index] ?? ''}}"></i>
                        <span class="number">{{$number}}</span>
                    </div>
                    <div class="content">
                        <h4 class="title">{{$all_title_fields[$loop->index] ?? ''}}</h4>
                        <p>{{$all_description_fields[$loop->index] ?? ''}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

@if(!empty(filter_static_option_value('home_page_online_store_section_status',$static_field_data)))
<div class="product-area-wrap padding-top-150 padding-bottom-60">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 grocery-home">
                    <span class="subtitle">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_section_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_product_section_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($latest_products as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="single-grocery-product-item">
                        <div class="thumb">
                            <a href="{{route('frontend.products.single',$data->slug)}}">
                                <div class="img-wrapper">
                                    {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                </div>
                            </a>
                            @if(!empty($data->badge))
                                <span class="tag">{{$data->badge}}</span>
                            @endif
                        </div>
                        <div class="content">
                            @if(count($data->ratings) > 0)
                                <div class="rating-wrap">
                                    <div class="ratings">
                                        <span class="hide-rating"></span>
                                        <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($data->id) / 5 * 100}}%"></span>
                                    </div>
                                    <p><span class="total-ratings">({{count($data->ratings)}})</span></p>
                                </div>
                            @endif
                            <a href="{{route('frontend.products.single',$data->slug)}}">
                                <h4 class="title">{{$data->title}}</h4>
                            </a>
                            <div class="price-wrap">
                                <span class="price">{{amount_with_currency_symbol($data->sale_price)}}</span>
                                @if(!empty($data->regular_price))<del class="del-price">{{amount_with_currency_symbol($data->regular_price)}}</del>@endif
                            </div>
                            @if($data->stock_status == 'out_stock')
                                <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                            @else
                                <a href="{{route('frontend.products.add.to.cart')}}" class="addtocart ajax_add_to_cart" data-product_id="{{$data->id}}" data-product_title="{{$data->title}}" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                    {{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="{{route('frontend.products')}}" class="btn-dagency grocery-home"> {{get_static_option('grocery_home_page_'.$user_select_lang_slug.'_product_section_button_text')}} <i class="fas fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="fruits-testimonial-area padding-top-60 padding-bottom-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 grocery-home">
                        <span class="subtitle">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_testimonial_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('grocery_home_page_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots grocery-home"
                             data-loop="true"
                             data-desktopitem="2"
                             data-mobileitem="1"
                             data-tabletitem="1"
                             data-dots="true"
                             data-autoplay="true"
                             data-margin="30"
                        >
                            @foreach($all_testimonial as $data)
                                <div class="fruits-home-single-testimonial-item">
                                    <div class="author-details">
                                        <div class="thumb ">
                                            {!! render_image_markup_by_attachment_id($data->image) !!}
                                        </div>
                                        <div class="content">
                                            <h4 class="title ">{{$data->name}}</h4>
                                            <span class="designation ">{{$data->designation}}</span>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <p class="description ">{{$data->description}}</p>
                                    </div>
                                    <div class="icon">
                                        <i class="fas fa-quote-right"></i>
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
                                        @if(!empty($data->url) )<a href="{{$data->url}}" rel="canonical">@endif
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

@section('style')
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection
@section('scripts')
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
    <script>
        (function () {
            "use strict";

            $(document).on('click','.ajax_add_to_cart',function (e) {
                e.preventDefault();
                var allData = $(this).data();
                var el = $(this);
                $.ajax({
                    url : "{{route('frontend.products.add.to.cart.ajax')}}",
                    type: "POST",
                    data: {
                        _token : "{{csrf_token()}}",
                        'product_id' : allData.product_id,
                        'quantity' : allData.product_quantity,
                    },
                    beforeSend: function(){
                        el.text("{{__('Adding')}}");
                    },
                    success: function (data) {
                        el.html('<i class="fa fa-shopping-bag" aria-hidden="true"></i>'+"{{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}");
                        toastr.options = {
                            "closeButton": true,
                            "debug": false,
                            "newestOnTop": false,
                            "progressBar": true,
                            "positionClass": "toast-top-right",
                            "preventDuplicates": false,
                            "onclick": null,
                            "showDuration": "300",
                            "hideDuration": "1000",
                            "timeOut": "2000",
                            "extendedTimeOut": "1000",
                            "showEasing": "swing",
                            "hideEasing": "linear",
                            "showMethod": "fadeIn",
                            "hideMethod": "fadeOut"
                        }
                        toastr.success(data.msg);
                        $('.navbar-area .nav-container .nav-right-content ul li.cart .pcount,.mobile-cart a .pcount').text(data.total_cart_item);
                    }
                });
            });

        })(jQuery);
    </script>
@endsection

