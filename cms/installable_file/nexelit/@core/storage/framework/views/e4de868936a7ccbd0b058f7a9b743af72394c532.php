<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('donation_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('donation_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="donation-content-area padding-top-120 padding-bottom-90">
        <div class="container">
            <div class="row">
                        <?php $__currentLoopData = $all_donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4">
                            <div class="contribute-single-item">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image,'','grid'); ?>

                                    <div class="thumb-content">
                                        <div class="progress-item">
                                            <div class="single-progressbar">
                                                <div class="donation-progress" data-percent="<?php echo e(get_percentage($data->amount,$data->raised)); ?>"></div>
                                            </div>
                                        </div>
                                        <div class="goal">
                                            <h4 class="raised"><?php echo e(get_static_option('donation_raised_'.$user_select_lang_slug.'_text')); ?> <?php if(!empty($data->raised)): ?><?php echo e(amount_with_currency_symbol($data->raised)); ?><?php else: ?> <?php echo e(amount_with_currency_symbol(0)); ?> <?php endif; ?></h4>
                                            <h4 class="raised"><?php echo e(get_static_option('donation_goal_'.$user_select_lang_slug.'_text')); ?> <?php echo e(amount_with_currency_symbol($data->amount)); ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="content">
                                    <a href="<?php echo e(route('frontend.donations.single',$data->slug)); ?>"><h4 class="title"><?php echo e($data->title); ?></h4></a>
                                    <p><?php echo e(strip_tags(Str::words(strip_tags($data->donation_content),20))); ?></p>
                                    <div class="btn-wrapper">
                                        <a href="<?php echo e(route('frontend.donations.single',$data->slug)); ?>" class="boxed-btn"><?php echo e(get_static_option('donation_button_'.$user_select_lang_slug.'_text')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-12 text-center">
                        <nav class="pagination-wrapper " aria-label="Page navigation ">
                            <?php echo e($all_donations->links()); ?>

                        </nav>
                    </div>
            </div>
        </div>
    </section>
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

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/donations/donation.blade.php ENDPATH**/ ?>