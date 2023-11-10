@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('product_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('product_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('product_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('product_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection

@section('content')
    <section class="blog-content-area padding-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-9 order-lg-2">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="product-archive-top-content-area">
                                <div class="search-form">
                                    <input type="text" class="form-control" id="search_term" placeholder="{{__('Search..')}}" value="{{$search_term}}">
                                    <button type="button" id="product_search_btn"><i class="fas fa-search"></i></button>
                                </div>
                                <div class="product-sorting">
                                    <select id="product_sorting_select">
                                        <option value="default" @if($selected_order == '' || $selected_order == 'default') selected @endif >{{__('Newest Product')}}</option>
                                        <option value="old" @if($selected_order == 'old') selected @endif >{{__('Oldest Product')}}</option>
                                        <option value="high_low" @if($selected_order == 'high_low') selected @endif >{{__('Highest To Lowest')}}</option>
                                        <option value="low_high" @if($selected_order == 'low_high') selected @endif >{{__('Lowest To Highest')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if(count($all_products) > 0)
                        @foreach($all_products as $data)
                            <div class="col-lg-4 col-md-6">
                                <x-frontend.product.grid :product="$data" :margin="true"/>
                            </div>
                        @endforeach
                        @else
                            <div class="col-lg-12">
                                <div class="alert alert-warning">{{__('No Products Found')}}</div>
                            </div>
                        @endif
                        <div class="col-lg-12 text-center">
                            <nav class="pagination-wrapper product-page-pagination" aria-label="Page navigation ">
                                {{$all_products->links()}}
                            </nav>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 order-lg-1">
                    <div class="product-widget-area">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title">{{get_static_option('product_category_'.$user_select_lang_slug.'_text')}}</h4>
                            <ul class="product_category_list">
                                @foreach($all_category as $data)
                                    <li>
                                        <a  data-catid="{{$data->id}}" href="{{route('frontend.products.category',['id' => $data->id,'any' => Str::slug($data->title)])}}" @if($data->id == $selected_category) class="active cat" @else class="cat" @endif>{{$data->title}}</a>
                                        @if(!empty($data->subcategory))
                                        <ul class="product_subcategory_list">
                                           @foreach( $data->subcategory as $sub_cat)
                                               <li>
                                                   <a data-catid="{{$sub_cat->id}}" href="{{route('frontend.products.subcategory',['id' => $sub_cat->id,'any' => Str::slug($sub_cat->title)])}}" @if($sub_cat->id == $selected_subcategory) class="active" @endif>  - {{$sub_cat->title}} </a>
                                               </li>
                                           @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget_price_filter">
                            <h4 class="widget-title">{{get_static_option('product_price_filter_'.$user_select_lang_slug.'_text')}}</h4>
                            <div id="slider-range"></div>
                            <p><span class="min_filter_price">{{amount_with_currency_symbol($min_price)}}</span> <span class="max_filter_price">{{amount_with_currency_symbol($max_price)}}</span></p>
                            <button type="button" class="btn-boxed style-01" id="submit_price_filter_btn">{{__("Apply Filter")}}</button>
                        </div>
                        <div class="widget widget_rating_filter">
                            <h4 class="widget-title">{{get_static_option('product_rating_filter_'.$user_select_lang_slug.'_text')}}</h4>
                            <ul class="ratings_filter_list">
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_all" @if(empty($selected_rating)) checked @endif  name="ratings_val" value="">
                                        <label class="filter-text" for="rating_bal_all">{{__('Show All')}}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_04" @if($selected_rating == '4') checked @endif name="ratings_val" value="4">
                                        <label class="filter-text" for="rating_bal_04">{{__('Upto 4 star')}}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" id="rating_bal_03" @if($selected_rating == '3') checked @endif name="ratings_val" value="3">
                                        <label class="filter-text" for="rating_bal_03">{{__('Upto 3 star')}}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" name="ratings_val" @if($selected_rating == '2') checked @endif id="rating_bal_02" value="2">
                                        <label for="rating_bal_02" class="filter-text">{{__('Upto 2 star')}}</label>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-rating-filter-wrap">
                                        <input type="radio" name="ratings_val" @if($selected_rating == '1') checked @endif id="rating_bal_01" value="1">
                                        <label class="filter-text" for="rating_bal_01">{{__('Upto 1star')}}</label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <form id="product_search_form" class="d-none"  action="{{route('frontend.products')}}" method="get">
        <input type="hidden" id="search_query" name="q" value="{{$search_term}}">
        <input type="hidden" id="min_price" name="min_price" value="{{$min_price}}">
        <input type="hidden" id="max_price" name="max_price" value="{{$max_price}}">
        <input type="hidden" name="cat_id" id="category_id" value="{{$selected_category}}">
        <input type="hidden" name="subcat_id" id="subcategory_id" value="{{$selected_subcategory}}">
        <input type="hidden" name="orderby" id="orderby" value="{{$selected_order ? $selected_order : 'default'}}">
        <input type="hidden" name="rating" id="review" value="{{$selected_rating}}">
        <input type="hidden" name="page" value="{{$pages ?? 1}}">
        <button id="product_hidden_form_submit_button" type="submit"></button>
    </form>
@endsection

@section('scripts')
    <script>
        (function () {
            "use strict";

            //search form trigger
            $(document).on('click','#product_search_btn',function (e) {
                e.preventDefault();
                var searchTerms = $('#search_term').val();
                $('#search_query').val(searchTerms)
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('change','#product_sorting_select',function (e) {
                var sortVal = $('#product_sorting_select').val();
                $('#orderby').val(sortVal);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','.product_category_list > li a.cat',function (e) {
                e.preventDefault();
                var catID = $(this).data('catid');
                $('#category_id').val(catID);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','ul.product_subcategory_list > li a',function (e) {
                e.preventDefault();
                var catID = $(this).data('catid');
                $('#subcategory_id').val(catID);
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('change','input[name="ratings_val"]',function (e) {
                e.preventDefault();
                $('#review').val($(this).val());
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $(document).on('click','#submit_price_filter_btn',function (e) {
                e.preventDefault();
                $('#product_hidden_form_submit_button').trigger('click');
            });
            $( "#slider-range" ).slider({
                range: true,
                min: 0,
                max: "{{$maximum_available_price}}",
                values: [ "{{$min_price}}", "{{$max_price}}" ],
                slide: function( event, ui ) {
                    var min_price = ui.values[ 0 ];
                    var max_price = ui.values[ 1 ];
                    var siteGlobalCurrency = "{{site_currency_symbol()}}";
                    $('.min_filter_price').text(siteGlobalCurrency+min_price);
                    $('.max_filter_price').text(siteGlobalCurrency+max_price);
                    $('#min_price').val(min_price);
                    $('#max_price').val(max_price);
                }
            });
            /* product page pagination */
            $(document).on('click','.product-page-pagination .page-link',function (e){
                e.preventDefault();
                $('input[name="page"]').val($(this).text());
                $('#product_hidden_form_submit_button').trigger('click');
            });

        })(jQuery);
    </script>
@endsection


