@extends('backend.admin-master')
@section('style')
    <link rel="stylesheet" href="{{asset('assets/backend/css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/media-uploader.css')}}">
@endsection
@section('site-title')
    {{__('Courses Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <x-error-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Courses Settings")}}</h4>
                        <form action="{{route('admin.courses.settings')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @foreach($all_languages as $key => $lang)
                                        <a class="nav-item nav-link @if($lang->slug === get_default_language()) active @endif" id="nav-home-tab" data-toggle="tab" href="#nav-home-{{$lang->slug}}" role="tab" aria-controls="nav-home" aria-selected="true">{{$lang->name}}</a>
                                    @endforeach
                                </div>
                            </nav>
                            <div class="tab-content margin-top-30" id="nav-tabContent">
                                @foreach($all_languages as $key => $lang)
                                    <div class="tab-pane fade @if($lang->slug === get_default_language()) show active @endif" id="nav-home-{{$lang->slug}}" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_overview_tab_title">{{__('Single Page Overview Tab Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_overview_tab_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_overview_tab_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_curriculum_tab_title">{{__('Single Page Curriculum Tab Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_curriculum_tab_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_curriculum_tab_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_instructor_tab_title">{{__('Single Page Instructor Tab Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_instructor_tab_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_instructor_tab_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_reviews_tab_title">{{__('Single Page Reviews Tab Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_reviews_tab_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_reviews_tab_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_enroll_button_text">{{__('Single Page Enroll Button Text')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_enroll_button_text"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_enroll_button_text')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_leave_feedback_title">{{__('Single Page Leave Feedback Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_leave_feedback_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_leave_feedback_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_single_{{$lang->slug}}_client_feedback_title">{{__('Single Page Feedback Title')}}</label>
                                            <input type="text" name="course_single_{{$lang->slug}}_client_feedback_title"  class="form-control" value="{{get_static_option('course_single_'.$lang->slug.'_client_feedback_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_success_{{$lang->slug}}_title">{{__('Success Page Title')}}</label>
                                            <input type="text" name="course_success_{{$lang->slug}}_title"  class="form-control" value="{{get_static_option('course_success_'.$lang->slug.'_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_success_{{$lang->slug}}_description">{{__('Success Page Description')}}</label>
                                            <textarea name="course_success_{{$lang->slug}}_description"  class="form-control" cols="30" rows="10">{{get_static_option('course_success_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="course_cancel_{{$lang->slug}}_title">{{__('Cancel Page Title')}}</label>
                                            <input type="text" name="course_cancel_{{$lang->slug}}_title"  class="form-control" value="{{get_static_option('course_cancel_'.$lang->slug.'_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="course_cancel_{{$lang->slug}}_description">{{__('Cancel Page Description')}}</label>
                                            <textarea name="course_cancel_{{$lang->slug}}_description"  class="form-control" cols="30" rows="10">{{get_static_option('course_cancel_'.$lang->slug.'_description')}}</textarea>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="course_page_items">{{__('Course Page Items')}}</label>
                                <input type="number" name="course_page_items"  class="form-control" value="{{get_static_option('course_page_items')}}">
                            </div>
                            <div class="form-group">
                                <label for="course_notify_mail">{{__('Course Notify Email')}}</label>
                                <input type="email" name="course_notify_mail"  class="form-control" value="{{get_static_option('course_notify_mail')}}">
                            </div>
                            <hr>
                            <x-media-upload :name="'course_certificate_bg_image'" :title="__('Certificate Background Image')"  :dimentions="'850x600px'" />
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
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
    <script src="{{asset('assets/backend/js/bootstrap-tagsinput.js')}}"></script>
    @include('backend.partials.media-upload.media-js')
@endsection
