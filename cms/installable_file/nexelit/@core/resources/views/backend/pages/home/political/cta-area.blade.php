@extends('backend.admin-master')
@section('site-title')
    {{__('Call To Action Area')}}
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
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Call To Action Area Settings')}}</h4>
                        <form action="{{route('admin.home11.cta')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach(get_all_language() as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$key}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" >
                                @foreach(get_all_language() as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_cta_area_subtitle">{{__('Subtitle')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_cta_area_subtitle" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_cta_area_subtitle')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_cta_area_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_cta_area_title" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_cta_area_title')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_cta_area_description">{{__('Description')}}</label>
                                        <textarea name="home_page_11_{{$lang->slug}}_cta_area_description" cols="30" class="form-control" rows="5">{{get_static_option('home_page_11_'.$lang->slug.'_cta_area_description')}}</textarea>
                                    
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_cta_area_button_status"><strong>{{__('Button Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_11_{{$lang->slug}}_cta_area_button_status"  @if(!empty(get_static_option('home_page_11_'.$lang->slug.'_cta_area_button_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_cta_area_button_title">{{__('Button Title')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_cta_area_button_title" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_cta_area_button_title')}}" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_11_cta_area_button_url">{{__('Button URL')}}</label>
                                <input type="text" name="home_page_11_cta_area_button_url" class="form-control" value="{{get_static_option('home_page_11_cta_area_button_url')}}" >
                            </div>
                            <div class="form-group">
                                <label for="home_page_11_cta_area_background_image">{{__('Background Image')}}</label>
                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $iamge_id = get_static_option('home_page_11_cta_area_background_image');
                                            $signature_img = get_attachment_image_by_id($iamge_id,null,false);
                                        @endphp
                                        @if (!empty($signature_img))
                                            <div class="attachment-preview">
                                                <div class="thumbnail">
                                                    <div class="centered">
                                                        <img class="avatar user-thumb" src="{{$signature_img['img_url']}}" >
                                                    </div>
                                                </div>
                                            </div>
                                            @php $signature_image_upload_btn_label = 'Change Image'; @endphp
                                        @endif
                                    </div>
                                    <input type="hidden" name="home_page_11_cta_area_background_image" value="{{$iamge_id}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$iamge_id}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($signature_image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 1920x1000 pixel')}}</small>
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
