@extends('frontend.frontend-master')

@section('content')
    @php
    $page_partial = 'home-'.get_static_option('home_page_variant');
    if (!empty(get_static_option('home_page_page_builder_status'))){
        $page_partial = 'page-builder';
    }
    @endphp
@include('frontend.home-pages.'.$page_partial)

@endsection
