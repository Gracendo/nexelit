@extends('backend.admin-master')
@section('site-title')
    {{__('About Us Area')}}
@endsection
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
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
                        <h4 class="header-title">{{__('About Us Area Settings')}}</h4>
                        <form action="{{route('admin.homeone.about.us')}}" method="post" enctype="multipart/form-data">
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
                                        <label for="home_page_01_{{$lang->slug}}_about_us_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_about_us_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_about_us_title')}}" id="home_page_01_{{$lang->slug}}_about_us_title">
                                    </div>
                                    @if(get_static_option('home_page_variant') == '01' || get_static_option('home_page_variant') == '02' )
                                    <div class="form-group">
                                        <label for="home_page_01_{{$lang->slug}}_about_us_video_url">{{__('Video Url')}}</label>
                                        <input type="text" name="home_page_01_{{$lang->slug}}_about_us_video_url" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_about_us_video_url')}}" id="home_page_01_{{$lang->slug}}_about_us_video_url">
                                    </div>
                                    @endif
                                    @if(get_static_option('home_page_variant') != '01' )
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_description">{{__('Description')}}</label>
                                             <input type="hidden" name="home_page_01_{{$lang->slug}}_about_us_description" >
                                             <div class="summernote" data-content='{{get_static_option('home_page_01_'.$lang->slug.'_about_us_description')}}'></div>
                                        </div>
                                    @endif
                                    @if(get_static_option('home_page_variant') == '02' || get_static_option('home_page_variant') == '03' )
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_quote_text">{{__('Quote Text')}}</label>
                                            <input type="text" name="home_page_01_{{$lang->slug}}_about_us_quote_text" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_about_us_quote_text')}}" id="home_page_01_{{$lang->slug}}_about_us_quote_text">
                                        </div>
                                    @endif
                                    @if(get_static_option('home_page_variant') == '04' )
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_our_mission_title">{{__('Our Mission Title')}}</label>
                                            <input type="text" name="home_page_01_{{$lang->slug}}_about_us_our_mission_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_about_us_our_mission_title')}}" id="home_page_01_{{$lang->slug}}_about_us_our_mission_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_our_mission_description">{{__('Our Mission Description')}}</label>
                                             <input type="hidden" name="home_page_01_{{$lang->slug}}_about_us_our_mission_description" >
                                             <div class="summernote" data-content='{{get_static_option('home_page_01_'.$lang->slug.'_about_us_our_mission_description')}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_our_vision_title">{{__('Our Vision Title')}}</label>
                                            <input type="text" name="home_page_01_{{$lang->slug}}_about_us_our_vision_title" class="form-control" value="{{get_static_option('home_page_01_'.$lang->slug.'_about_us_our_vision_title')}}" id="home_page_01_{{$lang->slug}}_about_us_our_vision_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_01_{{$lang->slug}}_about_us_our_vision_description">{{__('Our Vision Description')}}</label>
                                             <input type="hidden" name="home_page_01_{{$lang->slug}}_about_us_our_vision_description" >
                                             <div class="summernote" data-content='{{get_static_option('home_page_01_'.$lang->slug.'_about_us_our_vision_description')}}'></div>
                                        </div>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @if(get_static_option('home_page_variant') == '01')
                                <div class="form-group">
                                    <label>{{__('Background Image')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload background Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_01_about_us_video_background_image'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Background Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_01_about_us_video_background_image" value="{{get_static_option('home_page_01_about_us_video_background_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Background Image')}}" data-modaltitle="{{__('Upload Background Image')}}" data-imgid="{{get_static_option('home_page_01_about_us_video_background_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 850x480 pixel')}}</small>
                                </div>
                            @endif
                            @if(get_static_option('home_page_variant') == '02')
                                <div class="form-group">
                                    <label>{{__('Background Image')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload background Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_02_about_us_video_background_image'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Background Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_02_about_us_video_background_image" value="{{get_static_option('home_page_02_about_us_video_background_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Background Image')}}" data-modaltitle="{{__('Upload Background Image')}}" data-imgid="{{get_static_option('home_page_02_about_us_video_background_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 960x760 pixel')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>{{__('Signature Image')}}</label>
                                    @php $signature_image_upload_btn_label = 'Upload Signature Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $signature_img = get_attachment_image_by_id(get_static_option('home_page_02_about_us_signature_image'),null,false);
                                            @endphp
                                            @if (!empty($signature_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$signature_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $signature_image_upload_btn_label = 'Change Signature Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_02_about_us_signature_image" value="{{get_static_option('home_page_02_about_us_signature_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Signature Image')}}" data-modaltitle="{{__('Upload Signature Image')}}" data-imgid="{{get_static_option('home_page_02_about_us_signature_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($signature_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 100x50 pixel')}}</small>
                                </div>
                            @endif
                            @if(get_static_option('home_page_variant') == '03')
                                <div class="form-group">
                                    <label>{{__('Image 01')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_03_about_us_image_one'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_03_about_us_image_one" value="{{get_static_option('home_page_03_about_us_image_one')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_03_about_us_image_one')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 360x480 pixel')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>{{__('Image 02')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_03_about_us_image_two'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_03_about_us_image_two" value="{{get_static_option('home_page_03_about_us_image_two')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_03_about_us_image_two')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 360x480 pixel')}}</small>
                                </div>
                            @endif
                            @if(get_static_option('home_page_variant') == '04')
                                <div class="form-group">
                                    <label>{{__('Our Mission Image')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_04_about_us_our_mission_image'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_04_about_us_our_mission_image" value="{{get_static_option('home_page_04_about_us_our_mission_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_04_about_us_our_mission_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 480x350 pixel')}}</small>
                                </div>
                                <div class="form-group">
                                    <label>{{__('Our Vision Image')}}</label>
                                    @php $background_image_upload_btn_label = 'Upload Image'; @endphp
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            @php
                                                $background_img = get_attachment_image_by_id(get_static_option('home_page_04_about_us_our_vision_image'),null,false);
                                            @endphp
                                            @if (!empty($background_img))
                                                <div class="attachment-preview">
                                                    <div class="thumbnail">
                                                        <div class="centered">
                                                            <img class="avatar user-thumb" src="{{$background_img['img_url']}}" >
                                                        </div>
                                                    </div>
                                                </div>
                                                @php $background_image_upload_btn_label = 'Change Image'; @endphp
                                            @endif
                                        </div>
                                        <input type="hidden" name="home_page_04_about_us_our_vision_image" value="{{get_static_option('home_page_04_about_us_our_vision_image')}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('home_page_04_about_us_our_vision_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                            {{__($background_image_upload_btn_label)}}
                                        </button>
                                    </div>
                                    <small>{{__('recommended image size is 480x350 pixel')}}</small>
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
     <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function(contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });

            if($('.summernote').length > 0){
                $('.summernote').each(function(index,value){
                    $(this).summernote('code', $(this).data('content'));
                });
            }

        });
    </script>
@endsection