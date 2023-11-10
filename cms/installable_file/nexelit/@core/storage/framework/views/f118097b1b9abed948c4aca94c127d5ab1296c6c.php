<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('faq_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('faq_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('faq_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('faq_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('faq_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="faq-page-content-area padding-120">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion-wrapper">
                        <?php $rand_number = rand(9999,99999999); ?>
                        <div id="accordion_<?php echo e($rand_number); ?>">
                            <?php $__currentLoopData = $all_faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $aria_expanded = 'false';
                                    if($data->is_open == 'on'){ $aria_expanded = 'true'; }
                                ?>
                                <div class="card" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                                    <div class="card-header" id="headingOne_<?php echo e($key); ?>" itemprop="name">
                                        <h5 class="mb-0">
                                            <a data-toggle="collapse" data-target="#collapseOne_<?php echo e($key); ?>" role="button"
                                               aria-expanded="<?php echo e($aria_expanded); ?>" aria-controls="collapseOne_<?php echo e($key); ?>">
                                                <?php echo e($data->title); ?>

                                            </a>
                                        </h5>
                                    </div>

                                    <div id="collapseOne_<?php echo e($key); ?>" class="collapse <?php if($data->is_open == 'on'): ?> show <?php endif; ?> "
                                         aria-labelledby="headingOne_<?php echo e($key); ?>" data-parent="#accordion_<?php echo e($rand_number); ?>" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                                        <div class="card-body" itemprop="text">
                                            <?php echo $data->description; ?>

                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/faq-page.blade.php ENDPATH**/ ?>