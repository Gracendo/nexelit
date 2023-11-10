@extends('backend.admin-master')
@section('site-title')
    {{__('Appointment Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                <x-flash-msg/>
                <x-error-msg/>
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Appointment Settings")}}</h4>
                        <form action="{{route('admin.appointment.booking.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="appointment_single_{{$lang->slug}}_information_tab_title">{{__('Single Page Information Tab Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_information_tab_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_information_tab_title')}}" >
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_booking_tab_title">{{__('Single Page Booking Tab Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_booking_tab_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_booking_tab_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_feedback_tab_title">{{__('Single Page Feedback Tab Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_feedback_tab_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_feedback_tab_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_information_text">{{__('Single Page Booking Information Text')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_information_text"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_information_text')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_button_text">{{__('Single Page Appointment Booking Button Text')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_button_text"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_button_text')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_about_me_title">{{__('Single Page About me Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_about_me_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_about_me_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_educational_info_title">{{__('Single Page Education Info Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_educational_info_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_educational_info_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_additional_info_title">{{__('Single Page Additional Info Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_additional_info_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_additional_info_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_specialize_info_title">{{__('Single Page Specialize Info Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_specialize_info_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_specialize_info_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_single_{{$lang->slug}}_appointment_booking_client_feedback_title">{{__('Single Page Client Feedback Title')}}</label>
                                            <input type="text" name="appointment_single_{{$lang->slug}}_appointment_booking_client_feedback_title"  class="form-control" value="{{get_static_option('appointment_single_'.$lang->slug.'_appointment_booking_client_feedback_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_{{$lang->slug}}_success_page_title">{{__('Booking Success Page Title')}}</label>
                                            <input type="text" name="appointment_booking_{{$lang->slug}}_success_page_title"  class="form-control" value="{{get_static_option('appointment_booking_'.$lang->slug.'_success_page_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_{{$lang->slug}}_success_page_description">{{__('Booking Success Page Description')}}</label>
                                            <textarea name="appointment_booking_{{$lang->slug}}_success_page_description" cols="30" class="form-control" rows="5">{{get_static_option('appointment_booking_'.$lang->slug.'_success_page_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_{{$lang->slug}}_cancel_page_title">{{__('Booking Cancel Page Title')}}</label>
                                            <input type="text" name="appointment_booking_{{$lang->slug}}_cancel_page_title"  class="form-control" value="{{get_static_option('appointment_booking_'.$lang->slug.'_cancel_page_title')}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_booking_{{$lang->slug}}_cancel_page_description">{{__('Booking Cancel Page Description')}}</label>
                                            <textarea name="appointment_booking_{{$lang->slug}}_cancel_page_description" cols="30" class="form-control" rows="5">{{get_static_option('appointment_booking_'.$lang->slug.'_cancel_page_description')}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="appointment_page_{{$lang->slug}}_booking_button_text">{{__('Booking Button Text')}}</label>
                                            <input type="text" name="appointment_page_{{$lang->slug}}_booking_button_text"  class="form-control" value="{{get_static_option('appointment_page_'.$lang->slug.'_booking_button_text')}}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="appointment_notify_mail">{{__('Appointment Notify Email')}}</label>
                                <input type="email" name="appointment_notify_mail"  class="form-control" value="{{get_static_option('appointment_notify_mail')}}">
                            </div>
                            <div class="form-group">
                                <label for="disable_guest_mode_for_appointment_module"><strong>{{__('Enable/Disable Guest Checkout')}}</strong></label>
                                <label class="switch">
                                    <input type="checkbox" name="disable_guest_mode_for_appointment_module"  @if(!empty(get_static_option('disable_guest_mode_for_appointment_module'))) checked @endif >
                                    <span class="slider onff"></span>
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update Changes')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
