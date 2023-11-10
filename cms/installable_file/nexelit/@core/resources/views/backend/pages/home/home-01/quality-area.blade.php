@extends('backend.admin-master')
@section('site-title')
    {{__('Quality Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
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
                        <h4 class="header-title">{{__('Quality Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.quality.area')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                @foreach(get_all_language() as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$key}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach(get_all_language() as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_quality_area_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_quality_area_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_quality_area_title')}}" id="home_page_01_{{$lang->slug}}_quality_area_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_quality_area_description">{{__('Description')}}</label>
                                        <textarea name="home_page_01_{{$lang->slug}}_quality_area_description" class="form-control" rows="10" id="home_page_01_{{$lang->slug}}_quality_area_description">{{get_static_option('home_page_01_'.$lang->slug.'_quality_area_description')}}</textarea>
                                    </div>
                                    @if(get_static_option('home_page_variant') != '04')
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_quality_area_button_status"><strong>{{__('Button Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_01_{{$lang->slug}}_quality_area_button_status"  @if(!empty(get_static_option('home_page_01_'.$lang->slug.'_quality_area_button_status'))) checked @endif id="home_page_01_{{$lang->slug}}_quality_area_button_status">
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_quality_area_button_title">{{__('Button Title')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_quality_area_button_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_quality_area_button_title')}}" id="home_page_01_{{$lang->slug}}_quality_area_button_title">
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_quality_area_button_url">{{__('Button URL')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_quality_area_button_url" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_quality_area_button_url')}}" id="home_page_01_{{$lang->slug}}_quality_area_button_url">
                                    </div>
                                    @endif
                                    @if(get_static_option('home_page_variant') == '04')
                                        <div class="form-group">
                                            <label for="home_page_04_{{$lang->slug}}_quality_area_list">{{__('Bullet List')}}</label>
                                            <textarea name="home_page_01_{{$lang->slug}}_quality_area_list" id="home_page_01_{{$lang->slug}}_quality_area_list" class="form-control" cols="30" rows="5">{{get_static_option('home_page_01_'.$lang->slug.'_quality_area_list')}}</textarea>
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @if(get_static_option('home_page_variant') == '01')
                            <div class="form-group">
                                <label for="home_page_01_quality_area_background_image">{{__('Background Image')}}</label>
                                @php $cta_image_upload_btn_label = 'Upload Background Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $cta_bg_img = get_attachment_image_by_id(get_static_option('home_page_01_quality_area_background_image'),null,false);
                                        @endphp
                                        @if (!empty($cta_bg_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$cta_bg_img['img_url']}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            @php $cta_image_upload_btn_label = 'Change Background Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="home_page_01_quality_area_background_image" value="{{get_static_option('home_page_01_quality_area_background_image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Background Image')}}" data-modaltitle="{{__('Upload Background Image')}}" data-imgid="{{get_static_option('home_page_01_quality_area_background_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($cta_image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 950x530 pixel')}}</small>
                            </div>
                            @endif
                            @if(get_static_option('home_page_variant') == '02')
                                <div class="form-group">
                                    <label for="home_page_02_quality_area_image">{{__('Map Image')}}</label>
                                    @php $cta_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $cta_bg_img = get_attachment_image_by_id(get_static_option('home_page_02_quality_area_image'),null,false);
                                            @endphp
                                            @if (!empty($cta_bg_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$cta_bg_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $cta_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_02_quality_area_image" value="{{get_static_option('home_page_02_quality_area_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_02_quality_area_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($cta_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 650x380 pixel')}}</small>
                                </div>
                            @endif
                            @if(get_static_option('home_page_variant') == '04')
                                <div class="form-group">
                                    <label for="home_page_04_quality_area_image">{{__('Image')}}</label>
                                    @php $cta_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $cta_bg_img = get_attachment_image_by_id(get_static_option('home_page_04_quality_area_image'),null,false);
                                            @endphp
                                            @if (!empty($cta_bg_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$cta_bg_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $cta_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_04_quality_area_image" value="{{get_static_option('home_page_04_quality_area_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_04_quality_area_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($cta_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 570x590 pixel')}}</small>
                                </div>
                            @endif
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
