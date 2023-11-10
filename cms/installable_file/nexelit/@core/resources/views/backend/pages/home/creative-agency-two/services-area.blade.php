@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Services Area')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                @include('backend/partials/message')
                @include('backend/partials/error')
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Services Area Settings')}}</h4>

                        <form action="{{route('admin.home21.services')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="home_21_service_section_{{$lang}}_subtitle">{{__('Sub Title')}}</label>
                                            <input type="text" name="home_21_service_section_{{$lang->slug}}_subtitle" value="{{get_static_option('home_21_service_section_'.$lang->slug.'_subtitle')}}" class="form-control" >

                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="home_21_service_section_{{$lang->slug}}_title" value="{{get_static_option('home_21_service_section_'.$lang->slug.'_title')}}" class="form-control" >
                                            <small class="info-text">{{__('use {shape}text{/shape} to show shape in the title')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <textarea name="home_21_service_section_{{$lang->slug}}_description" class="form-control" cols="30" rows="10">{{get_static_option('home_21_service_section_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_{{$lang}}_button_one_text">{{__('Button One Text')}}</label>
                                            <input type="text" name="home_21_service_section_{{$lang->slug}}_button_one_text" value="{{get_static_option('home_21_service_section_'.$lang->slug.'_button_one_text')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_21_service_section_{{$lang}}_item_explore_one_text">{{__('Explore Text')}}</label>
                                            <input type="text" name="home_21_service_section_{{$lang->slug}}_item_explore_one_text" value="{{get_static_option('home_21_service_section_'.$lang->slug.'_item_explore_one_text')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_21_service_section_button_one_url">{{__('Button One URL')}}</label>
                                <input type="text" name="home_21_service_section_button_one_url" value="{{get_static_option('home_21_service_section_button_one_url')}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_service_area_items">{{__('Items')}}</label>
                                <input type="text" name="home_page_01_service_area_items" value="{{get_static_option('home_page_01_service_area_items')}}" class="form-control" >
                                <small class="info-text">{{__('enter how much service you want to show')}}</small>
                            </div>
                            <x-media-upload
                                    title="{{__('Left Shape Image')}}"
                                    name="home21_services_section_left_shape_image"
                                    id="{{get_static_option('home21_services_section_left_shape_image')}}"
                                    dimentions="770x1050"
                            />
                            <x-media-upload
                                    title="{{__('Right Shape Image')}}"
                                    name="home21_services_section_right_shape_image"
                                    id="{{get_static_option('home21_services_section_right_shape_image')}}"
                                    dimentions="770x1050"
                            />
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

