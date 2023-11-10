<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="main-content-inner">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                 <?php if(check_page_permission('admin_manage')): ?>
                    <div class="col-md-3 mt-5 mb-3">
                        <div class="card text-dark mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.new.user')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_admin); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Admin')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php if(check_page_permission_by_string('Blogs Manage')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.blog.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-comments"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($blog_count); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Blogs')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                 <?php endif; ?>
                    <?php if(check_page_permission_by_string('Job Post Manage') && !empty(get_static_option('job_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.jobs.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-briefcase"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_jobs); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Jobs')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.events.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-calendar"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_events); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Events')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-3 mt-md-5 mb-3">
                            <div class="card text-dark mb-3">
                                <div class="dsh-box-style">
                                    <a href="<?php echo e(route('admin.event.attendance.logs')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                    <div class="icon">
                                        <i class="ti-stats-up"></i>
                                    </div>
                                    <div class="content">
                                        <span class="total"><?php echo e($total_event_attendance); ?></span>
                                        <h4 class="title"><?php echo e(__('Total Events Attendance')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.donations.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-hand-stop"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_donations); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Donations Cause')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-md-3 mt-md-5 mb-3">
                            <div class="card text-dark  mb-3">
                                <div class="dsh-box-style">
                                    <a href="<?php echo e(route('admin.donations.payment.logs')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                    <div class="icon">
                                        <i class="ti-money"></i>
                                    </div>
                                    <div class="content">
                                        <span class="total"><?php echo e($total_donated_log); ?></span>
                                        <h4 class="title"><?php echo e(__('Total Donated')); ?></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.products.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-package"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_products); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Products')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.products.order.logs')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-shopping-cart"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_product_order); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Products Order')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Services')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.services.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-blackboard"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_services); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Services')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(check_page_permission_by_string('Price Plan')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.price.plan.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-pie-chart"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_price_plan); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Price Plan')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                     <?php if(check_page_permission_by_string('Case Study')): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card text-dark  mb-3">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.work.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-write"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_works); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Case Study')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                     <?php endif; ?>
                     <?php if(!empty(get_static_option('course_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.courses.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-book"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_courses); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Cources')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.courses.enroll.all')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-user"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_courses_enroll); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Course Enrolls')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if(!empty(get_static_option('appointment_module_status'))): ?>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.appointment.new')); ?>" class="add-new"><i class="ti-plus"></i></a>
                                <div class="icon">
                                    <i class="ti-calendar"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_appointments); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Appointments')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-md-5 mb-3">
                        <div class="card">
                            <div class="dsh-box-style">
                                <a href="<?php echo e(route('admin.appointment.booking.all')); ?>" class="add-new"><i class="ti-eye"></i></a>
                                <div class="icon">
                                    <i class="ti-alarm-clock"></i>
                                </div>
                                <div class="content">
                                    <span class="total"><?php echo e($total_appointment_booking); ?></span>
                                    <h4 class="title"><?php echo e(__('Total Appointment Booking')); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
             <?php if(check_page_permission_by_string('Products Manage') && !empty(get_static_option('product_module_status'))): ?>
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Product Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <th><?php echo e(__('Order ID')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment Gateway')); ?></th>
                                    <th><?php echo e(__('Payment Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $product_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($data->id); ?></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->total)); ?></td>
                                            <td><?php echo e(str_replace('_',' ',$data->payment_gateway)); ?></td>
                                            <td>
                                                <?php $pay_status = $data->payment_status; ?>
                                                <?php if($pay_status == 'complete'): ?>
                                                    <span class="alert alert-success"><?php echo e(__($pay_status)); ?></span>
                                                <?php elseif($pay_status == 'pending'): ?>
                                                    <span class="alert alert-warning"><?php echo e(__($pay_status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
            <?php if(check_page_permission_by_string('Events Manage') && !empty(get_static_option('events_module_status'))): ?>
                <div class="col-lg-6">
                    <div class="card margin-top-40">
                        <div class="smart-card">
                            <h4 class="title"><?php echo e(__('Recent Event Attendance Booking')); ?></h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th><?php echo e(__('Attendance ID')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $event_attendance_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($data->id); ?></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->event_cost * $data->quantity)); ?></td>
                                            <td>
                                                <?php $pay_status = $data->payment_status; ?>
                                                <?php if($pay_status == 'complete'): ?>
                                                    <span class="alert alert-success"><?php echo e(__($pay_status)); ?></span>
                                                <?php elseif($pay_status == 'pending'): ?>
                                                    <span class="alert alert-warning"><?php echo e(__($pay_status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(check_page_permission_by_string('Donations Manage') && !empty(get_static_option('donations_module_status'))): ?>
                <div class="col-lg-6">
                    <div class="card margin-top-40">
                        <div class="smart-card">
                            <h4 class="title"><?php echo e(__('Recent Donation Logs')); ?></h4>
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <th><?php echo e(__('Donation ID')); ?></th>
                                    <th><?php echo e(__('Amount')); ?></th>
                                    <th><?php echo e(__('Payment Gateway')); ?></th>
                                    <th><?php echo e(__('Payment Status')); ?></th>
                                    <th><?php echo e(__('Date')); ?></th>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $donation_recent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>#<?php echo e($data->id); ?></td>
                                            <td><?php echo e(amount_with_currency_symbol($data->amount)); ?></td>
                                            <td><?php echo e(str_replace('_',' ',$data->payment_gateway)); ?></td>
                                            <td>
                                                <?php $pay_status = $data->status; ?>
                                                <?php if($pay_status == 'complete'): ?>
                                                    <span class="alert alert-success"><?php echo e(__($pay_status)); ?></span>
                                                <?php elseif($pay_status == 'pending'): ?>
                                                    <span class="alert alert-warning"><?php echo e(__($pay_status)); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(check_page_permission_by_string('Price Plan')): ?>
            <div class="col-lg-6">
                <div class="card margin-top-40">
                    <div class="smart-card">
                        <h4 class="title"><?php echo e(__('Recent Package Order')); ?></h4>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <th><?php echo e(__('Order ID')); ?></th>
                                <th><?php echo e(__('Package Name')); ?></th>
                                <th><?php echo e(__('Payment Status')); ?></th>
                                <th><?php echo e(__('Date')); ?></th>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $package_recent_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>#<?php echo e($data->id); ?></td>
                                        <td><?php echo e($data->package_name); ?></td>
                                        <td>
                                            <?php $pay_status = $data->payment_status; ?>
                                            <?php if($pay_status == 'complete'): ?>
                                                <span class="alert alert-success"><?php echo e(__($pay_status)); ?></span>
                                            <?php elseif($pay_status == 'pending'): ?>
                                                <span class="alert alert-warning"><?php echo e(__($pay_status)); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo e(date_format($data->created_at,'d M Y h:i:s')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/backend/admin-home.blade.php ENDPATH**/ ?>