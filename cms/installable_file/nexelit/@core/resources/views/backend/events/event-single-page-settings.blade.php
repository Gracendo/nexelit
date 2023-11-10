@extends('backend.admin-master')
@section('site-title')
    {{__('Events Single Page Settings')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-5">
                @include('backend.partials.message')
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{__("Events Single Page Settings")}}</h4>
                        <form action="{{route('admin.events.single.page.settings')}}" method="POST" enctype="multipart/form-data">
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
                                            <label for="event_single_{{$lang->slug}}_event_info_title">{{__('Event Info Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_event_info_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_event_info_title')}}" id="event_single_{{$lang->slug}}_event_info_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_date_title">{{__('Date Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_date_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_date_title')}}" id="event_single_{{$lang->slug}}_date_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_time_title">{{__('Time Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_time_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_time_title')}}" id="event_single_{{$lang->slug}}_time_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_cost_title">{{__('Cost Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_cost_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_cost_title')}}" id="event_single_{{$lang->slug}}_cost_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_category_title">{{__('Category Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_category_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_category_title')}}" id="event_single_{{$lang->slug}}_category_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_organizer_title">{{__('Event Organizer Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_organizer_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_organizer_title')}}" id="event_single_{{$lang->slug}}_organizer_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_organizer_name_title">{{__('Organizer Name Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_organizer_name_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_organizer_name_title')}}" id="event_single_{{$lang->slug}}_organizer_name_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_organizer_email_title">{{__('Organizer Email Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_organizer_email_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_organizer_email_title')}}" id="event_single_{{$lang->slug}}_organizer_email_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_organizer_phone_title">{{__('Organizer Phone Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_organizer_phone_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_organizer_phone_title')}}" id="event_single_{{$lang->slug}}_organizer_phone_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_organizer_website_title">{{__('Organizer Website Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_organizer_website_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_organizer_website_title')}}" id="event_single_{{$lang->slug}}_organizer_website_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_venue_title">{{__('Event Venue Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_venue_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_venue_title')}}" id="event_single_{{$lang->slug}}_venue_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_venue_name_title">{{__('Venue Name Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_venue_name_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_venue_name_title')}}" id="event_single_{{$lang->slug}}_venue_name_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_venue_location_title">{{__('Venue Location Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_venue_location_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_venue_location_title')}}" id="event_single_{{$lang->slug}}_venue_location_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_venue_phone_title">{{__('Venue Phone Title')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_venue_phone_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_venue_phone_title')}}" id="event_single_{{$lang->slug}}_venue_phone_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_reserve_button_title">{{__('Reserve Seat Button Text')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_reserve_button_title"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_reserve_button_title')}}" id="event_single_{{$lang->slug}}_reserve_button_title">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_available_ticket_text">{{__('Available Ticket Text')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_available_ticket_text"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_available_ticket_text')}}" id="event_single_{{$lang->slug}}_available_ticket_text">
                                        </div>
                                        <div class="form-group">
                                            <label for="event_single_{{$lang->slug}}_event_expire_text">{{__('Event Expire Text')}}</label>
                                            <input type="text" name="event_single_{{$lang->slug}}_event_expire_text"  class="form-control" value="{{get_static_option('event_single_'.$lang->slug.'_event_expire_text')}}" id="event_single_{{$lang->slug}}_event_expire_text">
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
