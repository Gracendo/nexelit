@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('contact_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('contact_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('contact_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('contact_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('contact_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    @if(!empty(get_static_option('contact_page_page_builder_status')))
        {!! \App\PageBuilder\PageBuilderSetup::render_frontend_pagebuilder_content_by_location('contactpage') !!}
    @else
        @include('frontend.partials.contact-page-content')
    @endif

@endsection
@section('scripts')
 @include('frontend.partials.google-captcha')
@endsection