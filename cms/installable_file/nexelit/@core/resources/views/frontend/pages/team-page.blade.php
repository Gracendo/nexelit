@extends('frontend.frontend-page-master')
@section('site-title')
    {{get_static_option('team_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-title')
    {{get_static_option('team_page_'.$user_select_lang_slug.'_name')}}
@endsection
@section('page-meta-data')
    <meta name="description" content="{{get_static_option('team_page_'.$user_select_lang_slug.'_meta_description')}}">
    <meta name="tags" content="{{get_static_option('team_page_'.$user_select_lang_slug.'_meta_tags')}}">
    {!! render_og_meta_image_by_attachment_id(get_static_option('team_page_'.$user_select_lang_slug.'_meta_image')) !!}
@endsection
@section('content')

    <div class="team-member-area gray-bg team-page padding-120">
        <div class="container">
            <div class="row">
                @foreach($all_team_members as $data)
                    <div class="col-lg-3  col-sm-6 padding-bottom-60">
                        <div class="team-section">
                            <div class="team-img-cont">
                                {!! render_image_markup_by_attachment_id($data->image) !!}
                                <div class="social-link">
                                    <ul>
                                        @if(!empty($data->icon_one) && !empty($data->icon_one_url))
                                            <li><a href="{{$data->icon_one_url}}"><i class="{{$data->icon_one}}"></i></a></li>
                                        @endif
                                        @if(!empty($data->icon_two) && !empty($data->icon_two_url))
                                            <li><a href="{{$data->icon_two_url}}"><i class="{{$data->icon_two}}"></i></a></li>
                                        @endif
                                        @if(!empty($data->icon_three) && !empty($data->icon_three_url))
                                            <li><a href="{{$data->icon_three_url}}"><i class="{{$data->icon_three}}"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                            <div class="team-text">
                                <h4 class="title">{{$data->name}}</h4>
                                <span>{{$data->designation}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <div class="pagination-wrapper">
                        {{$all_team_members->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
