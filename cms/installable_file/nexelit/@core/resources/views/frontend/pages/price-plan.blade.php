@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('price_plan_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('price_plan_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    @php $a = 1; @endphp
        @foreach($all_price_plan as $key => $price_plan)
        <section class="pricing-plan-area @if( $a % 2 == 0) bg-liteblue @endif price-inner padding-bottom-120 padding-top-110">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title desktop-center padding-bottom-55">
                            <h2 class="title">{{get_price_plan_category_by_id($key)}}</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                            <div class="price-plan-slider global-carousel-init"
                                 data-loop="true"
                                 data-desktopitem="3"
                                 data-mobileitem="1"
                                 data-tabletitem="2"
                                 data-nav="true"
                                 data-autoplay="true"
                                 data-margin="30"
                            >
                            @foreach($price_plan as $data)
                                <div class="single-price-plan-01 @if( $a % 2 != 0) bg-lightwhite @endif  @if(!empty($data->highlight)) style-02 active @endif">
                                    <div class="price-header">
                                        <div class="name-box">
                                            <h4 class="name">{{$data->title}}</h4>
                                        </div>
                                        <div class="price-wrap">
                                            <span class="price">{{amount_with_currency_symbol($data->price)}}</span><span class="month">{{$data->type}}</span>
                                        </div>
                                    </div>
                                    <div class="price-body">
                                        <ul>
                                            @php
                                                $features = explode("\n",$data->features);
                                            @endphp
                                            @foreach($features as $item)
                                                <li>{{$item}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="btn-wrapper">
                                        @php
                                            $url = !empty($data->url_status) ? route('frontend.plan.order',['id' => $data->id]) : $data->btn_url;
                                        @endphp
                                        <a href="{{$url}}" rel="canonical" class="boxed-btn">{{$data->btn_text}}</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @php $a++; @endphp
        @endforeach
@endsection
