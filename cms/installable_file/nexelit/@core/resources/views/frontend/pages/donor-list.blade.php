@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('donor_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('donor_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('donor_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('donor_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('donor_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <section class="donor-list padding-bottom-90 padding-top-120">
        <div class="container">
            <div class="row">
                @foreach($all_donation_log as $data)
                <div class="col-lg-3 col-md-6">
                    <div class="single-donor-info">
                        <div class="thumb">
                            <img src="{{asset('assets/frontend/img/heart.png')}}" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                @if($data->anonymous == 1)
                                    {{__('anonymous')}}
                                 @else
                                {{$data->name}}
                                @endif
                            </h4>
                            <span class="amount">{{__("Donate:")}} {{amount_with_currency_symbol($data->amount)}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
