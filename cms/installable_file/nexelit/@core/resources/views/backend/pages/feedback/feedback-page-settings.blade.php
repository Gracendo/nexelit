@extends('backend.admin-master')
@section('site-title')
    {{__('Feedback Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Feedback Page Settings")}}</h4>
                        <form action="{{route('admin.feedback.page.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="feedback_page_form_{{$lang->slug}}_form_title">{{__('Form Title')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_form_title"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_form_title')}}" id="feedback_page_form_{{$lang->slug}}_form_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_{{$lang->slug}}_name_label">{{__('Name Label')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_name_label"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_name_label')}}" id="feedback_page_form_{{$lang->slug}}_name_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_{{$lang->slug}}_email_label">{{__('Email Label')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_email_label"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_email_label')}}" id="feedback_page_form_{{$lang->slug}}_email_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_{{$lang->slug}}_ratings_label">{{__('Ratings Label')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_ratings_label"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_ratings_label')}}" id="feedback_page_form_{{$lang->slug}}_ratings_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_{{$lang->slug}}_description_label">{{__('Description Label')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_description_label"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_description_label')}}" id="feedback_page_form_{{$lang->slug}}_description_label">
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_page_form_{{$lang->slug}}_button_text">{{__('Button Text')}}</label>
                                            <input type="text" name="feedback_page_form_{{$lang->slug}}_button_text"  class="form-control" value="{{get_static_option('feedback_page_form_'.$lang->slug.'_button_text')}}" id="feedback_page_form_{{$lang->slug}}_button_text">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="feedback_notify_mail">{{__('Feedback Notify Email')}}</label>
                                <input type="text" name="feedback_notify_mail"  class="form-control" value="{{get_static_option('feedback_notify_mail')}}" id="feedback_notify_mail">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
