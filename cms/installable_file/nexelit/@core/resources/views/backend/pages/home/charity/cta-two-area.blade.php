@extends('backend.admin-master')
@section('site-title')
    {{__('Join Volunteer Area')}}
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
                        <h4 class="header-title">{{__('Join Volunteer Area Settings')}}</h4>
                        <form action="{{route('admin.home13.cta.two')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <ul class="nav nav-tabs" role="tablist">
                                @foreach($all_languages as $key => $lang)
                                <li class="nav-item">
                                    <a class="nav-link @if($key == 0) active @endif" data-toggle="tab" href="#tab_{{$key}}" role="tab"  aria-selected="true">{{$lang->name}}</a>
                                </li>
                                @endforeach
                            </ul>
                            <div class="tab-content margin-top-30" >
                                @foreach($all_languages as $key => $lang)
                                <div class="tab-pane fade @if($key == 0) show active @endif" id="tab_{{$key}}" role="tabpanel" >
                                    <div class="form-group">
                                        <label for="home_page_13_{{$lang->slug}}_cta_two_area_title">{{__('Title')}}</label>
                                        <input type="text" name="home_page_13_{{$lang->slug}}_cta_two_area_title" class="form-control" value="{{get_static_option('home_page_13_'.$lang->slug.'_cta_two_area_title')}}" >
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_13_{{$lang->slug}}_cta_two_area_button_status"><strong>{{__('Button Show/Hide')}}</strong></label>
                                        <label class="switch">
                                            <input type="checkbox" name="home_page_13_{{$lang->slug}}_cta_two_area_button_status"  @if(!empty(get_static_option('home_page_13_'.$lang->slug.'_cta_two_area_button_status'))) checked @endif >
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                    <div class="form-group">
                                        <label for="home_page_13_{{$lang->slug}}_cta_two_area_button_title">{{__('Button Title')}}</label>
                                        <input type="text" name="home_page_13_{{$lang->slug}}_cta_two_area_button_title" class="form-control" value="{{get_static_option('home_page_13_'.$lang->slug.'_cta_two_area_button_title')}}" >
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_13_cta_two_area_button_url">{{__('Button URL')}}</label>
                                <input type="text" name="home_page_13_cta_two_area_button_url" class="form-control" value="{{get_static_option('home_page_13_cta_two_area_button_url')}}" >
                            </div>

                            <div class="form-group">
                                <label for="home_page_13_cta_two_section_button_icon" class="d-block">{{__('Icon')}}</label>
                                <div class="btn-group ">
                                    <button type="button" class="btn btn-primary iconpicker-component">
                                        <i class="{{get_static_option('home_page_13_cta_two_section_button_icon')}}"></i>
                                    </button>
                                    <button type="button" class="icp icp-dd btn btn-primary dropdown-toggle"
                                            data-selected="{{get_static_option('home_page_13_cta_two_section_button_icon')}}" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu"></div>
                                </div>
                                <input type="hidden" class="form-control" value="{{get_static_option('home_page_13_cta_two_section_button_icon')}}" name="home_page_13_cta_two_section_button_icon">
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
    <script>
        $('.icp-dd').iconpicker();
        $('body').on('iconpickerSelected','.icp-dd', function (e) {
            var selectedIcon = e.iconpickerValue;
            $(this).parent().parent().children('input').val(selectedIcon);
            $('body .dropdown-menu.iconpicker-container').removeClass('show');
        });
    </script>
@endsection
