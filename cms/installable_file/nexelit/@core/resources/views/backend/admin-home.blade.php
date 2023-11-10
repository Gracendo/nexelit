@extends('backend.admin-master')
@section('site-title')
    {{__('Dashboard')}}
@endsection
@section('content')

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                 @if(check_page_permission('admin_manage'))
                    <div class="col-md-3 mt-5 mb-3">
                        <div class="card text-dark mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.new.user')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_admin}}</span>
                                    <h4 class="title">{{__('Total Admin')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                @if(check_page_permission_by_string('Blogs Manage'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.blog.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-comments"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$blog_count}}</span>
                                    <h4 class="title">{{__('Total Blogs')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
                    @if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.jobs.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-briefcase"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_jobs}}</span>
                                    <h4 class="title">{{__('Total Jobs')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.events.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-calendar"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_events}}</span>
                                    <h4 class="title">{{__('Total Events')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-3 mt-md-5 mb-3">
                            <div class="card text-dark mb-3">
                                <div class="dsh-box-style">
                                    <a href="{{route('admin.event.attendance.logs')}}" class="add-new"><i class="ti-eye"></i></a>
                                    <div class="icon">
                                        <i class="ti-stats-up"></i>
                                    </div>
                                    <div class="content">
                                        <span class="total">{{$total_event_attendance}}</span>
                                        <h4 class="title">{{__('Total Events Attendance')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.donations.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-hand-stop"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_donations}}</span>
                                    <h4 class="title">{{__('Total Donations Cause')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-3 mt-md-5 mb-3">
                            <div class="card text-dark  mb-3">
                                <div class="dsh-box-style">
                                    <a href="{{route('admin.donations.payment.logs')}}" class="add-new"><i class="ti-eye"></i></a>
                                    <div class="icon">
                                        <i class="ti-money"></i>
                                    </div>
                                    <div class="content">
                                        <span class="total">{{$total_donated_log}}</span>
                                        <h4 class="title">{{__('Total Donated')}}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.products.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-package"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_products}}</span>
                                    <h4 class="title">{{__('Total Products')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.products.order.logs')}}" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_product_order}}</span>
                                    <h4 class="title">{{__('Total Products Order')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(check_page_permission_by_string('Services'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.services.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-blackboard"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_services}}</span>
                                    <h4 class="title">{{__('Total Services')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(check_page_permission_by_string('Price Plan'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.price.plan.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-pie-chart"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_price_plan}}</span>
                                    <h4 class="title">{{__('Total Price Plan')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                     @if(check_page_permission_by_string('Case Study'))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.work.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-write"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_works}}</span>
                                    <h4 class="title">{{__('Total Case Study')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                     @endif
                     @if(!empty(get_static_option('course_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.courses.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-book"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_courses}}</span>
                                    <h4 class="title">{{__('Total Cources')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.courses.enroll.all')}}" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_courses_enroll}}</span>
                                    <h4 class="title">{{__('Total Course Enrolls')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if(!empty(get_static_option('appointment_module_status')))
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.appointment.new')}}" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-calendar"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_appointments}}</span>
                                    <h4 class="title">{{__('Total Appointments')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="{{route('admin.appointment.booking.all')}}" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-alarm-clock"></i>
                                </div>
                                <div class="content">
                                    <span class="total">{{$total_appointment_booking}}</span>
                                    <h4 class="title">{{__('Total Appointment Booking')}}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
             @if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status')))
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Product Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th>{{__('Order ID')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Gateway')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($product_recent_order as $data)
                                        <tr>
                                            <td>#{{$data->id}}</td>
                                            <td>{{amount_with_currency_symbol($data->total)}}</td>
                                            <td>{{str_replace('_',' ',$data->payment_gateway)}}</td>
                                            <td>
                                                @php $pay_status = $data->payment_status; @endphp
                                                @if($pay_status == 'complete')
                                                    <span class="alert alert-success">{{__($pay_status)}}</span>
                                                @elseif($pay_status == 'pending')
                                                    <span class="alert alert-warning">{{__($pay_status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status')))
                <div class="col-lg-6">
                    <div class="card margin-top-40">
                        <div class="smart-card">
                            <h4 class="title">{{__('Recent Event Attendance Booking')}}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th>{{__('Attendance ID')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($event_attendance_recent_order as $data)
                                        <tr>
                                            <td>#{{$data->id}}</td>
                                            <td>{{amount_with_currency_symbol($data->event_cost * $data->quantity)}}</td>
                                            <td>
                                                @php $pay_status = $data->payment_status; @endphp
                                                @if($pay_status == 'complete')
                                                    <span class="alert alert-success">{{__($pay_status)}}</span>
                                                @elseif($pay_status == 'pending')
                                                    <span class="alert alert-warning">{{__($pay_status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status')))
                <div class="col-lg-6">
                    <div class="card margin-top-40">
                        <div class="smart-card">
                            <h4 class="title">{{__('Recent Donation Logs')}}</h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th>{{__('Donation ID')}}</th>
                                    <th>{{__('Amount')}}</th>
                                    <th>{{__('Payment Gateway')}}</th>
                                    <th>{{__('Payment Status')}}</th>
                                    <th>{{__('Date')}}</th>
                                    </thead>
                                    <tbody>
                                    @foreach($donation_recent as $data)
                                        <tr>
                                            <td>#{{$data->id}}</td>
                                            <td>{{amount_with_currency_symbol($data->amount)}}</td>
                                            <td>{{str_replace('_',' ',$data->payment_gateway)}}</td>
                                            <td>
                                                @php $pay_status = $data->status; @endphp
                                                @if($pay_status == 'complete')
                                                    <span class="alert alert-success">{{__($pay_status)}}</span>
                                                @elseif($pay_status == 'pending')
                                                    <span class="alert alert-warning">{{__($pay_status)}}</span>
                                                @endif
                                            </td>
                                            <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if(check_page_permission_by_string('Price Plan'))
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title">{{__('Recent Package Order')}}</h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th>{{__('Order ID')}}</th>
                                <th>{{__('Package Name')}}</th>
                                <th>{{__('Payment Status')}}</th>
                                <th>{{__('Date')}}</th>
                                </thead>
                                <tbody>
                                @foreach($package_recent_order as $data)
                                    <tr>
                                        <td>#{{$data->id}}</td>
                                        <td>{{$data->package_name}}</td>
                                        <td>
                                            @php $pay_status = $data->payment_status; @endphp
                                            @if($pay_status == 'complete')
                                                <span class="alert alert-success">{{__($pay_status)}}</span>
                                            @elseif($pay_status == 'pending')
                                                <span class="alert alert-warning">{{__($pay_status)}}</span>
                                            @endif
                                        </td>
                                        <td>{{date_format($data->created_at,'d M Y h:i:s')}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
