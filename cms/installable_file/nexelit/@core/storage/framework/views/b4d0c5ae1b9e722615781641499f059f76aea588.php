<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Course Enroll Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                       <div class="header-wrap d-flex justify-content-between margin-bottom-40">
                           <h4 class="header-title"><?php echo e(__('Course Enroll Details')); ?></h4>
                           <a href="<?php echo e(route('admin.courses.enroll.all')); ?>" class="btn btn-info"><?php echo e(__('All Course Enrollment')); ?></a>
                       </div>
                        <div class="booking-details-info">
                            <ul>
                                <li><strong><?php echo e(__('Enroll Id')); ?></strong> : #<?php echo e($enroll_details->id); ?></li>
                                <li><strong><?php echo e(__('Name')); ?></strong> : <?php echo e($enroll_details->name); ?></li>
                                <li><strong><?php echo e(__('Email')); ?></strong> : <?php echo e($enroll_details->email); ?></li>
                                <li><strong> <?php echo e(get_static_option('courses_page_'.get_default_language().'_name')); ?> <?php echo e(__('Name')); ?></strong> : <?php echo e($enroll_details->course->lang_front->title ?? __('Untitled')); ?></li>
                                <li><strong><?php echo e(__('Price')); ?></strong> :
                                    <?php echo e(amount_with_currency_symbol(course_discounted_amount($enroll_details->total,$enroll_details->coupon))); ?>

                                    <?php if(!empty($enroll_details->coupon)): ?>
                                        <del> <?php echo e(amount_with_currency_symbol($enroll_details->total)); ?></del>
                                    <?php endif; ?>
                                </li>
                                <?php if(!empty($enroll_details->coupon)): ?>
                                    <li><strong><?php echo e(__('Coupon')); ?></strong> : <?php echo e($enroll_details->coupon); ?></li>
                                <?php endif; ?>
                                <?php if(!empty($enroll_details->coupon)): ?>
                                    <li><strong><?php echo e(__('Discount')); ?></strong> : <?php echo e(amount_with_currency_symbol($enroll_details->coupon_discounted)); ?></li>
                                <?php endif; ?>
                                <li><strong><?php echo e(__('Payment Gateway')); ?></strong> : <?php echo e($enroll_details->payment_gateway); ?></li>
                                <li><strong><?php echo e(__('Payment Status')); ?></strong> : <?php echo e($enroll_details->payment_status); ?></li>
                                <li><strong><?php echo e(__('Transaction Id')); ?></strong> : <?php echo e($enroll_details->transaction_id); ?></li>
                                <li><strong><?php echo e(__('Enrollment Status')); ?></strong> : <?php echo e($enroll_details->status); ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/backend/courses/course-enroll-view.blade.php ENDPATH**/ ?>