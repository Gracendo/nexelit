<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Order Cancelled Of:'.' '.$order_details->package_name)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-cancel-area">
                        <h1 class="title"><?php echo e(get_static_option('site_order_cancel_page_' . $user_select_lang_slug . '_title')); ?></h1>
                        <h3 class="sub-title">
                            <?php
                                $subtitle = get_static_option('site_order_cancel_page_' . $user_select_lang_slug . '_subtitle');
                                $subtitle = str_replace('{pkname}',$order_details->package_name,$subtitle);
                            ?>
                            <?php echo e($subtitle); ?>

                        </h3>
                        <p>
                            <?php echo e(get_static_option('site_order_cancel_page_' . $user_select_lang_slug . '_description')); ?>

                        </p>
                        <div class="btn-wrapper">
                            <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/payment/payment-cancel.blade.php ENDPATH**/ ?>