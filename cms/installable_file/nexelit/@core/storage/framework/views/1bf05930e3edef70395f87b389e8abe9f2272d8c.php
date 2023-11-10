<?php $__env->startSection('site-title'); ?>
    <?php echo e(get_static_option('testimonial_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(get_static_option('testimonial_page_'.$user_select_lang_slug.'_name')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-meta-data'); ?>
    <meta name="description" content="<?php echo e(get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_description')); ?>">
    <meta name="tags" content="<?php echo e(get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_tags')); ?>">
    <?php echo render_og_meta_image_by_attachment_id(get_static_option('testimonial_page_'.$user_select_lang_slug.'_meta_image')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="testimonial-area bg-image padding-top-110 padding-bottom-40">
        <div class="container">
            <div class="row">
                <?php $__currentLoopData = $all_testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-lg-6">
                        <div class="single-testimonial-item-02 margin-bottom-60">
                        <div class="content">
                            <div class="content-wrapper">
                                <p class="description"><?php echo e($data->description); ?></p>
                                <div class="icon">
                                    <i class="flaticon-right-quote-1"></i>
                                </div>
                            </div>
                            <div class="author-details">
                                <div class="thumb">
                                    <?php echo render_image_markup_by_attachment_id($data->image); ?>

                                </div>
                                <div class="author-meta">
                                    <h4 class="title"><?php echo e($data->name); ?></h4>
                                    <span class="designation"><?php echo e($data->designation); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col-lg-12">
                    <nav class="pagination-wrapper" aria-label="Page navigation ">
                        <?php echo e($all_testimonials->links()); ?>

                    </nav>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.frontend-page-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/xgenxchi/nexelit.xgenious.com/@core/resources/views/frontend/pages/testimonial-page.blade.php ENDPATH**/ ?>