@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
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
                <x-error-msg/>
            </div>
            <div class="col-lg-12 mt-t">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__('Header Area Settings')}}</h4>
                        <form action="{{route('admin.home17.header')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($key == 0) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" >
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($key == 0) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="home_page_17_{{$lang->slug}}_header_area_title">{{__('Title')}}</label>
                                            <input type="text" name="home_page_17_{{$lang->slug}}_header_area_title" value="{{get_static_option('home_page_17_'.$lang->slug.'_header_area_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_17_{{$lang->slug}}_header_area_description">{{__('Description')}}</label>
                                            <input type="hidden" name="home_page_17_{{$lang->slug}}_header_area_description" >
                                            <div class="summernote" data-content='{{get_static_option('home_page_17_'.$lang->slug.'_header_area_description')}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="home_page_17_{{$lang}}_header_area_button_text">{{__('Button Text')}}</label>
                                            <input type="text" name="home_page_17_{{$lang->slug}}_header_area_button_text" value="{{get_static_option('home_page_17_'.$lang->slug.'_header_area_button_text')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="home_page_17_header_area_button_url">{{__('Button URL')}}</label>
                                <input type="text" name="home_page_17_header_area_button_url" value="{{get_static_option('home_page_17_header_area_button_url')}}" class="form-control" >
                            </div>
                            <x-icon-picker-static :name="'home_page_17_header_area_button_icon'" :title="'Button Icon'"/>
                            <x-image-upload-static  :name="'home_page_17_header_area_background_image'" :title="__('Background Image')" :dimentions="'1920x1200'"/>
                            <x-image-upload-static  :name="'home_page_17_header_area_right_image'" :title="__('Right Image')" :dimentions="'900x700'"/>

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
    <script src="{{asset('assets/backend/js/summernote-bs4.js')}}"></script>
    <script>
        (function ($){

            $(document).ready(function () {

                $('.icp-dd').iconpicker();
                $('body').on('iconpickerSelected', '.icp-dd', function (e) {
                    var selectedIcon = e.iconpickerValue;
                    $(this).parent().parent().children('input').val(selectedIcon);
                    $('body .dropdown-menu.iconpicker-container').removeClass('show');
                });

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
            });

        })(jQuery);
    </script>
@endsection
