<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success For:')); ?> <?php echo e($order_details->package_name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area margin-bottom-80">
                        <h1 class="title"><?php echo e(get_static_option('site_order_success_page_' . $user_select_lang_slug . '_title')); ?></h1>
                        <p><?php echo e(get_static_option('site_order_success_page_' . $user_select_lang_slug . '_description')); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title"><?php echo e(__('Billing Details')); ?></h2>
                    <ul class="billing-details">
                        <li><strong><?php echo e(__('Order ID')); ?></strong> #<?php echo e($order_details->id); ?></li>
                        <li><strong><?php echo e(__('Name')); ?></strong> <?php echo e($payment_details->name); ?></li>
                        <li><strong><?php echo e(__('Email')); ?></strong> <?php echo e($payment_details->email); ?></li>
                        <li><strong><?php echo e(__('Payment Method')); ?></strong> <?php echo e(str_replace('_',' ',$payment_details->package_gateway)); ?></li>
                        <li><strong><?php echo e(__('Payment Status')); ?></strong> <?php echo e($payment_details->status); ?></li>
                        <li><strong><?php echo e(__('Transaction id')); ?></strong> <?php echo e($payment_details->transaction_id); ?></li>
                    </ul>
                    <div class="btn-wrapper margin-top-40">
                        <?php if(auth()->guard('web')->check()): ?>
                            <a href="<?php echo e(route('user.home')); ?>" class="boxed-btn"><?php echo e(__('Go To Dashboard')); ?></a>
                        <?php else: ?>
                            <a href="<?php echo e(url('/')); ?>" class="boxed-btn"><?php echo e(__('Back To Home')); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="price-plan-wrap">
                        <div class="single-price-plan-01 style-02 active">
                            <div class="price-header">
                                <div class="name-box">
                                    <h4 class="name"><?php echo e($package_details->title); ?></h4>
                                </div>
                                <div class="price-wrap">
                                    <span class="price"><?php echo e(amount_with_currency_symbol($package_details->price)); ?></span><span class="month"><?php echo e($package_details->type); ?></span>
                                </div>
                            </div>
                            <div class="price-body">
                                <ul>
                                    <?php
                                        $features = explode("\n",$package_details->features);
                                    ?>
                                    <?php $__currentLoopData = $features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($item); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                            <div class="btn-wrapper text-center">
                                <?php if(!empty($package_details->url_status)): ?>
                                    <a class="order-btn boxed-btn" href="<?php echo e(route('frontend.plan.order',$package_details->id)); ?>"><?php echo e($package_details->btn_text); ?></a>
                                <?php else: ?>
                                    <a class="order-btn boxed-btn" href="<?php echo e($package_details->btn_url); ?>"><?php echo e($package_details->btn_text); ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/payment/payment-success.blade.php ENDPATH**/ ?>