<?php $__env->startSection('page-title'); ?>

    <?php echo e(__('Payment Success For:')); ?> <?php echo e($booking->appointment ? optional(optional($booking->appointment)->lang)->title : __('Untitled')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80">
                        <h1 class="title"><?php echo e(get_static_option('appointment_booking_'.$user_select_lang_slug.'_success_page_title' )); ?></h1>
                        <p><?php echo e(get_static_option('appointment_booking_' . $user_select_lang_slug . '_success_page_description')); ?></p>
                    </div>
                </div>
                <div class="col-lg-8">
                    <h2 class="billing-title"><?php echo e(__('Appointment Details')); ?></h2>
                    <ul class="booking_details_list">
                        <li><strong><?php echo e(__('Id')); ?></strong> : #<?php echo e($booking->id); ?></li>
                        <li><strong><?php echo e(__('Name')); ?></strong> : <?php echo e($booking->name); ?></li>
                        <li><strong><?php echo e(__('Email')); ?></strong> : <?php echo e($booking->email); ?></li>
                        <li><strong><?php echo e(__('Fee')); ?></strong> : <?php echo e(amount_with_currency_symbol($booking->total)); ?></li>
                        <li><strong><?php echo e(__('Payment Gateway')); ?></strong> : <?php echo e($booking->payment_gateway); ?></li>
                        <li><strong><?php echo e(__('Payment Status')); ?></strong> : <?php echo e($booking->payment_status); ?></li>
                        <li><strong><?php echo e(__('Transaction Id')); ?></strong> : <?php echo e($booking->transaction_id); ?></li>
                        <li><strong><?php echo e(__('Appointment Status')); ?></strong> : <?php echo e($booking->status); ?></li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        <?php if(auth()->guard('web')->check()): ?>
                            <a href="<?php echo e(route('user.home')); ?>" class="boxed-btn"><?php echo e(__('Go To Dashboard')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/appointment/payment-success.blade.php ENDPATH**/ ?>