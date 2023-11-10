@extends('backend.admin-master')
@section('site-title')
    {{__('Team Member Area')}}
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
                        <h4 class="header-title">{{__('Team Member Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.team.member')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                @foreach(get_all_language() as $key => $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#home_{{$key}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach(get_all_language() as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="home_{{$key}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_team_member_section_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_01_{{$lang->slug}}_team_member_section_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_team_member_section_title')}}" id="home_page_01_{{$lang->slug}}_team_member_section_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_team_member_section_description">{{__('Description')}}</label>
                                            <textarea name="home_page_01_{{$lang->slug}}_team_member_section_description" id="home_page_01_{{$lang->slug}}_team_member_section_description" class="form-control max-height-120" cols="30" rows="10">{{get_static_option('home_page_01_'.$lang->slug.'_team_member_section_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_team_member_items">{{__('Team Member Items')}}</label>
                                <input type="text" name="home_page_01_team_member_items" id="home_page_01_team_member_items" class="form-control"  value="{{get_static_option('home_page_01_team_member_items')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Settings')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

