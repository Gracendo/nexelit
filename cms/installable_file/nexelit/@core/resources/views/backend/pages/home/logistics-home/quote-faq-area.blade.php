@extends('backend.admin-master')
@section('site-title')
    {{__('Quote & Faq Area')}}
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
                        <h4 class="header-title">{{__('Quote & Faq Area Settings')}}</h4>

                        <form action="{{route('admin.home06.quote.faq.area')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="logistic_quote_section_{{$lang}}_subtitle">{{__('Quote Subtitle')}}</label>
                                            <input type="text" name="logistic_quote_section_{{$lang->slug}}_subtitle" value="{{get_static_option('logistic_quote_section_'.$lang->slug.'_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="logistic_quote_section_{{$lang}}_title">{{__('Quote Title')}}</label>
                                            <input type="text" name="logistic_quote_section_{{$lang->slug}}_title" value="{{get_static_option('logistic_quote_section_'.$lang->slug.'_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="logistic_quote_section_{{$lang}}_button_text">{{__('Quote Button Text')}}</label>
                                            <input type="text" name="logistic_quote_section_{{$lang->slug}}_button_text" value="{{get_static_option('logistic_quote_section_'.$lang->slug.'_button_text')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="logistic_faq_section_{{$lang}}_subtitle">{{__('FAQ Subtitle')}}</label>
                                            <input type="text" name="logistic_faq_section_{{$lang->slug}}_subtitle" value="{{get_static_option('logistic_faq_section_'.$lang->slug.'_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="logistic_faq_section_{{$lang}}_title">{{__('FAQ Title')}}</label>
                                            <input type="text" name="logistic_faq_section_{{$lang->slug}}_title" value="{{get_static_option('logistic_faq_section_'.$lang->slug.'_title')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @php
                                $all_title_fields = get_static_option('home_page_06_'.get_default_language().'_faq_item_title');
                                $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [''];
                            @endphp
                            @foreach($all_title_fields as $index => $title_field)
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
                                                      $all_title_fields = get_static_option('home_page_06_'.$lang->slug.'_faq_item_title');
                                                      $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields) : [''];
                                                      $all_subtitle_fields = get_static_option('home_page_06_'.$lang->slug.'_faq_item_description');
                                                      $all_subtitle_fields = !empty($all_subtitle_fields) ? unserialize($all_subtitle_fields) : [''];
                                                @endphp

                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="home_page_06_{{$lang->slug}}_faq_item_title">{{__('Title')}}</label>
                                                        <input type="text" name="home_page_06_{{$lang->slug}}_faq_item_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="home_page_06_{{$lang->slug}}_faq_item_description">{{__('Description')}}</label>
                                                        <textarea name="home_page_06_{{$lang->slug}}_faq_item_description[]" class="form-control">{{$all_subtitle_fields[$index] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach

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
@endsection


@section('script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    <script>
        $(document).ready(function () {

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