@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('site-title')
    {{__('Promo Area')}}
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
                        <h4 class="header-title">{{__('Promo Area Settings')}}</h4>

                        <form action="{{route('admin.home19.promo.area')}}" method="post" enctype="multipart/form-data">
                            @csrf

                            @php
                                $all_icon_fields =  get_static_option('home19_promo_section_icon');
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : ['#'];
                            @endphp
                            @foreach($all_icon_fields as $index => $icon_field)
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
                                                     $all_title_fields = get_static_option('home_19_promo_section_'.$lang->slug.'_title');
                                                     $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [];

                                                     $all_subtitle_fields = get_static_option('home_19_promo_section_'.$lang->slug.'_subtitle');
                                                     $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields,['class' => false]) : [];

                                                     $all_title_fields_url = get_static_option('home_19_promo_section_'.$lang->slug.'_title_url');
                                                     $all_title_fields_url = !empty($all_title_fields_url) ? unserialize($all_title_fields_url,['class' => false]) : [];
                                                @endphp

                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="home_19_header_section_{{$lang->slug}}_title">{{__('Title')}}</label>
                                                        <input type="text" name="home_19_promo_section_{{$lang->slug}}_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_19_header_section_{{$lang->slug}}_subtitle">{{__('Subtitle')}}</label>
                                                        <input type="text" name="home_19_promo_section_{{$lang->slug}}_subtitle[]" class="form-control" value="{{$all_subtitle_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_19_header_section_{{$lang->slug}}_button_text">{{__('Title URL')}}</label>
                                                        <input type="text" name="home_19_promo_section_{{$lang->slug}}_title_url[]" class="form-control" value="{{$all_title_fields_url[$index] ?? ''}}">
                                                    </div>
                                                </div>
                                            @endforeach

                                                <div class="form-group">
                                                    <label for="home_page_11_key_features_section_icon" class="d-block">{{__('Icon')}}</label>
                                                    <div class="btn-group ">
                                                        <button type="button" class="btn btn-primary iconpicker-component">
                                                            <i class="{{$icon_field}}"></i>
                                                        </button>
                                                        <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                                                data-selected="{{$icon_field}}" data-toggle="dropdown">
                                                            <span class="caret"></span>
                                                            <span class="sr-only">Toggle Dropdown</span>
                                                        </button>
                                                        <div class="dropdown-menu"></div>
                                                    </div>
                                                    <input type="hidden" class="form-control" value="{{$icon_field}}" name="home19_promo_section_icon[]">
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
