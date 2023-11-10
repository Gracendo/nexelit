@extends('backend.admin-master')
@section('site-title')
    {{__('Price Plan Area')}}
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
                        <h4 class="header-title">{{__('Price Plan Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.price.plan')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="home_page_01_{{$lang->slug}}_price_plan_section_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_01_{{$lang->slug}}_price_plan_section_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_price_plan_section_title')}}" id="home_page_01_{{$lang->slug}}_price_plan_section_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_price_plan_section_description">{{__('Description')}}</label>
                                            <textarea name="home_page_01_{{$lang->slug}}_price_plan_section_description" id="home_page_01_{{$lang->slug}}_price_plan_section_description" class="form-control max-height-120" cols="30" rows="10">{{get_static_option('home_page_01_'.$lang->slug.'_price_plan_section_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="form-group">
                                <label for="home_page_01_price_plan_section_items">{{__('Items')}}</label>
                                <input type="text" name="home_page_01_price_plan_section_items" class="form-control" value="{{get_static_option('home_page_01_price_plan_section_items')}}" id="home_page_01_price_plan_section_items">
                                <small class="info-text">{{__('enter how many service show in frontend')}}</small>
                            </div>
                            @if(get_static_option('home_page_variant') == '01' || get_static_option('home_page_variant') == '03')
                                <div class="form-group">
                                    <label for="home_page_01_price_plan_background_image">{{__('Background Image')}}</label>
                                    @php $cta_image_upload_btn_label = 'Upload Background Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $cta_bg_img = get_attachment_image_by_id(get_static_option('home_page_01_price_plan_background_image'),null,false);
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
                                        <input type="hidden" name="home_page_01_price_plan_background_image" value="{{get_static_option('home_page_01_price_plan_background_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Background Image')}}" data-modaltitle="{{__('Upload Background Image')}}" data-imgid="{{get_static_option('home_page_01_price_plan_background_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($cta_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 1920x1000 pixel')}}</small>
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
