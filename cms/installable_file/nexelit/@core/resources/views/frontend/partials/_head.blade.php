<!DOCTYPE html>
<html lang="{{$user_select_lang_slug}}"  dir="{{get_user_lang_direction()}}">
@php
    $home_page_variant = $home_page ?? filter_static_option_value('home_page_variant',$global_static_field_data);
@endphp
<head>
@if(!empty(filter_static_option_value('site_google_analytics',$global_static_field_data)))
    <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id={{filter_static_option_value('site_google_analytics',$global_static_field_data)}}"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', "{{filter_static_option_value('site_google_analytics',$global_static_field_data)}}");
        </script>
    @endif
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {!! render_favicon_by_id(filter_static_option_value('site_favicon',$global_static_field_data)) !!}
<!-- load fonts dynamically -->
    {!! load_google_fonts() !!}

    <link rel=preload href="{{asset('assets/frontend/css/fontawesome.min.css')}}" as="style">
    <link rel=preload href="{{asset('assets/frontend/css/flaticon.css')}}" as="style">
    <link rel=preload href="{{asset('assets/frontend/css/nexicon.css')}}" as="style">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/flaticon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/nexicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/fontawesome.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/animate.css')}}">

    <link rel="stylesheet" href="{{asset('assets/frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/jquery.ihavecookies.css')}}">
    <link rel="stylesheet" href="{{asset('assets/frontend/css/dynamic-style.css')}}">



    @if(file_exists('assets/frontend/css/home-'.$home_page_variant.'.css'))
        <link rel="stylesheet" href="{{asset('assets/frontend/css/home-'.$home_page_variant.'.css')}}">
    @endif
    @include('frontend.partials.css-variable')
    @yield('style')
    @if(!empty(filter_static_option_value('site_rtl_enabled',$global_static_field_data)) || get_user_lang_direction() == 'rtl')
        <link rel="stylesheet" href="{{asset('assets/frontend/css/rtl.css')}}">
    @endif
    @include('frontend.partials.og-meta')

<!-- jquery -->
    <script src="{{asset('assets/frontend/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('assets/frontend/js/jquery-migrate-3.1.0.min.js')}}"></script>
    <script>var siteurl = "{{url('/')}}"</script>
    {!! get_static_option('site_third_party_tracking_code') !!}
</head>

{{-- THIS FILE WILL BE REMOVED IN VERION 3.0 --}}