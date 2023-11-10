@extends('backend.admin-master')
@section('site-title')
    {{__('Speciality Area')}}
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
                        <h4 class="header-title">{{__('Speciality Area Settings')}}</h4>

                        <form action="{{route('admin.home17.speciality')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="course_home_page_{{$lang}}_specialities_area_title">{{__('Title')}}</label>
                                            <input type="text" name="course_home_page_{{$lang->slug}}_specialities_area_title" value="{{get_static_option('course_home_page_'.$lang->slug.'_specialities_area_title')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @php
                                $all_icon_fields =  get_static_option('course_home_page_specialities_item_icon');
                                $all_icon_fields = !empty($all_icon_fields) ? unserialize($all_icon_fields,['class' => false]) : ['fas fa-star'];
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
                                                    $all_title_fields = get_static_option('course_home_page_'.$lang->slug.'_specialities_item_title');
                                                    $all_title_fields = !empty($all_title_fields) ? unserialize($all_title_fields,['class' => false]) : [''];
                                                    $all_description_fields = get_static_option('course_home_page_'.$lang->slug.'_specialities_item_description');
                                                    $all_description_fields = !empty($all_description_fields) ? unserialize($all_description_fields,['class' => false]) : [''];
                                                    $all_url_fields = get_static_option('course_home_page_specialities_item_url');
                                                    $all_url_fields = !empty($all_url_fields) ? unserialize($all_url_fields,['class' => false]) : [''];
                                                @endphp

                                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$lang->slug}}_{{$key + $index}}" role="tabpanel" >
                                                    <div class="form-group">
                                                        <label for="course_home_page_{{$lang->slug}}_specialities_item_title">{{__('Title')}}</label>
                                                        <input type="text" name="course_home_page_{{$lang->slug}}_specialities_item_title[]" class="form-control" value="{{$all_title_fields[$index] ?? ''}}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="course_home_page_{{$lang->slug}}_specialities_item_description">{{__('Description')}}</label>
                                                        <textarea name="course_home_page_{{$lang->slug}}_specialities_item_description[]" class="form-control" cols="30" rows="10">{{$all_description_fields[$index] ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label for="course_home_page_specialities_item_url">{{__('URL')}}</label>
                                                <input type="text" name="course_home_page_specialities_item_url[]" class="form-control" value="{{$all_url_fields[$index] ?? ''}}">
                                            </div>
                                            <x-icon-picker-static :value="$icon_field" :name="'course_home_page_specialities_item_icon[]'" :title="__('Icon')"/>
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
    @include('backend.partials.icon-field.js')
    @include('backend.partials.repeater.script')
@endsection