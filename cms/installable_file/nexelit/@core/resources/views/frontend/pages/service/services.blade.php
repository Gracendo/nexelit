@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('service_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('service_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('service_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="service-area service-page padding-120">
        <div class="container">
            <div class="row">
                @php $a = 1; @endphp
                @foreach($all_services as $data)
                    <div class="col-lg-4 col-md-6">
                        <x-frontend.service.grid :increment="$a" :service="$data"/>
                    </div>
                    @php
                        if($a == 4){ $a = 1;}else{$a++;}; @endphp
                @endforeach
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_services->links()}}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
