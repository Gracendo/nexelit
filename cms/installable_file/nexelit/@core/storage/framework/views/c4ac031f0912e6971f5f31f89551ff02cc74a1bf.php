<?php $home_page_variant = get_static_option('home_page_variant');?>
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo" style="max-height: 50px;">
            <a href="<?php echo e(route('admin.home')); ?>">
                <?php
                    $logo_type = 'site_logo';
                    if(!empty(get_static_option('site_admin_dark_mode'))){
                        $logo_type = 'site_white_logo';
                    }
                ?>
                <?php echo render_image_markup_by_attachment_id(get_static_option($logo_type)); ?>

            </a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav id="main_menu_wrap">
                <ul class="metismenu" id="menu">
                    <li class="<?php echo e(active_menu('admin-home')); ?>">
                        <a href="<?php echo e(route('admin.home')); ?>"
                           aria-expanded="true">
                            <i class="ti-dashboard"></i>
                            <span><?php echo app('translator')->get('dashboard'); ?></span>
                        </a>
                    </li>
                    <?php if(check_page_permission('admin_manage')): ?>
                    <li
                        class="main_dropdown
                        <?php if(request()->is(['admin-home/admin/*'])): ?> active <?php endif; ?>
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Admin Manage')); ?></span></a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/admin/all')); ?>"><a
                                        href="<?php echo e(route('admin.all.user')); ?>"><?php echo e(__('All Admin')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/admin/new')); ?>"><a
                                        href="<?php echo e(route('admin.new.user')); ?>"><?php echo e(__('Add New Admin')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/admin/all/role')); ?>"><a
                                        href="<?php echo e(route('admin.all.user.role')); ?>"><?php echo e(__('All Admin Role')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Users Manage')): ?>
                    <li
                        class="main_dropdown
                        <?php if(request()->is([
                        'admin-home/frontend/user/*',
                        ])): ?> active <?php endif; ?>
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-user"></i>
                            <span><?php echo e(__('Users Manage')); ?></span></a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/frontend/user/all')); ?>"><a
                                    href="<?php echo e(route('admin.all.frontend.user')); ?>"><?php echo e(__('All Users')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/frontend/user/new')); ?>"><a
                                    href="<?php echo e(route('admin.frontend.new.user')); ?>"><?php echo e(__('Add New User')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Newsletter Manage')): ?>
                    <li
                        class="main_dropdown <?php if(request()->is(['admin-home/newsletter/*','admin-home/newsletter'])): ?> active <?php endif; ?>
                     ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-email"></i>
                            <span><?php echo e(__('Newsletter Manage')); ?></span></a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/newsletter')); ?>"><a
                                        href="<?php echo e(route('admin.newsletter')); ?>"><?php echo e(__('All Subscriber')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/newsletter/all')); ?>"><a
                                        href="<?php echo e(route('admin.newsletter.mail')); ?>"><?php echo e(__('Send Mail To All')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <?php if(check_page_permission_by_string('Pages Manage')): ?>
                        <li
                        class="main_dropdown
                        <?php if(request()->is(['admin-home/page/*','admin-home/page'])): ?> active <?php endif; ?>
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e(__('Pages')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/page')); ?>"><a
                                            href="<?php echo e(route('admin.page')); ?>"><?php echo e(__('All Pages')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/page/new')); ?>"><a
                                            href="<?php echo e(route('admin.page.new')); ?>"><?php echo e(__('Add New Page')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>

                    <?php if(check_page_permission_by_string('Blogs Manage')): ?>
                        <li
                         class="main_dropdown
                        <?php if(request()->is(['admin-home/blog/*','admin-home/blog'])): ?> active <?php endif; ?>
                        ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e(__('Blogs')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/blog')); ?>"><a
                                            href="<?php echo e(route('admin.blog')); ?>"><?php echo e(__('All Blog')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/blog/category')); ?>"><a
                                            href="<?php echo e(route('admin.blog.category')); ?>"><?php echo e(__('Category')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/blog/new')); ?>"><a
                                            href="<?php echo e(route('admin.blog.new')); ?>"><?php echo e(__('Add New Post')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/blog/page-settings')); ?>"><a
                                        href="<?php echo e(route('admin.blog.page.settings')); ?>"><?php echo e(__('Blog Page Settings')); ?></a></li>
                                <li class="<?php echo e(active_menu('admin-home/blog/single-settings')); ?>"><a
                                        href="<?php echo e(route('admin.blog.single.settings')); ?>"><?php echo e(__('Blog Single Settings')); ?></a></li>
                            </ul>
                        </li>
                    <?php endif; ?>


                    <li class="main_dropdown
                        <?php if(request()->is(['admin-home/advertisement/*','admin-home/advertisement'])): ?> active <?php endif; ?>
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                            <span><?php echo e(__('Advertisements')); ?></span></a>
                        <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/advertisement')); ?> <?php if(request()->is('admin-home/advertisement/edit/*')): ?> active <?php endif; ?>"><a
                                            href="<?php echo e(route('admin.advertisement')); ?>"><?php echo e(__('All Advertisements')); ?></a></li>

                                <li class="<?php echo e(active_menu('admin-home/advertisement/new')); ?>"><a
                                            href="<?php echo e(route('admin.advertisement.new')); ?>"><?php echo e(__('Add New Advertisement')); ?></a></li>
                        </ul>
                    </li>



                    <?php if(check_page_permission_by_string('Services')): ?>
                    <li class="main_dropdown
                    <?php if(request()->is(['admin-home/services/*','admin-home/services'])): ?> active <?php endif; ?>
                    ">
                        <a href="javascript:void(0)"
                           aria-expanded="true">
                            <i class="ti-layout"></i>
                            <span><?php echo e(__('Services')); ?></span>
                        </a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/services')); ?>"><a
                                    href="<?php echo e(route('admin.services')); ?>"><?php echo e(__('All Services')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/services/new')); ?>"><a
                                    href="<?php echo e(route('admin.services.new')); ?>"><?php echo e(__('New Service')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/services/category')); ?>"><a
                                    href="<?php echo e(route('admin.service.category')); ?>"><?php echo e(__('Category')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/services/page-settings')); ?>"><a
                                    href="<?php echo e(route('admin.services.page.settings')); ?>"><?php echo e(__('Service Page')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Case Study')): ?>
                    <li class="main_dropdown
                    <?php if(request()->is(['admin-home/works/*','admin-home/works'])): ?> active <?php endif; ?> ">
                        <a href="javascript:void(0)"
                           aria-expanded="true">
                            <i class="ti-layout"></i>
                            <span><?php echo e(__('Case Study')); ?></span>
                        </a>
                        <ul class="collapse">
                            <li class="<?php echo e(active_menu('admin-home/works')); ?>"><a
                                        href="<?php echo e(route('admin.work')); ?>"><?php echo e(__('All Case Study')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/works/new')); ?>"><a
                                    href="<?php echo e(route('admin.work.new')); ?>"><?php echo e(__('New Case Study')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/works/category')); ?>"><a
                                        href="<?php echo e(route('admin.work.category')); ?>"><?php echo e(__('Category')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/works/single-page/settings')); ?>"><a
                                    href="<?php echo e(route('admin.work.single.page.settings')); ?>"><?php echo e(__('Case Single Page Settings')); ?></a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Gallery Page')): ?>
                        <li class="main_dropdown
                        <?php echo e(active_menu('admin-home/gallery-page')); ?>

                        <?php if(request()->is('admin-home/gallery-page/*')): ?> active <?php endif; ?>
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e(__('Image Gallery')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/gallery-page')); ?>">
                                    <a href="<?php echo e(route('admin.gallery.all')); ?>" ><?php echo e(__('Image Gallery')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/gallery-page/category')); ?>">
                                    <a href="<?php echo e(route('admin.gallery.category')); ?>" ><?php echo e(__('Category')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/gallery-page/page-settings')); ?>">
                                    <a href="<?php echo e(route('admin.gallery.page.settings')); ?>" ><?php echo e(__('Page Settings')); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Video Gallery')): ?>
                        <li class="main_dropdown
                        <?php echo e(active_menu('admin-home/video-gallery')); ?>

                        <?php if(request()->is('admin-home/video-gallery/*')): ?> active <?php endif; ?>
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e(__('Video Gallery')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/video-gallery')); ?>">
                                    <a href="<?php echo e(route('admin.video.gallery.all')); ?>" ><?php echo e(__('Video Gallery')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/video-gallery/page-settings')); ?>">
                                    <a href="<?php echo e(route('admin.video.gallery.page.settings')); ?>" ><?php echo e(__('Page Settings')); ?></a>
                                </li>
                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Price Plan')): ?>
                        <li class="main_dropdown <?php echo e(active_menu('admin-home/price-plan')); ?>

                        <?php if(request()->is('admin-home/price-plan/*')): ?> active <?php endif; ?>
                                ">
                            <a href="javascript:void(0)" aria-expanded="true"><i class="ti-write"></i>
                                <span><?php echo e(__('Price Plan')); ?></span></a>
                            <ul class="collapse">
                                <li class="<?php echo e(active_menu('admin-home/price-plan')); ?>">
                                    <a href="<?php echo e(route('admin.price.plan')); ?>" ><?php echo e(__('All Price Plan')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/price-plan/new')); ?>">
                                    <a href="<?php echo e(route('admin.price.plan.new')); ?>" ><?php echo e(__('New Price Plan')); ?></a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/price-plan/category')); ?>">
                                    <a href="<?php echo e(route('admin.price.plan.category')); ?>" ><?php echo e(__('Category')); ?></a>
                                </li>

                            </ul>
                        </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Faq')): ?>
                    <li class="main_dropdown <?php echo e(active_menu('admin-home/faq')); ?>">
                        <a href="<?php echo e(route('admin.faq')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span><?php echo e(__('Faq')); ?></span></a>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Brand Logos')): ?>
                    <li class="main_dropdown <?php echo e(active_menu('admin-home/brands')); ?>">
                        <a href="<?php echo e(route('admin.brands')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span><?php echo e(__('Brand Logos')); ?></span></a>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Team Members')): ?>
                    <li class="main_dropdown <?php echo e(active_menu('admin-home/team-member')); ?>">
                        <a href="<?php echo e(route('admin.team.member')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span><?php echo e(__('Team Members')); ?></span></a>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Testimonial')): ?>
                    <li class="main_dropdown <?php echo e(active_menu('admin-home/testimonial')); ?>">
                        <a href="<?php echo e(route('admin.testimonial')); ?>" aria-expanded="true"><i class="ti-control-forward"></i>
                            <span><?php echo e(__('Testimonial')); ?></span></a>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Counterup')): ?>
                    <li class="main_dropdown <?php echo e(active_menu('admin-home/counterup')); ?>">
                        <a href="<?php echo e(route('admin.counterup')); ?>" aria-expanded="true"><i class="ti-exchange-vertical"></i>
                            <span><?php echo e(__('Counterup')); ?></span></a>
                    </li>
                    <?php endif; ?>
                    <li class="main_dropdown
                    <?php if(request()->is(['admin-home/quote-manage/*',
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
                    ])): ?> active <?php endif; ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span><?php echo e(__('All Modules')); ?></span></a>
                        <ul class="collapse ">
                            <?php if(check_page_permission_by_string('Courses Manage')  && !empty(get_static_option('course_module_status'))): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/courses/*')): ?> active <?php endif; ?> ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Courses Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/courses/all')); ?>">
                                            <a href="<?php echo e(route('admin.courses.all')); ?>"><?php echo e(__('All Courses')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/new')); ?>">
                                            <a href="<?php echo e(route('admin.courses.new')); ?>"><?php echo e(__('New Course')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/category')); ?>">
                                            <a href="<?php echo e(route('admin.courses.category.all')); ?>"><?php echo e(__('Category')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/lesson')); ?>">
                                            <a href="<?php echo e(route('admin.courses.lesson.all')); ?>"><?php echo e(__('All Lessons')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/review')); ?>">
                                            <a href="<?php echo e(route('admin.courses.review.all')); ?>"><?php echo e(__('All Reviews')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/coupon')); ?>">
                                            <a href="<?php echo e(route('admin.courses.coupon.all')); ?>"><?php echo e(__('Coupons')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/instructor')); ?>">
                                            <a href="<?php echo e(route('admin.courses.instructor.all')); ?>"><?php echo e(__('Instructor')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/enroll')); ?>">
                                            <a href="<?php echo e(route('admin.courses.enroll.all')); ?>"><?php echo e(__('All Enrollment')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/certificate')); ?>">
                                            <a href="<?php echo e(route('admin.courses.certificate.all')); ?>"><?php echo e(__('Certificate')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/courses/settings')); ?>">
                                            <a href="<?php echo e(route('admin.courses.settings')); ?>"><?php echo e(__('Settings')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Appointment Manage') && !empty(get_static_option('appointment_module_status'))): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/appointment/*')): ?> active <?php endif; ?> ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Appointment Manage')); ?> </a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/appointment/all')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.all')); ?>"><?php echo e(__('All appointment')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/new')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.new')); ?>"><?php echo e(__('New Appointment')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/category')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.category.all')); ?>"><?php echo e(__('Category')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/booking-time')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.booking.time.all')); ?>"><?php echo e(__('Booking Time')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/booking')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.booking.all')); ?>"><?php echo e(__('All Appointment Booking')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/review')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.review.all')); ?>"><?php echo e(__('All Reviews')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/form-builder')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.booking.form.builder')); ?>"><?php echo e(__('Booking Form Builder')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/appointment/settings')); ?>">
                                            <a href="<?php echo e(route('admin.appointment.booking.settings')); ?>"><?php echo e(__('Settings')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Quote Manage')): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/quote-manage/*')): ?> active <?php endif; ?> ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Quote Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/quote-manage/all')); ?>"><a
                                                    href="<?php echo e(route('admin.quote.manage.all')); ?>"><?php echo e(__('All Quote')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/quote-manage/pending')); ?>"><a
                                                    href="<?php echo e(route('admin.quote.manage.pending')); ?>"><?php echo e(__('Pending Quote')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/quote-manage/completed')); ?>"><a
                                                    href="<?php echo e(route('admin.quote.manage.completed')); ?>"><?php echo e(__('Complete Quote')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/quote-manage/quote-page')); ?>">
                                            <a href="<?php echo e(route('admin.quote.page')); ?>">
                                                <?php echo e(__('Quote Page Manage')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Package Orders Manage')): ?>
                                <li class="main_dropdown <?php if(request()->is(['admin-home/payment-logs/report','admin-home/payment-logs','admin-home/package/*'])): ?> active <?php endif; ?>
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Package Orders Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/all')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.manage.all')); ?>"><?php echo e(__('All Order')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/pending')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.manage.pending')); ?>"><?php echo e(__('Pending Order')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/in-progress')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.manage.in.progress')); ?>"><?php echo e(__('In Progress Order')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/completed')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.manage.completed')); ?>"><?php echo e(__('Completed Order')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/success-page')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.success.page')); ?>"><?php echo e(__('Success Order Page')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/cancel-page')); ?>"><a
                                                    href="<?php echo e(route('admin.package.order.cancel.page')); ?>"><?php echo e(__('Cancel Order Page')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-page')); ?>">
                                            <a href="<?php echo e(route('admin.package.order.page')); ?>"><?php echo e(__('Order Page Manage')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-report')); ?>">
                                            <a href="<?php echo e(route('admin.package.order.report')); ?>"><?php echo e(__('Order Report')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/payment-logs')); ?>"><a
                                                    href="<?php echo e(route('admin.payment.logs')); ?>"><?php echo e(__('All Payment Logs')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/payment-logs/report')); ?>"><a
                                                    href="<?php echo e(route('admin.payment.report')); ?>"><?php echo e(__('Payment Report')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/package/order-manage/settings')); ?>"><a
                                                    href="<?php echo e(route('admin.package.settings')); ?>"><?php echo e(__('Settings')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status'))): ?>
                                <li
                                    class="main_dropdown
                                    <?php if(request()->is(['admin-home/jobs/*','admin-home/jobs'])): ?> active <?php endif; ?>
                                    ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Job Post Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/jobs')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.all')); ?>"><?php echo e(__('All Jobs')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/category')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.category.all')); ?>"><?php echo e(__('Category')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/new-jobs')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.new')); ?>"><?php echo e(__('Add New Job')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/page-settings')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.page.settings')); ?>"><?php echo e(__('Job Page Settings')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/single-page-settings')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.single.page.settings')); ?>"><?php echo e(__('Job Single Page Settings')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/success-page-settings')); ?>">
                                            <a href="<?php echo e(route('admin.jobs.success.page.settings')); ?>"><?php echo e(__('Job Success Page Settings')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/cancel-page-settings')); ?>">
                                            <a href="<?php echo e(route('admin.jobs.cancel.page.settings')); ?>"><?php echo e(__('Job Cancel Page Settings')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/applicant')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.applicant')); ?>"><?php echo e(__('All Applicant')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/jobs/applicant/report')); ?>"><a
                                                    href="<?php echo e(route('admin.jobs.applicant.report')); ?>"><?php echo e(__('Applicant Report')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status'))): ?>
                                    <li class="main_dropdown
                                    <?php if(request()->is(['admin-home/events/*','admin-home/events'])): ?> active <?php endif; ?>
                                            ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            <?php echo e(__('Events Manage')); ?></a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/events/all')); ?>"><a
                                                        href="<?php echo e(route('admin.events.all')); ?>"><?php echo e(__('All Events')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/category')); ?>"><a
                                                        href="<?php echo e(route('admin.events.category.all')); ?>"><?php echo e(__('Category')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/new')); ?>"><a
                                                        href="<?php echo e(route('admin.events.new')); ?>"><?php echo e(__('Add New Event')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.events.page.settings')); ?>"><?php echo e(__('Event Page Settings')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/single-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.events.single.page.settings')); ?>"><?php echo e(__('Event Single Settings')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/attendance')); ?>"><a
                                                        href="<?php echo e(route('admin.events.attendance')); ?>"><?php echo e(__('Event Attendance settings')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/events/attendance/all')); ?>"><a
                                                        href="<?php echo e(route('admin.event.attendance.logs')); ?>"><?php echo e(__('Event Attendance Logs')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/event-payment-logs')); ?>"><a
                                                        href="<?php echo e(route('admin.event.payment.logs')); ?>"><?php echo e(__('Event Payment Logs')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/payment-success-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.events.payment.success.page.settings')); ?>"><?php echo e(__('Payment Success Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/payment-cancel-pag-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.events.payment.cancel.page.settings')); ?>"><?php echo e(__('Payment Cancel Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/attendance/report')); ?>"><a
                                                        href="<?php echo e(route('admin.event.attendance.report')); ?>"><?php echo e(__('Attendance Report')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/payment/report')); ?>"><a
                                                        href="<?php echo e(route('admin.event.payment.report')); ?>"><?php echo e(__('Payment Log Report')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/events/settings')); ?>"><a
                                                        href="<?php echo e(route('admin.events.settings')); ?>"><?php echo e(__('Settings')); ?></a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status'))): ?>
                                    <li class="main_dropdown
                                    <?php echo e(active_menu('admin-home/products')); ?>

                                    <?php if(request()->is('admin-home/products/*')): ?> active <?php endif; ?>
                                            ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            <?php echo e(__('Products Manage')); ?></a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/products')); ?>"><a
                                                        href="<?php echo e(route('admin.products.all')); ?>"><?php echo e(__('All Products')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/new')); ?>"><a
                                                        href="<?php echo e(route('admin.products.new')); ?>"><?php echo e(__('Add New Product')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/category')); ?>"><a
                                                        href="<?php echo e(route('admin.products.category.all')); ?>"><?php echo e(__('Category')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/subcategory')); ?>"><a
                                                        href="<?php echo e(route('admin.products.subcategory.all')); ?>"><?php echo e(__('Sub Category')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/shipping')); ?>"><a
                                                        href="<?php echo e(route('admin.products.shipping.all')); ?>"><?php echo e(__('Shipping')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/coupon')); ?>"><a
                                                        href="<?php echo e(route('admin.products.coupon.all')); ?>"><?php echo e(__('Coupon')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/variants')); ?>"><a
                                                        href="<?php echo e(route('admin.products.variants.all')); ?>"><?php echo e(__('Variants')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/products/page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.products.page.settings')); ?>"><?php echo e(__('Product Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/single-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.products.single.page.settings')); ?>"><?php echo e(__('Product Single Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/success-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.products.success.page.settings')); ?>"><?php echo e(__('Order Success Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/cancel-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.products.cancel.page.settings')); ?>"><?php echo e(__('Order Cancel Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/product-order-logs')); ?>"><a
                                                        href="<?php echo e(route('admin.products.order.logs')); ?>"><?php echo e(__('Orders')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/product-ratings')); ?>"><a
                                                        href="<?php echo e(route('admin.products.ratings')); ?>"><?php echo e(__('Ratings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/order-report')); ?>">
                                                <a href="<?php echo e(route('admin.products.order.report')); ?>"><?php echo e(__('Order Report')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/tax-settings')); ?>">
                                                <a href="<?php echo e(route('admin.products.tax.settings')); ?>"><?php echo e(__('Tax Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/products/settings')); ?>">
                                                <a href="<?php echo e(route('admin.products.settings')); ?>"><?php echo e(__('Settings')); ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status'))): ?>
                                    <li class="main_dropdown
                                    <?php echo e(active_menu('admin-home/donations')); ?>

                                    <?php if(request()->is('admin-home/donations/*')): ?> active <?php endif; ?>
                                        ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                           <?php echo e(__('Donations Manage')); ?></a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/donations')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.all')); ?>"><?php echo e(__('All Donations')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/new')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.new')); ?>"><?php echo e(__('Add New Donation')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.page.settings')); ?>"><?php echo e(__('Donation Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/single-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.single.page.settings')); ?>"><?php echo e(__('Donation Single Settings')); ?></a>
                                            </li>

                                            <li class="<?php echo e(active_menu('admin-home/donations/donations-payment-logs')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.payment.logs')); ?>"><?php echo e(__('Donation Payment Logs')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/payment-success-page-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.payment.success.page.settings')); ?>"><?php echo e(__('Payment Success Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/payment-cancel-pag-settings')); ?>"><a
                                                        href="<?php echo e(route('admin.donations.payment.cancel.page.settings')); ?>"><?php echo e(__('Payment Cancel Page Settings')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/donations/report')); ?>">
                                                <a href="<?php echo e(route('admin.donations.report')); ?>"><?php echo e(__('Donation Report')); ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php if(check_page_permission_by_string('Knowledgebase') && !empty(get_static_option('knowledgebase_module_status'))): ?>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/knowledge')); ?> <?php if(request()->is('admin-home/knowledge/*')): ?> active <?php endif; ?>"
                                >
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Knowledgebase')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/knowledge')); ?>"><a
                                                    href="<?php echo e(route('admin.knowledge.all')); ?>"><?php echo e(__('All Articles')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/knowledge/category')); ?>"><a
                                                    href="<?php echo e(route('admin.knowledge.category.all')); ?>"><?php echo e(__('Topics')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/knowledge/new')); ?>"><a
                                                    href="<?php echo e(route('admin.knowledge.new')); ?>"><?php echo e(__('Add New Article')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/knowledge/page-settings')); ?>"><a
                                                    href="<?php echo e(route('admin.knowledge.page.settings')); ?>"><?php echo e(__('Knowledgebase Page Settings')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Support Tickets') && !empty(get_static_option('support_ticket_module_status'))): ?>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/support-tickets')); ?> <?php if(request()->is('admin-home/support-tickets/*')): ?> active <?php endif; ?>"
                                >
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Support Tickets')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/support-tickets')); ?>">
                                            <a href="<?php echo e(route('admin.support.ticket.all')); ?>"><?php echo e(__('All Tickets')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/support-tickets/new')); ?>"><a
                                                    href="<?php echo e(route('admin.support.ticket.new')); ?>"><?php echo e(__('Add New Ticket')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/support-tickets/department')); ?>"><a
                                                    href="<?php echo e(route('admin.support.ticket.department')); ?>"><?php echo e(__('Departments')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/support-tickets/page-settings')); ?>"><a
                                                    href="<?php echo e(route('admin.support.ticket.page.settings')); ?>"><?php echo e(__('Page Settings')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="main_dropdown
                        <?php if(request()->is([
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
                        ])): ?> active <?php endif; ?>
                        ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span><?php echo e(__('All Page Settings')); ?></span></a>
                        <ul class="collapse ">
                            <?php if(check_page_permission_by_string('Home Page Manage')): ?>
                                <li class="main_dropdown
                                <?php if(request()->is([
                                    'admin-home/home-'.$home_page_variant.'/*',
                                    'admin-home/home-page-'.$home_page_variant.'/*',
                                    'admin-home/home-page-01/*',
                                    'admin-home/header',
                                    'admin-home/keyfeatures',
                                    'admin-home/page-builder/home-page'
                                    ])  ): ?> active <?php endif; ?>
                                ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        <?php echo e(__('Home Page Manage')); ?>

                                    </a>
                                    <ul class="collapse">
                                        
                                        <?php if(empty(get_static_option('home_page_page_builder_status'))): ?>
                                        <?php if(in_array($home_page_variant,['01','02','03','04'])): ?>
                                            <li class="<?php echo e(active_menu('admin-home/header')); ?>">
                                                <a href="<?php echo e(route('admin.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/keyfeatures')); ?>">
                                                <a href="<?php echo e(route('admin.keyfeatures')); ?>"><?php echo e(__('Key Features')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/about-us')); ?>"><a
                                                        href="<?php echo e(route('admin.homeone.about.us')); ?>"><?php echo e(__('About Us Area')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/service-area')); ?>"><a
                                                        href="<?php echo e(route('admin.homeone.service.area')); ?>"><?php echo e(__('Service Area')); ?></a></li>
                                            <?php if($home_page_variant != '03'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-01/quality-area')); ?>"><a
                                                            href="<?php echo e(route('admin.homeone.quality.area')); ?>"><?php echo e(__('Quality Area')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/case-study-area')); ?>"><a
                                                        href="<?php echo e(route('admin.homeone.case.study.area')); ?>"><?php echo e(__('Case Study Area')); ?></a>
                                            </li>
                                            <?php if($home_page_variant == '03'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-01/cta-area')); ?>"><a
                                                            href="<?php echo e(route('admin.homeone.cta.area')); ?>"><?php echo e(__('Call To Action Area')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/testimonial')); ?>"><a
                                                        href="<?php echo e(route('admin.homeone.testimonial')); ?>"><?php echo e(__('Testimonial Area')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/price-plan')); ?>"><a
                                                        href="<?php echo e(route('admin.homeone.price.plan')); ?>"><?php echo e(__('Price Plan Area')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/contact-area')); ?>">

                                                <a href="<?php echo e(route('admin.homeone.contact.area')); ?>"><?php echo e(__('Contact Area')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/home-page-01/latest-news')); ?>"><a

                                                        href="<?php echo e(route('admin.homeone.latest.news')); ?>"><?php echo e(__('Latest News Area')); ?></a>
                                            </li>
                                            <?php if(in_array($home_page_variant,['04','02'])): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-01/team-member')); ?>"><a
                                                            href="<?php echo e(route('admin.homeone.team.member')); ?>"><?php echo e(__('Team Member Area')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if(in_array($home_page_variant,['03','02'])): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-01/brand-logos')); ?>"><a
                                                            href="<?php echo e(route('admin.homeone.brand.logos')); ?>"><?php echo e(__('Brands Logos Area')); ?></a></li>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '05'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/header')); ?>">
                                                <a href="<?php echo e(route('admin.home05.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/about')); ?>">
                                                <a href="<?php echo e(route('admin.home05.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/expertises')); ?>">
                                                <a href="<?php echo e(route('admin.home05.expertises')); ?>">
                                                    <?php echo e(__('Experties Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/what-we-offer')); ?>">
                                                <a href="<?php echo e(route('admin.home05.what.offer.area')); ?>">
                                                    <?php echo e(__('What We Offer Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/recent-work')); ?>">
                                                <a href="<?php echo e(route('admin.home05.recent.work.area')); ?>">
                                                    <?php echo e(__('Recent Work Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/cta-area')); ?>">
                                                <a href="<?php echo e(route('admin.home05.cta.area')); ?>">
                                                    <?php echo e(__('Cta Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home05.testimonial.area')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-05/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home05.news.area')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '06'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/header')); ?>">
                                                <a href="<?php echo e(route('admin.home06.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                             <li class="<?php echo e(active_menu('admin-home/keyfeatures')); ?>">
                                                <a href="<?php echo e(route('admin.keyfeatures')); ?>"><?php echo e(__('Key Features')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/what-we-offer')); ?>">
                                                <a href="<?php echo e(route('admin.home06.what.offer')); ?>">
                                                    <?php echo e(__('What we offer area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/video-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.video.area')); ?>">
                                                    <?php echo e(__('Video area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/counterup-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.counterup.area')); ?>">
                                                    <?php echo e(__('Counterup area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/project-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.project.area')); ?>">
                                                    <?php echo e(__('Project area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/quote-faq-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.quote.faq.area')); ?>">
                                                    <?php echo e(__('Quote & FAQ area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.testimonial.area')); ?>">
                                                    <?php echo e(__('Testimonial area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-06/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home06.news.area')); ?>">
                                                    <?php echo e(__('News area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '07'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/header')); ?>">
                                                <a href="<?php echo e(route('admin.home07.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/about')); ?>">
                                                <a href="<?php echo e(route('admin.home07.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/service')); ?>">
                                                <a href="<?php echo e(route('admin.home07.service')); ?>">
                                                    <?php echo e(__('Service Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/counterup')); ?>">
                                                <a href="<?php echo e(route('admin.home07.counterup')); ?>">
                                                    <?php echo e(__('Counterup Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/our-projects')); ?>">
                                                <a href="<?php echo e(route('admin.home07.projects')); ?>">
                                                    <?php echo e(__('Our Projects Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/team-member')); ?>">
                                                <a href="<?php echo e(route('admin.home07.team.member')); ?>">
                                                    <?php echo e(__('Team Member Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/testimonial')); ?>">
                                                <a href="<?php echo e(route('admin.home07.testimonial')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-07/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home07.news.area')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '08'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/header')); ?>">
                                                <a href="<?php echo e(route('admin.home08.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/what-we-offer')); ?>">
                                                <a href="<?php echo e(route('admin.home08.what.we.offer')); ?>">
                                                    <?php echo e(__('What We Offer Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/video-area')); ?>">
                                                <a href="<?php echo e(route('admin.home08.video.area')); ?>">
                                                    <?php echo e(__('Video area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/work-process')); ?>">
                                                <a href="<?php echo e(route('admin.home08.work.process')); ?>">
                                                    <?php echo e(__('Work Process area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/our-portfolio')); ?>">
                                                <a href="<?php echo e(route('admin.home08.our.portfolio')); ?>">
                                                    <?php echo e(__('Our Portfolio area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/cta-area')); ?>">
                                                <a href="<?php echo e(route('admin.home08.cta.area')); ?>">
                                                    <?php echo e(__('Call to action area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home08.testimonial.area')); ?>">
                                                    <?php echo e(__('Testimonial area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-08/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home08.news.area')); ?>">
                                                    <?php echo e(__('News area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>

                                        <?php if($home_page_variant == '09'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/header')); ?>">
                                                <a href="<?php echo e(route('admin.home09.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/about-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/what-we-offer-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.what.we.offer')); ?>">
                                                    <?php echo e(__('What We Offer Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/quote-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.quote.area')); ?>">
                                                    <?php echo e(__('Quote Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/project-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.project.area')); ?>">
                                                    <?php echo e(__('Project Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/team-member-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.team.member.area')); ?>">
                                                    <?php echo e(__('Team Member Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.testimonial.area')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-09/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home09.news.area')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '10'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/header-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/key-features-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.key.features')); ?>">
                                                    <?php echo e(__('Key Features Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/about-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/service-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.service')); ?>">
                                                    <?php echo e(__('Service Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/appointment-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.appointment')); ?>">
                                                    <?php echo e(__('Appointment Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/counterup-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.counterup')); ?>">
                                                    <?php echo e(__('Counterup Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.testimonial')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.news')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/cta-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.cta')); ?>">
                                                    <?php echo e(__('Call to action Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-10/contact-area')); ?>">
                                                <a href="<?php echo e(route('admin.home10.contact')); ?>">
                                                    <?php echo e(__('Contact Area')); ?>

                                                </a>
                                            </li>
                                        <?php endif; ?>
                                        <?php if($home_page_variant == '11'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/header-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/key-features-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.key.features')); ?>">
                                                    <?php echo e(__('Key Features Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/about-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/video-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.video')); ?>">
                                                    <?php echo e(__('Video Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/cta-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.cta')); ?>">
                                                    <?php echo e(__('Call to action Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/service-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.service')); ?>">
                                                    <?php echo e(__('Service Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/counterup-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.counterup')); ?>">
                                                    <?php echo e(__('Counterup Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/event-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.event')); ?>">
                                                    <?php echo e(__('Event Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.testimonial')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-11/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home11.news')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                            <?php endif; ?>
                                        <?php if($home_page_variant == '12'): ?>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/header-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.header')); ?>">
                                                    <?php echo e(__('Header Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/about-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.about')); ?>">
                                                    <?php echo e(__('About Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/service-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.service')); ?>">
                                                    <?php echo e(__('Service Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/cta-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.cta')); ?>">
                                                    <?php echo e(__('Call To Action Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/appointment-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.appointment')); ?>">
                                                    <?php echo e(__('Appointment Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/case-study-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.case.study')); ?>">
                                                    <?php echo e(__('Case Study Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/testimonial-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.testimonial')); ?>">
                                                    <?php echo e(__('Testimonial Area')); ?>

                                                </a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/home-12/news-area')); ?>">
                                                <a href="<?php echo e(route('admin.home12.news')); ?>">
                                                    <?php echo e(__('News Area')); ?>

                                                </a>
                                            </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '13'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/about-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.about')); ?>">
                                                        <?php echo e(__('About Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/popular-cause')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.popular.cause')); ?>">
                                                        <?php echo e(__('Popular Cause Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/team-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.team')); ?>">
                                                        <?php echo e(__('Team Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/cta-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.cta')); ?>">
                                                        <?php echo e(__('Call To Action Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/event-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.event')); ?>">
                                                        <?php echo e(__('Event Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.testimonial')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/cta-area-02')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.cta.two')); ?>">
                                                        <?php echo e(__('Join Volunteer Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-13/news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home13.news')); ?>">
                                                        <?php echo e(__('News Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '14'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/service-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.service')); ?>">
                                                        <?php echo e(__('Service Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/portfolio-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.portfolio')); ?>">
                                                        <?php echo e(__('Portfolio Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/cta-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.cta')); ?>">
                                                        <?php echo e(__('Call To Action Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/work-process-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.work.process')); ?>">
                                                        <?php echo e(__('Work Process Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/counterup-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.counterup')); ?>">
                                                        <?php echo e(__('Counterup Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.testimonial')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.news')); ?>">
                                                        <?php echo e(__('News Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-14/contact-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home14.contact')); ?>">
                                                        <?php echo e(__('Contact Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '15'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/offer-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.offer')); ?>">
                                                        <?php echo e(__('Offer Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/featured-product-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.featured.products')); ?>">
                                                        <?php echo e(__('Featured Products Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/process-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.process')); ?>">
                                                        <?php echo e(__('Process Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/product-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.latest.product')); ?>">
                                                        <?php echo e(__('Products Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.testimonial')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-15/top-selling-product-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home15.top.selling.product')); ?>">
                                                        <?php echo e(__('Top Selling Products Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '16'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/about-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.about')); ?>">
                                                        <?php echo e(__('About Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/service-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.service')); ?>">
                                                        <?php echo e(__('Our Services Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/free-estimate-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.estimate')); ?>">
                                                        <?php echo e(__('Estimate Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/work-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.work')); ?>">
                                                        <?php echo e(__('Work Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/appointment-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.appointment')); ?>">
                                                        <?php echo e(__('Appointment Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.testimonial')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-16/news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home16.news')); ?>">
                                                        <?php echo e(__('News Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '17'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/speciality')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.speciality')); ?>">
                                                        <?php echo e(__('Speciality Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/featured-courses')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.featured.courses')); ?>">
                                                        <?php echo e(__('Featured Course Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/video-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.video.area')); ?>">
                                                        <?php echo e(__('Video Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/all-courses-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.all.courses.area')); ?>">
                                                        <?php echo e(__('All Courses Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.all.testimonial.area')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/event-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.all.event.area')); ?>">
                                                        <?php echo e(__('Event Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-17/cta-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home17.all.cta.area')); ?>">
                                                        <?php echo e(__('Call To Action Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '18'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/product-categories')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.product.categories')); ?>">
                                                        <?php echo e(__('Categories Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/offer-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.offer.area')); ?>">
                                                        <?php echo e(__('Offer Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/popular-item-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.popular.item')); ?>">
                                                        <?php echo e(__('Popular Items Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/process-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.process.area')); ?>">
                                                        <?php echo e(__('Process Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/product-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.product.area')); ?>">
                                                        <?php echo e(__('Product Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-18/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home18.testimonial.area')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '21'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/services-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.services')); ?>">
                                                        <?php echo e(__('Services Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/project-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.project')); ?>">
                                                        <?php echo e(__('Project Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/counterup-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.counterup')); ?>">
                                                        <?php echo e(__('Counterup Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/blog-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.blog')); ?>">
                                                        <?php echo e(__('Blog Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/testimonial-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.testimonial')); ?>">
                                                        <?php echo e(__('Testimonial Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/contact-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.contact')); ?>">
                                                        <?php echo e(__('Contact Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-21/newsletter-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home21.newsletter')); ?>">
                                                        <?php echo e(__('Newsletter Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>


                                            <?php if($home_page_variant == '19'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/todays-deal-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.todays.deal')); ?>">
                                                        <?php echo e(__('Todays Deal Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/updated-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.updated.area')); ?>">
                                                        <?php echo e(__('Updated Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/store-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.store.area')); ?>">
                                                        <?php echo e(__('Store Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/clothing-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.clothing.area')); ?>">
                                                        <?php echo e(__('Clothing Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/popular-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.popular.area')); ?>">
                                                        <?php echo e(__('Popular Sale Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/instagram-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.instagram.area')); ?>">
                                                        <?php echo e(__('Instagram Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-19/promo-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home19.promo.area')); ?>">
                                                        <?php echo e(__('Promotional Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                            <?php if($home_page_variant == '20'): ?>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/header-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.header')); ?>">
                                                        <?php echo e(__('Header Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/breaking-news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.breaking.news')); ?>">
                                                        <?php echo e(__('Breaking News Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/advertisement-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.advertisement')); ?>">
                                                        <?php echo e(__('Advertisement Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/popular-news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.popular')); ?>">
                                                        <?php echo e(__('Popular News Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/video-news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.video')); ?>">
                                                        <?php echo e(__('Video News Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/sports-news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.sports')); ?>">
                                                        <?php echo e(__('Sports News Area')); ?>

                                                    </a>
                                                </li>
                                                <li class="<?php echo e(active_menu('admin-home/home-page-20/hot-news-area')); ?>">
                                                    <a href="<?php echo e(route('admin.home20.hot')); ?>">
                                                        <?php echo e(__('Hot News Area')); ?>

                                                    </a>
                                                </li>
                                            <?php endif; ?>

                                        <li class="<?php echo e(active_menu('admin-home/home-page-01/section-manage')); ?>">
                                            <a href="<?php echo e(route('admin.homeone.section.manage')); ?>"><?php echo e(__('Section Manage')); ?></a>
                                        </li>
                                        
                                        <?php endif; ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-builder/home-page')); ?>">
                                            <a href="<?php echo e(route('admin.home.page.builder')); ?>">
                                                <?php echo e(__('Home Page Builder')); ?>

                                            </a>
                                        </li>

                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission('about_page_manage')): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/about-page/*') || request()->is('admin-home/page-builder/about-page')  ): ?> active <?php endif; ?> ">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                       <?php echo e(__('About Page Manage')); ?>

                                    </a>
                                    <ul class="collapse">
                                        <?php if(empty(get_static_option('about_page_page_builder_status'))): ?>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/about-us')); ?>"><a
                                                    href="<?php echo e(route('admin.about.page.about')); ?>"><?php echo e(__('About Us Section')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/global-network')); ?>"><a
                                                    href="<?php echo e(route('admin.about.global.network')); ?>"><?php echo e(__('Global Network Section')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/experience')); ?>"><a
                                                    href="<?php echo e(route('admin.about.experience')); ?>"><?php echo e(__('Experience Section')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/team-member')); ?>"><a
                                                    href="<?php echo e(route('admin.about.team.member')); ?>"><?php echo e(__('Team Member Section')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/testimonial')); ?>"><a
                                                    href="<?php echo e(route('admin.about.testimonial')); ?>"><?php echo e(__('Testimonial Section')); ?></a></li>
                                        <li class="<?php echo e(active_menu('admin-home/keyfeatures')); ?>">
                                            <a href="<?php echo e(route('admin.keyfeatures')); ?>"><?php echo e(__('Key Features')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/about-page/section-manage')); ?>"><a
                                                    href="<?php echo e(route('admin.about.page.section.manage')); ?>"><?php echo e(__('Section Manage')); ?></a>
                                        </li>
                                        <?php endif; ?> 
                                        <li class="<?php echo e(active_menu('admin-home/page-builder/about-page')); ?>">
                                            <a href="<?php echo e(route('admin.about.page.builder')); ?>">
                                                <?php echo e(__('About Page Builder')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Contact Page Manage')): ?>
                                <li class="main_dropdown <?php if(request()->is(['admin-home/contact-page/*','admin-home/page-builder/contact-page'])  ): ?> active <?php endif; ?>">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        <?php echo e(__('Contact Page Manage')); ?>

                                    </a>
                                    <ul class="collapse">
                                        <?php if(empty(get_static_option('contact_page_page_builder_status'))): ?>
                                        <li class="<?php echo e(active_menu('admin-home/contact-page/contact-info')); ?>">
                                            <a href="<?php echo e(route('admin.contact.info')); ?>"><?php echo e(__('Contact Info')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/contact-page/form-area')); ?>">
                                            <a href="<?php echo e(route('admin.contact.page.form.area')); ?>"><?php echo e(__('Form Area')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/contact-page/map')); ?>">
                                            <a href="<?php echo e(route('admin.contact.page.map')); ?>"><?php echo e(__('Google Map Area')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/contact-page/section-manage')); ?>">
                                            <a href="<?php echo e(route('admin.contact.page.section.manage')); ?>"><?php echo e(__('Section Manage')); ?></a>
                                        </li>
                                        <?php endif; ?>
                                        <li class="<?php echo e(active_menu('admin-home/page-builder/contact-page')); ?>">
                                            <a href="<?php echo e(route('admin.contact.page.builder')); ?>">
                                                <?php echo e(__('Contact Page Builder')); ?>

                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('Feedback Page Manage')): ?>
                                <li class="main_dropdown <?php if(request()->is('admin-home/feedback-page/*')  ): ?> active <?php endif; ?>">
                                    <a href="javascript:void(0)"
                                       aria-expanded="true">
                                        <?php echo e(__('Feedback Page Manage')); ?>

                                    </a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/feedback-page/page-settings')); ?>">
                                            <a href="<?php echo e(route('admin.feedback.page.settings')); ?>"><?php echo e(__('Page Settings')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/feedback-page/form-builder')); ?>">
                                            <a href="<?php echo e(route('admin.feedback.page.form.builder')); ?>"><?php echo e(__('Form Builder')); ?></a>
                                        </li>
                                        <li class="<?php echo e(active_menu('admin-home/feedback-page/all-feedback')); ?>">
                                            <a href="<?php echo e(route('admin.feedback.all')); ?>"><?php echo e(__('All Feedback')); ?></a>
                                        </li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                            <?php if(check_page_permission_by_string('404 Page Manage')): ?>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/404-page-manage')); ?>">
                                    <a href="<?php echo e(route('admin.404.page.settings')); ?>" aria-expanded="true">
                                        <?php echo e(__('404 Page Manage')); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if(!empty(get_static_option('site_maintenance_mode'))): ?>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/maintains-page/settings')); ?>">
                                    <a href="<?php echo e(route('admin.maintains.page.settings')); ?>"
                                       aria-expanded="true">
                                       <?php echo e(__('Maintain Page Manage')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <li class="main_dropdown
                    <?php if(request()->is([
                    'admin-home/form-builder/*',
                    'admin-home/email-template/*',
                    'admin-home/popup-builder/*',
                    'admin-home/widgets/*',
                    'admin-home/widgets',
                    'admin-home/menu-edit/*',
                    'admin-home/media-upload/page',
                    'admin-home/menu',
                    'admin-home/appearance-setting/*'
                    ])): ?> active <?php endif; ?>
                    ">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span><?php echo e(__('Appearance Settings')); ?></span></a>
                        <ul class="collapse ">
                            <?php if(check_page_permission_by_string('Topbar Settings')): ?>
                                <li class="<?php echo e(active_menu('admin-home/appearance-setting/topbar-settings')); ?>">
                                    <a href="<?php echo e(route('admin.topbar.settings')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Topbar Settings')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(check_page_permission_by_string('Home Variant')): ?>
                                <li class="<?php echo e(active_menu('admin-home/appearance-setting/navbar-variant/settings')); ?>">
                                    <a href="<?php echo e(route('admin.navbar.settings')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Navbar Settings')); ?>

                                    </a>
                                </li>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/appearance-setting/home-variant')); ?>">
                                    <a href="<?php echo e(route('admin.home.variant')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Home Variant')); ?>

                                    </a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/appearance-setting/breadcrumb-settings')); ?>">
                                    <a href="<?php echo e(route('admin.breadcrumb.settings')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Breadcrumb Settings')); ?>

                                    </a>
                                </li>
                                <li class="<?php echo e(active_menu('admin-home/appearance-setting/footer-settings')); ?>">
                                    <a href="<?php echo e(route('admin.footer.settings')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Footer Color Settings')); ?>

                                    </a>
                                </li>
                            <?php endif; ?>

                            <?php if(check_page_permission_by_string('Menus Manage')): ?>
                                <li
                                        class="main_dropdown
                                        <?php echo e(active_menu('admin-home/menu')); ?>

                                        <?php if(request()->is('admin-home/menu-edit/*')): ?> active <?php endif; ?>
                                        ">
                                    <a href="javascript:void(0)" aria-expanded="true">
                                        <?php echo e(__('Menus Manage')); ?></a>
                                    <ul class="collapse">
                                        <li class="<?php echo e(active_menu('admin-home/menu')); ?>"><a
                                                    href="<?php echo e(route('admin.menu')); ?>"><?php echo e(__('All Menus')); ?></a></li>
                                    </ul>
                                </li>
                            <?php endif; ?>
                                <?php if(check_page_permission_by_string('Widgets Manage')): ?>
                                    <li
                                            class="main_dropdown
                                            <?php echo e(active_menu('admin-home/widgets')); ?>

                                            <?php if(request()->is('admin-home/widgets/*')): ?> active <?php endif; ?>
                                                    ">
                                        <a href="javascript:void(0)" aria-expanded="true">
                                            <?php echo e(__('Widgets Manage')); ?></a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/widgets')); ?>"><a
                                                        href="<?php echo e(route('admin.widgets')); ?>"><?php echo e(__('All Widgets')); ?></a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if(check_page_permission_by_string('Popup Builder')): ?>
                                    <li class="main_dropdown <?php if(request()->is('admin-home/popup-builder/*')): ?> active <?php endif; ?>">
                                        <a href="javascript:void(0)"
                                           aria-expanded="true">
                                            <?php echo e(__('Popup Builder')); ?>

                                        </a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/popup-builder/all')); ?>"><a
                                                        href="<?php echo e(route('admin.popup.builder.all')); ?>"><?php echo e(__('All Popup')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/popup-builder/new')); ?>"><a
                                                        href="<?php echo e(route('admin.popup.builder.new')); ?>"><?php echo e(__('New Popup')); ?></a></li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if(check_page_permission_by_string('Form Builder')): ?>
                                    <li class="main_dropdown <?php if(request()->is('admin-home/form-builder/*')): ?> active <?php endif; ?>">
                                        <a href="javascript:void(0)"
                                           aria-expanded="true">
                                            <?php echo e(__('Form Builder')); ?>

                                        </a>
                                        <ul class="collapse">
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/all')); ?>">
                                                <a href="<?php echo e(route('admin.form.builder.all')); ?>"><?php echo e(__('All Custom Form')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/get-in-touch')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.get.in.touch')); ?>"><?php echo e(__('Get In Touch Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/service-query')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.service.query')); ?>"><?php echo e(__('Service Query Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/case-study-query')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.case.study.query')); ?>"><?php echo e(__('Case Study Query Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/quote-form')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.quote')); ?>"><?php echo e(__('Quote Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/order-form')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.order')); ?>"><?php echo e(__('Order Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/contact-form')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.contact')); ?>"><?php echo e(__('Contact Form')); ?></a></li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/apply-job-form')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.apply.job.form')); ?>"><?php echo e(__('Apply Job Form')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/event-attendance')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.event.attendance.form')); ?>"><?php echo e(__('Event Attendance Form')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/appoinment-booking')); ?>"><a
                                                href="<?php echo e(route('admin.form.builder.appointment.form')); ?>"><?php echo e(__('Call Action Query Form')); ?></a>
                                            </li>
                                            <li class="<?php echo e(active_menu('admin-home/form-builder/estimate')); ?>"><a
                                                        href="<?php echo e(route('admin.form.builder.estimate.form')); ?>"><?php echo e(__('Estimate Form')); ?></a>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                                <?php if(check_page_permission_by_string('Email Templates')): ?>
                                    <li class="main_dropdown <?php if(request()->is('admin-home/email-template/*')): ?> active <?php endif; ?>">
                                        <a href="<?php echo e(route('admin.email.template.all')); ?>"
                                           aria-expanded="true">
                                            <?php echo e(__('Email Templates')); ?>

                                        </a>
                                    </li>
                                <?php endif; ?>
                                <li class="main_dropdown <?php echo e(active_menu('admin-home/media-upload/page')); ?>">
                                    <a href="<?php echo e(route('admin.upload.media.images.page')); ?>"
                                       aria-expanded="true">
                                        <?php echo e(__('Media Images Manage')); ?>

                                    </a>
                                </li>
                        </ul>
                    </li>
                    <?php if(check_page_permission_by_string('General Settings')): ?>
                    <li class="main_dropdown <?php if(request()->is('admin-home/general-settings/*')): ?> active <?php endif; ?>">
                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-settings"></i>
                            <span><?php echo e(__('General Settings')); ?></span></a>
                        <ul class="collapse ">
                            <li class="<?php echo e(active_menu('admin-home/general-settings/site-identity')); ?>"><a
                                        href="<?php echo e(route('admin.general.site.identity')); ?>"><?php echo e(__('Site Identity')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/basic-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.basic.settings')); ?>"><?php echo e(__('Basic Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/color-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.color.settings')); ?>"><?php echo e(__('Color Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/typography-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.typography.settings')); ?>"><?php echo e(__('Typography Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/seo-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.seo.settings')); ?>"><?php echo e(__('SEO Settings')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/scripts')); ?>"><a
                                        href="<?php echo e(route('admin.general.scripts.settings')); ?>"><?php echo e(__('Third Party Scripts')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/email-template')); ?>"><a
                                        href="<?php echo e(route('admin.general.email.template')); ?>"><?php echo e(__('Email Template')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/email-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.email.settings')); ?>"><?php echo e(__('Email Messages Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/smtp-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.smtp.settings')); ?>"><?php echo e(__('SMTP Settings')); ?></a>
                            </li>



                            <li class="<?php echo e(active_menu('admin-home/general-settings/page-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.page.settings')); ?>"><?php echo e(__('Page Settings')); ?></a></li>
                            <?php if(!empty(get_static_option('site_payment_gateway'))): ?>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/payment-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.payment.settings')); ?>"><?php echo e(__('Payment Gateway Settings')); ?></a></li>
                            <?php endif; ?>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/custom-css')); ?>"><a
                                        href="<?php echo e(route('admin.general.custom.css')); ?>"><?php echo e(__('Custom CSS')); ?></a></li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/custom-js')); ?>"><a
                                        href="<?php echo e(route('admin.general.custom.js')); ?>"><?php echo e(__('Custom JS')); ?></a></li>

                            <li class="<?php echo e(active_menu('admin-home/general-settings/cache-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.cache.settings')); ?>"><?php echo e(__('Cache Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/gdpr-settings')); ?>"><a
                                        href="<?php echo e(route('admin.general.gdpr.settings')); ?>"><?php echo e(__('GDPR Compliant Cookies Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/preloader-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.preloader.settings')); ?>"><?php echo e(__('Preloader Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/popup-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.popup.settings')); ?>"><?php echo e(__('Popup Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/sitemap-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.sitemap.settings')); ?>"><?php echo e(__('Sitemap Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/rss-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.rss.feed.settings')); ?>"><?php echo e(__('RSS Feed Settings')); ?></a>
                            </li>
                            
                            <li class="<?php echo e(active_menu('admin-home/general-settings/module-settings')); ?>"><a
                                    href="<?php echo e(route('admin.general.module.settings')); ?>"><?php echo e(__('Module Settings')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/database-upgrade')); ?>"><a
                                        href="<?php echo e(route('admin.general.database.upgrade')); ?>"><?php echo e(__('Database Upgrade')); ?></a>
                            </li>
                            <li class="<?php echo e(active_menu('admin-home/general-settings/license-setting')); ?>"><a
                                        href="<?php echo e(route('admin.general.license.settings')); ?>"><?php echo e(__('Licence Settings')); ?></a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if(check_page_permission('languages')): ?>
                    <li class="main_dropdown <?php if(request()->is('admin-home/languages/*') || request()->is('admin-home/languages') ): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('admin.languages')); ?>" aria-expanded="true"><i class="ti-signal"></i>
                            <span><?php echo e(__('Languages')); ?></span></a>
                    </li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/partials/sidebar.blade.php ENDPATH**/ ?>