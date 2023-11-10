@extends('backend.admin-master')
@section('site-title')
    {{__('Email Message Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Email Message Settings")}}</h4>
                        <x-error-msg/>
                        <x-flash-msg/>
                        <form action="{{route('admin.general.email.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="service_query_{{$lang->slug}}_success_message">{{__('Service Query Mail Success Message')}}</label>
                                            <input type="text" name="service_query_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('service_query_'.$lang->slug.'_success_message')}}" id="service_query_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when anyone contact your from service query form.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="case_study_query_{{$lang->slug}}_success_message">{{__('Case Study Query Mail Success Message')}}</label>
                                            <input type="text" name="case_study_query_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('case_study_query_'.$lang->slug.'_success_message')}}" id="case_study_query_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when anyone contact your from case study query form.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="quote_mail_{{$lang->slug}}_success_message">{{__('Quote Mail Success Message')}}</label>
                                            <input type="text" name="quote_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('quote_mail_'.$lang->slug.'_success_message')}}" id="quote_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any one contact your from quote form.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="order_mail_{{$lang->slug}}_success_message">{{__('Order Mail Success Message')}}</label>
                                            <input type="text" name="order_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('order_mail_'.$lang->slug.'_success_message')}}" id="order_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any one place order.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="contact_mail_{{$lang->slug}}_success_message">{{__('Contact Mail Success Message')}}</label>
                                            <input type="text" name="contact_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('contact_mail_'.$lang->slug.'_success_message')}}" id="contact_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any one contact you via contact page form.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="get_in_touch_mail_{{$lang->slug}}_success_message">{{__('Get In Touch Form Success Message')}}</label>
                                            <input type="text" name="get_in_touch_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('get_in_touch_mail_'.$lang->slug.'_success_message')}}" id="get_in_touch_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any one contact you via get in touch form.')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="apply_job_{{$lang->slug}}_success_message">{{__('Apply Job Form Success Message')}}</label>
                                            <input type="text" name="apply_job_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('apply_job_'.$lang->slug.'_success_message')}}" id="apply_job_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any apply to any job')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="event_attendance_mail_{{$lang->slug}}_success_message">{{__('Event Attendance Form Success Message')}}</label>
                                            <input type="text" name="event_attendance_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('event_attendance_mail_'.$lang->slug.'_success_message')}}" id="event_attendance_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any submit event attendance form')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="feedback_form_mail_{{$lang->slug}}_success_message">{{__('Feedback Form Success Message')}}</label>
                                            <input type="text" name="feedback_form_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('feedback_form_mail_'.$lang->slug.'_success_message')}}" id="feedback_form_mail_{{$lang->slug}}_success_message">
                                            <small class="form-text text-muted">{{__('this message will show when any submit feedback form')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_form_mail_{{$lang->slug}}_success_message">{{__('Call To Action Query Form Success Message')}}</label>
                                            <input type="text" name="appointment_form_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('appointment_form_mail_'.$lang->slug.'_success_message')}}">
                                            <small class="form-text text-muted">{{__('this message will show when any one submit call to action query form')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="estimate_form_mail_{{$lang->slug}}_success_message">{{__('Estimate Form Success Message')}}</label>
                                            <input type="text" name="estimate_form_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('estimate_form_mail_'.$lang->slug.'_success_message')}}">
                                            <small class="form-text text-muted">{{__('this message will show when any one submit estimate form')}}</small>
                                        </div>
                                        <div class="form-group">
                                            <label for="enroll_form_mail_{{$lang->slug}}_success_message">{{__('Course Enroll Form Success Message')}}</label>
                                            <input type="text" name="enroll_form_mail_{{$lang->slug}}_success_message"  class="form-control" value="{{get_static_option('enroll_form_mail_'.$lang->slug.'_success_message')}}">
                                            <small class="form-text text-muted">{{__('this message will show when any one submit course enroll form')}}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
