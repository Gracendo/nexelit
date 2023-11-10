@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Team Member Section')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Team Member Section Settings')}}</h4>

                        <form action="{{route('admin.about.team.member')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="about_page_{{$lang}}_team_member_section_title">{{__('Title')}}</label>
                                            <input type="text" name="about_page_{{$lang->slug}}_team_member_section_title" value="{{get_static_option('about_page_'.$lang->slug.'_team_member_section_title')}}" class="form-control" id="about_page_{{$lang->slug}}_team_member_section_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="about_page_{{$lang->slug}}_team_member_section_description">{{__('Description')}}</label>
                                            <textarea name="about_page_{{$lang->slug}}_team_member_section_description" id="about_page_{{$lang->slug}}_team_member_section_description" class="form-control max-height-150" cols="30" rows="10">{{get_static_option('about_page_'.$lang->slug.'_team_member_section_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="about_page_team_member_item">{{__('Team Member Item')}}</label>
                                <input type="text" name="about_page_team_member_item" value="{{get_static_option('about_page_team_member_item')}}" class="form-control" id="about_page_team_member_item">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection

@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
