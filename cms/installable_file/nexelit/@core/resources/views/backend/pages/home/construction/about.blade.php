@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('site-title')
    {{__('About Area')}}
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
                        <h4 class="header-title">{{__('About Area Settings')}}</h4>

                        <form action="{{route('admin.home09.about')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="construction_about_section_{{$lang}}_subtitle">{{__('Subtitle')}}</label>
                                            <input type="text" name="construction_about_section_{{$lang->slug}}_subtitle" value="{{get_static_option('construction_about_section_'.$lang->slug.'_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="construction_about_section_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="construction_about_section_{{$lang->slug}}_title" value="{{get_static_option('construction_about_section_'.$lang->slug.'_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="construction_about_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <input type="hidden" name="construction_about_section_{{$lang->slug}}_description" >
                                            <div class="summernote" data-content='{{get_static_option('construction_about_section_'.$lang->slug.'_description')}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="construction_about_section_{{$lang}}_button_one_text">{{__('Button Text')}}</label>
                                            <input type="text" name="construction_about_section_{{$lang->slug}}_button_one_text" value="{{get_static_option('construction_about_section_'.$lang->slug.'_button_one_text')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="construction_about_section_{{$lang}}_experience_year_title">{{__('Experience Year Title')}}</label>
                                            <input type="text" name="construction_about_section_{{$lang->slug}}_experience_year_title" value="{{get_static_option('construction_about_section_'.$lang->slug.'_experience_year_title')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="construction_about_section_button_one_url">{{__('Button URL')}}</label>
                                <input type="text" name="construction_about_section_button_one_url" value="{{get_static_option('construction_about_section_button_one_url')}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="construction_about_section_video_url">{{__('Video Url URL')}}</label>
                                <input type="text" name="construction_about_section_video_url" value="{{get_static_option('construction_about_section_video_url')}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="construction_about_section_experience_year">{{__('Experience Year')}}</label>
                                <input type="text" name="construction_about_section_experience_year" value="{{get_static_option('construction_about_section_experience_year')}}" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="construction_about_section_button_one_icon" class="d-block">{{__('Button Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="{{get_static_option('construction_about_section_button_one_icon')}}"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="{{get_static_option('construction_about_section_button_one_icon')}}" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" value="{{get_static_option('construction_about_section_button_one_icon')}}" name="construction_about_section_button_one_icon">
                            </div>
                            <div class="form-group">
                                <label for="construction_about_section_left_image">{{__('Left Image')}}</label>
                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                <div class="media-upload-btn-wrapper">
                                    <div class="img-wrap">
                                        @php
                                            $signature_img = get_attachment_image_by_id(get_static_option('construction_about_section_left_image'),null,false);
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
                                    <input type="hidden" name="construction_about_section_left_image" value="{{get_static_option('construction_about_section_left_image')}}">
                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{get_static_option('construction_about_section_left_image')}}" data-toggle="modal" data-target="#media_upload_modal">
                                        {{__($signature_image_upload_btn_label)}}
                                    </button>
                                </div>
                                <small>{{__('recommended image size is 450x375 pixel')}}</small>
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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function () {

            $('.summernote').summernote({
                height: 200,   //set editable area's height
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

            $('.icp-dd').iconpicker();
            $('body').on('iconpickerSelected','.icp-dd', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
                $('body .dropdown-menu.iconpicker-container').removeClass('show');
            });

        });
    </script>
@endsection
