@extends('frontend.user.dashboard.user-master')
@section('section')
    <div class="row">
        @if(!empty(get_static_option('events_module_status')))
            <div class="col-lg-6">
                <div class="user-dashboard-card margin-bottom-30">
                    <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('events_page_'.$user_select_lang_slug.'_name')}} {{__('Booking')}}</h4>
                        <span class="number">{{$event_attendances}}</span>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01">
                <div class="icon"><i class="fas fa-money-bill"></i></div>
                <div class="content">
                    <h4 class="title">{{__('Package Order')}}</h4>
                    <span class="number">{{$package_orders}}</span>
                </div>
            </div>
        </div>
        @if(!empty(get_static_option('product_module_status')))
            <div class="col-lg-6">
                <div class="user-dashboard-card">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('product_page_'.$user_select_lang_slug.'_name')}} {{__('Order')}}</h4>
                        <span class="number">{{$product_orders}}</span>
                    </div>
                </div>
            </div>
        @endif
        @if(get_static_option('donations_module_status'))
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-donate"></i></div>
                    <div class="content">
                        <h4 class="title">{{__('Total')}} {{get_static_option('donation_page_'.$user_select_lang_slug.'_name')}}</h4>
                        <span class="number">{{$donation}}</span>
                    </div>
                </div>
            </div>
        @endif
        @if(get_static_option('appointment_module_status'))
            <div class="col-lg-6">
                <div class="user-dashboard-card">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('appointment_page_'.$user_select_lang_slug.'_name')}} {{__('Booking')}}</h4>
                        <span class="number">{{$appointments}}</span>
                    </div>
                </div>
            </div>
        @endif
        @if(get_static_option('course_module_status'))
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title">{{get_static_option('courses_page_'.$user_select_lang_slug.'_name')}} {{__('Enrolled')}}</h4>
                        <span class="number">{{$courses}}</span>
                    </div>
                </div>
            </div>
        @endif
        @if(get_static_option('support_ticket_module_status'))
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title">{{__('All')}} {{get_static_option('support_ticket_page_'.$user_select_lang_slug.'_name')}}</h4>
                        <span class="number">{{$support_tickets}}</span>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection