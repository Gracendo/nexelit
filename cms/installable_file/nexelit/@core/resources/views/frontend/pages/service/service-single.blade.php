@extends('frontend.frontend-page-master')
@section('og-meta')
    <meta property="og:url" content="{{route('frontend.services.single',$service_item->slug)}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$service_item->title}}"/>
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{$service_item->meta_description}}">
    <meta name="tags" content="{{$service_item->meta_tag}}">
    {!! render_og_meta_image_by_attachment_id($service_item->image) !!}
@endsection
@section('site-title')
    {{$service_item->title}} -  {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{$service_item->title}}
@endsection
@section('content')

    <div class="page-content service-details padding-top-120 padding-bottom-115">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="service-details-item">
                        <div class="thumb margin-bottom-40">
                            {!! render_image_markup_by_attachment_id($service_item->image) !!}
                        </div>
                        <div class="service-description">
                            {!! $service_item->description !!}
                        </div>
                        @if(!empty($price_plan))
                        <div class="price-plan-wrapper margin-top-40">
                            <div class="row">
                                @foreach($price_plan as $data)
                                <div class="col-lg-6">
                                    <div class="single-price-plan-01 margin-bottom-20">
                                        <div class="price-header">
                                            <div class="name-box">
                                                <h4 class="name">{{$data->title}}</h4>
                                            </div>
                                            <div class="price-wrap">
                                                <span class="price">{{amount_with_currency_symbol($data->price)}}</span><span
                                                        class="month">{{$data->type}}</span>
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
                                            <a href="{{$url}}" class="boxed-btn">{{$data->btn_text}}</a>
                                        </div>
                                    </div>
                                </div>
                                    @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="widget-area">
                        {!! App\WidgetsBuilder\WidgetBuilderSetup::render_frontend_sidebar('service',['column' => false]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
