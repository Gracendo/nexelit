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

<div class="header-slider-wrapper fruits-home"
        {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_15_header_area_background_image',$static_field_data)) !!}
>
    <div class="right-image-wrap">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_header_area_bottom_image',$static_field_data)) !!}
    </div>
    <div class="header-area fruits-home">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner">
                        <h1 class="title">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_header_area_title',$static_field_data)}}</h1>
                        <div class="description">{!! filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_header_area_description',$static_field_data) !!}</div>
                        <div class="btn-wrapper margin-top-30">
                            @if(!empty(filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data)))
                                <a href="{{ filter_static_option_value('home_page_15_header_area_button_url',$static_field_data) }}"
                                   class="btn-fruits">{{ filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_header_area_button_text',$static_field_data) }}
                                    <i class="{{filter_static_option_value('home_page_15_header_area_button_icon',$static_field_data)}}"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@if(!empty(filter_static_option_value('home_page_offer_section_status',$static_field_data)))
<div class="offer-area-wrap padding-top-115 padding-bottom-120">
    <div class="container">
        <div class="row">
            @php
                $all_btton_url_fields =  get_static_option('home_page_15_offer_item_button_url');
                $all_btton_url_fields = !empty($all_btton_url_fields) ? unserialize($all_btton_url_fields) : [];
                $offer_item_title = get_static_option('home_page_15_'.$user_select_lang_slug.'_offer_item_title');
                $offer_item_title = !empty($offer_item_title) ? unserialize($offer_item_title,['class' => false]) : [];
                $offer_item_short_description = get_static_option('home_page_15_'.$user_select_lang_slug.'_offer_item_short_description');
                $offer_item_short_description = !empty($offer_item_short_description) ? unserialize($offer_item_short_description,['class' => false]) : [];
                $offer_item_button_text = get_static_option('home_page_15_'.$user_select_lang_slug.'_offer_item_button_text');
                $offer_item_button_text = !empty($offer_item_button_text) ? unserialize($offer_item_button_text,['class' => false]) : [];
                $offer_item_image = get_static_option('home_page_15_offer_item_image');
                $offer_item_image = !empty($offer_item_image) ? unserialize($offer_item_image,['class' => false]) : [];
            @endphp
            @foreach($all_btton_url_fields as $url)
                <div class="col-lg-6">
                    <div class="offer-item-wrap">
                        <div class="content-warp">
                            <h4 class="title">{{$offer_item_title[$loop->index] ?? ''}}</h4>
                            <p class="short-description">{{$offer_item_short_description[$loop->index] ?? ''}}</p>
                            @if(!empty($offer_item_button_text[$loop->index]))
                            <a href="{{$url}}" class="offer-btn">{{$offer_item_button_text[$loop->index] ?? ''}}</a>
                            @endif
                        </div>
                        <div class="right-image">
                            {!! render_image_markup_by_attachment_id($offer_item_image[$loop->index] ?? '') !!}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_featured_fruit_section_status',$static_field_data)))
<div class="feature-products-area padding-bottom-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 fruits-home">
                    <span class="subtitle">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_featured_product_area_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_featured_product_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="global-carousel-init product-slider logistic-dots fruits-home"
                     data-loop="true"
                     data-desktopitem="4"
                     data-mobileitem="1"
                     data-tabletitem="2"
                     data-dots="true"
                     data-autoplay="true"
                     data-margin="30"
                >
                    @foreach($featured_products as $data)
                        <div class="single-fruit-product-item">
                            <div class="thumb">
                                <a href="{{route('frontend.products.single',$data->slug)}}">
                                    <div class="img-wrapper">
                                        {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                                    </div>
                                </a>
                                @if($data->stock_status == 'out_stock')
                                    <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                                @else
                                    <a href="{{route('frontend.products.add.to.cart')}}" class="addtocart ajax_add_to_cart" data-product_id="{{$data->id}}" data-product_title="{{$data->title}}" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                        {{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}</a>
                                @endif
                                @if(!empty($data->badge))
                                    <span class="tag">{{$data->badge}}</span>
                                @endif
                            </div>
                            <div class="content">
                                <a href="{{route('frontend.products.single',$data->slug)}}">
                                    <h4 class="title">{{$data->title}}</h4>
                                </a>
                                <div class="price-wrap">
                                    <span class="price">{{amount_with_currency_symbol($data->sale_price)}}</span>
                                    @if(!empty($data->regular_price))<del class="del-price">{{amount_with_currency_symbol($data->regular_price)}}</del>@endif
                                </div>
                                @if(count($data->ratings) > 0)
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($data->id) / 5 * 100}}%"></span>
                                        </div>
                                        <p><span class="total-ratings">({{count($data->ratings)}})</span></p>
                                    </div>
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
{!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_15_process_area_background_image',$static_field_data)) !!}
>
    <div class="right-image shape">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_process_area_right_image',$static_field_data)) !!}
    </div>
    <div class="left-image shape">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_process_area_left_image',$static_field_data)) !!}
    </div>
    <div class="container">
        <div class="row">
            @php
                $all_number_fields =  filter_static_option_value('home_page_15_process_area_item_number',$static_field_data);
                $all_number_fields = !empty($all_number_fields) ? unserialize($all_number_fields,['class' => false]) : [];
                $all_title_fields = filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_process_area_item_title',$static_field_data);
                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];
                $all_description_fields = filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_process_area_item_description',$static_field_data);
                $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [];
                $process_area_item_icon = filter_static_option_value('home_page_15_process_area_item_icon',$static_field_data);
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
<div class="product-area-wrap padding-top-150 padding-bottom-90">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 fruits-home">
                    <span class="subtitle">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_product_section_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_product_section_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($latest_products as $data)
                <div class="col-lg-3 col-md-6">
                <div class="single-fruit-product-item">
                    <div class="thumb">
                        <a href="{{route('frontend.products.single',$data->slug)}}">
                            <div class="img-wrapper">
                                {!! render_image_markup_by_attachment_id($data->image,'','grid') !!}
                            </div>
                        </a>
                        @if($data->stock_status == 'out_stock')
                            <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                        @else
                            <a href="{{route('frontend.products.add.to.cart')}}" class="addtocart ajax_add_to_cart" data-product_id="{{$data->id}}" data-product_title="{{$data->title}}" data-product_quantity="1"><i class="fa fa-shopping-bag" aria-hidden="true"></i>
                                {{get_static_option('product_add_to_cart_button_'.$user_select_lang_slug.'_text')}}</a>
                        @endif
                        @if(!empty($data->badge))
                            <span class="tag">{{$data->badge}}</span>
                        @endif
                    </div>
                    <div class="content">
                        <a href="{{route('frontend.products.single',$data->slug)}}">
                            <h4 class="title">{{$data->title}}</h4>
                        </a>
                        <div class="price-wrap">
                            <span class="price">{{amount_with_currency_symbol($data->sale_price)}}</span>
                            @if(!empty($data->regular_price))<del class="del-price">{{amount_with_currency_symbol($data->regular_price)}}</del>@endif
                        </div>
                        @if(count($data->ratings) > 0)
                            <div class="rating-wrap">
                                <div class="ratings">
                                    <span class="hide-rating"></span>
                                    <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($data->id) / 5 * 100}}%"></span>
                                </div>
                                <p><span class="total-ratings">({{count($data->ratings)}})</span></p>
                            </div>
                        @endif
                    </div>
                </div>
                </div>
            @endforeach
            <div class="col-lg-12">
                <div class="btn-wrapper text-center margin-top-40">
                    <a href="{{route('frontend.products')}}" class="boxed-btn fruits-home"> {{get_static_option('home_page_15_'.$user_select_lang_slug.'_product_section_button_text')}}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if(!empty(filter_static_option_value('home_page_testimonial_section_status',$static_field_data)))
    <div class="fruits-testimonial-area padding-top-120 padding-bottom-120"
    {!! render_background_image_markup_by_attachment_id(filter_static_option_value('home_page_15_testimonial_area_background_image',$static_field_data)) !!}
    >
        <div class="shape-image right-wrap">
            {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_testimonial_area_right_image',$static_field_data)) !!}
        </div>
        <div class="shape-image left-wrap">
            {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_testimonial_area_left_image',$static_field_data)) !!}
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-60 fruits-home">
                        <span class="subtitle">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_testimonial_area_subtitle',$static_field_data)}}</span>
                        <h2 class="title">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_testimonial_area_title',$static_field_data)}}</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area margin-top-10 ">
                        <div class="global-carousel-init logistic-dots fruits-home"
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
@if(!empty(filter_static_option_value('home_page_top_selling_section_status',$static_field_data)))
<div class="top-selling-product-area padding-bottom-120">
    <div class="shape left-image">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_top_selling_product_area_left_image',$static_field_data)) !!}
    </div>
    <div class="shape right-image">
        {!! render_image_markup_by_attachment_id(filter_static_option_value('home_page_15_top_selling_product_area_right_image',$static_field_data)) !!}
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title desktop-center margin-bottom-60 fruits-home">
                    <span class="subtitle">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_top_selling_product_area_subtitle',$static_field_data)}}</span>
                    <h2 class="title">{{filter_static_option_value('home_page_15_'.$user_select_lang_slug.'_top_selling_product_area_title',$static_field_data)}}</h2>
                </div>
            </div>
        </div>
        <div class="row">
                @foreach($top_selling_products as $data)
            <div class="col-lg-4">
                <div class="single-top-selling-product">
                    <div class="img-wrapper">
                        <a href="{{route('frontend.products.single',$data->slug)}}">
                        {!! render_image_markup_by_attachment_id($data->image,'','thumb') !!}
                        </a>
                    </div>
                    <div class="content">
                        <a href="{{route('frontend.products.single',$data->slug)}}">
                            <h4 class="title">{{$data->title}}</h4>
                        </a>
                        <div class="price-wrap">
                            <span class="price">{{amount_with_currency_symbol($data->sale_price)}}</span>
                            @if(!empty($data->regular_price))<del class="del-price">{{amount_with_currency_symbol($data->regular_price)}}</del>@endif
                        </div>
                        @if(count($data->ratings) > 0)
                            <div class="rating-wrap">
                                <div class="ratings">
                                    <span class="hide-rating"></span>
                                    <span class="show-rating" style="width: {{get_product_ratings_avg_by_id($data->id) / 5 * 100}}%"></span>
                                </div>
                                <p><span class="total-ratings">({{count($data->ratings)}})</span></p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach

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

