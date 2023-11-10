@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('clients_feedback_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('clients_feedback_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('clients_feedback_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('clients_feedback_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('clients_feedback_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')
    <div class="clients-feedbck-section padding-bottom-60 padding-top-120">
        <div class="container">
            <div class="row">
                @foreach($all_feedback as $data)
                <div class="col-lg-4">
                    <div class="teastimonial-item-09">
                        <div class="bottom-content">
                            <div class="clients-details">
                                <div class="content">
                                    <h4 class="name">{{$data->name}}</h4>
                                </div>
                            </div>
                            <ul class="ratings">
                                {!! ratings_markup($data->ratings,'li') !!}
                            </ul>
                            <p>{{$data->description}}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
@section('scripts')
 @include('frontend.partials.google-captcha')
@endsection