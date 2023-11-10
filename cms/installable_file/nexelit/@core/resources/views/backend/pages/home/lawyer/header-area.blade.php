@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Header Area')}}
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
                        <h4 class="header-title">{{__('Header Area Settings')}}</h4>

                        <form action="{{route('admin.home10.header')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @php
                                   $all_bg_image_fields =  get_static_option('home_page_10_header_section_bg_image');
                                   $all_bg_image_fields = !empty($all_bg_image_fields) ? unserialize($all_bg_image_fields) : [''];
                                   $all_button_one_url_fields =  get_static_option('home_page_10_header_section_button_one_url');
                                   $all_button_one_url_fields = !empty($all_button_one_url_fields) ? unserialize($all_button_one_url_fields) : [];
                                   $all_button_two_url_fields =  get_static_option('home_page_10_header_section_button_two_url');
                                   $all_button_two_url_fields = !empty($all_button_two_url_fields) ? unserialize($all_button_two_url_fields) : [];
                            @endphp
                            @foreach($all_bg_image_fields as $index => $image_field)
                                <div class="iconbox-repeater-wrapper">
                                    <div class="all-field-wrap">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            @foreach($all_languages as $key => $lang)
                                                <li class="nav-item">
                                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$lang->slug}}_{{$key + $index}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content margin-top-30" id="myTabContent">
                                            @foreach($all_languages as $key => $lang)
                                                @php
                                                    $all_description_fields = get_static_option('home_page_10_'.$lang->slug.'_header_section_description');
                                                    $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [''];
                                                    $all_btn_one_text_fields = get_static_option('home_page_10_'.$lang->slug.'_header_section_button_one_text');
                                                    $all_btn_one_text_fields = !empty($all_btn_one_text_fields) ? unserialize($all_btn_one_text_fields,['class' => false]) : ['Practice Area'];
                                                    $all_btn_two_text_fields = get_static_option('home_page_10_'.$lang->slug.'_header_section_button_two_text');
                                                    $all_btn_two_text_fields = !empty($all_btn_two_text_fields) ? unserialize($all_btn_two_text_fields,['class' => false]) : ['About Us'];
                                                    $all_title_fields = get_static_option('home_page_10_'.$lang->slug.'_header_section_title');
                                                    $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : ['Welcome to Lawyer & Attorney'];
                                                    $all_subtitle_fields = get_static_option('home_page_10_'.$lang->slug.'_header_section_subtitle');
                                                    $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : ['We are here to help!'];
                                                @endphp

                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="home_page_10_{{$lang->slug}}_header_section_subtitle">{{__('Subtitle')}}</label>
                                                        <input type="text" name="home_page_10_{{$lang->slug}}_header_section_subtitle[]" class="form-control" value="{{$all_subtitle_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_10_{{$lang->slug}}_header_section_title">{{__('Title')}}</label>
                                                        <input type="text" name="home_page_10_{{$lang->slug}}_header_section_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_10_{{$lang->slug}}_header_section_description">{{__('Description')}}</label>
                                                        <textarea  name="home_page_10_{{$lang->slug}}_header_section_description[]" class="form-control" > {{$all_description_fields[$index] ?? ''}}</textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_10_{{$lang->slug}}_header_section_button_one_text">{{__('Button One Title')}}</label>
                                                        <input type="text" name="home_page_10_{{$lang->slug}}_header_section_button_one_text[]" class="form-control" value="{{$all_btn_one_text_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_10_{{$lang->slug}}_header_section_button_two_text">{{__('Button Two Title')}}</label>
                                                        <input type="text" name="home_page_10_{{$lang->slug}}_header_section_button_two_text[]" class="form-control" value="{{$all_btn_two_text_fields[$index] ?? ''}}">
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="home_page_10_header_section_button_one_url" class="d-block">{{__('Button One Url')}}</label>
                                                <input type="text" class="form-control" value="{{$all_button_one_url_fields[$index] ??''}}" name="home_page_10_header_section_button_one_url[]">
                                            </div>
                                            <div class="form-group">
                                                <label for="home_page_10_header_section_button_two_url" class="d-block">{{__('Button Two Url')}}</label>
                                                <input type="text" class="form-control" value="{{$all_button_two_url_fields[$index] ??''}}" name="home_page_10_header_section_button_two_url[]">
                                            </div>
                                            <div class="form-group">
                                                <label for="home_page_10_header_section_bg_image">{{__('Background Image')}}</label>
                                                @php $signature_image_upload_btn_label = 'Upload Image'; @endphp
                                                <div class="media-upload-btn-wrapper">
                                                    <div class="img-wrap">
                                                        @php
                                                            $signature_img = get_attachment_image_by_id($image_field,null,false);
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
                                                    <input type="hidden" name="home_page_10_header_section_bg_image[]" value="{{$image_field}}">
                                                    <button type="button" class="btn btn-info media_upload_form_btn" data-btntitle="{{__('Select Image')}}" data-modaltitle="{{__('Upload Image')}}" data-imgid="{{$image_field}}" data-toggle="modal" data-target="#media_upload_modal">
                                                        {{__($signature_image_upload_btn_label)}}
                                                    </button>
                                                </div>
                                                <small>{{__('recommended image size is 1920x1050 pixel')}}</small>
                                            </div>
                                        </div>
                                        <div class="action-wrap">
                                            <span class="add"><i class="ti-plus"></i></span>
                                            <span class="remove"><i class="ti-trash"></i></span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
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
    <script>
        $(document).ready(function () {

            $('.icp-dd').iconpicker();
            $('body').on('iconpickerSelected','.icp-dd', function (e) {
                var selectedIcon = e.iconpickerValue;
                $(this).parent().parent().children('input').val(selectedIcon);
                $('body .dropdown-menu.iconpicker-container').removeClass('show');
            });

            $(document).on('click','.all-field-wrap .action-wrap .add',function (e){
                e.preventDefault();

                var el = $(this);
                var parent = el.parent().parent();
                var container = $('.all-field-wrap');
                var clonedData = parent.clone();
                var containerLength = container.length;
                clonedData.find('#myTab').attr('id','mytab_'+containerLength);
                clonedData.find('#myTabContent').attr('id','myTabContent_'+containerLength);
                var allTab =  clonedData.find('.tab-pane');
                allTab.each(function (index,value){
                    var el = $(this);
                    var oldId = el.attr('id');
                    el.attr('id',oldId+containerLength);
                });
                var allTabNav =  clonedData.find('.nav-link');
                allTabNav.each(function (index,value){
                    var el = $(this);
                    var oldId = el.attr('href');
                    el.attr('href',oldId+containerLength);
                });

                parent.parent().append(clonedData);

                if (containerLength > 0){
                    parent.parent().find('.remove').show(300);
                }
                parent.parent().find('.iconpicker-popover').remove();
                parent.parent().find('.icp-dd').iconpicker();

            });

            $(document).on('click','.all-field-wrap .action-wrap .remove',function (e){
                e.preventDefault();
                var el = $(this);
                var parent = el.parent().parent();
                var container = $('.all-field-wrap');

                if (container.length > 1){
                    el.show(300);
                    parent.hide(300);
                    parent.remove();
                }else{
                    el.hide(300);
                }
            });

        });
    </script>
@endsection
