<?php $__env->startSection('section'); ?>
    <div class="row">
        <?php if(!empty(get_static_option('events_module_status'))): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card margin-bottom-30">
                    <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(get_static_option('events_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Booking')); ?></h4>
                        <span class="number"><?php echo e($event_attendances); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-lg-6">
            <div class="user-dashboard-card style-01">
                <div class="icon"><i class="fas fa-money-bill"></i></div>
                <div class="content">
                    <h4 class="title"><?php echo e(__('Package Order')); ?></h4>
                    <span class="number"><?php echo e($package_orders); ?></span>
                </div>
            </div>
        </div>
        <?php if(!empty(get_static_option('product_module_status'))): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card">
                    <div class="icon"><i class="fas fa-shopping-bag"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(get_static_option('product_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Order')); ?></h4>
                        <span class="number"><?php echo e($product_orders); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_static_option('donations_module_status')): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-donate"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(__('Total')); ?> <?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?></h4>
                        <span class="number"><?php echo e($donation); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_static_option('appointment_module_status')): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(get_static_option('appointment_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Booking')); ?></h4>
                        <span class="number"><?php echo e($appointments); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_static_option('course_module_status')): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(get_static_option('courses_page_'.$user_select_lang_slug.'_name')); ?> <?php echo e(__('Enrolled')); ?></h4>
                        <span class="number"><?php echo e($courses); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <?php if(get_static_option('support_ticket_module_status')): ?>
            <div class="col-lg-6">
                <div class="user-dashboard-card style-01">
                    <div class="icon"><i class="fas fa-calendar"></i></div>
                    <div class="content">
                        <h4 class="title"><?php echo e(__('All')); ?> <?php echo e(get_static_option('support_ticket_page_'.$user_select_lang_slug.'_name')); ?></h4>
                        <span class="number"><?php echo e($support_tickets); ?></span>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.dashboard.user-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/user/dashboard/user-home.blade.php ENDPATH**/ ?>