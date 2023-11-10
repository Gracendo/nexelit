<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('donor_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('donor_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('donor_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('donor_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('donor_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="donor-list padding-bottom-90 padding-top-120">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_donation_log; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-3 col-md-6">
                    <div class="single-donor-info">
                        <div class="thumb">
                            <img src="<?php echo e(asset('assets/frontend/img/heart.png')); ?>" alt="">
                        </div>
                        <div class="content">
                            <h4 class="title">
                                <?php if($data->anonymous == 1): ?>
                                    <?php echo e(__('anonymous')); ?>

                                 <?php else: ?>
                                <?php echo e($data->name); ?>

                                <?php endif; ?>
                            </h4>
                            <span class="amount"><?php echo e(__("Donate:")); ?> <?php echo e(amount_with_currency_symbol($data->amount)); ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/donor-list.blade.php ENDPATH**/ ?>