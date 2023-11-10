@extends('backend.admin-master')
@section('site-title')
    {{__('Service Area')}}
@endsection
@section('style')
    @include('backend.partials.media-upload.style')
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
               <x-flash-msg/>
               <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Service Area Settings')}}</h4>
                        <form action="{{route('admin.home11.service')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs " id="myTab" role="tablist">
                                @foreach($all_languages as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->first) active @endif" data-toggle="tab" href="#home_{{$key}}" role="tab" aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" id="myTabContent">
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($loop->first) show active @endif" id="home_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_service_area_subtitle">{{__('Subtitle')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_service_area_subtitle" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_service_area_subtitle')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_service_area_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_service_area_title" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_service_area_title')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_11_{{$lang->slug}}_service_area_readmore_text">{{__('Readmore Text')}}</label>
                                        <input type="text" name="home_page_11_{{$lang->slug}}_service_area_readmore_text" class="form-control" value="{{get_static_option('home_page_11_'.$lang->slug.'_service_area_readmore_text')}}" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_01_service_area_items">{{__('Service Items')}}</label>
                                <input type="text" name="home_page_01_service_area_items" class="form-control"
                                       value="{{get_static_option('home_page_01_service_area_items')}}"
                                       id="home_page_01_service_area_items">
                                <small class="info-text">{{__('enter how many service show in frontend')}}</small>
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
