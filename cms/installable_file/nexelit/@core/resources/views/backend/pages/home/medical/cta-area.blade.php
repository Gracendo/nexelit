@extends('backend.admin-master')
@section('style')
    @include('backend.partials.media-upload.style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/summernote-bs4.css')}}">
@endsection
@section('site-title')
    {{__('Call To Action Area')}}
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
                        <h4 class="header-title">{{__('Call To Action Area Settings')}}</h4>

                        <form action="{{route('admin.home12.cta')}}" method="post" enctype="multipart/form-data">
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
                                            <label for="medical_cta_area_section_{{$lang}}_subtitle">{{__('Subtitle')}}</label>
                                            <input type="text" name="medical_cta_area_section_{{$lang->slug}}_subtitle" value="{{get_static_option('medical_cta_area_section_'.$lang->slug.'_subtitle')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="medical_cta_area_section_{{$lang}}_title">{{__('Title')}}</label>
                                            <input type="text" name="medical_cta_area_section_{{$lang->slug}}_title" value="{{get_static_option('medical_cta_area_section_'.$lang->slug.'_title')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="medical_cta_area_section_{{$lang->slug}}_description">{{__('Description')}}</label>
                                            <input type="hidden" name="medical_cta_area_section_{{$lang->slug}}_description" >
                                            <div class="summernote" data-content='{{get_static_option('medical_cta_area_section_'.$lang->slug.'_description')}}'></div>
                                        </div>
                                        <div class="form-group">
                                            <label for="medical_cta_area_section_{{$lang}}_hotline">{{__('Hotline')}}</label>
                                            <input type="text" name="medical_cta_area_section_{{$lang->slug}}_hotline" value="{{get_static_option('medical_cta_area_section_'.$lang->slug.'_hotline')}}" class="form-control" >
                                        </div>
                                        <div class="form-group">
                                            <label for="medical_cta_area_section_{{$lang}}_button_text">{{__('Button Text')}}</label>
                                            <input type="text" name="medical_cta_area_section_{{$lang->slug}}_button_text" value="{{get_static_option('medical_cta_area_section_'.$lang->slug.'_button_text')}}" class="form-control" >
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="medical_cta_area_section_cta_area_email">{{__('Query Received Email')}}</label>
                                <input type="text" name="medical_cta_area_section_cta_area_email" value="{{get_static_option('medical_cta_area_section_cta_area_email')}}" class="form-control" >
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
        });
    </script>
@endsection
