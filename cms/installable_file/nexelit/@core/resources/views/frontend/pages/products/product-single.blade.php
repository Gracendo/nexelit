@extends('frontend.frontend-page-master')
@section('site-title')
    {{$product->title}}
@endsection
@section('style')
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/toastr.css')}}">
@endsection
@section('page-title')
    {{$product->title}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$product->meta_tags}}">
    <meta name="tags" content="{{$product->meta_description}}">
@endsection

@section('og-meta')
    <meta property="og:url" content="{{route('frontend.products.single',$product->slug)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$product->title}}"/>
    {!! render_og_meta_image_by_attachment_id($product->image) !!}
    @php
        $post_img = null;
        $blog_image = get_attachment_image_by_id($product->image,"full",false);
        $post_img = !empty($blog_image) ? $blog_image['img_url'] : '';
    @endphp
@endsection
@section('content')
    <section class="product-content-area padding-top-120 padding-bottom-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @include('backend.partials.message')
                    <div class="single-product-details">
                        <div class="top-content">
                            @if(!empty($product->gallery))
                                @php
                                    $product_gllery_images = !empty( $product->gallery) ? explode('|', $product->gallery) : [];
                                @endphp
                                <div class="product-gallery">
                                    <div class="slider-gallery-slider">
                                        @foreach($product_gllery_images as $gl_img)
                                            <div class="single-gallery-slider-item">
                                                {!! render_image_markup_by_attachment_id($gl_img,'','large') !!}
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="slider-gallery-nav">
                                        @foreach($product_gllery_images as $gl_img)
                                            <div class="single-gallery-slider-nav-item">
                                                {!! render_image_markup_by_attachment_id($gl_img,'','thumb') !!}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="thumb">
                                    {!! render_image_markup_by_attachment_id($product->image,'','large') !!}
                                </div>
                            @endif
                            <div class="product-summery">
                                @if(count($product->ratings) > 0)
                                    <div class="rating-wrap">
                                        <div class="ratings">
                                            <span class="hide-rating"></span>
                                            <span class="show-rating"
                                                  style="width: {{$average_ratings / 5 * 100}}%"></span>
                                        </div>
                                        <p><span class="total-ratings">({{count($product->ratings)}})</span></p>
                                    </div>
                                @endif
                                @if(!get_static_option('display_price_only_for_logged_user'))
                                <div class="price-wrap">
                                    <span class="price">{{$product->sale_price == 0 ? __('Free') : amount_with_currency_symbol($product->sale_price)}}</span>
                                    @if(!empty($product->regular_price))
                                        <del class="del-price">{{amount_with_currency_symbol($product->regular_price)}}</del>
                                    @endif
                                </div>
                                @endif
                                <div class="short-description">
                                    <p>{{$product->short_description}}</p>
                                </div>
                                    <div class="product-variant-list-wrapper-outer">
                                        @if($product->stock_status == 'out_stock')
                                            <div class="out_of_stock">{{__('Out Of Stock')}}</div>
                                        @else
                                            @if(!empty($product->variant))
                                                @foreach(json_decode($product->variant) as $id => $terms)
                                                    @php
                                                        $variant = get_product_variant_list_by_id($id);
                                                    @endphp
                                                    @if(!empty($variant))
                                                        <div class="product-variant-list-wrapper">
                                                            <h5 class="title">{{$variant->title}}</h5>
                                                            <ul class="product-variant-list">
                                                                @php
                                                                    $prices = json_decode($variant->price);
                                                                @endphp
                                                                @foreach($terms as $term)
                                                                    @php
                                                                        $v_term_index  = array_search($term,json_decode($variant->terms,true));
                                                                    @endphp
                                                                    <li
                                                                        data-variantid="{{$id}}"
                                                                        data-variantname="{{$variant->title}}"
                                                                        data-term="{{$term}}"
                                                                    @if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index]))
                                                                        data-price="{{$prices[$v_term_index]}}"
                                                                        data-termprice="{{amount_with_currency_symbol($prices[$v_term_index] + $product->sale_price )}}"
                                                                    @else
                                                                        data-termprice="{{amount_with_currency_symbol($product->sale_price)}}"
                                                                    @endif
                                                                    >
                                                                        {{$term}}
                                                                        @if(isset($prices[$v_term_index]) && !empty($prices[$v_term_index]))
                                                                            <small>+ {{amount_with_currency_symbol($prices[$v_term_index])}} </small>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </div>
                                <div class="single-add-to-card-wrapper">

                                    @if($product->is_downloadable === 'on' && $product->direct_download === 1)
                                        <form action="{{route('frontend.product.download',$product->id)}}" method="post">
                                            @csrf
                                            <button class="addtocart" type="submit"> <i class="fas fa-download"></i>
                                                {{get_static_option('product_download_now_button_'.$user_select_lang_slug.'_text')}}</button>
                                        </form>
                                   @elseif($product->stock_status === 'in_stock')
                                        <form action="{{route('frontend.products.add.to.cart')}}" method="post">
                                            @csrf
                                            <input type="hidden" name="product_variants" >
                                            <input type="number" class="quantity" name="quantity" min="1" value="1">
                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                            <button type="submit" class="addtocart product_variant_add_to_cart">{{get_static_option('product_single_'.$user_select_lang_slug.'_add_to_cart_text')}}</button>
                                        </form>
                                    @endif
                                </div>
                                
                                <div class="cat-sku-content-wrapper">
                                    <div class="category-wrap">
                                        <span class="title">{{get_static_option('product_single_'.$user_select_lang_slug.'_category_text')}}</span>
                                        {!! get_product_category_by_id($product->category_id,'link') !!}
                                    </div>
                                    <div class="category-wrap">
                                        <span class="title">{{get_static_option('product_single_'.$user_select_lang_slug.'_subcategory_text')}}</span>
                                        {!! get_product_subcategory_by_id($product->subcategory_id,'link') !!}
                                    </div>
                                    @if(!empty($product->sku))
                                        <div class="sku-wrap">
                                            <span class="title">{{get_static_option('product_single_'.$user_select_lang_slug.'_sku_text')}}</span>
                                            <span class="sku_">{{$product->sku}}</span></div>
                                    @endif
                                    <div class="share-wrap">
                                       <ul class="social-icons">
                                           <li class="title">{{__('Share')}}:</li>
                                           {!! single_post_share(route('frontend.blog.single',$product->slug),$product->title,$post_img) !!}
                                       </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bottom-content">
                            <div class="extra-content-wrap">
                                <nav>
                                    <div class="nav nav-tabs" role="tablist">
                                        <a class="nav-item nav-link active" data-toggle="tab" href="#nav-description"
                                           role="tab"
                                           aria-selected="true">{{get_static_option('product_single_'.$user_select_lang_slug.'_description_text')}}</a>
                                        @php
                                        $product_attributes_title = unserialize($product->attributes_title);
                                        @endphp
                                        @if(!empty($product_attributes_title[0]) )
                                            <a class="nav-item nav-link" data-toggle="tab" href="#nav-attributes"
                                               role="tab"
                                               aria-selected="false">{{get_static_option('product_single_'.$user_select_lang_slug.'_attributes_text')}}</a>
                                        @endif
                                        @if(!empty(get_static_option('product_single_related_products_status')))
                                        <a class="nav-item nav-link" data-toggle="tab" href="#nav-ratings" role="tab"
                                           aria-selected="false">{{get_static_option('product_single_'.$user_select_lang_slug.'_ratings_text')}}</a>
                                        @endif
                                    </div>
                                </nav>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="nav-description" role="tabpanel">
                                        <div class="product-description">
                                            {!! $product->description !!}
                                        </div>
                                    </div>
                                    @if(!empty($product_attributes_title[0]))
                                        <div class="tab-pane fade" id="nav-attributes" role="tabpanel">
                                            @php
                                                $att_title = unserialize($product->attributes_title);
                                                $att_descr = unserialize($product->attributes_description);
                                            @endphp
                                            @if(!empty($att_title))
                                                <div class="table-wrap table-responsive">
                                                    <table class="table table-bordered">
                                                        @foreach($att_title as $key => $att_title)
                                                            <tr>
                                                                <th>{{$att_title}}</th>
                                                                <td>{{$att_descr[$key]}}</td>
                                                            </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                    @if(!empty(get_static_option('product_single_related_products_status')))
                                    <div class="tab-pane fade" id="nav-ratings" role="tabpanel">
                                        <div class="product-rating">
                                            <div class="rating-wrap">
                                                <div class="ratings">
                                                    <span class="hide-rating"></span>
                                                    <span class="show-rating"
                                                          style="width: {{$average_ratings / 5 * 100}}%"></span>
                                                </div>
                                                <p><span class="total-ratings">({{count($product->ratings)}})</span></p>
                                            </div>
                                            @if(count($product->ratings) > 0)
                                                <ul class="product-rating-list">
                                                    @foreach($product->ratings as $rating)
                                                        <li>
                                                            <div class="single-product-rating-item">
                                                                <div class="content">
                                                                    <h4 class="title">{{get_user_name_by_id($rating->user_id) ? get_user_name_by_id($rating->user_id)->name : __('anonymous')}}</h4>
                                                                    <div class="ratings text-warning">
                                                                        {!! render_ratings($rating->ratings) !!}
                                                                    </div>
                                                                    <p>{{$rating->message}}</p>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                            <div class="product-ratings-form">
                                                @if(auth()->check())
                                                    <h4 class="title">{{__('Leave A Review')}}</h4>
                                                    @if($errors->any())
                                                        <ul class="alert alert-danger">
                                                            @foreach($errors->all() as $error)
                                                                <li>{{$error}}</li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                    <form action="{{route('product.ratings.store')}}" method="post"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="product_id" value="{{$product->id}}">
                                                        <div class="form-group">
                                                            <label
                                                                for="rating-empty-clearable2">{{__('Ratings')}}</label>
                                                            <input type="number" name="ratings"
                                                                   id="rating-empty-clearable2"
                                                                   class="rating text-warning"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ratings_message">{{__('Message')}}</label>
                                                            <textarea name="ratings_message" class="form-control"
                                                                      id="ratings_message" cols="30" rows="5"
                                                                      placeholder="{{__('Message')}}"></textarea>
                                                        </div>
                                                        <div class="btn-wrapper">
                                                            <button type="submit"
                                                                    class="btn-boxed style-01">{{__('Submit')}}</button>
                                                        </div>
                                                    </form>
                                                @else
                                                  @include('frontend.partials.ajax-login-form')
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if(count($related_products) > 0 && !empty(get_static_option('product_single_related_products_status')))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="related-product-area">
                            <h3 class="title">{{get_static_option('product_single_'.$user_select_lang_slug.'_related_product_text')}}</h3>
                            <div class="related-product-wrapper">
                                <div class="row">
                                    @foreach($related_products as $data)
                                        <div class="col-lg-3">
                                            <x-frontend.product.grid :product="$data" :margin="true"/>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script type="text/javascript" src="//use.fontawesome.com/5ac93d4ca8.js"></script>
    <script type="text/javascript" src="{{asset('assets/frontend/js/bootstrap4-rating-input.js')}}"></script>
    <script src="{{asset('assets/frontend/js/toastr.min.js')}}"></script>
    @include('frontend.partials.ajax-login-form-js')
    <script>
        (function ($) {
            "use strict";

            var rtlEnable = $('html').attr('dir');
            var sliderRtlValue = typeof rtlEnable === 'undefined' ||  rtlEnable === 'ltr' ? false : true ;

            $(document).ready(function () {
                $(document).on('click','.product_variant_add_to_cart',function (e){
                    e.preventDefault();
                    var variants = $('.product-variant-list').length;
                    var variantSelected = $('.product-variant-list li.selected').length;
                    $(this).parent().parent().find('p.text-danger').remove();
                    if(variants != variantSelected){
                        $(this).parent().parent().append('<p class="text-danger">{{__('Select Product Variants')}}</p>');
                    }else {
                        $(this).parent().trigger('submit');
                    }
                });

                $(document).on('click','.product-variant-list li',function (){
                    $(this).addClass('selected').siblings().removeClass('selected');
                    var price = $(this).data('price');
                    var termprice = $(this).data('termprice');
                    $('.single-product-details .top-content .price-wrap .price').text(termprice);
                    var allSelectedValue = $('.product-variant-list li.selected');
                    var variantVal = [];
                    $.each(allSelectedValue,function (index,value){
                        var elData = $(this).data();
                        variantVal.push({
                            'variantID' : elData.variantid,
                            'variantName' : elData.variantname,
                            'term' : elData.term,
                            'price' :  elData.price =! 'undefined' ? elData.price : '',
                        })
                    });

                    $('input[name="product_variants"]').val(JSON.stringify(variantVal));
                });


                $('.slider-gallery-slider').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-gallery-nav',
                    rtl: sliderRtlValue
                });
                $('.slider-gallery-nav').slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    asNavFor: '.slider-gallery-slider',
                    dots: false,
                    arrows: false,
                    centerMode: false,
                    focusOnSelect: true,
                    rtl: sliderRtlValue
                });

            
            });

        })(jQuery)
    </script>
@endsection
