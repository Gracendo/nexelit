@php $home_page_variant = get_static_option('home_page_variant');@endphp
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo" style="max-height: 50px;">
            <a href="{{route('admin.home')}}">
                @php
                    $logo_type = 'site_logo';
                    if(!empty(get_static_option('site_admin_dark_mode'))){
                        $logo_type = 'site_white_logo';
                    }
                @endphp
                {!! render_image_markup_by_attachment_id(get_static_option($logo_type)) !!}
            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav id="main_menu_wrap">
                <ul class="metismenu" id="menu">
                    <li class="{{active_menu('admin-home')}}">
                        <a href="{{route('admin.home')}}"
                           aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span>@lang('dashboard')</span>
                        </a>
                    </li>
                    @if(check_page_permission('admin_manage'))
                    <li
                        class="main_dropdown
                        @if(request()->is(['admin-home/admin/*'])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{__('Admin Manage')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/admin/all')}}"><a
                                        href="{{route('admin.all.user')}}">{{__('All Admin')}}</a></li>
                            <li class="{{active_menu('admin-home/admin/new')}}"><a
                                        href="{{route('admin.new.user')}}">{{__('Add New Admin')}}</a></li>
                            <li class="{{active_menu('admin-home/admin/all/role')}}"><a
                                        href="{{route('admin.all.user.role')}}">{{__('All Admin Role')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Users Manage'))
                    <li
                        class="main_dropdown
                        @if(request()->is([
                        'admin-home/frontend/user/*',
                        ])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span>{{__('Users Manage')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/frontend/user/all')}}"><a
                                    href="{{route('admin.all.frontend.user')}}">{{__('All Users')}}</a></li>
                            <li class="{{active_menu('admin-home/frontend/user/new')}}"><a
                                    href="{{route('admin.frontend.new.user')}}">{{__('Add New User')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Newsletter Manage'))
                    <li
                        class="main_dropdown @if(request()->is(['admin-home/newsletter/*','admin-home/newsletter'])) active @endif
                     ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>
                            <span>{{__('Newsletter Manage')}}</span></a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/newsletter')}}"><a
                                        href="{{route('admin.newsletter')}}">{{__('All Subscriber')}}</a></li>
                            <li class="{{active_menu('admin-home/newsletter/all')}}"><a
                                        href="{{route('admin.newsletter.mail')}}">{{__('Send Mail To All')}}</a></li>
                        </ul>
                    </li>
                    @endif

                    @if(check_page_permission_by_string('Pages Manage'))
                        <li
                        class="main_dropdown
                        @if(request()->is(['admin-home/page/*','admin-home/page'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Pages')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/page')}}"><a
                                            href="{{route('admin.page')}}">{{__('All Pages')}}</a></li>
                                <li class="{{active_menu('admin-home/page/new')}}"><a
                                            href="{{route('admin.page.new')}}">{{__('Add New Page')}}</a></li>
                            </ul>
                        </li>
                    @endif

                    @if(check_page_permission_by_string('Blogs Manage'))
                        <li
                         class="main_dropdown
                        @if(request()->is(['admin-home/blog/*','admin-home/blog'])) active @endif
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Blogs')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/blog')}}"><a
                                            href="{{route('admin.blog')}}">{{__('All Blog')}}</a></li>
                                <li class="{{active_menu('admin-home/blog/category')}}"><a
                                            href="{{route('admin.blog.category')}}">{{__('Category')}}</a></li>
                                <li class="{{active_menu('admin-home/blog/new')}}"><a
                                            href="{{route('admin.blog.new')}}">{{__('Add New Post')}}</a></li>
                                <li class="{{active_menu('admin-home/blog/page-settings')}}"><a
                                        href="{{route('admin.blog.page.settings')}}">{{__('Blog Page Settings')}}</a></li>
                                <li class="{{active_menu('admin-home/blog/single-settings')}}"><a
                                        href="{{route('admin.blog.single.settings')}}">{{__('Blog Single Settings')}}</a></li>
                            </ul>
                        </li>
                    @endif


                    <li class="main_dropdown
                        @if(request()->is(['admin-home/advertisement/*','admin-home/advertisement'])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span>{{__('Advertisements')}}</span></a>
                        <ul class="collapse">
                                <li class="{{active_menu('admin-home/advertisement')}} @if(request()->is('admin-home/advertisement/edit/*')) active @endif"><a
                                            href="{{route('admin.advertisement')}}">{{__('All Advertisements')}}</a></li>

                                <li class="{{active_menu('admin-home/advertisement/new')}}"><a
                                            href="{{route('admin.advertisement.new')}}">{{__('Add New Advertisement')}}</a></li>
                        </ul>
                    </li>



                    @if(check_page_permission_by_string('Services'))
                    <li class="main_dropdown
                    @if(request()->is(['admin-home/services/*','admin-home/services'])) active @endif
                    ">
                        <a href="javascript:void(0)"
                           aria-expanded="true">
                            <i class="ti-layout"></i>
                            <span>{{__('Services')}}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/services')}}"><a
                                    href="{{route('admin.services')}}">{{__('All Services')}}</a></li>
                            <li class="{{active_menu('admin-home/services/new')}}"><a
                                    href="{{route('admin.services.new')}}">{{__('New Service')}}</a></li>
                            <li class="{{active_menu('admin-home/services/category')}}"><a
                                    href="{{route('admin.service.category')}}">{{__('Category')}}</a></li>
                            <li class="{{active_menu('admin-home/services/page-settings')}}"><a
                                    href="{{route('admin.services.page.settings')}}">{{__('Service Page')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Case Study'))
                    <li class="main_dropdown
                    @if(request()->is(['admin-home/works/*','admin-home/works'])) active @endif ">
                        <a href="javascript:void(0)"
                           aria-expanded="true">
                            <i class="ti-layout"></i>
                            <span>{{__('Case Study')}}</span>
                        </a>
                        <ul class="collapse">
                            <li class="{{active_menu('admin-home/works')}}"><a
                                        href="{{route('admin.work')}}">{{__('All Case Study')}}</a></li>
                            <li class="{{active_menu('admin-home/works/new')}}"><a
                                    href="{{route('admin.work.new')}}">{{__('New Case Study')}}</a></li>
                            <li class="{{active_menu('admin-home/works/category')}}"><a
                                        href="{{route('admin.work.category')}}">{{__('Category')}}</a></li>
                            <li class="{{active_menu('admin-home/works/single-page/settings')}}"><a
                                    href="{{route('admin.work.single.page.settings')}}">{{__('Case Single Page Settings')}}</a></li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Gallery Page'))
                        <li class="main_dropdown
                        {{active_menu('admin-home/gallery-page')}}
                        @if(request()->is('admin-home/gallery-page/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Image Gallery')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/gallery-page')}}">
                                    <a href="{{route('admin.gallery.all')}}" >{{__('Image Gallery')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/gallery-page/category')}}">
                                    <a href="{{route('admin.gallery.category')}}" >{{__('Category')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/gallery-page/page-settings')}}">
                                    <a href="{{route('admin.gallery.page.settings')}}" >{{__('Page Settings')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Video Gallery'))
                        <li class="main_dropdown
                        {{active_menu('admin-home/video-gallery')}}
                        @if(request()->is('admin-home/video-gallery/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Video Gallery')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/video-gallery')}}">
                                    <a href="{{route('admin.video.gallery.all')}}" >{{__('Video Gallery')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/video-gallery/page-settings')}}">
                                    <a href="{{route('admin.video.gallery.page.settings')}}" >{{__('Page Settings')}}</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Price Plan'))
                        <li class="main_dropdown {{active_menu('admin-home/price-plan')}}
                        @if(request()->is('admin-home/price-plan/*')) active @endif
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span>{{__('Price Plan')}}</span></a>
                            <ul class="collapse">
                                <li class="{{active_menu('admin-home/price-plan')}}">
                                    <a href="{{route('admin.price.plan')}}" >{{__('All Price Plan')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/price-plan/new')}}">
                                    <a href="{{route('admin.price.plan.new')}}" >{{__('New Price Plan')}}</a>
                                </li>
                                <li class="{{active_menu('admin-home/price-plan/category')}}">
                                    <a href="{{route('admin.price.plan.category')}}" >{{__('Category')}}</a>
                                </li>

                            </ul>
                        </li>
                    @endif
                    @if(check_page_permission_by_string('Faq'))
                    <li class="main_dropdown {{active_menu('admin-home/faq')}}">
                        <a href="{{route('admin.faq')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>{{__('Faq')}}</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Brand Logos'))
                    <li class="main_dropdown {{active_menu('admin-home/brands')}}">
                        <a href="{{route('admin.brands')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>{{__('Brand Logos')}}</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Team Members'))
                    <li class="main_dropdown {{active_menu('admin-home/team-member')}}">
                        <a href="{{route('admin.team.member')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>{{__('Team Members')}}</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Testimonial'))
                    <li class="main_dropdown {{active_menu('admin-home/testimonial')}}">
                        <a href="{{route('admin.testimonial')}}" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span>{{__('Testimonial')}}</span></a>
                    </li>
                    @endif
                    @if(check_page_permission_by_string('Counterup'))
                    <li class="main_dropdown {{active_menu('admin-home/counterup')}}">
                        <a href="{{route('admin.counterup')}}" aria-expanded="true"><i class="ti-exchange-vertical"></i>
                            <span>{{__('Counterup')}}</span></a>
                    </li>
                    @endif
                    <li class="main_dropdown
                    @if(request()->is(['admin-home/quote-manage/*',
                    'admin-home/package/*',
                    'admin-home/payment-logs',
                    'admin-home/payment-logs/report',
                    'admin-home/jobs',
                    'admin-home/jobs/*',
                    'admin-home/events',
                    'admin-home/events/*',
                    'admin-home/products',
                    'admin-home/products/*',
                    'admin-home/donations',
                    'admin-home/donations/*',
                    'admin-home/knowledge',
                    'admin-home/knowledge/*',
                    'admin-home/appointment/*',
                    'admin-home/courses/*',
                    'admin-home/support-tickets/*',
                    'admin-home/support-tickets'
                    ])) active @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>{{__('All Modules')}}</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Courses Manage')  && !empty(get_static_option('course_module_status')))
                                <li class="main_dropdown @if(request()->is('admin-home/courses/*')) active @endif ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Courses Manage')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/courses/all')}}">
                                            <a href="{{route('admin.courses.all')}}">{{__('All Courses')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/new')}}">
                                            <a href="{{route('admin.courses.new')}}">{{__('New Course')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/category')}}">
                                            <a href="{{route('admin.courses.category.all')}}">{{__('Category')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/lesson')}}">
                                            <a href="{{route('admin.courses.lesson.all')}}">{{__('All Lessons')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/review')}}">
                                            <a href="{{route('admin.courses.review.all')}}">{{__('All Reviews')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/coupon')}}">
                                            <a href="{{route('admin.courses.coupon.all')}}">{{__('Coupons')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/instructor')}}">
                                            <a href="{{route('admin.courses.instructor.all')}}">{{__('Instructor')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/enroll')}}">
                                            <a href="{{route('admin.courses.enroll.all')}}">{{__('All Enrollment')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/certificate')}}">
                                            <a href="{{route('admin.courses.certificate.all')}}">{{__('Certificate')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/courses/settings')}}">
                                            <a href="{{route('admin.courses.settings')}}">{{__('Settings')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Appointment Manage') && !empty(get_static_option('appointment_module_status')))
                                <li class="main_dropdown @if(request()->is('admin-home/appointment/*')) active @endif ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Appointment Manage')}} </a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/appointment/all')}}">
                                            <a href="{{route('admin.appointment.all')}}">{{__('All appointment')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/new')}}">
                                            <a href="{{route('admin.appointment.new')}}">{{__('New Appointment')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/category')}}">
                                            <a href="{{route('admin.appointment.category.all')}}">{{__('Category')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/booking-time')}}">
                                            <a href="{{route('admin.appointment.booking.time.all')}}">{{__('Booking Time')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/booking')}}">
                                            <a href="{{route('admin.appointment.booking.all')}}">{{__('All Appointment Booking')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/review')}}">
                                            <a href="{{route('admin.appointment.review.all')}}">{{__('All Reviews')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/form-builder')}}">
                                            <a href="{{route('admin.appointment.booking.form.builder')}}">{{__('Booking Form Builder')}}</a></li>
                                        <li class="{{active_menu('admin-home/appointment/settings')}}">
                                            <a href="{{route('admin.appointment.booking.settings')}}">{{__('Settings')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Quote Manage'))
                                <li class="main_dropdown @if(request()->is('admin-home/quote-manage/*')) active @endif ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Quote Manage')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/quote-manage/all')}}"><a
                                                    href="{{route('admin.quote.manage.all')}}">{{__('All Quote')}}</a></li>
                                        <li class="{{active_menu('admin-home/quote-manage/pending')}}"><a
                                                    href="{{route('admin.quote.manage.pending')}}">{{__('Pending Quote')}}</a></li>
                                        <li class="{{active_menu('admin-home/quote-manage/completed')}}"><a
                                                    href="{{route('admin.quote.manage.completed')}}">{{__('Complete Quote')}}</a></li>
                                        <li class="{{active_menu('admin-home/quote-manage/quote-page')}}">
                                            <a href="{{route('admin.quote.page')}}">
                                                {{__('Quote Page Manage')}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Package Orders Manage'))
                                <li class="main_dropdown @if(request()->is(['admin-home/payment-logs/report','admin-home/payment-logs','admin-home/package/*'])) active @endif
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Package Orders Manage')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/package/order-manage/all')}}"><a
                                                    href="{{route('admin.package.order.manage.all')}}">{{__('All Order')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/pending')}}"><a
                                                    href="{{route('admin.package.order.manage.pending')}}">{{__('Pending Order')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/in-progress')}}"><a
                                                    href="{{route('admin.package.order.manage.in.progress')}}">{{__('In Progress Order')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/completed')}}"><a
                                                    href="{{route('admin.package.order.manage.completed')}}">{{__('Completed Order')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/success-page')}}"><a
                                                    href="{{route('admin.package.order.success.page')}}">{{__('Success Order Page')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/cancel-page')}}"><a
                                                    href="{{route('admin.package.order.cancel.page')}}">{{__('Cancel Order Page')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-page')}}">
                                            <a href="{{route('admin.package.order.page')}}">{{__('Order Page Manage')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/package/order-report')}}">
                                            <a href="{{route('admin.package.order.report')}}">{{__('Order Report')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/payment-logs')}}"><a
                                                    href="{{route('admin.payment.logs')}}">{{__('All Payment Logs')}}</a></li>
                                        <li class="{{active_menu('admin-home/payment-logs/report')}}"><a
                                                    href="{{route('admin.payment.report')}}">{{__('Payment Report')}}</a></li>
                                        <li class="{{active_menu('admin-home/package/order-manage/settings')}}"><a
                                                    href="{{route('admin.package.settings')}}">{{__('Settings')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status')))
                                <li
                                    class="main_dropdown
                                    @if(request()->is(['admin-home/jobs/*','admin-home/jobs'])) active @endif
                                    ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Job Post Manage')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/jobs')}}"><a
                                                    href="{{route('admin.jobs.all')}}">{{__('All Jobs')}}</a></li>
                                        <li class="{{active_menu('admin-home/jobs/category')}}"><a
                                                    href="{{route('admin.jobs.category.all')}}">{{__('Category')}}</a></li>
                                        <li class="{{active_menu('admin-home/new-jobs')}}"><a
                                                    href="{{route('admin.jobs.new')}}">{{__('Add New Job')}}</a></li>
                                        <li class="{{active_menu('admin-home/jobs/page-settings')}}"><a
                                                    href="{{route('admin.jobs.page.settings')}}">{{__('Job Page Settings')}}</a></li>
                                        <li class="{{active_menu('admin-home/jobs/single-page-settings')}}"><a
                                                    href="{{route('admin.jobs.single.page.settings')}}">{{__('Job Single Page Settings')}}</a></li>
                                        <li class="{{active_menu('admin-home/jobs/success-page-settings')}}">
                                            <a href="{{route('admin.jobs.success.page.settings')}}">{{__('Job Success Page Settings')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/jobs/cancel-page-settings')}}">
                                            <a href="{{route('admin.jobs.cancel.page.settings')}}">{{__('Job Cancel Page Settings')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/jobs/applicant')}}"><a
                                                    href="{{route('admin.jobs.applicant')}}">{{__('All Applicant')}}</a></li>
                                        <li class="{{active_menu('admin-home/jobs/applicant/report')}}"><a
                                                    href="{{route('admin.jobs.applicant.report')}}">{{__('Applicant Report')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status')))
                                    <li class="main_dropdown
                                    @if(request()->is(['admin-home/events/*','admin-home/events'])) active @endif
                                            ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            {{__('Events Manage')}}</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/events/all')}}"><a
                                                        href="{{route('admin.events.all')}}">{{__('All Events')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/category')}}"><a
                                                        href="{{route('admin.events.category.all')}}">{{__('Category')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/new')}}"><a
                                                        href="{{route('admin.events.new')}}">{{__('Add New Event')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/page-settings')}}"><a
                                                        href="{{route('admin.events.page.settings')}}">{{__('Event Page Settings')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/single-page-settings')}}"><a
                                                        href="{{route('admin.events.single.page.settings')}}">{{__('Event Single Settings')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/attendance')}}"><a
                                                        href="{{route('admin.events.attendance')}}">{{__('Event Attendance settings')}}</a></li>
                                            <li class="{{active_menu('admin-home/events/attendance/all')}}"><a
                                                        href="{{route('admin.event.attendance.logs')}}">{{__('Event Attendance Logs')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/event-payment-logs')}}"><a
                                                        href="{{route('admin.event.payment.logs')}}">{{__('Event Payment Logs')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment-success-page-settings')}}"><a
                                                        href="{{route('admin.events.payment.success.page.settings')}}">{{__('Payment Success Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment-cancel-pag-settings')}}"><a
                                                        href="{{route('admin.events.payment.cancel.page.settings')}}">{{__('Payment Cancel Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/attendance/report')}}"><a
                                                        href="{{route('admin.event.attendance.report')}}">{{__('Attendance Report')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/payment/report')}}"><a
                                                        href="{{route('admin.event.payment.report')}}">{{__('Payment Log Report')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/events/settings')}}"><a
                                                        href="{{route('admin.events.settings')}}">{{__('Settings')}}</a></li>
                                        </ul>
                                    </li>
                                @endif
                            @if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status')))
                                    <li class="main_dropdown
                                    {{active_menu('admin-home/products')}}
                                    @if(request()->is('admin-home/products/*')) active @endif
                                            ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            {{__('Products Manage')}}</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/products')}}"><a
                                                        href="{{route('admin.products.all')}}">{{__('All Products')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/new')}}"><a
                                                        href="{{route('admin.products.new')}}">{{__('Add New Product')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/category')}}"><a
                                                        href="{{route('admin.products.category.all')}}">{{__('Category')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/subcategory')}}"><a
                                                        href="{{route('admin.products.subcategory.all')}}">{{__('Sub Category')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/shipping')}}"><a
                                                        href="{{route('admin.products.shipping.all')}}">{{__('Shipping')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/coupon')}}"><a
                                                        href="{{route('admin.products.coupon.all')}}">{{__('Coupon')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/variants')}}"><a
                                                        href="{{route('admin.products.variants.all')}}">{{__('Variants')}}</a></li>
                                            <li class="{{active_menu('admin-home/products/page-settings')}}"><a
                                                        href="{{route('admin.products.page.settings')}}">{{__('Product Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/single-page-settings')}}"><a
                                                        href="{{route('admin.products.single.page.settings')}}">{{__('Product Single Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/success-page-settings')}}"><a
                                                        href="{{route('admin.products.success.page.settings')}}">{{__('Order Success Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/cancel-page-settings')}}"><a
                                                        href="{{route('admin.products.cancel.page.settings')}}">{{__('Order Cancel Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/product-order-logs')}}"><a
                                                        href="{{route('admin.products.order.logs')}}">{{__('Orders')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/product-ratings')}}"><a
                                                        href="{{route('admin.products.ratings')}}">{{__('Ratings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/order-report')}}">
                                                <a href="{{route('admin.products.order.report')}}">{{__('Order Report')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/tax-settings')}}">
                                                <a href="{{route('admin.products.tax.settings')}}">{{__('Tax Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/products/settings')}}">
                                                <a href="{{route('admin.products.settings')}}">{{__('Settings')}}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status')))
                                    <li class="main_dropdown
                                    {{active_menu('admin-home/donations')}}
                                    @if(request()->is('admin-home/donations/*')) active @endif
                                        ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                           {{__('Donations Manage')}}</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/donations')}}"><a
                                                        href="{{route('admin.donations.all')}}">{{__('All Donations')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/new')}}"><a
                                                        href="{{route('admin.donations.new')}}">{{__('Add New Donation')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/page-settings')}}"><a
                                                        href="{{route('admin.donations.page.settings')}}">{{__('Donation Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/single-page-settings')}}"><a
                                                        href="{{route('admin.donations.single.page.settings')}}">{{__('Donation Single Settings')}}</a>
                                            </li>

                                            <li class="{{active_menu('admin-home/donations/donations-payment-logs')}}"><a
                                                        href="{{route('admin.donations.payment.logs')}}">{{__('Donation Payment Logs')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/payment-success-page-settings')}}"><a
                                                        href="{{route('admin.donations.payment.success.page.settings')}}">{{__('Payment Success Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/payment-cancel-pag-settings')}}"><a
                                                        href="{{route('admin.donations.payment.cancel.page.settings')}}">{{__('Payment Cancel Page Settings')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/donations/report')}}">
                                                <a href="{{route('admin.donations.report')}}">{{__('Donation Report')}}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                            @if(check_page_permission_by_string('Knowledgebase') && !empty(get_static_option('knowledgebase_module_status')))
                                <li class="main_dropdown {{active_menu('admin-home/knowledge')}} @if(request()->is('admin-home/knowledge/*')) active @endif"
                                >
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Knowledgebase')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/knowledge')}}"><a
                                                    href="{{route('admin.knowledge.all')}}">{{__('All Articles')}}</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/category')}}"><a
                                                    href="{{route('admin.knowledge.category.all')}}">{{__('Topics')}}</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/new')}}"><a
                                                    href="{{route('admin.knowledge.new')}}">{{__('Add New Article')}}</a></li>
                                        <li class="{{active_menu('admin-home/knowledge/page-settings')}}"><a
                                                    href="{{route('admin.knowledge.page.settings')}}">{{__('Knowledgebase Page Settings')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Support Tickets') && !empty(get_static_option('support_ticket_module_status')))
                                <li class="main_dropdown {{active_menu('admin-home/support-tickets')}} @if(request()->is('admin-home/support-tickets/*')) active @endif"
                                >
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Support Tickets')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/support-tickets')}}">
                                            <a href="{{route('admin.support.ticket.all')}}">{{__('All Tickets')}}</a></li>
                                        <li class="{{active_menu('admin-home/support-tickets/new')}}"><a
                                                    href="{{route('admin.support.ticket.new')}}">{{__('Add New Ticket')}}</a></li>
                                        <li class="{{active_menu('admin-home/support-tickets/department')}}"><a
                                                    href="{{route('admin.support.ticket.department')}}">{{__('Departments')}}</a></li>
                                        <li class="{{active_menu('admin-home/support-tickets/page-settings')}}"><a
                                                    href="{{route('admin.support.ticket.page.settings')}}">{{__('Page Settings')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="main_dropdown
                        @if(request()->is([
                            'admin-home/home-page-01/*',
                            'admin-home/home-'.$home_page_variant.'/*',
                            'admin-home/home-page-'.$home_page_variant.'/*',
                            'admin-home/header',
                            'admin-home/keyfeatures',
                            'admin-home/about-page/*',
                            'admin-home/contact-page/*',
                            'admin-home/feedback-page/*',
                            'admin-home/404-page-manage',
                            'admin-home/maintains-page/settings',
                            'admin-home/page-builder/*'
                        ])) active @endif
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>{{__('All Page Settings')}}</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Home Page Manage'))
                                <li class="main_dropdown
                                @if(request()->is([
                                    'admin-home/home-'.$home_page_variant.'/*',
                                    'admin-home/home-page-'.$home_page_variant.'/*',
                                    'admin-home/home-page-01/*',
                                    'admin-home/header',
                                    'admin-home/keyfeatures',
                                    'admin-home/page-builder/home-page'
                                    ])  ) active @endif
                                ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        {{__('Home Page Manage')}}
                                    </a>
                                    <ul class="collapse">
                                        {{-- page builder check --}}
                                        @if(empty(get_static_option('home_page_page_builder_status')))
                                        @if(in_array($home_page_variant,['01','02','03','04']))
                                            <li class="{{active_menu('admin-home/header')}}">
                                                <a href="{{route('admin.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/keyfeatures')}}">
                                                <a href="{{route('admin.keyfeatures')}}">{{__('Key Features')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-page-01/about-us')}}"><a
                                                        href="{{route('admin.homeone.about.us')}}">{{__('About Us Area')}}</a></li>
                                            <li class="{{active_menu('admin-home/home-page-01/service-area')}}"><a
                                                        href="{{route('admin.homeone.service.area')}}">{{__('Service Area')}}</a></li>
                                            @if($home_page_variant != '03')
                                                <li class="{{active_menu('admin-home/home-page-01/quality-area')}}"><a
                                                            href="{{route('admin.homeone.quality.area')}}">{{__('Quality Area')}}</a>
                                                </li>
                                            @endif
                                            <li class="{{active_menu('admin-home/home-page-01/case-study-area')}}"><a
                                                        href="{{route('admin.homeone.case.study.area')}}">{{__('Case Study Area')}}</a>
                                            </li>
                                            @if($home_page_variant == '03')
                                                <li class="{{active_menu('admin-home/home-page-01/cta-area')}}"><a
                                                            href="{{route('admin.homeone.cta.area')}}">{{__('Call To Action Area')}}</a>
                                                </li>
                                            @endif
                                            <li class="{{active_menu('admin-home/home-page-01/testimonial')}}"><a
                                                        href="{{route('admin.homeone.testimonial')}}">{{__('Testimonial Area')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-page-01/price-plan')}}"><a
                                                        href="{{route('admin.homeone.price.plan')}}">{{__('Price Plan Area')}}</a></li>
                                            <li class="{{active_menu('admin-home/home-page-01/contact-area')}}">

                                                <a href="{{route('admin.homeone.contact.area')}}">{{__('Contact Area')}}</a></li>
                                            <li class="{{active_menu('admin-home/home-page-01/latest-news')}}"><a

                                                        href="{{route('admin.homeone.latest.news')}}">{{__('Latest News Area')}}</a>
                                            </li>
                                            @if(in_array($home_page_variant,['04','02']))
                                                <li class="{{active_menu('admin-home/home-page-01/team-member')}}"><a
                                                            href="{{route('admin.homeone.team.member')}}">{{__('Team Member Area')}}</a>
                                                </li>
                                            @endif
                                            @if(in_array($home_page_variant,['03','02']))
                                                <li class="{{active_menu('admin-home/home-page-01/brand-logos')}}"><a
                                                            href="{{route('admin.homeone.brand.logos')}}">{{__('Brands Logos Area')}}</a></li>
                                            @endif
                                        @endif
                                        @if($home_page_variant == '05')
                                            <li class="{{active_menu('admin-home/home-05/header')}}">
                                                <a href="{{route('admin.home05.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/about')}}">
                                                <a href="{{route('admin.home05.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/expertises')}}">
                                                <a href="{{route('admin.home05.expertises')}}">
                                                    {{__('Experties Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/what-we-offer')}}">
                                                <a href="{{route('admin.home05.what.offer.area')}}">
                                                    {{__('What We Offer Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/recent-work')}}">
                                                <a href="{{route('admin.home05.recent.work.area')}}">
                                                    {{__('Recent Work Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/cta-area')}}">
                                                <a href="{{route('admin.home05.cta.area')}}">
                                                    {{__('Cta Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/testimonial-area')}}">
                                                <a href="{{route('admin.home05.testimonial.area')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-05/news-area')}}">
                                                <a href="{{route('admin.home05.news.area')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                        @endif
                                        @if($home_page_variant == '06')
                                            <li class="{{active_menu('admin-home/home-06/header')}}">
                                                <a href="{{route('admin.home06.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                             <li class="{{active_menu('admin-home/keyfeatures')}}">
                                                <a href="{{route('admin.keyfeatures')}}">{{__('Key Features')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/what-we-offer')}}">
                                                <a href="{{route('admin.home06.what.offer')}}">
                                                    {{__('What we offer area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/video-area')}}">
                                                <a href="{{route('admin.home06.video.area')}}">
                                                    {{__('Video area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/counterup-area')}}">
                                                <a href="{{route('admin.home06.counterup.area')}}">
                                                    {{__('Counterup area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/project-area')}}">
                                                <a href="{{route('admin.home06.project.area')}}">
                                                    {{__('Project area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/quote-faq-area')}}">
                                                <a href="{{route('admin.home06.quote.faq.area')}}">
                                                    {{__('Quote & FAQ area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/testimonial-area')}}">
                                                <a href="{{route('admin.home06.testimonial.area')}}">
                                                    {{__('Testimonial area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-06/news-area')}}">
                                                <a href="{{route('admin.home06.news.area')}}">
                                                    {{__('News area')}}
                                                </a>
                                            </li>
                                        @endif
                                        @if($home_page_variant == '07')
                                            <li class="{{active_menu('admin-home/home-07/header')}}">
                                                <a href="{{route('admin.home07.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/about')}}">
                                                <a href="{{route('admin.home07.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/service')}}">
                                                <a href="{{route('admin.home07.service')}}">
                                                    {{__('Service Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/counterup')}}">
                                                <a href="{{route('admin.home07.counterup')}}">
                                                    {{__('Counterup Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/our-projects')}}">
                                                <a href="{{route('admin.home07.projects')}}">
                                                    {{__('Our Projects Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/team-member')}}">
                                                <a href="{{route('admin.home07.team.member')}}">
                                                    {{__('Team Member Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/testimonial')}}">
                                                <a href="{{route('admin.home07.testimonial')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-07/news-area')}}">
                                                <a href="{{route('admin.home07.news.area')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                        @endif
                                        @if($home_page_variant == '08')
                                            <li class="{{active_menu('admin-home/home-08/header')}}">
                                                <a href="{{route('admin.home08.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/what-we-offer')}}">
                                                <a href="{{route('admin.home08.what.we.offer')}}">
                                                    {{__('What We Offer Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/video-area')}}">
                                                <a href="{{route('admin.home08.video.area')}}">
                                                    {{__('Video area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/work-process')}}">
                                                <a href="{{route('admin.home08.work.process')}}">
                                                    {{__('Work Process area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/our-portfolio')}}">
                                                <a href="{{route('admin.home08.our.portfolio')}}">
                                                    {{__('Our Portfolio area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/cta-area')}}">
                                                <a href="{{route('admin.home08.cta.area')}}">
                                                    {{__('Call to action area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/testimonial-area')}}">
                                                <a href="{{route('admin.home08.testimonial.area')}}">
                                                    {{__('Testimonial area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-08/news-area')}}">
                                                <a href="{{route('admin.home08.news.area')}}">
                                                    {{__('News area')}}
                                                </a>
                                            </li>
                                        @endif

                                        @if($home_page_variant == '09')
                                            <li class="{{active_menu('admin-home/home-09/header')}}">
                                                <a href="{{route('admin.home09.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/about-area')}}">
                                                <a href="{{route('admin.home09.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/what-we-offer-area')}}">
                                                <a href="{{route('admin.home09.what.we.offer')}}">
                                                    {{__('What We Offer Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/quote-area')}}">
                                                <a href="{{route('admin.home09.quote.area')}}">
                                                    {{__('Quote Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/project-area')}}">
                                                <a href="{{route('admin.home09.project.area')}}">
                                                    {{__('Project Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/team-member-area')}}">
                                                <a href="{{route('admin.home09.team.member.area')}}">
                                                    {{__('Team Member Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/testimonial-area')}}">
                                                <a href="{{route('admin.home09.testimonial.area')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-09/news-area')}}">
                                                <a href="{{route('admin.home09.news.area')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                        @endif
                                        @if($home_page_variant == '10')
                                            <li class="{{active_menu('admin-home/home-10/header-area')}}">
                                                <a href="{{route('admin.home10.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/key-features-area')}}">
                                                <a href="{{route('admin.home10.key.features')}}">
                                                    {{__('Key Features Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/about-area')}}">
                                                <a href="{{route('admin.home10.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/service-area')}}">
                                                <a href="{{route('admin.home10.service')}}">
                                                    {{__('Service Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/appointment-area')}}">
                                                <a href="{{route('admin.home10.appointment')}}">
                                                    {{__('Appointment Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/counterup-area')}}">
                                                <a href="{{route('admin.home10.counterup')}}">
                                                    {{__('Counterup Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/testimonial-area')}}">
                                                <a href="{{route('admin.home10.testimonial')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/news-area')}}">
                                                <a href="{{route('admin.home10.news')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/cta-area')}}">
                                                <a href="{{route('admin.home10.cta')}}">
                                                    {{__('Call to action Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-10/contact-area')}}">
                                                <a href="{{route('admin.home10.contact')}}">
                                                    {{__('Contact Area')}}
                                                </a>
                                            </li>
                                        @endif
                                        @if($home_page_variant == '11')
                                            <li class="{{active_menu('admin-home/home-11/header-area')}}">
                                                <a href="{{route('admin.home11.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/key-features-area')}}">
                                                <a href="{{route('admin.home11.key.features')}}">
                                                    {{__('Key Features Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/about-area')}}">
                                                <a href="{{route('admin.home11.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/video-area')}}">
                                                <a href="{{route('admin.home11.video')}}">
                                                    {{__('Video Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/cta-area')}}">
                                                <a href="{{route('admin.home11.cta')}}">
                                                    {{__('Call to action Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/service-area')}}">
                                                <a href="{{route('admin.home11.service')}}">
                                                    {{__('Service Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/counterup-area')}}">
                                                <a href="{{route('admin.home11.counterup')}}">
                                                    {{__('Counterup Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/event-area')}}">
                                                <a href="{{route('admin.home11.event')}}">
                                                    {{__('Event Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/testimonial-area')}}">
                                                <a href="{{route('admin.home11.testimonial')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-11/news-area')}}">
                                                <a href="{{route('admin.home11.news')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                            @endif
                                        @if($home_page_variant == '12')
                                            <li class="{{active_menu('admin-home/home-12/header-area')}}">
                                                <a href="{{route('admin.home12.header')}}">
                                                    {{__('Header Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/about-area')}}">
                                                <a href="{{route('admin.home12.about')}}">
                                                    {{__('About Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/service-area')}}">
                                                <a href="{{route('admin.home12.service')}}">
                                                    {{__('Service Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/cta-area')}}">
                                                <a href="{{route('admin.home12.cta')}}">
                                                    {{__('Call To Action Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/appointment-area')}}">
                                                <a href="{{route('admin.home12.appointment')}}">
                                                    {{__('Appointment Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/case-study-area')}}">
                                                <a href="{{route('admin.home12.case.study')}}">
                                                    {{__('Case Study Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/testimonial-area')}}">
                                                <a href="{{route('admin.home12.testimonial')}}">
                                                    {{__('Testimonial Area')}}
                                                </a>
                                            </li>
                                            <li class="{{active_menu('admin-home/home-12/news-area')}}">
                                                <a href="{{route('admin.home12.news')}}">
                                                    {{__('News Area')}}
                                                </a>
                                            </li>
                                            @endif
                                            @if($home_page_variant == '13')
                                                <li class="{{active_menu('admin-home/home-13/header-area')}}">
                                                    <a href="{{route('admin.home13.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/about-area')}}">
                                                    <a href="{{route('admin.home13.about')}}">
                                                        {{__('About Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/popular-cause')}}">
                                                    <a href="{{route('admin.home13.popular.cause')}}">
                                                        {{__('Popular Cause Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/team-area')}}">
                                                    <a href="{{route('admin.home13.team')}}">
                                                        {{__('Team Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/cta-area')}}">
                                                    <a href="{{route('admin.home13.cta')}}">
                                                        {{__('Call To Action Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/event-area')}}">
                                                    <a href="{{route('admin.home13.event')}}">
                                                        {{__('Event Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/testimonial-area')}}">
                                                    <a href="{{route('admin.home13.testimonial')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/cta-area-02')}}">
                                                    <a href="{{route('admin.home13.cta.two')}}">
                                                        {{__('Join Volunteer Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-13/news-area')}}">
                                                    <a href="{{route('admin.home13.news')}}">
                                                        {{__('News Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '14')
                                                <li class="{{active_menu('admin-home/home-14/header-area')}}">
                                                    <a href="{{route('admin.home14.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/service-area')}}">
                                                    <a href="{{route('admin.home14.service')}}">
                                                        {{__('Service Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/portfolio-area')}}">
                                                    <a href="{{route('admin.home14.portfolio')}}">
                                                        {{__('Portfolio Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/cta-area')}}">
                                                    <a href="{{route('admin.home14.cta')}}">
                                                        {{__('Call To Action Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/work-process-area')}}">
                                                    <a href="{{route('admin.home14.work.process')}}">
                                                        {{__('Work Process Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/counterup-area')}}">
                                                    <a href="{{route('admin.home14.counterup')}}">
                                                        {{__('Counterup Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/testimonial-area')}}">
                                                    <a href="{{route('admin.home14.testimonial')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/news-area')}}">
                                                    <a href="{{route('admin.home14.news')}}">
                                                        {{__('News Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-14/contact-area')}}">
                                                    <a href="{{route('admin.home14.contact')}}">
                                                        {{__('Contact Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '15')
                                                <li class="{{active_menu('admin-home/home-15/header-area')}}">
                                                    <a href="{{route('admin.home15.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/offer-area')}}">
                                                    <a href="{{route('admin.home15.offer')}}">
                                                        {{__('Offer Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/featured-product-area')}}">
                                                    <a href="{{route('admin.home15.featured.products')}}">
                                                        {{__('Featured Products Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/process-area')}}">
                                                    <a href="{{route('admin.home15.process')}}">
                                                        {{__('Process Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/product-area')}}">
                                                    <a href="{{route('admin.home15.latest.product')}}">
                                                        {{__('Products Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/testimonial-area')}}">
                                                    <a href="{{route('admin.home15.testimonial')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-15/top-selling-product-area')}}">
                                                    <a href="{{route('admin.home15.top.selling.product')}}">
                                                        {{__('Top Selling Products Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '16')
                                                <li class="{{active_menu('admin-home/home-16/header-area')}}">
                                                    <a href="{{route('admin.home16.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/about-area')}}">
                                                    <a href="{{route('admin.home16.about')}}">
                                                        {{__('About Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/service-area')}}">
                                                    <a href="{{route('admin.home16.service')}}">
                                                        {{__('Our Services Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/free-estimate-area')}}">
                                                    <a href="{{route('admin.home16.estimate')}}">
                                                        {{__('Estimate Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/work-area')}}">
                                                    <a href="{{route('admin.home16.work')}}">
                                                        {{__('Work Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/appointment-area')}}">
                                                    <a href="{{route('admin.home16.appointment')}}">
                                                        {{__('Appointment Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/testimonial-area')}}">
                                                    <a href="{{route('admin.home16.testimonial')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-16/news-area')}}">
                                                    <a href="{{route('admin.home16.news')}}">
                                                        {{__('News Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '17')
                                                <li class="{{active_menu('admin-home/home-17/header-area')}}">
                                                    <a href="{{route('admin.home17.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/speciality')}}">
                                                    <a href="{{route('admin.home17.speciality')}}">
                                                        {{__('Speciality Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/featured-courses')}}">
                                                    <a href="{{route('admin.home17.featured.courses')}}">
                                                        {{__('Featured Course Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/video-area')}}">
                                                    <a href="{{route('admin.home17.video.area')}}">
                                                        {{__('Video Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/all-courses-area')}}">
                                                    <a href="{{route('admin.home17.all.courses.area')}}">
                                                        {{__('All Courses Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/testimonial-area')}}">
                                                    <a href="{{route('admin.home17.all.testimonial.area')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/event-area')}}">
                                                    <a href="{{route('admin.home17.all.event.area')}}">
                                                        {{__('Event Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-17/cta-area')}}">
                                                    <a href="{{route('admin.home17.all.cta.area')}}">
                                                        {{__('Call To Action Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '18')
                                                <li class="{{active_menu('admin-home/home-18/header-area')}}">
                                                    <a href="{{route('admin.home18.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/product-categories')}}">
                                                    <a href="{{route('admin.home18.product.categories')}}">
                                                        {{__('Categories Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/offer-area')}}">
                                                    <a href="{{route('admin.home18.offer.area')}}">
                                                        {{__('Offer Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/popular-item-area')}}">
                                                    <a href="{{route('admin.home18.popular.item')}}">
                                                        {{__('Popular Items Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/process-area')}}">
                                                    <a href="{{route('admin.home18.process.area')}}">
                                                        {{__('Process Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/product-area')}}">
                                                    <a href="{{route('admin.home18.product.area')}}">
                                                        {{__('Product Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-18/testimonial-area')}}">
                                                    <a href="{{route('admin.home18.testimonial.area')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '21')
                                                <li class="{{active_menu('admin-home/home-21/header-area')}}">
                                                    <a href="{{route('admin.home21.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/services-area')}}">
                                                    <a href="{{route('admin.home21.services')}}">
                                                        {{__('Services Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/project-area')}}">
                                                    <a href="{{route('admin.home21.project')}}">
                                                        {{__('Project Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/counterup-area')}}">
                                                    <a href="{{route('admin.home21.counterup')}}">
                                                        {{__('Counterup Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/blog-area')}}">
                                                    <a href="{{route('admin.home21.blog')}}">
                                                        {{__('Blog Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/testimonial-area')}}">
                                                    <a href="{{route('admin.home21.testimonial')}}">
                                                        {{__('Testimonial Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/contact-area')}}">
                                                    <a href="{{route('admin.home21.contact')}}">
                                                        {{__('Contact Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-21/newsletter-area')}}">
                                                    <a href="{{route('admin.home21.newsletter')}}">
                                                        {{__('Newsletter Area')}}
                                                    </a>
                                                </li>
                                            @endif


                                            @if($home_page_variant == '19')
                                                <li class="{{active_menu('admin-home/home-page-19/header-area')}}">
                                                    <a href="{{route('admin.home19.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/todays-deal-area')}}">
                                                    <a href="{{route('admin.home19.todays.deal')}}">
                                                        {{__('Todays Deal Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/updated-area')}}">
                                                    <a href="{{route('admin.home19.updated.area')}}">
                                                        {{__('Updated Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/store-area')}}">
                                                    <a href="{{route('admin.home19.store.area')}}">
                                                        {{__('Store Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/clothing-area')}}">
                                                    <a href="{{route('admin.home19.clothing.area')}}">
                                                        {{__('Clothing Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/popular-area')}}">
                                                    <a href="{{route('admin.home19.popular.area')}}">
                                                        {{__('Popular Sale Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/instagram-area')}}">
                                                    <a href="{{route('admin.home19.instagram.area')}}">
                                                        {{__('Instagram Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-19/promo-area')}}">
                                                    <a href="{{route('admin.home19.promo.area')}}">
                                                        {{__('Promotional Area')}}
                                                    </a>
                                                </li>
                                            @endif
                                            @if($home_page_variant == '20')
                                                <li class="{{active_menu('admin-home/home-page-20/header-area')}}">
                                                    <a href="{{route('admin.home20.header')}}">
                                                        {{__('Header Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/breaking-news-area')}}">
                                                    <a href="{{route('admin.home20.breaking.news')}}">
                                                        {{__('Breaking News Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/advertisement-area')}}">
                                                    <a href="{{route('admin.home20.advertisement')}}">
                                                        {{__('Advertisement Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/popular-news-area')}}">
                                                    <a href="{{route('admin.home20.popular')}}">
                                                        {{__('Popular News Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/video-news-area')}}">
                                                    <a href="{{route('admin.home20.video')}}">
                                                        {{__('Video News Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/sports-news-area')}}">
                                                    <a href="{{route('admin.home20.sports')}}">
                                                        {{__('Sports News Area')}}
                                                    </a>
                                                </li>
                                                <li class="{{active_menu('admin-home/home-page-20/hot-news-area')}}">
                                                    <a href="{{route('admin.home20.hot')}}">
                                                        {{__('Hot News Area')}}
                                                    </a>
                                                </li>
                                            @endif

                                        <li class="{{active_menu('admin-home/home-page-01/section-manage')}}">
                                            <a href="{{route('admin.homeone.section.manage')}}">{{__('Section Manage')}}</a>
                                        </li>
                                        {{--  page builder check end --}}
                                        @endif
                                        <li class="{{active_menu('admin-home/page-builder/home-page')}}">
                                            <a href="{{route('admin.home.page.builder')}}">
                                                {{__('Home Page Builder')}}
                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission('about_page_manage'))
                                <li class="main_dropdown @if(request()->is('admin-home/about-page/*') || request()->is('admin-home/page-builder/about-page')  ) active @endif ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                       {{__('About Page Manage')}}
                                    </a>
                                    <ul class="collapse">
                                        @if(empty(get_static_option('about_page_page_builder_status')))
                                        <li class="{{active_menu('admin-home/about-page/about-us')}}"><a
                                                    href="{{route('admin.about.page.about')}}">{{__('About Us Section')}}</a></li>
                                        <li class="{{active_menu('admin-home/about-page/global-network')}}"><a
                                                    href="{{route('admin.about.global.network')}}">{{__('Global Network Section')}}</a></li>
                                        <li class="{{active_menu('admin-home/about-page/experience')}}"><a
                                                    href="{{route('admin.about.experience')}}">{{__('Experience Section')}}</a></li>
                                        <li class="{{active_menu('admin-home/about-page/team-member')}}"><a
                                                    href="{{route('admin.about.team.member')}}">{{__('Team Member Section')}}</a></li>
                                        <li class="{{active_menu('admin-home/about-page/testimonial')}}"><a
                                                    href="{{route('admin.about.testimonial')}}">{{__('Testimonial Section')}}</a></li>
                                        <li class="{{active_menu('admin-home/keyfeatures')}}">
                                            <a href="{{route('admin.keyfeatures')}}">{{__('Key Features')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/about-page/section-manage')}}"><a
                                                    href="{{route('admin.about.page.section.manage')}}">{{__('Section Manage')}}</a>
                                        </li>
                                        @endif 
                                        <li class="{{active_menu('admin-home/page-builder/about-page')}}">
                                            <a href="{{route('admin.about.page.builder')}}">
                                                {{__('About Page Builder')}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Contact Page Manage'))
                                <li class="main_dropdown @if(request()->is(['admin-home/contact-page/*','admin-home/page-builder/contact-page'])  ) active @endif">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        {{__('Contact Page Manage')}}
                                    </a>
                                    <ul class="collapse">
                                        @if(empty(get_static_option('contact_page_page_builder_status')))
                                        <li class="{{active_menu('admin-home/contact-page/contact-info')}}">
                                            <a href="{{route('admin.contact.info')}}">{{__('Contact Info')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/form-area')}}">
                                            <a href="{{route('admin.contact.page.form.area')}}">{{__('Form Area')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/map')}}">
                                            <a href="{{route('admin.contact.page.map')}}">{{__('Google Map Area')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/contact-page/section-manage')}}">
                                            <a href="{{route('admin.contact.page.section.manage')}}">{{__('Section Manage')}}</a>
                                        </li>
                                        @endif
                                        <li class="{{active_menu('admin-home/page-builder/contact-page')}}">
                                            <a href="{{route('admin.contact.page.builder')}}">
                                                {{__('Contact Page Builder')}}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('Feedback Page Manage'))
                                <li class="main_dropdown @if(request()->is('admin-home/feedback-page/*')  ) active @endif">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        {{__('Feedback Page Manage')}}
                                    </a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/feedback-page/page-settings')}}">
                                            <a href="{{route('admin.feedback.page.settings')}}">{{__('Page Settings')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/feedback-page/form-builder')}}">
                                            <a href="{{route('admin.feedback.page.form.builder')}}">{{__('Form Builder')}}</a>
                                        </li>
                                        <li class="{{active_menu('admin-home/feedback-page/all-feedback')}}">
                                            <a href="{{route('admin.feedback.all')}}">{{__('All Feedback')}}</a>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                            @if(check_page_permission_by_string('404 Page Manage'))
                                <li class="main_dropdown {{active_menu('admin-home/404-page-manage')}}">
                                    <a href="{{route('admin.404.page.settings')}}" aria-expanded="true">
                                        {{__('404 Page Manage')}}</a>
                                </li>
                            @endif
                            @if(!empty(get_static_option('site_maintenance_mode')))
                                <li class="main_dropdown {{active_menu('admin-home/maintains-page/settings')}}">
                                    <a href="{{route('admin.maintains.page.settings')}}"
                                       aria-expanded="true">
                                       {{__('Maintain Page Manage')}}
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </li>
                    <li class="main_dropdown
                    @if(request()->is([
                    'admin-home/form-builder/*',
                    'admin-home/email-template/*',
                    'admin-home/popup-builder/*',
                    'admin-home/widgets/*',
                    'admin-home/widgets',
                    'admin-home/menu-edit/*',
                    'admin-home/media-upload/page',
                    'admin-home/menu',
                    'admin-home/appearance-setting/*'
                    ])) active @endif
                    ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>{{__('Appearance Settings')}}</span></a>
                        <ul class="collapse ">
                            @if(check_page_permission_by_string('Topbar Settings'))
                                <li class="{{active_menu('admin-home/appearance-setting/topbar-settings')}}">
                                    <a href="{{route('admin.topbar.settings')}}"
                                       aria-expanded="true">
                                        {{__('Topbar Settings')}}
                                    </a>
                                </li>
                            @endif

                            @if(check_page_permission_by_string('Home Variant'))
                                <li class="{{active_menu('admin-home/appearance-setting/navbar-variant/settings')}}">
                                    <a href="{{route('admin.navbar.settings')}}"
                                       aria-expanded="true">
                                        {{__('Navbar Settings')}}
                                    </a>
                                </li>
                                <li class="main_dropdown {{active_menu('admin-home/appearance-setting/home-variant')}}">
                                    <a href="{{route('admin.home.variant')}}"
                                       aria-expanded="true">
                                        {{__('Home Variant')}}
                                    </a>
                                </li>
                                <li class="{{active_menu('admin-home/appearance-setting/breadcrumb-settings')}}">
                                    <a href="{{route('admin.breadcrumb.settings')}}"
                                       aria-expanded="true">
                                        {{__('Breadcrumb Settings')}}
                                    </a>
                                </li>
                                <li class="{{active_menu('admin-home/appearance-setting/footer-settings')}}">
                                    <a href="{{route('admin.footer.settings')}}"
                                       aria-expanded="true">
                                        {{__('Footer Color Settings')}}
                                    </a>
                                </li>
                            @endif

                            @if(check_page_permission_by_string('Menus Manage'))
                                <li
                                        class="main_dropdown
                                        {{active_menu('admin-home/menu')}}
                                        @if(request()->is('admin-home/menu-edit/*')) active @endif
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        {{__('Menus Manage')}}</a>
                                    <ul class="collapse">
                                        <li class="{{active_menu('admin-home/menu')}}"><a
                                                    href="{{route('admin.menu')}}">{{__('All Menus')}}</a></li>
                                    </ul>
                                </li>
                            @endif
                                @if(check_page_permission_by_string('Widgets Manage'))
                                    <li
                                            class="main_dropdown
                                            {{active_menu('admin-home/widgets')}}
                                            @if(request()->is('admin-home/widgets/*')) active @endif
                                                    ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            {{__('Widgets Manage')}}</a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/widgets')}}"><a
                                                        href="{{route('admin.widgets')}}">{{__('All Widgets')}}</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(check_page_permission_by_string('Popup Builder'))
                                    <li class="main_dropdown @if(request()->is('admin-home/popup-builder/*')) active @endif">
                                        <a href="javascript:void(0)"
                                           aria-expanded="true">
                                            {{__('Popup Builder')}}
                                        </a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/popup-builder/all')}}"><a
                                                        href="{{route('admin.popup.builder.all')}}">{{__('All Popup')}}</a></li>
                                            <li class="{{active_menu('admin-home/popup-builder/new')}}"><a
                                                        href="{{route('admin.popup.builder.new')}}">{{__('New Popup')}}</a></li>
                                        </ul>
                                    </li>
                                @endif
                                @if(check_page_permission_by_string('Form Builder'))
                                    <li class="main_dropdown @if(request()->is('admin-home/form-builder/*')) active @endif">
                                        <a href="javascript:void(0)"
                                           aria-expanded="true">
                                            {{__('Form Builder')}}
                                        </a>
                                        <ul class="collapse">
                                            <li class="{{active_menu('admin-home/form-builder/all')}}">
                                                <a href="{{route('admin.form.builder.all')}}">{{__('All Custom Form')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/get-in-touch')}}"><a
                                                        href="{{route('admin.form.builder.get.in.touch')}}">{{__('Get In Touch Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/service-query')}}"><a
                                                        href="{{route('admin.form.builder.service.query')}}">{{__('Service Query Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/case-study-query')}}"><a
                                                        href="{{route('admin.form.builder.case.study.query')}}">{{__('Case Study Query Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/quote-form')}}"><a
                                                        href="{{route('admin.form.builder.quote')}}">{{__('Quote Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/order-form')}}"><a
                                                        href="{{route('admin.form.builder.order')}}">{{__('Order Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/contact-form')}}"><a
                                                        href="{{route('admin.form.builder.contact')}}">{{__('Contact Form')}}</a></li>
                                            <li class="{{active_menu('admin-home/form-builder/apply-job-form')}}"><a
                                                        href="{{route('admin.form.builder.apply.job.form')}}">{{__('Apply Job Form')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/event-attendance')}}"><a
                                                        href="{{route('admin.form.builder.event.attendance.form')}}">{{__('Event Attendance Form')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/appoinment-booking')}}"><a
                                                href="{{route('admin.form.builder.appointment.form')}}">{{__('Call Action Query Form')}}</a>
                                            </li>
                                            <li class="{{active_menu('admin-home/form-builder/estimate')}}"><a
                                                        href="{{route('admin.form.builder.estimate.form')}}">{{__('Estimate Form')}}</a>
                                            </li>
                                        </ul>
                                    </li>
                                @endif
                                @if(check_page_permission_by_string('Email Templates'))
                                    <li class="main_dropdown @if(request()->is('admin-home/email-template/*')) active @endif">
                                        <a href="{{route('admin.email.template.all')}}"
                                           aria-expanded="true">
                                            {{__('Email Templates')}}
                                        </a>
                                    </li>
                                @endif
                                <li class="main_dropdown {{active_menu('admin-home/media-upload/page')}}">
                                    <a href="{{route('admin.upload.media.images.page')}}"
                                       aria-expanded="true">
                                        {{__('Media Images Manage')}}
                                    </a>
                                </li>
                        </ul>
                    </li>
                    @if(check_page_permission_by_string('General Settings'))
                    <li class="main_dropdown @if(request()->is('admin-home/general-settings/*')) active @endif">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span>{{__('General Settings')}}</span></a>
                        <ul class="collapse ">
                            <li class="{{active_menu('admin-home/general-settings/site-identity')}}"><a
                                        href="{{route('admin.general.site.identity')}}">{{__('Site Identity')}}</a></li>
                            <li class="{{active_menu('admin-home/general-settings/basic-settings')}}"><a
                                        href="{{route('admin.general.basic.settings')}}">{{__('Basic Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/color-settings')}}"><a
                                        href="{{route('admin.general.color.settings')}}">{{__('Color Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/typography-settings')}}"><a
                                        href="{{route('admin.general.typography.settings')}}">{{__('Typography Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/seo-settings')}}"><a
                                        href="{{route('admin.general.seo.settings')}}">{{__('SEO Settings')}}</a></li>
                            <li class="{{active_menu('admin-home/general-settings/scripts')}}"><a
                                        href="{{route('admin.general.scripts.settings')}}">{{__('Third Party Scripts')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/email-template')}}"><a
                                        href="{{route('admin.general.email.template')}}">{{__('Email Template')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/email-settings')}}"><a
                                        href="{{route('admin.general.email.settings')}}">{{__('Email Messages Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/smtp-settings')}}"><a
                                        href="{{route('admin.general.smtp.settings')}}">{{__('SMTP Settings')}}</a>
                            </li>
{{--                            <li class="{{active_menu('admin-home/general-settings/regenerate-image')}}"><a--}}
{{--                                        href="{{route('admin.general.regenerate.thumbnail')}}">{{__('Regenerate Media Image')}}</a>--}}
{{--                            </li>--}}
                            <li class="{{active_menu('admin-home/general-settings/page-settings')}}"><a
                                        href="{{route('admin.general.page.settings')}}">{{__('Page Settings')}}</a></li>
                            @if(!empty(get_static_option('site_payment_gateway')))
                            <li class="{{active_menu('admin-home/general-settings/payment-settings')}}"><a
                                        href="{{route('admin.general.payment.settings')}}">{{__('Payment Gateway Settings')}}</a></li>
                            @endif
                            <li class="{{active_menu('admin-home/general-settings/custom-css')}}"><a
                                        href="{{route('admin.general.custom.css')}}">{{__('Custom CSS')}}</a></li>
                            <li class="{{active_menu('admin-home/general-settings/custom-js')}}"><a
                                        href="{{route('admin.general.custom.js')}}">{{__('Custom JS')}}</a></li>

                            <li class="{{active_menu('admin-home/general-settings/cache-settings')}}"><a
                                        href="{{route('admin.general.cache.settings')}}">{{__('Cache Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/gdpr-settings')}}"><a
                                        href="{{route('admin.general.gdpr.settings')}}">{{__('GDPR Compliant Cookies Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/preloader-settings')}}"><a
                                    href="{{route('admin.general.preloader.settings')}}">{{__('Preloader Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/popup-settings')}}"><a
                                    href="{{route('admin.general.popup.settings')}}">{{__('Popup Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/sitemap-settings')}}"><a
                                    href="{{route('admin.general.sitemap.settings')}}">{{__('Sitemap Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/rss-settings')}}"><a
                                    href="{{route('admin.general.rss.feed.settings')}}">{{__('RSS Feed Settings')}}</a>
                            </li>
                            
                            <li class="{{active_menu('admin-home/general-settings/module-settings')}}"><a
                                    href="{{route('admin.general.module.settings')}}">{{__('Module Settings')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/database-upgrade')}}"><a
                                        href="{{route('admin.general.database.upgrade')}}">{{__('Database Upgrade')}}</a>
                            </li>
                            <li class="{{active_menu('admin-home/general-settings/license-setting')}}"><a
                                        href="{{route('admin.general.license.settings')}}">{{__('Licence Settings')}}</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if(check_page_permission('languages'))
                    <li class="main_dropdown @if(request()->is('admin-home/languages/*') || request()->is('admin-home/languages') ) active @endif">
                        <a href="{{route('admin.languages')}}" aria-expanded="true"><i class="ti-signal"></i>
                            <span>{{__('Languages')}}</span></a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
</div>
