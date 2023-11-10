<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success For:'.' '.$attendance_details->event_name)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-50">
                        <h1 class="title"><?php echo e(get_static_option('event_success_page_' . $user_select_lang_slug . '_title')); ?></h1>
                        <p><?php echo e(get_static_option('event_success_page_' . $user_select_lang_slug . '_description')); ?></p>

                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title"><?php echo e(__('Billing Details')); ?></h2>
                    <ul class="billing-details">
                        <li><strong><?php echo e(__('Attendance ID')); ?>:</strong> #<?php echo e($payment_log->id); ?></li>
                        <li><strong><?php echo e(__('Name')); ?>:</strong> <?php echo e($payment_log->name); ?></li>
                        <li><strong><?php echo e(__('Email')); ?>:</strong> <?php echo e($payment_log->email); ?></li>
                        <li><strong><?php echo e(__('Payment Method')); ?>:</strong> <?php echo e(str_replace('_',' ',$payment_log->package_gateway)); ?></li>
                        <li><strong><?php echo e(__('Payment Status')); ?>:</strong> <?php echo e($payment_log->status); ?></li>
                        <li><strong><?php echo e(__('Transaction id')); ?>:</strong> <?php echo e($payment_log->transaction_id); ?></li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        <?php if(auth()->guard('web')->check()): ?>
                            <a href="<?php echo e(route('user.home')); ?>" class="boxed-btn"><?php echo e(__('Go To Dashboard')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="event-single-wrap">
                        <div class="single-events-list-item event-order-success-page">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($event_details->image); ?>

                            </div>
                            <div class="content-area">
                                <div class="top-part">
                                    <div class="time-wrap">
                                        <span class="date"><?php echo e(date('d',strtotime($event_details->date))); ?></span>
                                        <span class="month"><?php echo e(date('M',strtotime($event_details->date))); ?></span>
                                    </div>
                                    <div class="title-wrap">
                                        <a href="<?php echo e(route('frontend.events.single',$event_details->slug)); ?>"><h4 class="title"><?php echo e($event_details->title); ?></h4></a>
                                        <span class="location"><i class="fas fa-map-marker-alt"></i> <?php echo e($event_details->venue_location); ?></span>
                                    </div>
                                </div>
                                <p><?php echo e(strip_tags(Str::words(str_replace('&nbsp;',' ',$event_details->content),20))); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/public_html/laravel/nexelit/@core/resources/views/frontend/pages/events/attendance-success.blade.php ENDPATH**/ ?>