@extends('backend.admin-master')
@section('site-title')
    {{__('New Instructor')}}
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
                <x-error-msg/>
                <x-flash-msg/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between margin-bottom-30">
                            <h4 class="header-title">{{__('Add New Instructor')}}</h4>
                            <a href="{{route('admin.courses.instructor.all')}}" class="btn btn-info">{{__('All Instructor')}}</a>
                        </div>
                        <form action="{{route('admin.courses.instructor.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $lang)
                                    <li class="nav-item">
                                        <a class="nav-link @if($loop->first) active @endif"  data-toggle="tab" href="#slider_tab_{{$lang->slug}}" role="tab" aria-controls="home" aria-selected="true">{{$lang->name}}</a>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-40" >
                                @foreach($all_languages as $lang)
                                    <div class="tab-pane fade @if($loop->first) show active @endif" id="slider_tab_{{$lang->slug}}" role="tabpanel" >
                                        <div class="form-group">
                                            <label for="description">{{__('Description')}}</label>
                                            <textarea class="form-control" name="description[{{$lang->slug}}]"cols="30" rows="5"  placeholder="{{__('Description')}}"></textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control" name="name" placeholder="{{__('Name')}}">
                            </div>
                            <div class="form-group">
                                <label for="designation">{{__('Designation')}}</label>
                                <input type="text" class="form-control" name="designation" placeholder="{{__('Designation')}}">
                            </div>
                            <x-media-upload :name="'image'" :title="__('Image')" :id="null" :dimentions="'200x200px'" />
                            <div class="iconbox-repeater-wrapper dynamic-repeater">
                                <label for="additional_info" class="d-block">{{__('Social Icons')}}</label>
                                <div class="all-field-wrap">
                                    <x-backend.icon-field :title="__('Icon')" :name="'social_icon[]'" :icon="null"/>
                                    <div class="form-group margin-top-20">
                                        <label for="">{{__('URL')}}</label>
                                        <input type="text" class="form-control" name="social_icon_url[]"  placeholder="{{__('social icon url')}}">
                                    </div>
                                    <div class="action-wrap">
                                        <span class="add"><i class="ti-plus"></i></span>
                                        <span class="remove"><i class="ti-trash"></i></span>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add New')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('backend.partials.media-upload.media-upload-markup')
@endsection
@section('script')
    @include('backend.partials.repeater.script')
    <script src="{{asset('assets/backend/js/dropzone.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
    @include('backend.partials.icon-field.js')
@endsection
