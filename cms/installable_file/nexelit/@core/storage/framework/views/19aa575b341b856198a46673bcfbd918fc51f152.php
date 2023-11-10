<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Payment Success For:'.' '.$donation_logs->donation->title)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="error-page-content padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="order-success-area">
                        <h1 class="title"><?php echo e(get_static_option('donation_success_page_' . $user_select_lang_slug . '_title')); ?></h1>
                        <p><?php echo e(get_static_option('donation_success_page_' . $user_select_lang_slug . '_description')); ?></p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="billing-title"><?php echo e(__('Donor Details')); ?></h2>
                    <ul class="billing-details">
                        <li><strong><?php echo e(__('Donation Log ID')); ?>:</strong> #<?php echo e($donation_logs->id); ?></li>
                        <li><strong><?php echo e(__('Name')); ?>:</strong> <?php echo e($donation_logs->name); ?></li>
                        <li><strong><?php echo e(__('Email')); ?>:</strong> <?php echo e($donation_logs->email); ?></li>
                        <li><strong><?php echo e(__('Payment Method')); ?>:</strong>  <?php echo e(str_replace('_',' ',$donation_logs->payment_gateway)); ?></li>
                        <li><strong><?php echo e(__('Payment Status')); ?>:</strong> <?php echo e($donation_logs->status); ?></li>
                        <li><strong><?php echo e(__('Transaction id')); ?>:</strong> <?php echo e($donation_logs->transaction_id); ?></li>
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
                    <div class="donation-wrap donation-success-page">
                        <div class="contribute-single-item">
                            <div class="thumb">
                                <?php echo render_image_markup_by_attachment_id($donation->image,'','grid'); ?>

                                <div class="thumb-content">
                                    <div class="progress-item">
                                        <div class="single-progressbar">
                                            <div class="donation-progress" data-percent="<?php echo e(get_percentage($donation->amount,$donation->raised)); ?>"></div>
                                        </div>
                                    </div>
                                    <div class="goal">
                                        <h4 class="raised"><?php echo e(get_static_option('donation_raised_'.$user_select_lang_slug.'_text')); ?> <?php if(!empty($donation->raised)): ?><?php echo e(amount_with_currency_symbol($donation->raised)); ?><?php else: ?> <?php echo e(amount_with_currency_symbol(0)); ?> <?php endif; ?></h4>
                                        <h4 class="raised"><?php echo e(get_static_option('donation_goal_'.$user_select_lang_slug.'_text')); ?> <?php echo e(amount_with_currency_symbol($donation->amount)); ?></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <a href="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>"><h4 class="title"><?php echo e($donation->title); ?></h4></a>
                                <p><?php echo e(strip_tags(Str::words(strip_tags($donation->donation_content),20))); ?></p>
                                <div class="btn-wrapper">
                                    <a href="<?php echo e(route('frontend.donations.single',$donation->slug)); ?>" class="boxed-btn"><?php echo e(get_static_option('donation_button_'.$user_select_lang_slug.'_text')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/frontend/js/jQuery.rProgressbar.min.js')); ?>"></script>
    <script>
        (function($) {
            'use strict';
            var allProgress =  $('.donation-progress');
            $.each(allProgress,function (index, value) {
                $(this).rProgressbar({
                    percentage: $(this).data('percent'),
                    fillBackgroundColor: "<?php echo e(get_static_option('site_color')); ?>"
                });
            })
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/donations/donation-success.blade.php ENDPATH**/ ?>